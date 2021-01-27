<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function resetPassword(User $user, $password)
    {
      $user->password = Hash::make($password);

      $user->setRememberToken(Str::random(60));

      $user->save();

      event(new PasswordReset($user));
    }

    protected function sendResetResponse(Request $request, $response)
    {
      try {
        return $this->responseJson(200, 'Senha redefinida com sucesso.');
      } catch (\Throwable $th) {
        throw $th;
      }
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
      try {
        return $this->responseJson(401, 'Token inválido.');
      } catch (\Throwable $th) {
        throw $th;
      }
    }
}
