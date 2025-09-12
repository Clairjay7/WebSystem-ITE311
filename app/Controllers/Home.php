<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Home extends BaseController
{
    public function index(): string
    {
        if (! session('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();

        $data = [
            'totalUsers' => $userModel->countAll(),
            'totalCourses' => $courseModel->getCourseCount(),
            'totalEnrollments' => $enrollmentModel->getEnrollmentCount(),
            'instructors' => $userModel->getInstructors(),
            'students' => $userModel->getStudents(),
            'recentCourses' => $courseModel->getRecentCourses(6),
            'recentEnrollments' => $enrollmentModel->getRecentEnrollments(5),
            'allCourses' => $courseModel->getCoursesWithInstructor()
        ];

        return view('template', $data);
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
