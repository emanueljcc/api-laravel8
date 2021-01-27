<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelsSeeder extends Seeder
{
  public $hotels = [
    [
      'name' => 'Hoten #1',
    ]
  ];

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Hotel::truncate();

    foreach ($this->hotels as $hotel) {
      Hotel::insert([
        'name' => $hotel['name'],
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'deleted_at' => null
      ]);
    }
  }
}
