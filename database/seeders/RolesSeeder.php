<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
  public $roles = [
    [
      'name' => 'Admin',
      'slug' => 'admin'
    ],
    [
      'name' => 'User',
      'slug' => 'user'
    ]
  ];

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Role::truncate();

    foreach ($this->roles as $role) {
      Role::insert([
        'name' => $role['name'],
        'slug' => $role['slug'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'deleted_at' => null
      ]);
    }
  }
}
