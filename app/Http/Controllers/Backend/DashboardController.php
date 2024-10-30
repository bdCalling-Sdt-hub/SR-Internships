<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashobard()
    {
        $company= CompanyProfile::where("id",1)->first();
        return view("backend.layouts.dashboard.dashboard",compact("company"));
    }
}
