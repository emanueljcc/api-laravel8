<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
      try {
        $hotels = Hotel::all();

        return $this->responseJson(200, 'Success', $hotels);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }
}
