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
        $goodStock = (int) $this->good_stock;
        $minorDamageStock = (int) $this->minor_damage_stock;
        $majorDamageStock = (int) $this->major_damage_stock;

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

    public function getAvailableStockAttribute(): int
    {
        return (int) ($this->good_stock ?? 0);
    }

    public function getDamagedStockAttribute(): int
    {
        return (int) ($this->minor_damage_stock ?? 0)
            + (int) ($this->major_damage_stock ?? 0);
    }

    public function getConditionSummaryAttribute(): string
    {
        return __('app.good') . ': ' . (int) $this->good_stock
            . ' | ' . __('app.minor_damage') . ': ' . (int) $this->minor_damage_stock
            . ' | ' . __('app.major_damage') . ': ' . (int) $this->major_damage_stock;
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) {
            return 'out_of_stock';
        }

        if ($this->available_stock <= 0 && $this->damaged_stock > 0) {
            return 'damaged';
        }

        if ($this->available_stock > 0 && $this->available_stock <= 5) {
            return 'low_stock';
        }

        return 'available';
    }

    public function getStockStatusLabelAttribute(): string
    {
        return match ($this->stock_status) {
            'out_of_stock' => __('app.out_of_stock'),
            'low_stock' => __('app.low_stock'),
            'damaged' => __('app.damaged'),
            default => __('app.available'),
        };
    }
}
