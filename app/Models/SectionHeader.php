<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHeader extends Model
{
    protected $fillable = [
        'section_key',
        'eyebrow_en', 'eyebrow_ar',
        'title_en', 'title_ar',
        'subtitle_en', 'subtitle_ar',
    ];

    public static function forSection(string $key): self
    {
        return static::firstOrNew(['section_key' => $key]);
    }

    public function field(string $name): ?string
    {
        $locale = app()->getLocale();
        return $this->{$name . '_' . $locale} ?? $this->{$name . '_en'};
    }
}
