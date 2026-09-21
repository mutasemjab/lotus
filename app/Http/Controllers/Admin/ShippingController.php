<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionHeader;
use App\Models\ShippingMode;
use App\Models\ShippingRoute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShippingController extends Controller
{
    public function index()
    {
        $modes  = ShippingMode::withCount('routes')->orderBy('sort_order')->orderBy('id')->get();
        $header = SectionHeader::forSection('shipping');
        return view('admin.website.shipping.index', compact('modes', 'header'));
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
        SectionHeader::updateOrCreate(['section_key' => 'shipping'], $data);
        return redirect()->route('admin.website.shipping.index')->with('success', 'Section header updated.');
    }

    public function create()
    {
        return view('admin.website.shipping.form', ['mode' => new ShippingMode(['icon' => 'sea', 'is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedMode($request);
        $data['is_active'] = $request->boolean('is_active', true);
        $mode = ShippingMode::create($data);
        return redirect()->route('admin.website.shipping.edit', $mode)
            ->with('success', 'Shipping type created. Now add its routes below.');
    }

    public function edit(ShippingMode $mode)
    {
        $mode->load('routes');
        return view('admin.website.shipping.form', compact('mode'));
    }

    public function update(Request $request, ShippingMode $mode)
    {
        $data = $this->validatedMode($request);
        $data['is_active'] = $request->boolean('is_active');
        $mode->update($data);
        return redirect()->route('admin.website.shipping.edit', $mode)->with('success', 'Shipping type updated.');
    }

    public function destroy(ShippingMode $mode)
    {
        $mode->delete(); // routes cascade
        return redirect()->route('admin.website.shipping.index')->with('success', 'Shipping type deleted.');
    }

    // ── Routes ────────────────────────────────────────────────────────────

    public function storeRoute(Request $request, ShippingMode $mode)
    {
        $mode->routes()->create($this->validatedRoute($request));
        return redirect()->route('admin.website.shipping.edit', $mode)->with('success', 'Route added.');
    }

    public function updateRoute(Request $request, ShippingMode $mode, ShippingRoute $route)
    {
        abort_unless($route->shipping_mode_id === $mode->id, 404);
        $route->update($this->validatedRoute($request));
        return redirect()->route('admin.website.shipping.edit', $mode)->with('success', 'Route updated.');
    }

    public function destroyRoute(ShippingMode $mode, ShippingRoute $route)
    {
        abort_unless($route->shipping_mode_id === $mode->id, 404);
        $route->delete();
        return redirect()->route('admin.website.shipping.edit', $mode)->with('success', 'Route deleted.');
    }

    // ── Validation ────────────────────────────────────────────────────────

    private function validatedMode(Request $request): array
    {
        $data = $request->validate([
            'icon'       => ['required', Rule::in(ShippingMode::ICONS)],
            'title_en'   => 'required|string|max:255',
            'title_ar'   => 'required|string|max:255',
            'tag_en'     => 'nullable|string|max:255',
            'tag_ar'     => 'nullable|string|max:255',
            'link'       => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    private function validatedRoute(Request $request): array
    {
        $data = $request->validate([
            'from_en'    => 'required|string|max:255',
            'from_ar'    => 'required|string|max:255',
            'to_en'      => 'nullable|string|max:255|required_with:to_ar',
            'to_ar'      => 'nullable|string|max:255|required_with:to_en',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        $data['sort_order']       = $data['sort_order'] ?? 0;
        $data['is_bidirectional'] = $request->boolean('is_bidirectional');

        return $data;
    }
}
