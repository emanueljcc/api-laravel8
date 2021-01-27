<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRoomRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRoom;
use App\Models\Room;

class UserRoomController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/user-room",
    *   tags={"UserRooms"},
    *   summary="Create user rooms",
    *   description="Create user rooms",
    *   operationId="",
    *
    * @OA\Parameter(
    *      name="room_id",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="integer"
    *      )
    *   ),
    *   @OA\Response(
    *      response=200,
    *       description="Success",
    *      @OA\MediaType(
    *           mediaType="application/json",
    *      )
    *   ),
    *   @OA\Response(
    *      response=401,
    *       description="Unauthenticated"
    *   ),
    *   @OA\Response(
    *      response=400,
    *      description="Bad Request"
    *   ),
    *   @OA\Response(
    *      response=404,
    *      description="Not found"
    *   ),
    *   @OA\Response(
    *      response=403,
    *      description="Forbidden"
    *   ),
    *   security={{"bearerAuth":{}}}
    *)
    **/

    /**
     * UserRooms create api.
     *
     * @return \Illuminate\Http\Response
     */
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
