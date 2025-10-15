<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\UserModel;

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

        $user_id = session()->get('id');
        
        // Get enrolled courses
        $enrollmentModel = new EnrollmentModel();
        $enrolledCourses = $enrollmentModel->getUserEnrollments($user_id);
        
        // Get all available courses
        $courseModel = new CourseModel();
        $allCourses = $courseModel->findAll();
        
        // Get enrolled course IDs for filtering
        $enrolledCourseIds = array_column($enrolledCourses, 'course_id');
        
        // Filter available courses (exclude already enrolled)
        $availableCourses = array_filter($allCourses, function($course) use ($enrolledCourseIds) {
            return !in_array($course['id'], $enrolledCourseIds);
        });

        $data = [
            'enrolledCourses' => $enrolledCourses,
            'availableCourses' => $availableCourses
        ];

        return view('student/courses', $data);
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
