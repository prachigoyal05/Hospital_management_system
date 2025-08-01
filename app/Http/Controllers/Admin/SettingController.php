<?php

namespace App\Http\Controllers\Admin;
use App\Models\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
{
    $settings = Setting::all()->pluck('value', 'key');
    return view('admin.settings.index', compact('settings'));
}

public function update(Request $request)
{
     $tab = $request->input('tab', 'general');
        
        // Handle file upload
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('public/logos');
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => str_replace('public/', '', $path)]
            );
        }

        // Handle other settings
        foreach ($request->except(['_token', 'tab', 'site_logo']) as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Update last updated timestamp
        Setting::updateOrCreate(
            ['key' => 'updated_at'],
            ['value' => now()->toDateTimeString()]
        );

        return back()->with('success', ucfirst($tab) . ' settings updated successfully');
    }
}
