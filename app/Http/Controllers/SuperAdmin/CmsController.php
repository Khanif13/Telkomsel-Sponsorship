<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('superadmin.cms.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // 1. Grab the array safely using Laravel's input helper
        $settings = $request->input('settings', []);

        // 2. Loop through and update explicitly
        foreach ($settings as $key => $value) {
            // Find the specific setting row
            $setting = Setting::where('key', $key)->first();

            // If it exists in the database, update and save it
            if ($setting) {
                $setting->value = $value;
                $setting->save();
            }
        }

        return back()->with('success', 'Landing page content updated successfully.');
    }
}
