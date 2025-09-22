<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OptionsController extends Controller
{
    /**
     * Display the options management dashboard.
     */
    public function index()
    {
        $options = [
            'site_name' => Option::getValue('site_name', 'MagStore'),
            'site_description' => Option::getValue('site_description', 'Premium Digital Magazines'),
            'contact_email' => Option::getValue('contact_email', 'info@magstore.com'),
            'contact_phone' => Option::getValue('contact_phone', '+1 234 567 8900'),
            'contact_address' => Option::getValue('contact_address', '123 Magazine Street, Digital City, DC 12345'),
            'social_facebook' => Option::getValue('social_facebook', ''),
            'social_twitter' => Option::getValue('social_twitter', ''),
            'social_instagram' => Option::getValue('social_instagram', ''),
            'social_linkedin' => Option::getValue('social_linkedin', ''),
            'logo' => Option::getValue('logo', ''),
            'favicon' => Option::getValue('favicon', ''),
            'hero_banner' => Option::getValue('hero_banner', ''),
            'banner_title' => Option::getValue('banner_title', 'Discover Premium Digital Magazines'),
            'banner_subtitle' => Option::getValue('banner_subtitle', 'Access thousands of magazines instantly'),
        ];

        return view('admin.options.index', compact('options'));
    }

    /**
     * Update general site settings.
     */
    public function updateGeneral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Option::setValue('site_name', $request->site_name);
        Option::setValue('site_description', $request->site_description);

        return redirect()->back()->with('success', 'General settings updated successfully!');
    }

    /**
     * Update contact information.
     */
    public function updateContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_address' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Option::setValue('contact_email', $request->contact_email);
        Option::setValue('contact_phone', $request->contact_phone);
        Option::setValue('contact_address', $request->contact_address);

        return redirect()->back()->with('success', 'Contact information updated successfully!');
    }

    /**
     * Update social media links.
     */
    public function updateSocial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Option::setValue('social_facebook', $request->social_facebook);
        Option::setValue('social_twitter', $request->social_twitter);
        Option::setValue('social_instagram', $request->social_instagram);
        Option::setValue('social_linkedin', $request->social_linkedin);

        return redirect()->back()->with('success', 'Social media links updated successfully!');
    }

    /**
     * Update logo and favicon.
     */
    public function updateMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:512',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            $oldLogo = Option::getValue('logo');
            if ($oldLogo && Storage::exists('public/' . $oldLogo)) {
                Storage::delete('public/' . $oldLogo);
            }

            $logoPath = $request->file('logo')->store('options/media', 'public');
            Option::setValue('logo', $logoPath);
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon
            $oldFavicon = Option::getValue('favicon');
            if ($oldFavicon && Storage::exists('public/' . $oldFavicon)) {
                Storage::delete('public/' . $oldFavicon);
            }

            $faviconPath = $request->file('favicon')->store('options/media', 'public');
            Option::setValue('favicon', $faviconPath);
        }

        return redirect()->back()->with('success', 'Logo and favicon updated successfully!');
    }

    /**
     * Update banner settings.
     */
    public function updateBanner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_title' => 'required|string|max:255',
            'banner_subtitle' => 'required|string|max:500',
            'hero_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Option::setValue('banner_title', $request->banner_title);
        Option::setValue('banner_subtitle', $request->banner_subtitle);

        // Handle banner image upload
        if ($request->hasFile('hero_banner')) {
            // Delete old banner
            $oldBanner = Option::getValue('hero_banner');
            if ($oldBanner && Storage::exists('public/' . $oldBanner)) {
                Storage::delete('public/' . $oldBanner);
            }

            $bannerPath = $request->file('hero_banner')->store('options/banners', 'public');
            Option::setValue('hero_banner', $bannerPath);
        }

        return redirect()->back()->with('success', 'Banner settings updated successfully!');
    }

    /**
     * Remove uploaded file.
     */
    public function removeFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:logo,favicon,hero_banner',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid file type.']);
        }

        $type = $request->type;
        $filePath = Option::getValue($type);

        if ($filePath && Storage::exists('public/' . $filePath)) {
            Storage::delete('public/' . $filePath);
            Option::setValue($type, '');
            return response()->json(['success' => true, 'message' => 'File removed successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'File not found.']);
    }

    /**
     * Reset all options to default values.
     */
    public function resetToDefaults()
    {
        $defaults = [
            'site_name' => 'MagStore',
            'site_description' => 'Premium Digital Magazines',
            'contact_email' => 'info@magstore.com',
            'contact_phone' => '+1 234 567 8900',
            'contact_address' => '123 Magazine Street, Digital City, DC 12345',
            'social_facebook' => '',
            'social_twitter' => '',
            'social_instagram' => '',
            'social_linkedin' => '',
            'banner_title' => 'Discover Premium Digital Magazines',
            'banner_subtitle' => 'Access thousands of magazines instantly',
        ];

        foreach ($defaults as $key => $value) {
            Option::setValue($key, $value);
        }

        return redirect()->back()->with('success', 'All settings have been reset to default values!');
    }
}