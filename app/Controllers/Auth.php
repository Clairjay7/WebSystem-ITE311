<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        helper(['form', 'url']);
        $data = [];

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'name'     => 'required|min_length[2]|max_length[100]',
                'email'    => 'required|valid_email|max_length[100]|is_unique[users.email]',
                'password' => 'required|min_length[6]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                $newData = [
                    'name'     => trim($this->request->getPost('name')),
                    'email'    => trim($this->request->getPost('email')),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role'     => 'student'
                ];

                try {
                    $result = $model->insert($newData);
                    
                    if ($result) {
                        session()->setFlashdata('success', 'Registration successful!');
                        return redirect()->to('/login');
                    } else {
                        $errors = $model->errors();
                        session()->setFlashdata('error', 'Registration failed: ' . implode(', ', $errors));
                    }
                } catch (\Exception $e) {
                    session()->setFlashdata('error', 'Database error: ' . $e->getMessage());
                }
            }
        }

        return view('auth/register', $data);
    }

    public function login()
    {
        helper(['form', 'url']);
        $data = [];

        // Ensure default admin & instructor accounts exist when opening the login page
        if ($this->request->getMethod() !== 'POST') {
            $this->ensureDefaultUsers();
        }

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]',
                'role'     => 'required|in_list[student,instructor,admin]'
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();
                $user = $model->where('email', $this->request->getPost('email'))->first();

                if ($user) {
                    if (password_verify($this->request->getPost('password'), $user['password'])) {
                        // Do not block login based on requested role; rely on stored role
                        // $requestedRole = $this->request->getPost('role');
                        $sessionData = [
                            'id'        => $user['id'],
                            'name'      => $user['name'],
                            'email'     => $user['email'],
                            'role'      => $user['role'] ?? 'student',
                            'isLoggedIn'=> true,
                        ];
                        session()->set($sessionData);

                        // Friendly welcome message on unified dashboard
                        session()->setFlashdata('welcome', 'Welcome back, ' . $user['name'] . '!');

                        return redirect()->to('/dashboard');
                    } else {
                        session()->setFlashdata('error', 'Wrong password.');
                        return redirect()->to('/login');
                    }
                } else {
                    session()->setFlashdata('error', 'Email not found.');
                    return redirect()->to('/login');
                }
            }
        }

        return view('auth/login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function dashboard()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        // Ensure a role exists in session for unified dashboard rendering
        if (!session()->has('role') || empty(session('role'))) {
            session()->set('role', 'student');
        }

        $role = strtolower((string) session('role'));
        $userId = (int) session('id');

        $model = new UserModel();
        $data = [];

        if ($role === 'admin') {
            // Example role-specific data for admin: user counts by role
            $studentsCount = (new UserModel())->where('role', 'student')->countAllResults();
            $instructorsCount = (new UserModel())->where('role', 'instructor')->countAllResults();
            $adminsCount = (new UserModel())->where('role', 'admin')->countAllResults();

            $data['metrics'] = [
                'students' => $studentsCount,
                'instructors' => $instructorsCount,
                'admins' => $adminsCount,
            ];
        } elseif ($role === 'instructor') {
            // Example role-specific data for instructor: latest students
            $recentStudents = (new UserModel())
                ->where('role', 'student')
                ->orderBy('id', 'DESC')
                ->findAll(5);
            $data['recentStudents'] = $recentStudents;
        } else {
            // Example role-specific data for student: own profile
            $profile = $model->find($userId);
            $data['profile'] = $profile;
        }

        return view('auth/dashboard', $data);
    }

    // Temporary seeding endpoint to create default admin and instructor accounts
    public function seedDefaults()
    {
        $model = new UserModel();
        $created = [];

        $defaults = [
            [
                'name' => 'Site Admin',
                'email' => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
            ],
            [
                'name' => 'Lead Instructor',
                'email' => 'teacher@example.com',
                'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                'role' => 'instructor',
            ],
        ];

        foreach ($defaults as $userData) {
            $existing = $model->where('email', $userData['email'])->first();
            if (!$existing) {
                $model->insert($userData);
                $created[] = $userData['email'];
            }
        }

        if (!empty($created)) {
            return $this->response->setJSON(['status' => 'ok', 'created' => $created]);
        }

        return $this->response->setJSON(['status' => 'ok', 'message' => 'Already seeded']);
    }

    // Internal utility: silently ensure default admin & instructor accounts exist
    private function ensureDefaultUsers(): void
    {
        try {
            $model = new UserModel();
            $defaults = [
                [
                    'name' => 'Site Admin',
                    'email' => 'admin@example.com',
                    'password' => password_hash('admin123', PASSWORD_DEFAULT),
                    'role' => 'admin',
                ],
                [
                    'name' => 'Lead Instructor',
                    'email' => 'teacher@example.com',
                    'password' => password_hash('teacher123', PASSWORD_DEFAULT),
                    'role' => 'instructor',
                ],
            ];

            foreach ($defaults as $userData) {
                $exists = $model->where('email', $userData['email'])->first();
                if (!$exists) {
                    $model->insert($userData);
                }
            }
        } catch (\Throwable $e) {
            // avoid disrupting login page if DB not ready
        }
    }
}