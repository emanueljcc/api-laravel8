<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\UserRoom;
use Illuminate\Database\Seeder;

class UserRoomsSeeder extends Seeder
{
  public $userRooms = [
    [
      'room_id' => 1,
      'user_id' => 1
    ]
  ];

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    UserRoom::truncate();

    foreach ($this->userRooms as $userRoom) {
      UserRoom::insert([
        'room_id' => $userRoom['room_id'],
        'user_id' => $userRoom['user_id'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'deleted_at' => null
      ]);
    }
  }
}
