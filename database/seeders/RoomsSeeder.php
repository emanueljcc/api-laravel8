<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
  public $rooms = [
    [
      'hotel_id' => 1,
      'name' => 'Room #1',
      'numberBeds' => 2,
      'description' => 'General description of the room'
    ]
  ];

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Room::truncate();

    foreach ($this->rooms as $room) {
      Room::insert([
        'hotel_id' => $room['hotel_id'],
        'name' => $room['name'],
        'numberBeds' => $room['numberBeds'],
        'description' => $room['description'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'deleted_at' => null
      ]);
    }
  }
}
