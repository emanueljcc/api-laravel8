<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
  public $users = [
    [
      'name' => 'emanuel',
      'email' => 'emanuelcastillo9101@gmail.com',
      'email_verified_at' => null,
      'image' => null,
      'provider' => null,
      'provider_id' => null,
      'password' => '$2y$10$LY3Uvut3I4ThuIjucjUfyOaNqXUEijqqIS/VEt4R1ii7wVbYd9Cya', // 123123
      'role_id' => 1,
      'remember_token' => null,
      'deleted_at' => null,
    ]
  ];

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::truncate();

    foreach ($this->users as $user) {
      User::insert([
        'name' => $user['name'],
        'email' => $user['email'],
        'email_verified_at' => $user['email_verified_at'],
        'image' => $user['image'],
        'provider' => $user['provider'],
        'provider_id' => $user['provider_id'],
        'password' => $user['password'],
        'role_id' => $user['role_id'],
        'remember_token' => $user['remember_token'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'deleted_at' => $user['deleted_at'],
      ]);
    }
  }
}
