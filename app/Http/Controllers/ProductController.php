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
                $query->where('condition', $request->condition);
            })
            ->when($request->location, function ($query) use ($request) {
                $query->where('location', $request->location);
            })
            ->when($request->stock_status, function ($query) use ($request) {
                if ($request->stock_status === 'available') {
                    $query->where('stock', '>', 5)
                        ->where('condition', 'Baik');
                }

                if ($request->stock_status === 'low_stock') {
                    $query->whereBetween('stock', [1, 5]);
                }

                if ($request->stock_status === 'out_of_stock') {
                    $query->where('stock', '<=', 0);
                }

                if ($request->stock_status === 'damaged') {
                    $query->where('condition', '!=', 'Baik');
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

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'nullable|string|max:255|unique:products,code',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'condition' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $duplicateExists = Product::where('name', $request->name)
            ->where('category_id', $request->category_id)
            ->where('location', $request->location)
            ->exists();

        if ($duplicateExists) {
            return back()
                ->withErrors([
                    'name' => 'Barang dengan nama, kategori, dan lokasi yang sama sudah tersedia.',
                ])
                ->withInput();
        }

        $data = $request->only([
            'category_id',
            'name',
            'stock',
            'location',
            'condition',
        ]);

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
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:255|unique:products,code,' . $product->id,
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'location' => 'required|string|max:255',
            'condition' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $duplicateExists = Product::where('name', $request->name)
            ->where('category_id', $request->category_id)
            ->where('location', $request->location)
            ->where('id', '!=', $product->id)
            ->exists();

        if ($duplicateExists) {
            return back()
                ->withErrors([
                    'name' => 'Barang dengan nama, kategori, dan lokasi yang sama sudah tersedia.',
                ])
                ->withInput();
        }

        $oldData = $product->toArray();

        $data = $request->only([
            'category_id',
            'code',
            'name',
            'stock',
            'location',
            'condition',
        ]);

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
            ->with('success', 'Barang berhasil diperbarui.');
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
            ->with('success', 'Barang berhasil dihapus.');
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
