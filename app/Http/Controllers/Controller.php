<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  /**
   * @OA\Info(title="API Hotels", description="Collection POSTMAN - https://www.getpostman.com/collections/913d52f92a89811af5ee", version="0.1")
   * @OA\Schemes(format="http")
   * @OA\SecurityScheme(
   *      securityScheme="bearerAuth",
   *      in="header",
   *      name="Authorization",
   *      type="http",
   *      scheme="Bearer",
   *      bearerFormat="JWT",
   * ),
   * @OA\Tag(
   *     name="Auth",
   *     description="Auth endpoints",
   * )
   * @OA\Tag(
   *     name="Users",
   *     description="Users endpoints",
   * )
   * @OA\Tag(
   *     name="Hotels",
   *     description="Hotels endpoints",
   * )
   * @OA\Tag(
   *     name="Rooms",
   *     description="Rooms endpoints",
   * )
   * @OA\Tag(
   *     name="UserRooms",
   *     description="UserRooms endpoints",
   * )
   */
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public static function responseJson($code, $message, $data = null)
  {
    try {
      return response()->json([
        'status_code' => $code,
        'message' => $message,
        'data' => $data
      ], $code);
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
