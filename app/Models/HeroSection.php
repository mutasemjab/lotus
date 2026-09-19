<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'kicker_en', 'kicker_ar',
        'title_en', 'title_ar',
        'lead_en', 'lead_ar',
        'btn1_text_en', 'btn1_text_ar', 'btn1_link',
        'btn2_text_en', 'btn2_text_ar', 'btn2_link',
    ];

    public static function current(): self
    {
        return static::firstOrNew(['id' => 1]);
    }

    public function field(string $name): ?string
    {
        $locale = app()->getLocale();
        return $this->{$name . '_' . $locale} ?? $this->{$name . '_en'};
    }
}
