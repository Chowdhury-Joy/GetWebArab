<?php

namespace App\Http\Controllers;

use App\Models\LandingContent;
use App\Models\LandingSetting;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            'i18n' => LandingContent::asI18n(),
            'landingSetting' => LandingSetting::current(),
        ]);
    }
}
