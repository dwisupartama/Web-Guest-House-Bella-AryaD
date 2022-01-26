<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeLandingController extends Controller
{
    public function homePage(){
        return view('landing.index');
    }

    public function bookingPage(){
        return view('landing.booking');
    }

    public function contentPage(){
        return view('landing.content');
    }

    public function contactusPage(){
        return view('landing.contactus');
    }
}
