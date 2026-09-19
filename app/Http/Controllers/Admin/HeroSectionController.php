<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::current();
        return view('admin.website.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'kicker_en'    => 'nullable|string|max:255',
            'kicker_ar'    => 'nullable|string|max:255',
            'title_en'     => 'nullable|string|max:1000',
            'title_ar'     => 'nullable|string|max:1000',
            'lead_en'      => 'nullable|string|max:2000',
            'lead_ar'      => 'nullable|string|max:2000',
            'btn1_text_en' => 'nullable|string|max:100',
            'btn1_text_ar' => 'nullable|string|max:100',
            'btn1_link'    => 'nullable|string|max:255',
            'btn2_text_en' => 'nullable|string|max:100',
            'btn2_text_ar' => 'nullable|string|max:100',
            'btn2_link'    => 'nullable|string|max:255',
        ]);

        HeroSection::updateOrCreate(['id' => 1], $data);

        return redirect()->route('admin.website.hero.edit')
            ->with('success', 'Hero section updated successfully.');
    }
}
