<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use CodeIgniter\HTTP\ResponseInterface;

class Employee extends BaseController
{
    protected $employeeModel;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function index()
    {
        $this->data['title'] = 'Employee List';
        return view('admin/employee/employee', $this->data);
    }

    public function createEmployee()
    {
        $this->data['title'] = 'Create Employee';

        return view('admin/employee/create-employee', $this->data);
    }


    public function saveEmployeeData()
    {
        $this->data = [
            'success' => false,
            'hash'    => csrf_hash(),
        ];

        $validation = \Config\Services::validation();

        $rules = [
            'emp_name'    => 'required|string|min_length[3]|max_length[100]',
            'designation' => 'required|string|max_length[100]',
            'salary'      => 'required|numeric|min_length[1]',
        ];

        $messages = [
            'emp_name' => [
                'required' => 'Employee name is required.',
            ],
            'designation' => [
                'required' => 'Designation is required.',
            ],
            'salary' => [
                'required' => 'Salary is required.',
                'numeric'  => 'Salary must be a number.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            $this->data['errors'] = $this->validator->getErrors();
            return $this->response->setJSON($this->data);
        }

        $data = [
            'name'        => $this->request->getPost('emp_name'),
            'designation' => $this->request->getPost('designation'),
            'salary'      => $this->request->getPost('salary'),
            'address'     => $this->request->getPost('address'),
        ];

        $picture = $this->request->getFile('picture');
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $newName = $picture->getRandomName();
            $picture->move(FCPATH . 'uploads/employees', $newName);
            $data['picture'] = $newName;
        }

        $result = $this->employeeModel->insertEmployeeData($data);

        if ($result) {
            $this->data['success'] = true;
            $this->data['message'] = 'Employee saved successfully!';
        } else {
            $this->data['message'] = 'Failed to save employee. Please try again.';
        }

        return $this->response->setJSON($this->data);
    }

    public function getEmployeeListDt()
    {
        $request = service('request');
    
        $draw   = $request->getGet('draw');
        $start  = $request->getGet('start');
        $length = $request->getGet('length');
    
        $totalRecords = $totalFiltered = $this->employeeModel->getEmployeeListData(1, $length, $start);
        $employees = $this->employeeModel->getEmployeeListData(0, $length, $start);

        $data = [];
        $slNo = $start + 1;
        foreach ($employees as $row) {
            $action = '';
            $action  = '<a href="' . base_url('admin/employee/edit-employee/') . $row['id'] . '" class="me-2"><i class="fa fa-edit"></i></a>';
            $action .= '<a href="javascript:void(0)" class="delete-employee text-danger" data-id="'. $row['id'] .'"><i class="fa fa-trash"></i></a>';
            
            if($row['picture']){
                $picture = '<a href="'.base_url('uploads/employees/') . $row['picture'].'" data-lightbox="employee-image">
                <img src="'.base_url('uploads/employees/') . $row['picture'].'" alt="Image" style="width: 50px; height: 50px;" class="img-thumbnail">
                </a>';
            }else{
                $picture = '
                <img src="'.base_url('uploads/employees/no-photo.jpg') .'" alt="Image" style="width: 50px; height: 50px;" class="img-thumbnail">';
            }

            $data[] = [
                'slNo'         => $slNo++,
                'name'         => $row['name'],
                'designation'  => $row['designation'],
                'salary'       => $row['salary'],
                'picture'      => $picture,
                'created_date' => date('d M Y', strtotime($row['created_at'] ?? '')),
                'action'       => $action
            ];
        }
    
        return $this->response->setJSON([
            'draw'            => intval($draw),
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'aaData'          => $data,
        ]);
    }
    

    public function deleteEmployee($id)
    {
        $this->data['success'] = false;
        $this->data['hash'] = csrf_hash();

        if (!$this->request->isAJAX()) {
            $this->data['message'] = 'Invalid request.';
            return $this->response->setJSON($this->data);
        }

        $employee = $this->employeeModel->find($id);
        if (!$employee) {
            $this->data['message'] = 'Employee not found.';
            return $this->response->setJSON($this->data);
        }

        if (!empty($employee['picture'])) {
            $filePath = FCPATH . 'uploads/employees/' . $employee['picture'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        if ($this->employeeModel->delete($id)) {
            $this->data['success'] = true;
            $this->data['message'] = 'Employee deleted successfully.';
        } else {
            $this->data['message'] = 'Failed to delete employee.';
        }

        return $this->response->setJSON($this->data);
    }

    public function editEmployee(int $id)
    {
        $this->data['title'] = 'Edit Employee';
        $this->data['details'] = $this->employeeModel->find($id);
        return view('admin/employee/edit-employee', $this->data);
    }


    public function updateEmployeeData()
    {
        $this->data = [
            'success' => false,
            'hash'    => csrf_hash(),
        ];
    
        $id = $this->request->getPost('id');
        $employee = $this->employeeModel->find($id);
    
        if (!$employee) {
            $this->data['message'] = 'Employee not found.';
            return $this->response->setJSON($this->data);
        }
    
        $validation = \Config\Services::validation();
    
        $rules = [
            'emp_name'    => 'required|string|min_length[3]|max_length[100]',
            'designation' => 'required|string|max_length[100]',
            'salary'      => 'required|numeric|min_length[1]',
        ];
    
        $messages = [
            'emp_name' => [
                'required' => 'Employee name is required.',
            ],
            'designation' => [
                'required' => 'Designation is required.',
            ],
            'salary' => [
                'required' => 'Salary is required.',
                'numeric'  => 'Salary must be a number.',
            ],
        ];
    
        if (!$this->validate($rules, $messages)) {
            $this->data['errors'] = $this->validator->getErrors();
            return $this->response->setJSON($this->data);
        }
    
        $data = [
            'name'        => $this->request->getPost('emp_name'),
            'designation' => $this->request->getPost('designation'),
            'salary'      => $this->request->getPost('salary'),
            'address'     => $this->request->getPost('address'),
        ];
    
        $picture = $this->request->getFile('picture');
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $newName = $picture->getRandomName();
            $picture->move(FCPATH . 'uploads/employees', $newName);
            $data['picture'] = $newName;
    
            if (!empty($employee['picture'])) {
                $oldPicture = FCPATH . $employee['picture'];
                if (file_exists($oldPicture)) {
                    unlink($oldPicture);
                }
            }
        }
    
        $updated = $this->employeeModel->updateEmployeeData($id, $data);
    
        if ($updated) {
            $this->data['success'] = true;
            $this->data['message'] = 'Employee updated successfully!';
        } else {
            $this->data['message'] = 'Failed to update employee.';
        }
    
        return $this->response->setJSON($this->data);
    }



}

