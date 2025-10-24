<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Home extends BaseController
{
    public function index()
    {
        // If user is logged in, redirect to their dashboard
        if (session('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        // Show public homepage for guests
        return view('index');
    }

    public function about(): string
    {
        return view('about');
    }

    public function contact(): string
    {
        return view('contact');
    }
}
