<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        $this->call('StudentSeeder');
        $this->call('BookSeeder');
        $this->call('MaterialSeeder');
        $this->call('StudentMaterialProgressSeeder');
        $this->call('SubmaterialSeeder');
        $this->call('AssignmentSeeder');
        $this->call('GradeSeeder');
        $this->call('BookStoreSeeder');
        $this->call('BookStoreMaterialSeeder');
        $this->call('BookStoreAssignmentSeeder');
    }
}
