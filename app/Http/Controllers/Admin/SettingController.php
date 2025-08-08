<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            return Setting::all()->pluck('value', 'key');
        });
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $tab = $request->input('tab', 'general');
        
        // Handle file upload
        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            $oldLogo = Setting::where('key', 'site_logo')->first();
            if ($oldLogo && Storage::exists('public/' . $oldLogo->value)) {
                Storage::delete('public/' . $oldLogo->value);
            }
            
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

        // Clear settings cache
        Cache::forget('site_settings');
        
        // Update last updated timestamp
        Setting::updateOrCreate(
            ['key' => 'updated_at'],
            ['value' => now()->toDateTimeString()]
        );

        return back()
            ->with('success', ucfirst($tab) . ' settings updated successfully')
            ->with('updated_at', now()->toDateTimeString());
    }
}