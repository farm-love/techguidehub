<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::orderBy('position')->paginate(20);
        return view('admin.ads.index', compact('ads'));
    }

    public function create()
    {
        return view('admin.ads.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'script' => 'nullable|string',
            // checkbox value from HTML is often "on" — accept nullable and coerce below
            'is_active' => 'nullable',
        ]);

        // coerce checkbox to boolean
        $data['is_active'] = $request->has('is_active');

        Ad::create($data);

        return redirect()->route('admin.ads.index')->with('status', 'Ad created');
    }

    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    public function update(Request $request, Ad $ad)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'script' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        // coerce checkbox to boolean
        $data['is_active'] = $request->has('is_active');

        $ad->update($data);

        return redirect()->route('admin.ads.index')->with('status', 'Ad updated');
    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
        return back()->with('status', 'Ad deleted');
    }
}
