<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrollment_date'];

    public function getEnrollmentCount()
    {
        return $this->countAll();
    }

    public function getEnrollmentsWithDetails()
    {
        return $this->select('enrollments.*, users.name as student_name, courses.title as course_title')
                    ->join('users', 'users.id = enrollments.user_id')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->findAll();
    }

    public function getRecentEnrollments($limit = 5)
    {
        return $this->select('enrollments.*, users.name as student_name, courses.title as course_title')
                    ->join('users', 'users.id = enrollments.user_id')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->orderBy('enrollments.enrollment_date', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    /**
     * Insert a new enrollment record
     * @param array $data - Array containing user_id, course_id, and enrollment_date
     * @return int|bool - Returns the insert ID on success, false on failure
     */
    public function enrollUser($data)
    {
        // Set enrollment_date to current datetime if not provided
        if (!isset($data['enrollment_date'])) {
            $data['enrollment_date'] = date('Y-m-d H:i:s');
        }
        
        return $this->insert($data);
    }

    /**
     * Fetch all courses a user is enrolled in
     * @param int $user_id - The user ID
     * @return array - Array of enrollment records with course details
     */
    public function getUserEnrollments($user_id)
    {
        return $this->select('enrollments.*, courses.title as course_title, courses.description, courses.instructor_id')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->where('enrollments.user_id', $user_id)
                    ->orderBy('enrollments.enrollment_date', 'DESC')
                    ->findAll();
    }

    /**
     * Check if a user is already enrolled in a specific course to prevent duplicates
     * @param int $user_id - The user ID
     * @param int $course_id - The course ID
     * @return bool - Returns true if already enrolled, false otherwise
     */
    public function isAlreadyEnrolled($user_id, $course_id)
    {
        $enrollment = $this->where('user_id', $user_id)
                          ->where('course_id', $course_id)
                          ->first();
        
        return $enrollment !== null;
    }
}
