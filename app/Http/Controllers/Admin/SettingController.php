<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('key')->get();
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'nullable|string',
        ]);

        Setting::updateOrCreate(
            ['key' => $data['key']],
            ['value' => $data['value']]
        );

        return redirect()->route('admin.settings.index')->with('success', 'Setting saved successfully!');
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'value' => 'nullable|string',
        ]);

        $setting->update($data);

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully!');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return back()->with('success', 'Setting deleted successfully!');
    }
}
