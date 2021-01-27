<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRoomRequest;
use App\Models\Room;
use App\Models\UserRoom;
use Illuminate\Support\Facades\Auth;

class UserRoomController extends Controller
{
    // TODO: AGRGEAR A LA DOC SWAGGER
    public function store(CreateUserRoomRequest $request)
    {
      try {
        $userId = Auth::id();

        if (!Room::find($request->room_id)) {
          return $this->responseJson(401, 'Room not found.');
        }

        $room = new UserRoom();
        $room->room_id = $request->room_id;
        $room->user_id = $userId;
        $room->save();

        return $this->responseJson(200, 'Room created successfuly.', $room);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }
}
