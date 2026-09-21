<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapCountry extends Model
{
    protected $fillable = [
        'code', 'name_en', 'name_ar',
        'latitude', 'longitude',
        'is_hub', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'latitude'  => 'float',
        'longitude' => 'float',
        'is_hub'    => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function name(): string
    {
        return $this->{'name_' . app()->getLocale()} ?: $this->name_en;
    }

    /** Local flag if we have one, otherwise the flagcdn.com SVG. */
    public function flagUrl(): string
    {
        $code = strtolower($this->code);

        return file_exists(base_path("assets_front/flags/{$code}.svg"))
            ? asset("assets_front/flags/{$code}.svg")
            : "https://flagcdn.com/{$code}.svg";
    }
}
