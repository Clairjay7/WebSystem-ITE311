<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Home extends BaseController
{
    public function index(): string
    {
        // Show public homepage for guests without hitting models
        if (! session('isLoggedIn')) {
            return view('index');
        }

        // For logged-in users you can later load dashboard-like stats here.
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
