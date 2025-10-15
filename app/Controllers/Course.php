<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Course extends BaseController
{
    /**
     * Handle AJAX enrollment request
     */
    public function enroll()
    {
        // Check if the user is logged in
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You must be logged in to enroll in a course.'
            ]);
        }

        // Check if this is a POST request
        if ($this->request->getMethod() !== 'POST') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request method.'
            ]);
        }

        // Receive the course_id from the POST request
        $course_id = $this->request->getPost('course_id');
        $user_id = session()->get('id');

        // Validate course_id
        if (!$course_id || !is_numeric($course_id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid course ID.'
            ]);
        }

        // Check if the course exists
        $courseModel = new CourseModel();
        $course = $courseModel->find($course_id);
        
        if (!$course) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Course not found.'
            ]);
        }

        $enrollmentModel = new EnrollmentModel();

        // Check if the user is already enrolled
        if ($enrollmentModel->isAlreadyEnrolled($user_id, $course_id)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'You are already enrolled in this course.'
            ]);
        }

        // Insert the new enrollment record with the current timestamp
        $enrollmentData = [
            'user_id' => $user_id,
            'course_id' => $course_id,
            'enrollment_date' => date('Y-m-d H:i:s')
        ];

        $enrollmentId = $enrollmentModel->enrollUser($enrollmentData);

        if ($enrollmentId) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Successfully enrolled in the course!',
                'enrollment_id' => $enrollmentId
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to enroll in the course. Please try again.'
            ]);
        }
    }
}
