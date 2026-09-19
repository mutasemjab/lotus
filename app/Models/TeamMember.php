<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name_en', 'name_ar',
        'role_en', 'role_ar',
        'description_en', 'description_ar',
        'phone', 'initials', 'image',
        'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function field(string $name): ?string
    {
        $locale = app()->getLocale();
        return $this->{$name . '_' . $locale} ?? $this->{$name . '_en'};
    }
}
