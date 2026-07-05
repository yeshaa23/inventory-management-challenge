<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'code',
        'name',
        'stock',
        'location',
        'condition',
        'image',
    ];

    protected $appends = [
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

    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) {
            return 'out_of_stock';
        }

        if ($this->stock <= 5) {
            return 'low_stock';
        }

        if ($this->condition !== 'Baik') {
            return 'damaged';
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
