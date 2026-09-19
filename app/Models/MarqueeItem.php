<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarqueeItem extends Model
{
    protected $fillable = ['text_en', 'text_ar', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function text(): string
    {
        $locale = app()->getLocale();
        return $this->{'text_' . $locale} ?: $this->text_en;
    }
}
