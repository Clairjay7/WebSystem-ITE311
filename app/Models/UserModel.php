<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getInstructors()
    {
        return $this->where('role', 'instructor')->findAll();
    }

    public function getStudents()
    {
        return $this->where('role', 'student')->findAll();
    }

    public function getAdmins()
    {
        return $this->where('role', 'admin')->findAll();
    }
}
