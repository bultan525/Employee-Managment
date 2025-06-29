<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_name' => 'admin@gmail.com',
            'password'  => password_hash('admin@123', PASSWORD_DEFAULT), // Hashed password
            'name'      => 'Super Admin',
        ];

        $this->db->table('login_details')->insert($data);
    }
}
