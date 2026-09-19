<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = [
        'step_number',
        'title_en', 'title_ar',
        'description_en', 'description_ar',
        'sort_order',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function field(string $name): ?string
    {
        $locale = app()->getLocale();
        return $this->{$name . '_' . $locale} ?? $this->{$name . '_en'};
    }
}
