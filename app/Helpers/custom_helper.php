<?php
use App\Models\EmployeeModel;
if (!function_exists('getCountTotalEmployee')) {
    function getCountTotalEmployee() {
        $model = new EmployeeModel();
        return $model->countAll();
    }
}


if (!function_exists('getHighestPaidSalary')) {
    function getHighestPaidSalary() {
        $model = new EmployeeModel();
        return $model->selectMax('salary')->first()['salary'] ?? 0;
    }
}

if (!function_exists('getAdminUsername')) {
    function getAdminUsername() {
        $db = \Config\Database::connect();
        $builder = $db->table('login_details');
        $admin = $builder->select('user_name')->get()->getRowArray();
        return $admin['user_name'];
    }
}

if (!function_exists('getAdminName')) {
    function getAdminName() {
        $db = \Config\Database::connect();
        $builder = $db->table('login_details');
        $admin = $builder->select('name')->get()->getRowArray();
        return $admin['name'];
    }
}
