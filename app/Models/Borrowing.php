<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $fillable = [
        'borrower_name',
        'division',
        'borrow_date',
        'due_date',
        'return_date',
        'return_condition',
        'return_note',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    protected $appends = [
        'display_status',
        'display_status_label',
    ];

    public function details()
    {
        return $this->hasMany(BorrowingDetail::class);
    }

    public function getDisplayStatusAttribute(): string
    {
        $status = $this->status ?? 'borrowed';

        if (
            $status === 'borrowed' &&
            $this->due_date &&
            now()->toDateString() > $this->due_date->toDateString()
        ) {
            return 'overdue';
        }

        return $status;
    }

    public function getDisplayStatusLabelAttribute(): string
    {
        return match ($this->display_status) {
            'overdue' => __('app.overdue'),
            'returned' => __('app.returned'),
            default => __('app.borrowed'),
        };
    }
}
