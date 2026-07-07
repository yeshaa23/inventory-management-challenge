<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $locations = Product::select('location')
            ->whereNotNull('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('name', 'like', "%{$request->search}%")
                        ->orWhere('code', 'like', "%{$request->search}%")
                        ->orWhere('location', 'like', "%{$request->search}%");
                });
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->condition, function ($query) use ($request) {
                if ($request->condition === Product::CONDITION_GOOD) {
                    $query->where('good_stock', '>', 0);
                }

                if ($request->condition === Product::CONDITION_MINOR_DAMAGE) {
                    $query->where('minor_damage_stock', '>', 0);
                }

                if ($request->condition === Product::CONDITION_MAJOR_DAMAGE) {
                    $query->where('major_damage_stock', '>', 0);
                }
            })
            ->when($request->location, function ($query) use ($request) {
                $query->where('location', $request->location);
            })
            ->when($request->stock_status, function ($query) use ($request) {
                if ($request->stock_status === 'available') {
                    $query->where('good_stock', '>', 5);
                }

                if ($request->stock_status === 'low_stock') {
                    $query->whereBetween('good_stock', [1, 5]);
                }

                if ($request->stock_status === 'out_of_stock') {
                    $query->where('stock', '<=', 0);
                }

                if ($request->stock_status === 'damaged') {
                    $query->where(function ($subQuery) {
                        $subQuery->where('minor_damage_stock', '>', 0)
                            ->orWhere('major_damage_stock', '>', 0);
                    });
                }
            });

        match ($request->sort) {
            'name_asc' => $products->orderBy('name', 'asc'),
            'stock_asc' => $products->orderBy('stock', 'asc'),
            'stock_desc' => $products->orderBy('stock', 'desc'),
            'oldest' => $products->oldest(),
            default => $products->latest(),
        };

        $products = $products->paginate(10)->withQueryString();

        return view('products.index', compact(
            'products',
            'categories',
            'locations'
        ));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        $locations = Product::select('location')
            ->whereNotNull('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('products.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->productRules());

        $location = $this->resolveLocation($request);

        if ($this->duplicateProductExists($request, $location)) {
            return back()
                ->withErrors([
                    'name' => __('app.error_duplicate_product'),
                ])
                ->withInput();
        }

        $data = [
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'location' => $location,
        ];

        $data = array_merge($data, $this->stockData($request));

        $data['code'] = $request->filled('code')
            ? $request->code
            : $this->generateProductCode((int) $request->category_id);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        ActivityLog::record(
            'create',
            'products',
            'Menambahkan barang baru: ' . $product->name,
            $product->toArray()
        );

        return redirect()
            ->route('products.index')
            ->with('success', __('app.success_create_product'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        $locations = Product::select('location')
            ->whereNotNull('location')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('products.edit', compact('product', 'categories', 'locations'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate($this->productRules($product));

        $location = $this->resolveLocation($request);

        if ($this->duplicateProductExists($request, $location, $product)) {
            return back()
                ->withErrors([
                    'name' => __('app.error_duplicate_product'),
                ])
                ->withInput();
        }

        $oldData = $product->toArray();

        $data = [
            'category_id' => $validated['category_id'],
            'code' => $validated['code'],
            'name' => $validated['name'],
            'location' => $location,
        ];

        $data = array_merge($data, $this->stockData($request));

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        ActivityLog::record(
            'update',
            'products',
            'Memperbarui data barang: ' . $product->name,
            [
                'before' => $oldData,
                'after' => $product->fresh()->toArray(),
            ]
        );

        return redirect()
            ->route('products.index')
            ->with('success', __('app.success_update_product'));
    }

    public function destroy(Product $product)
    {
        $productName = $product->name;
        $productData = $product->toArray();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        ActivityLog::record(
            'delete',
            'products',
            'Menghapus barang: ' . $productName,
            $productData
        );

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', __('app.success_delete_product'));
    }

    public function generateCodePreview(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
        ]);

        $code = $this->generateProductCode((int) $request->category_id);

        return response()->json([
            'code' => $code,
        ]);
    }

    private function productRules(?Product $product = null): array
    {
        $productId = $product?->id;

        return [
            'category_id' => 'required|exists:categories,id',
            'code' => $product ? 'required|string|max:255|unique:products,code,' . $productId : 'nullable|string|max:255|unique:products,code',
            'name' => 'required|string|max:255',
            'good_stock' => 'required|integer|min:0',
            'minor_damage_stock' => 'required|integer|min:0',
            'major_damage_stock' => 'required|integer|min:0',
            'location_select' => 'required|string|max:255',
            'location_other' => 'nullable|required_if:location_select,other|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    private function stockData(Request $request): array
    {
        $goodStock = (int) $request->input('good_stock', 0);
        $minorDamageStock = (int) $request->input('minor_damage_stock', 0);
        $majorDamageStock = (int) $request->input('major_damage_stock', 0);

        return [
            'good_stock' => $goodStock,
            'minor_damage_stock' => $minorDamageStock,
            'major_damage_stock' => $majorDamageStock,
            'stock' => Product::totalFromCounts($goodStock, $minorDamageStock, $majorDamageStock),
            'condition' => Product::conditionFromCounts($goodStock, $minorDamageStock, $majorDamageStock),
        ];
    }

    private function resolveLocation(Request $request): string
    {
        return $request->location_select === 'other'
            ? $request->location_other
            : $request->location_select;
    }

    private function duplicateProductExists(Request $request, string $location, ?Product $product = null): bool
    {
        return Product::where('name', $request->name)
            ->where('category_id', $request->category_id)
            ->where('location', $location)
            ->when($product, fn ($query) => $query->where('id', '!=', $product->id))
            ->exists();
    }

    private function generateProductCode(int $categoryId): string
    {
        $category = Category::find($categoryId);

        $categoryName = $category?->name ?? 'Barang';

        $prefix = preg_replace('/[^A-Za-z]/', '', $categoryName);
        $prefix = Str::upper(Str::substr($prefix, 0, 3));

        if (!$prefix) {
            $prefix = 'BRG';
        }

        $lastProduct = Product::where('code', 'like', $prefix . '-%')
            ->orderByDesc('id')
            ->first();

        $nextNumber = 1;

        if ($lastProduct) {
            $lastNumber = (int) Str::afterLast($lastProduct->code, '-');
            $nextNumber = $lastNumber + 1;
        }

        return $prefix . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
