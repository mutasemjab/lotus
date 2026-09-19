<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarqueeItem;
use Illuminate\Http\Request;

class MarqueeItemController extends Controller
{
    public function index()
    {
        $items = MarqueeItem::orderBy('sort_order')->get();
        return view('admin.website.marquee.index', compact('items'));
    }

    public function create()
    {
        return view('admin.website.marquee.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'text_en'    => 'required|string|max:255',
            'text_ar'    => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        MarqueeItem::create($data);
        return redirect()->route('admin.website.marquee.index')->with('success', 'Item added.');
    }

    public function edit(MarqueeItem $marquee)
    {
        return view('admin.website.marquee.edit', ['item' => $marquee]);
    }

    public function update(Request $request, MarqueeItem $marquee)
    {
        $data = $request->validate([
            'text_en'    => 'required|string|max:255',
            'text_ar'    => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $marquee->update($data);
        return redirect()->route('admin.website.marquee.index')->with('success', 'Item updated.');
    }

    public function destroy(MarqueeItem $marquee)
    {
        $marquee->delete();
        return redirect()->route('admin.website.marquee.index')->with('success', 'Item deleted.');
    }
}
