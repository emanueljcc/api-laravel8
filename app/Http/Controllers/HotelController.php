<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // TODO: AGREGAR DOC
    public function index()
    {
      try {
        $hotels = Hotel::with('rooms')->get();

        return $this->responseJson(200, 'Success', $hotels);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    public function find(Request $request)
    {
      try {
        $id = $request->id;
        $hotels = Hotel::with('rooms')->where('id', $id)->first();

        return $this->responseJson(200, 'Success', $hotels);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }
}
