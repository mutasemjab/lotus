<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustItem;
use Illuminate\Http\Request;

class TrustItemController extends Controller
{
    public function index()
    {
        $items = TrustItem::orderBy('sort_order')->get();
        return view('admin.website.trust.index', compact('items'));
    }

    public function create()
    {
        return view('admin.website.trust.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        TrustItem::create($data);
        return redirect()->route('admin.website.trust.index')->with('success', 'Item added.');
    }

    public function edit(TrustItem $trust)
    {
        return view('admin.website.trust.edit', ['item' => $trust]);
    }

    public function update(Request $request, TrustItem $trust)
    {
        $data = $request->validate([
            'title_en'       => 'required|string|max:255',
            'title_ar'       => 'required|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $trust->update($data);
        return redirect()->route('admin.website.trust.index')->with('success', 'Item updated.');
    }

    public function destroy(TrustItem $trust)
    {
        $trust->delete();
        return redirect()->route('admin.website.trust.index')->with('success', 'Item deleted.');
    }
}
