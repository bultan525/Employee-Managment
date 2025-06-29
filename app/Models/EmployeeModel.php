<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'emp_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'designation', 'salary', 'address', 'picture'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    

    public function insertEmployeeData($data)
    {
        return $this->insert($data);
    }
    
    public function updateEmployeeData($id, $data)
    {
        return $this->where('id', $id)->set($data)->update();
    }

    public function getEmployeeListData($count = 0, $length = 10, $start = 0)
    {
        $builder = $this->builder();
    
        if ($count) {
            return $builder->countAllResults();
        } else {
            $query = $builder
                ->select('id, name, designation, salary, picture, created_at')
                ->orderBy('id', 'DESC')
                ->limit($length, $start)
                ->get();
    
            return $query->getResultArray();
        }
    }
    

}
