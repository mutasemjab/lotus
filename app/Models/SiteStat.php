<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteStat extends Model
{
    protected $fillable = ['value', 'suffix', 'label_en', 'label_ar', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function label(): string
    {
        return $this->{'label_' . app()->getLocale()} ?: $this->label_en;
    }
}
