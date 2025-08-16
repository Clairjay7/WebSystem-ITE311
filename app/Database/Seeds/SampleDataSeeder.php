<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // Delete existing data in correct order
        $this->db->query('DELETE FROM enrollments');
        $this->db->query('DELETE FROM courses');
        $this->db->query('DELETE FROM users');
        $this->db->query('ALTER TABLE users AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE courses AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE enrollments AUTO_INCREMENT = 1');

        // Insert sample users
        $users = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'instructor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria.garcia@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'instructor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'David Chen',
                'email' => 'david.chen@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'instructor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Robert Wilson',
                'email' => 'robert.wilson@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.anderson@example.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'student',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('users')->insertBatch($users);

        // Insert sample courses
        $courses = [
            [
                'title' => 'Web Development Fundamentals',
                'description' => 'Learn the basics of HTML, CSS, and JavaScript to build modern websites. This comprehensive course covers everything from basic markup to responsive design principles.',
                'instructor_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('-30 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-30 days'))
            ],
            [
                'title' => 'Advanced PHP Programming',
                'description' => 'Master PHP programming with advanced concepts including OOP, design patterns, and modern PHP frameworks like Laravel and CodeIgniter.',
                'instructor_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('-25 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-25 days'))
            ],
            [
                'title' => 'Database Design & Management',
                'description' => 'Learn database design principles, SQL optimization, and database administration. Covers MySQL, PostgreSQL, and NoSQL databases.',
                'instructor_id' => 2,
                'created_at' => date('Y-m-d H:i:s', strtotime('-20 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-20 days'))
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Build native and cross-platform mobile applications using React Native, Flutter, and native iOS/Android development.',
                'instructor_id' => 2,
                'created_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-15 days'))
            ],
            [
                'title' => 'Data Science & Analytics',
                'description' => 'Introduction to data science, machine learning, and statistical analysis using Python, R, and popular data science libraries.',
                'instructor_id' => 3,
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-10 days'))
            ],
            [
                'title' => 'Cybersecurity Fundamentals',
                'description' => 'Learn about network security, ethical hacking, cryptography, and security best practices for protecting digital assets.',
                'instructor_id' => 3,
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days'))
            ],
            [
                'title' => 'Cloud Computing & AWS',
                'description' => 'Master cloud computing concepts and Amazon Web Services (AWS) including EC2, S3, Lambda, and cloud architecture patterns.',
                'instructor_id' => 1,
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'title' => 'DevOps & CI/CD',
                'description' => 'Learn DevOps practices, containerization with Docker, orchestration with Kubernetes, and continuous integration/deployment.',
                'instructor_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('courses')->insertBatch($courses);

        // Insert sample enrollments
        $enrollments = [
            [
                'user_id' => 4,
                'course_id' => 1,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-28 days'))
            ],
            [
                'user_id' => 5,
                'course_id' => 1,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-27 days'))
            ],
            [
                'user_id' => 6,
                'course_id' => 2,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-23 days'))
            ],
            [
                'user_id' => 7,
                'course_id' => 2,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-22 days'))
            ],
            [
                'user_id' => 8,
                'course_id' => 3,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-18 days'))
            ],
            [
                'user_id' => 4,
                'course_id' => 3,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-17 days'))
            ],
            [
                'user_id' => 5,
                'course_id' => 4,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-13 days'))
            ],
            [
                'user_id' => 6,
                'course_id' => 4,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-12 days'))
            ],
            [
                'user_id' => 7,
                'course_id' => 5,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-8 days'))
            ],
            [
                'user_id' => 8,
                'course_id' => 5,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-7 days'))
            ],
            [
                'user_id' => 4,
                'course_id' => 6,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-3 days'))
            ],
            [
                'user_id' => 5,
                'course_id' => 6,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ],
            [
                'user_id' => 6,
                'course_id' => 7,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-1 day'))
            ],
            [
                'user_id' => 7,
                'course_id' => 7,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-12 hours'))
            ],
            [
                'user_id' => 8,
                'course_id' => 8,
                'enrolled_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ]
        ];

        $this->db->table('enrollments')->insertBatch($enrollments);

        echo "Sample data has been successfully seeded!\n";
    }
}
