<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHotelRequest;
use App\Http\Requests\RemoveHotelRequest;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    // TODO: AGREGAR DOC swagger
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
        $hotel = Hotel::with('rooms')->where('id', $id)->first();

        if (!$hotel) {
          return $this->responseJson(401, 'Room not found.');
        }

        return $this->responseJson(200, 'Success', $hotel);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    public function store(CreateHotelRequest $request)
    {
      try {
        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->save();

        return $this->responseJson(200, 'Success', $hotel);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    public function remove(Request $request)
    {
      try {
        $id = $request->id;

        $hotel = Hotel::find($id);

        if (!$hotel) {
          return $this->responseJson(401, 'Hotel not found.');
        }

        $hotel->rooms()->delete();
        $hotel->delete();

        return $this->responseJson(200, 'Success');
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }
}
