<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapCountry;
use App\Models\SectionHeader;
use Illuminate\Http\Request;

class MapCountryController extends Controller
{
    public function index()
    {
        $countries = MapCountry::orderBy('sort_order')->orderBy('id')->get();
        $header    = SectionHeader::forSection('map');
        $presets   = config('map_countries.presets');
        $bounds    = config('map_countries.bounds');
        return view('admin.website.map.index', compact('countries', 'header', 'presets', 'bounds'));
    }

    public function updateHeader(Request $request)
    {
        $data = $request->validate([
            'eyebrow_en'  => 'nullable|string|max:255',
            'eyebrow_ar'  => 'nullable|string|max:255',
            'title_en'    => 'nullable|string|max:1000',
            'title_ar'    => 'nullable|string|max:1000',
            'subtitle_en' => 'nullable|string|max:2000',
            'subtitle_ar' => 'nullable|string|max:2000',
        ]);
        SectionHeader::updateOrCreate(['section_key' => 'map'], $data);
        return redirect()->route('admin.website.map.index')->with('success', 'Section header updated.');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active', true);
        MapCountry::create($data);
        return redirect()->route('admin.website.map.index')->with('success', 'Country added.');
    }

    public function update(Request $request, MapCountry $country)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');
        $country->update($data);
        return redirect()->route('admin.website.map.index')->with('success', 'Country updated.');
    }

    public function destroy(MapCountry $country)
    {
        $country->delete();
        return redirect()->route('admin.website.map.index')->with('success', 'Country deleted.');
    }

    private function validated(Request $request): array
    {
        $b = config('map_countries.bounds');

        $data = $request->validate([
            'code'       => 'required|alpha|size:2',
            'name_en'    => 'required|string|max:255',
            'name_ar'    => 'required|string|max:255',
            'latitude'   => "required|numeric|between:{$b['lat_min']},{$b['lat_max']}",
            'longitude'  => "required|numeric|between:{$b['lon_min']},{$b['lon_max']}",
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['code']       = strtolower($data['code']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_hub']     = $request->boolean('is_hub');

        return $data;
    }
}
