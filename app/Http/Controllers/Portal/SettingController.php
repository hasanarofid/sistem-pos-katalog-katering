<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = \DB::table('company_settings')->where('id', 1)->first();
        return view('portal.settings.edit', compact('setting'));
    }

    public function hero()
    {
        $setting = \DB::table('company_settings')->where('id', 1)->first();
        return view('portal.settings.hero', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'sometimes|required',
            'phone' => 'sometimes|required',
            'address' => 'sometimes|required',
            'about_us' => 'nullable',
            'custom_scripts' => 'nullable',
            'logo' => 'nullable|image|max:2048',
            'hero_image' => 'nullable|image|max:2048',
            'hero_card_title' => 'nullable',
            'hero_card_image' => 'nullable|image|max:2048',
            'wa_message' => 'nullable',
            'seo_title' => 'nullable',
            'seo_description' => 'nullable',
        ]);

        $updateData = [
            'updated_at' => now(),
        ];

        if ($request->has('company_name')) $updateData['company_name'] = $request->company_name;
        if ($request->has('phone')) $updateData['phone'] = $request->phone;
        if ($request->has('wa_message')) $updateData['wa_message'] = $request->wa_message;
        if ($request->has('address')) $updateData['address'] = $request->address;
        if ($request->has('about_us')) $updateData['about_us'] = $request->about_us;
        if ($request->has('custom_scripts')) $updateData['custom_scripts'] = $request->custom_scripts;
        if ($request->has('hero_card_title')) $updateData['hero_card_title'] = $request->hero_card_title;
        if ($request->has('seo_title')) $updateData['seo_title'] = $request->seo_title;
        if ($request->has('seo_description')) $updateData['seo_description'] = $request->seo_description;

        if ($request->hasFile('logo')) {
            $updateData['logo'] = $request->file('logo')->store('company', 'public');
        }

        if ($request->hasFile('hero_image')) {
            $updateData['hero_image'] = $request->file('hero_image')->store('company', 'public');
        }

        if ($request->hasFile('hero_card_image')) {
            $updateData['hero_card_image'] = $request->file('hero_card_image')->store('company', 'public');
        }

        \DB::table('company_settings')->where('id', 1)->update($updateData);
        
        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
