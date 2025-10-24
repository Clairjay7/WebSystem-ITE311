<?php

namespace App\Controllers;

class Instructor extends BaseController
{
    private function ensureInstructor()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $role = strtolower((string) session('role'));
        if ($role !== 'instructor' && $role !== 'admin') {
            // allow admin to preview too; otherwise block
            session()->setFlashdata('error', 'Unauthorized. Instructor access only.');
            return redirect()->to('/dashboard');
        }
        return null;
    }

    public function myClasses()
    {
        if ($redirect = $this->ensureInstructor()) {
            return $redirect;
        }
        return view('instructor/my_classes');
    }

    public function submissions()
    {
        if ($redirect = $this->ensureInstructor()) {
            return $redirect;
        }
        return view('instructor/submissions');
    }

    public function attendance()
    {
        if ($redirect = $this->ensureInstructor()) {
            return $redirect;
        }
        return view('instructor/attendance');
    }
}


