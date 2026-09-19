<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactLocation extends Model
{
    protected $fillable = [
        'title_en', 'title_ar',
        'address_en', 'address_ar',
        'maps_link',
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
