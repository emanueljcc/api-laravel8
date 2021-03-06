<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  /**
   * @OA\Get(
   ** path="/api/users",
    *   tags={"Users"},
    *   summary="Get all users",
    *   description="Get all users",
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
   * get all users api.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $users = User::all();

      return $this->responseJson(200, 'Success.', $users);
    } catch (\Exception $e) {
      return $this->responseJson(500, $e->getMessage());
    }
  }

  /**
   * @OA\Get(
   ** path="/api/users/find",
    *   tags={"Users"},
    *   summary="Find user",
    *   description="Find user",
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
   * find user api.
   *
   * @return \Illuminate\Http\Response
   */
  public function find()
  {
    try {
      $user = Auth::user();
      $user->role;
      $user->assignedRoom->room->hotel;

      // TODO: ver si dejar billing para pagos de habitaciones

      return $this->responseJson(200, 'Success.', $user);
    } catch (\Exception $e) {
      return $this->responseJson(500, $e->getMessage());
    }
  }

  /**
   * @OA\Put(
   ** path="/api/users",
    *   tags={"Users"},
    *   summary="Update user by session user",
    *   description="Update user by session user",
    *   operationId="",
    *
    *  @OA\Parameter(
    *      name="name",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *  @OA\Parameter(
    *      name="email",
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
  public function update(UpdateUserRequest $request)
  {
    try {
      $id = Auth::id();

      if (!$id) {
        return $this->responseJson(200, 'User not found.');
      }

      $user = User::find($id)->update([
        'name' => $request->name
      ]);

      return $this->responseJson(200, 'Update successfuly.', $user);
    } catch (\Exception $e) {
      return $this->responseJson(500, $e->getMessage());
    }
  }
}
