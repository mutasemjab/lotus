<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMode extends Model
{
    public const ICONS = ['sea', 'air', 'land'];

    protected $fillable = [
        'icon', 'tag_en', 'tag_ar', 'title_en', 'title_ar',
        'link', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function routes()
    {
        return $this->hasMany(ShippingRoute::class)->orderBy('sort_order')->orderBy('id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function field(string $name): ?string
    {
        return $this->{$name . '_' . app()->getLocale()} ?: $this->{$name . '_en'};
    }
}
