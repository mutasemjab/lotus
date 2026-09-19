<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use App\Models\AboutStat;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    public function edit()
    {
        $about = AboutSection::current();
        $stats = AboutStat::orderBy('sort_order')->get();
        return view('admin.website.about.edit', compact('about', 'stats'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'eyebrow_en'    => 'nullable|string|max:255',
            'eyebrow_ar'    => 'nullable|string|max:255',
            'title_en'      => 'nullable|string|max:1000',
            'title_ar'      => 'nullable|string|max:1000',
            'paragraph1_en' => 'nullable|string|max:3000',
            'paragraph1_ar' => 'nullable|string|max:3000',
            'paragraph2_en' => 'nullable|string|max:3000',
            'paragraph2_ar' => 'nullable|string|max:3000',
            'badge_number'  => 'nullable|string|max:50',
            'badge_text_en' => 'nullable|string|max:255',
            'badge_text_ar' => 'nullable|string|max:255',
            'image'         => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('public/uploads/about', $request->file('image'));
        } else {
            unset($data['image']);
        }

        AboutSection::updateOrCreate(['id' => 1], $data);
        return redirect()->route('admin.website.about.edit')->with('success', 'About section updated.');
    }

    // ── Stats ──────────────────────────────────────────────────────────────

    public function storeStat(Request $request)
    {
        $data = $request->validate([
            'value'      => 'required|string|max:50',
            'label_en'   => 'required|string|max:255',
            'label_ar'   => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        AboutStat::create($data);
        return redirect()->route('admin.website.about.edit')->with('success', 'Stat added.');
    }

    public function updateStat(Request $request, AboutStat $stat)
    {
        $data = $request->validate([
            'value'      => 'required|string|max:50',
            'label_en'   => 'required|string|max:255',
            'label_ar'   => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $stat->update($data);
        return redirect()->route('admin.website.about.edit')->with('success', 'Stat updated.');
    }

    public function destroyStat(AboutStat $stat)
    {
        $stat->delete();
        return redirect()->route('admin.website.about.edit')->with('success', 'Stat deleted.');
    }
}
