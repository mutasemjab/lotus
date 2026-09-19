<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use App\Models\SectionHeader;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    public function index()
    {
        $steps  = ProcessStep::orderBy('sort_order')->get();
        $header = SectionHeader::forSection('process');
        return view('admin.website.process.index', compact('steps', 'header'));
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
        SectionHeader::updateOrCreate(['section_key' => 'process'], $data);
        return redirect()->route('admin.website.process.index')->with('success', 'Section header updated.');
    }

    public function create()
    {
        return view('admin.website.process.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'step_number'    => 'required|integer|min:1',
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'sort_order'     => 'nullable|integer|min:0',
        ]);
        ProcessStep::create($data);
        return redirect()->route('admin.website.process.index')->with('success', 'Step added.');
    }

    public function edit(ProcessStep $step)
    {
        return view('admin.website.process.edit', compact('step'));
    }

    public function update(Request $request, ProcessStep $step)
    {
        $data = $request->validate([
            'step_number'    => 'required|integer|min:1',
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'sort_order'     => 'nullable|integer|min:0',
        ]);
        $step->update($data);
        return redirect()->route('admin.website.process.index')->with('success', 'Step updated.');
    }

    public function destroy(ProcessStep $step)
    {
        $step->delete();
        return redirect()->route('admin.website.process.index')->with('success', 'Step deleted.');
    }
}
