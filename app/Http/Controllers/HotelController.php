<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHotelRequest;
use App\Http\Requests\RemoveHotelRequest;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/hotels",
      *   tags={"Hotels"},
      *   summary="Get all hotels",
      *   description="Get all hotels",
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
     * get all hotels api.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try {
        $hotels = Hotel::with('rooms.userRoom.user.role')->get();

        return $this->responseJson(200, 'Success', $hotels);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    /**
     * @OA\Get(
     ** path="/api/hotels/{id}",
    *   tags={"Hotels"},
    *   summary="Find hotel id",
    *   description="Find hotel id",
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
     * Hotel find api.
     *
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
      try {
        $id = $request->id;
        $hotel = Hotel::with('rooms.userRoom.user.role')->where('id', $id)->first();

        if (!$hotel) {
          return $this->responseJson(401, 'Room not found.');
        }

        return $this->responseJson(200, 'Success', $hotel);
      } catch (\Exception $e) {
        return $this->responseJson(500, $e->getMessage());
      }
    }

    /**
     * @OA\Post(
     ** path="/api/hotels",
    *   tags={"Hotels"},
    *   summary="Create hotels",
    *   description="Create hotels",
    *   operationId="",
    *
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
     * Hotels create api.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * @OA\Delete(
     ** path="/api/hotels/{id}",
    *   tags={"Hotels"},
    *   summary="Delete hotels for id",
    *   description="Delete hotels for id",
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
     * Hotels delete api.
     *
     * @return \Illuminate\Http\Response
     */
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
