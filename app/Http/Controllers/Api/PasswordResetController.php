<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use Illuminate\Support\Str;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        try {
             $request->validate([
            'email' => 'required|string|email',
          ]);
           $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => __('passwords.user')
            ], 404);
            $passwordReset = PasswordReset::updateOrCreate(['email' => $user->email], [
                'email' => $user->email,
                'token' => Str::random(12)
            ]);
        if ($user && $passwordReset)
            $user->notify(new PasswordResetRequest($passwordReset->token));
            return response()->json([
                'message' => __('passwords.sent')
            ]);
        } catch(\Exeception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error'=> trans('messages.oops_message')])
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($token)
    {
        try {
              $passwordReset = PasswordReset::where('token', $token)->first();
              if (!$passwordReset)
                    return response()->json([
                        'message' => __('passwords.token')
                    ], 404);

              if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
                    $passwordReset->delete();
                    return response()->json([
                        'message' => __('passwords.token')
                    ], 404);
               }

               return response()->json($passwordReset);

        } catch(\Exeception $e) {
            \Log::error($e->getMessage());

            return response()->json(['error'=> trans('messages.oops_message')])
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
        }

    }

    /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        try {
                $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|confirmed',
                'token' => 'required|string'
               ]);
                $passwordReset = PasswordReset::where([
                    ['token', $request->token],
                    ['email', $request->email]
                ])->first();

         if (!$passwordReset)
                return response()->json([
                    'message' => __('passwords.token')
                ], 404);

            $user = User::where('email', $passwordReset->email)->first();

        if (!$user)
                return response()->json([
                    'message' => __('passwords.user')
                ], 404);

            $user->password = bcrypt($request->password);
            $user->save();
            $passwordReset->delete();
            $user->notify(new PasswordResetSuccess($user));
            return response()->json($user);

        } catch(\Exeception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error'=> trans('messages.oops_message')])
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
        }

    }
}
