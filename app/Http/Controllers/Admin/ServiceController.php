<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionHeader;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        $header   = SectionHeader::forSection('services');
        return view('admin.website.services.index', compact('services', 'header'));
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
        SectionHeader::updateOrCreate(['section_key' => 'services'], $data);
        return redirect()->route('admin.website.services.index')->with('success', 'Section header updated.');
    }

    public function create()
    {
        return view('admin.website.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number'         => 'required|string|max:10',
            'letter'         => 'nullable|string|max:5',
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string|max:2000',
            'description_ar' => 'nullable|string|max:2000',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        Service::create($data);
        return redirect()->route('admin.website.services.index')->with('success', 'Service added.');
    }

    public function edit(Service $service)
    {
        return view('admin.website.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'number'         => 'required|string|max:10',
            'letter'         => 'nullable|string|max:5',
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string|max:2000',
            'description_ar' => 'nullable|string|max:2000',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $service->update($data);
        return redirect()->route('admin.website.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.website.services.index')->with('success', 'Service deleted.');
    }
}
