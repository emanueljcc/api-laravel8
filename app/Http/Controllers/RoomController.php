<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoomRequest;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;

class RoomController extends Controller
{
    // TODO: AGREGAR DOC swagger
    public function index()
    {
      try {
        $rooms = Room::with('hotel')->get();

        return $this->responseJson(200, 'Success', $rooms);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    public function find(Request $request)
    {
      try {
        $id = $request->id;
        $room = Room::with('hotel')->where('id', $id)->first();

        if (!$room) {
          return $this->responseJson(401, 'Room not found.');
        }

        return $this->responseJson(200, 'Success', $room);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    public function store(CreateRoomRequest $request)
    {
      try {
        $hotel = Hotel::find($request->hotel_id);

        if (!$hotel) {
          return $this->responseJson(401, 'Hotel not found.');
        }

        $room = new Room();
        $room->hotel_id = $request->hotel_id;
        $room->name = $request->name;
        $room->save();

        return $this->responseJson(200, 'Room created successfuly', $room);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    public function remove(Request $request)
    {
      try {
        $id = $request->id;

        $room = Room::find($id);

        if (!$room) {
          return $this->responseJson(401, 'Room not found.');
        }

        $room->delete();

        return $this->responseJson(200, 'Remove successfuly.');
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }
}
