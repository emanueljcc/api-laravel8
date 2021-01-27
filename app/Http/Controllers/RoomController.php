<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/rooms",
      *   tags={"Rooms"},
      *   summary="Get all rooms",
      *   description="Get all rooms",
      *   operationId="",
      *
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
     * get all rooms api.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $rooms = Room::with('hotel', 'userRoom.user.role')->get();

        return $this->responseJson(200, 'Success', $rooms);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    /**
     * @OA\Get(
     ** path="/api/rooms/{id}",
    *   tags={"Rooms"},
    *   summary="Find room id",
    *   description="Find room id",
    *   operationId="id",
    *
    *   @OA\Parameter(
    *      name="id",
    *      in="path",
    *      required=true,
    *      @OA\Schema(
    *           type="integer",
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
    * @param mixed $id
    **/

    /**
     * Room find api.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
      try {
        $id = $request->id;
        $room = Room::with('hotel', 'userRoom.user.role')->where('id', $id)->first();

        if (!$room) {
          return $this->responseJson(401, 'Room not found.');
        }

        return $this->responseJson(200, 'Success', $room);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    /**
     * @OA\Post(
     ** path="/api/rooms",
    *   tags={"Rooms"},
    *   summary="Create rooms",
    *   description="Create rooms",
    *   operationId="",
    *
    * @OA\Parameter(
    *      name="hotel_id",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="integer"
    *      )
    *   ),
    * @OA\Parameter(
    *      name="name",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
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
     * Rooms create api.
     *
     * @return \Illuminate\Http\Response
     */
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
        $room->numberBeds = $request->numberBeds;
        $room->description = $request->description;
        $room->save();

        return $this->responseJson(200, 'Room created successfuly', $room);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    /**
   * @OA\Put(
   ** path="/api/rooms/{id}",
    *   tags={"Rooms"},
    *   summary="Update room",
    *   description="Update room",
    *   operationId="id",
    *
    *   @OA\Parameter(
    *      name="id",
    *      in="path",
    *      required=true,
    *      @OA\Schema(
    *           type="integer",
    *      )
    *   ),
    *  @OA\Parameter(
    *      name="name",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *  @OA\Parameter(
    *      name="numberBeds",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *  @OA\Parameter(
    *      name="description",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
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
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      )
    *)
    **/

  /**
   * Update user api.
   *
   * @return \Illuminate\Http\Response
   */
    public function update(UpdateRoomRequest $request)
    {
      try {
        $room = Room::find($request->id);
        $room->name = $request->name;
        $room->numberBeds = $request->numberBeds;
        $room->description = $request->description;
        $room->save();

        return $this->responseJson(200, 'Room updated successfuly', $room);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    /**
     * @OA\Delete(
     ** path="/api/rooms/{id}",
    *   tags={"Rooms"},
    *   summary="Delete rooms for id",
    *   description="Delete rooms for id",
    *   operationId="id",
    *
    * @OA\Parameter(
    *      name="id",
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
     * Rooms delete api.
     *
     * @return \Illuminate\Http\Response
     */
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
