<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\UserModel;
use App\Models\MaterialModel;

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

    /**
     * View materials for a specific course
     *
     * @param int $course_id The course ID
     * @return mixed
     */
    public function materials($course_id = null)
    {
        if ($redirect = $this->ensureStudent()) {
            return $redirect;
        }

        $user_id = session()->get('id');
        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();
        $materialModel = new MaterialModel();

        // If no course_id provided, show all materials from enrolled courses
        if ($course_id === null) {
            // Get all enrolled courses
            $enrolledCourses = $enrollmentModel->getUserEnrollments($user_id);
            
            // Get materials for each enrolled course
            $coursesWithMaterials = [];
            foreach ($enrolledCourses as $enrollment) {
                $course = $courseModel->find($enrollment['course_id']);
                if ($course) {
                    $materials = $materialModel->getMaterialsByCourse($enrollment['course_id']);
                    if (!empty($materials)) {
                        $coursesWithMaterials[] = [
                            'course' => $course,
                            'materials' => $materials
                        ];
                    }
                }
            }

            $data = [
                'coursesWithMaterials' => $coursesWithMaterials
            ];

            return view('student/materials', $data);
        }

        // Check if student is enrolled in the course
        $enrollment = $enrollmentModel
            ->where('user_id', $user_id)
            ->where('course_id', $course_id)
            ->first();

        if (!$enrollment) {
            session()->setFlashdata('error', 'You are not enrolled in this course.');
            return redirect()->to('/student/courses');
        }

        // Get course details
        $course = $courseModel->find($course_id);
        if (!$course) {
            session()->setFlashdata('error', 'Course not found.');
            return redirect()->to('/student/courses');
        }

        // Get materials for the course
        $materials = $materialModel->getMaterialsByCourse($course_id);

        $data = [
            'course' => $course,
            'materials' => $materials
        ];

        return view('student/course_materials', $data);
    }
}
