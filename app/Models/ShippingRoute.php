<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRoute extends Model
{
    protected $fillable = [
        'shipping_mode_id', 'from_en', 'from_ar', 'to_en', 'to_ar',
        'is_bidirectional', 'sort_order',
    ];

    protected $casts = ['is_bidirectional' => 'boolean'];

    public function mode()
    {
        return $this->belongsTo(ShippingMode::class, 'shipping_mode_id');
    }

    public function field(string $name): ?string
    {
        return $this->{$name . '_' . app()->getLocale()} ?: $this->{$name . '_en'};
    }
}
