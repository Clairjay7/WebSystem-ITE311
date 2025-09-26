<?php

namespace App\Controllers;

class Student extends BaseController
{
    private function ensureStudent()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $role = strtolower((string) session('role'));
        if ($role !== 'student' && $role !== 'admin') {
            // allow admin to preview too; otherwise block
            session()->setFlashdata('error', 'Unauthorized. Student access only.');
            return redirect()->to('/dashboard');
        }
        return null;
    }

    public function courses()
    {
        if ($redirect = $this->ensureStudent()) {
            return $redirect;
        }
        return view('student/courses');
    }

    public function assignments()
    {
        if ($redirect = $this->ensureStudent()) {
            return $redirect;
        }
        return view('student/assignments');
    }

    public function grades()
    {
        if ($redirect = $this->ensureStudent()) {
            return $redirect;
        }
        return view('student/grades');
    }
}
