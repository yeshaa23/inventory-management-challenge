<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public const CONDITION_GOOD = 'Baik';
    public const CONDITION_MINOR_DAMAGE = 'Rusak Ringan';
    public const CONDITION_MAJOR_DAMAGE = 'Rusak Berat';

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'stock',
        'good_stock',
        'minor_damage_stock',
        'major_damage_stock',
        'location',
        'condition',
        'image',
    ];

    protected $casts = [
        'stock' => 'integer',
        'good_stock' => 'integer',
        'minor_damage_stock' => 'integer',
        'major_damage_stock' => 'integer',
    ];

    protected $appends = [
        'available_stock',
        'damaged_stock',
        'condition_summary',
        'stock_status',
        'stock_status_label',
    ];

    protected static function booted(): void
    {
        static::saving(function (Product $product): void {
            $product->normalizeLegacyStockFields();
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    public function scopeAvailableForBorrowing(Builder $query): Builder
    {
        return $query->where('good_stock', '>', 0);
    }

    public static function conditionFromCounts(int $goodStock, int $minorDamageStock, int $majorDamageStock): string
    {
        if ($majorDamageStock > 0) {
            return self::CONDITION_MAJOR_DAMAGE;
        }

        if ($minorDamageStock > 0) {
            return self::CONDITION_MINOR_DAMAGE;
        }

        return self::CONDITION_GOOD;
    }

    public static function totalFromCounts(int $goodStock, int $minorDamageStock, int $majorDamageStock): int
    {
        return $goodStock + $minorDamageStock + $majorDamageStock;
    }

    public function syncStockFromConditionCounts(): void
    {
        $goodStock = max((int) $this->good_stock, 0);
        $minorDamageStock = max((int) $this->minor_damage_stock, 0);
        $majorDamageStock = max((int) $this->major_damage_stock, 0);

        $this->good_stock = $goodStock;
        $this->minor_damage_stock = $minorDamageStock;
        $this->major_damage_stock = $majorDamageStock;

        $this->stock = self::totalFromCounts(
            $goodStock,
            $minorDamageStock,
            $majorDamageStock
        );

        $this->condition = self::conditionFromCounts(
            $goodStock,
            $minorDamageStock,
            $majorDamageStock
        );
    }

    public function normalizeLegacyStockFields(): void
    {
        /*
         * Backward compatibility:
         * Existing tests and older code may still create products using only:
         * stock + condition.
         *
         * The new UI sends:
         * good_stock + minor_damage_stock + major_damage_stock.
         *
         * If the new fields are not explicitly provided, convert the old stock
         * value into the correct stock-per-condition column before saving.
         */
        $attributes = $this->getAttributes();

        $hasStockConditionColumns =
            array_key_exists('good_stock', $attributes)
            || array_key_exists('minor_damage_stock', $attributes)
            || array_key_exists('major_damage_stock', $attributes);

        if (! $hasStockConditionColumns && array_key_exists('stock', $attributes)) {
            $stock = max((int) ($attributes['stock'] ?? 0), 0);
            $condition = $attributes['condition'] ?? self::CONDITION_GOOD;

            $this->good_stock = $condition === self::CONDITION_GOOD ? $stock : 0;
            $this->minor_damage_stock = $condition === self::CONDITION_MINOR_DAMAGE ? $stock : 0;
            $this->major_damage_stock = $condition === self::CONDITION_MAJOR_DAMAGE ? $stock : 0;

            $this->syncStockFromConditionCounts();

            return;
        }

        if ($hasStockConditionColumns) {
            $this->syncStockFromConditionCounts();
        }
    }

    public function getAvailableStockAttribute(): int
    {
        if (! $this->hasConditionStockColumns()) {
            return $this->condition === self::CONDITION_GOOD
                ? max((int) $this->stock, 0)
                : 0;
        }

        return max((int) ($this->good_stock ?? 0), 0);
    }

    public function getDamagedStockAttribute(): int
    {
        if (! $this->hasConditionStockColumns()) {
            return $this->condition !== self::CONDITION_GOOD
                ? max((int) $this->stock, 0)
                : 0;
        }

        return max((int) ($this->minor_damage_stock ?? 0), 0)
            + max((int) ($this->major_damage_stock ?? 0), 0);
    }

    public function getConditionSummaryAttribute(): string
    {
        return __('app.good') . ': ' . (int) $this->available_stock
            . ' | ' . __('app.minor_damage') . ': ' . max((int) ($this->minor_damage_stock ?? 0), 0)
            . ' | ' . __('app.major_damage') . ': ' . max((int) ($this->major_damage_stock ?? 0), 0);
    }

    public function getStockStatusAttribute(): string
    {
        /*
         * Legacy compatibility:
         * Product::make([
         *     'stock' => 10,
         *     'condition' => 'Rusak Ringan',
         * ]);
         *
         * Unit tests may use an unsaved model like this, so condition stock
         * columns are not available yet. In that case, keep the old status.
         */
        if (! $this->hasConditionStockColumns()) {
            $stock = max((int) ($this->stock ?? 0), 0);
            $condition = $this->condition ?? self::CONDITION_GOOD;

            if ($stock <= 0) {
                return 'out_of_stock';
            }

            if ($condition !== self::CONDITION_GOOD) {
                return 'damaged';
            }

            if ($stock <= 5) {
                return 'low_stock';
            }

            return 'available';
        }

        /*
         * New logic:
         * Main stock status is based on good stock only.
         * Damaged units are shown in separate minor/major damage columns.
         */
        $availableStock = max((int) ($this->good_stock ?? 0), 0);

        if ($availableStock <= 0) {
            return 'out_of_stock';
        }

        if ($availableStock <= 5) {
            return 'low_stock';
        }

        return 'available';
    }

    public function getStockStatusLabelAttribute(): string
    {
        return match ($this->stock_status) {
            'out_of_stock' => __('app.out_of_stock'),
            'low_stock' => __('app.low_stock'),
            'damaged' => app()->getLocale() === 'id' ? 'Perlu Perhatian' : 'Needs Attention',
            default => __('app.available'),
        };
    }

    private function hasConditionStockColumns(): bool
    {
        $attributes = $this->getAttributes();

        return array_key_exists('good_stock', $attributes)
            || array_key_exists('minor_damage_stock', $attributes)
            || array_key_exists('major_damage_stock', $attributes);
    }
}
