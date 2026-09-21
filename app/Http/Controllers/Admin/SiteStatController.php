<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteStat;
use Illuminate\Http\Request;

class SiteStatController extends Controller
{
    public function index()
    {
        $stats = SiteStat::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.website.stats.index', compact('stats'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active', true);
        SiteStat::create($data);
        return redirect()->route('admin.website.stats.index')->with('success', 'Statistic added.');
    }

    public function update(Request $request, SiteStat $stat)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');
        $stat->update($data);
        return redirect()->route('admin.website.stats.index')->with('success', 'Statistic updated.');
    }

    public function destroy(SiteStat $stat)
    {
        $stat->delete();
        return redirect()->route('admin.website.stats.index')->with('success', 'Statistic deleted.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'value'      => 'required|integer|min:0|max:999999999',
            'suffix'     => 'nullable|string|max:10',
            'label_en'   => 'required|string|max:255',
            'label_ar'   => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
