<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactLocation;
use App\Models\ContactPhone;
use App\Models\SectionHeader;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactSectionController extends Controller
{
    public function index()
    {
        $header   = SectionHeader::forSection('contact');
        $phones   = ContactPhone::orderBy('sort_order')->get();
        $location = ContactLocation::current();
        $whatsapp = SiteSetting::get('whatsapp_number', '');
        return view('admin.website.contact.index', compact('header', 'phones', 'location', 'whatsapp'));
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
        SectionHeader::updateOrCreate(['section_key' => 'contact'], $data);
        return redirect()->route('admin.website.contact.index')->with('success', 'Section header updated.');
    }

    public function updateSettings(Request $request)
    {
        $request->validate(['whatsapp_number' => 'nullable|string|max:30']);
        SiteSetting::set('whatsapp_number', $request->whatsapp_number);
        return redirect()->route('admin.website.contact.index')->with('success', 'Settings saved.');
    }

    // ── Phones ─────────────────────────────────────────────────────────────

    public function storePhone(Request $request)
    {
        $data = $request->validate([
            'label_en'   => 'nullable|string|max:255',
            'label_ar'   => 'nullable|string|max:255',
            'phone'      => 'required|string|max:30',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);
        ContactPhone::create($data);
        return redirect()->route('admin.website.contact.index')->with('success', 'Phone added.');
    }

    public function updatePhone(Request $request, ContactPhone $phone)
    {
        $data = $request->validate([
            'label_en'   => 'nullable|string|max:255',
            'label_ar'   => 'nullable|string|max:255',
            'phone'      => 'required|string|max:30',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $phone->update($data);
        return redirect()->route('admin.website.contact.index')->with('success', 'Phone updated.');
    }

    public function destroyPhone(ContactPhone $phone)
    {
        $phone->delete();
        return redirect()->route('admin.website.contact.index')->with('success', 'Phone deleted.');
    }

    // ── Location ───────────────────────────────────────────────────────────

    public function updateLocation(Request $request)
    {
        $data = $request->validate([
            'title_en'   => 'nullable|string|max:255',
            'title_ar'   => 'nullable|string|max:255',
            'address_en' => 'nullable|string|max:1000',
            'address_ar' => 'nullable|string|max:1000',
            'maps_link'  => 'nullable|url|max:500',
        ]);
        ContactLocation::updateOrCreate(['id' => 1], $data);
        return redirect()->route('admin.website.contact.index')->with('success', 'Location updated.');
    }
}
