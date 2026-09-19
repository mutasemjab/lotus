<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutStat extends Model
{
    protected $fillable = ['value', 'label_en', 'label_ar', 'sort_order'];

    public function label(): string
    {
        $locale = app()->getLocale();
        return $this->{'label_' . $locale} ?: $this->label_en;
    }
}
