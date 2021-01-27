<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  /**
   * @OA\Post(
   ** path="/api/register",
    *   tags={"Auth"},
    *   summary="Signup",
    *   description="Register new user",
    *   operationId="register",
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
    *   @OA\Parameter(
    *      name="password",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="password_confirmation",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="type",
    *      in="query",
    *      description="default=0 - 0 is Normal, 1 admin, 2 superAdmin",
    *      required=false,
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
   * Register api.
   *
   * @return \Illuminate\Http\Response
   */
  public function register(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'role_id' => 'integer',
      ]);
      if ($validator->fails()) {
        return $this->responseJson(422, ['errors' => $validator->errors()->all()]);
      }
      $request['password'] = Hash::make($request['password']);
      $request['remember_token'] = Str::random(10);
      $request['role_id'] = $request['role_id'] ? $request['role_id'] : 0;
      $user = User::create($request->toArray());
      $token = $user->createToken('Email')->accessToken;
      $response = [
        'token_type' => 'Bearer',
        'access_token' => $token
      ];
      return $this->responseJson(200, 'Sucesso.', $response);
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  /**
   * @OA\Post(
   ** path="/api/login",
    *   tags={"Auth"},
    *   summary="Login",
    *   description="Login user",
    *   operationId="login",
    *
    *   @OA\Parameter(
    *      name="email",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *           type="string"
    *      )
    *   ),
    *   @OA\Parameter(
    *      name="password",
    *      in="query",
    *      required=true,
    *      @OA\Schema(
    *          type="string"
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
   * login api.
   *
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
      ]);
      if ($validator->fails()) {
        return $this->responseJson(422, 'E-mail ou senha inválida');
      }
      $user = User::where('email', $request->email)->first();
      if ($user) {
        if (Hash::check($request->password, $user->password)) {
          $token = $user->createToken('Email')->accessToken;
          $response = [
              'token_type' => 'Bearer',
              'access_token' => $token,
              'user' => $user,
          ];
          return $this->responseJson(200, 'Sucesso.', $response);
        } else {
          return $this->responseJson(422, 'Senha incorreta.');
        }
      } else {
        return $this->responseJson(404, 'Usuário não existe.');
      }
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  /**
   * @OA\Post(
   ** path="/api/logout",
    *   tags={"Auth"},
    *   summary="Logout",
    *   description="Logout user",
    *   operationId="logout",
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
   * logout api.
   *
   * @return \Illuminate\Http\Response
   */
  public function logout(Request $request)
  {
    try {
      $token = $request->user()->token();
      $token->revoke();
      return $this->responseJson(200, 'Você foi desconectado com sucesso!');
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
