<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    protected $fillable = [
        'label_en', 'label_ar', 'phone',
        'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function label(): string
    {
        $locale = app()->getLocale();
        return $this->{'label_' . $locale} ?: ($this->label_en ?: '');
    }
}
