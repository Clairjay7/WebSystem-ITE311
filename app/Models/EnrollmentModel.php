<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrolled_at'];

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
                    ->orderBy('enrollments.enrolled_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }
}
