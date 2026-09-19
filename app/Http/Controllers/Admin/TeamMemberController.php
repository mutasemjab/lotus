<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionHeader;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->get();
        $header  = SectionHeader::forSection('team');
        return view('admin.website.team.index', compact('members', 'header'));
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
        SectionHeader::updateOrCreate(['section_key' => 'team'], $data);
        return redirect()->route('admin.website.team.index')->with('success', 'Section header updated.');
    }

    public function create()
    {
        return view('admin.website.team.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en'        => 'required|string|max:255',
            'name_ar'        => 'required|string|max:255',
            'role_en'        => 'nullable|string|max:255',
            'role_ar'        => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'phone'          => 'nullable|string|max:30',
            'initials'       => 'nullable|string|max:10',
            'image'          => 'nullable|image|max:4096',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('public/uploads/team', $request->file('image'));
        }
        $data['is_active'] = $request->boolean('is_active', true);

        TeamMember::create($data);
        return redirect()->route('admin.website.team.index')->with('success', 'Member added.');
    }

    public function edit(TeamMember $member)
    {
        return view('admin.website.team.edit', compact('member'));
    }

    public function update(Request $request, TeamMember $member)
    {
        $data = $request->validate([
            'name_en'        => 'required|string|max:255',
            'name_ar'        => 'required|string|max:255',
            'role_en'        => 'nullable|string|max:255',
            'role_ar'        => 'nullable|string|max:255',
            'description_en' => 'nullable|string|max:1000',
            'description_ar' => 'nullable|string|max:1000',
            'phone'          => 'nullable|string|max:30',
            'initials'       => 'nullable|string|max:10',
            'image'          => 'nullable|image|max:4096',
            'sort_order'     => 'nullable|integer|min:0',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = uploadImage('public/uploads/team', $request->file('image'));
        } else {
            unset($data['image']);
        }
        $data['is_active'] = $request->boolean('is_active');

        $member->update($data);
        return redirect()->route('admin.website.team.index')->with('success', 'Member updated.');
    }

    public function destroy(TeamMember $member)
    {
        $member->delete();
        return redirect()->route('admin.website.team.index')->with('success', 'Member deleted.');
    }
}
