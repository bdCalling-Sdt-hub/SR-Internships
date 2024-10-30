<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:company_profiles,email,' . $id,
            'phone' => 'required|string|max:20',
            'summary' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $companyProfile = CompanyProfile::findOrFail($id);

        $companyProfile->company_name = $request->input('company_name');
        $companyProfile->address = $request->input('address');
        $companyProfile->email = $request->input('email');
        $companyProfile->phone = $request->input('phone');
        $companyProfile->summary = $request->input('summary');

        if ($request->hasFile('logo')) {
            if ($companyProfile->logo && file_exists(public_path($companyProfile->logo))) {
                unlink(public_path($companyProfile->logo));
            }
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logoPath = 'logos/' . $logoName;
            $logo->move(public_path('logos'), $logoName);
            $companyProfile->logo = $logoPath;
        }
        $companyProfile->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
