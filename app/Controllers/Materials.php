<?php

namespace App\Controllers;

use App\Models\MaterialModel;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Materials extends BaseController
{
    protected $materialModel;
    protected $courseModel;
    protected $enrollmentModel;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
        $this->courseModel = new CourseModel();
        $this->enrollmentModel = new EnrollmentModel();
    }

    /**
     * Display file upload form and handle file upload process
     *
     * @param int $course_id The course ID
     * @return mixed
     */
    public function upload($course_id)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if user is instructor or admin
        $role = strtolower((string) session('role'));
        if (!in_array($role, ['instructor', 'admin', 'teacher'])) {
            session()->setFlashdata('error', 'Unauthorized. Only instructors can upload materials.');
            return redirect()->back();
        }

        // Verify course exists
        $course = $this->courseModel->find($course_id);
        if (!$course) {
            session()->setFlashdata('error', 'Course not found.');
            return redirect()->back();
        }

        // Handle POST request (file upload)
        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('material_file');

            // Validate file
            $validationRules = [
                'material_file' => [
                    'rules' => 'uploaded[material_file]|max_size[material_file,10240]|ext_in[material_file,pdf,doc,docx,ppt,pptx,xls,xlsx,txt,zip,rar]',
                    'errors' => [
                        'uploaded' => 'Please select a file to upload.',
                        'max_size' => 'File size must not exceed 10MB.',
                        'ext_in' => 'Only PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, TXT, ZIP, and RAR files are allowed.'
                    ]
                ]
            ];

            if (!$this->validate($validationRules)) {
                session()->setFlashdata('error', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            // Check if file is valid
            if ($file->isValid() && !$file->hasMoved()) {
                // Generate unique filename
                $newName = $file->getRandomName();
                
                // Move file to uploads/materials directory
                $uploadPath = WRITEPATH . 'uploads/materials/';
                
                // Create directory if it doesn't exist
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $file->move($uploadPath, $newName);

                // Prepare data for database
                $data = [
                    'course_id' => $course_id,
                    'file_name' => $file->getClientName(),
                    'file_path' => 'uploads/materials/' . $newName,
                ];

                // Insert into database
                if ($this->materialModel->insertMaterial($data)) {
                    session()->setFlashdata('success', 'Material uploaded successfully.');
                } else {
                    session()->setFlashdata('error', 'Failed to save material to database.');
                }
            } else {
                session()->setFlashdata('error', 'Failed to upload file.');
            }

            return redirect()->back();
        }

        // Display upload form (GET request)
        $data = [
            'title' => 'Upload Material',
            'course' => $course,
            'materials' => $this->materialModel->getMaterialsByCourse($course_id)
        ];

        return view('materials/upload', $data);
    }

    /**
     * Handle deletion of a material record and associated file
     *
     * @param int $material_id The material ID
     * @return mixed
     */
    public function delete($material_id)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if user is instructor or admin
        $role = strtolower((string) session('role'));
        if (!in_array($role, ['instructor', 'admin', 'teacher'])) {
            session()->setFlashdata('error', 'Unauthorized. Only instructors can delete materials.');
            return redirect()->back();
        }

        // Get material record
        $material = $this->materialModel->find($material_id);
        
        if (!$material) {
            session()->setFlashdata('error', 'Material not found.');
            return redirect()->back();
        }

        // Delete physical file
        $filePath = WRITEPATH . $material['file_path'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Delete database record
        if ($this->materialModel->delete($material_id)) {
            session()->setFlashdata('success', 'Material deleted successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to delete material.');
        }

        return redirect()->back();
    }

    /**
     * Handle file download for enrolled students
     *
     * @param int $material_id The material ID
     * @return mixed
     */
    public function download($material_id)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Get material record
        $material = $this->materialModel->find($material_id);
        
        if (!$material) {
            session()->setFlashdata('error', 'Material not found.');
            return redirect()->back();
        }

        $userId = session()->get('id');
        $role = strtolower((string) session('role'));

        // Check if user is enrolled in the course or is instructor/admin
        if (!in_array($role, ['instructor', 'admin', 'teacher'])) {
            // Check enrollment for students
            $enrollment = $this->enrollmentModel
                ->where('user_id', $userId)
                ->where('course_id', $material['course_id'])
                ->first();

            if (!$enrollment) {
                session()->setFlashdata('error', 'You must be enrolled in this course to download materials.');
                return redirect()->back();
            }
        }

        // Get file path
        $filePath = WRITEPATH . $material['file_path'];

        // Check if file exists
        if (!file_exists($filePath)) {
            session()->setFlashdata('error', 'File not found on server.');
            return redirect()->back();
        }

        // Force download
        return $this->response->download($filePath, null)->setFileName($material['file_name']);
    }
}
