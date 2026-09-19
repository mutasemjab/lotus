<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'eyebrow_en', 'eyebrow_ar',
        'title_en', 'title_ar',
        'paragraph1_en', 'paragraph1_ar',
        'paragraph2_en', 'paragraph2_ar',
        'image', 'badge_number',
        'badge_text_en', 'badge_text_ar',
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
