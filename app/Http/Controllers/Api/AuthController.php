<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    /**
     * register user behalf of campus id and student id
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $user = User::where('email', '=', $request->email)
                ->where('campus_id', '=',$request->campus_id)
                ->where('student_id', '=',$request->student_id)
                ->first();
                if($user) {
                     $user->update(['password' => bcrypt('Welcome')]);
                       Mail::send("emails.mail", ['user'=> $user], function($mail) use ($user) {
                        $mail->from(trans('messages.from'));
                        $mail->to($user->email, $user->name)->subject(trans('messages.mail_subject'));
                    });
                    $success['token'] =  $user->createToken('MyApp')->accessToken;
                    $success['name'] =  $user->name;

                    return response()->json(['success'=>$success])
                    ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        } else {

            return response()->json(['error'=> trans('messages.error_message')])
            ->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);

        }
        } catch(\Exeception $e) {
            \Log::error($e->getMessage());

            return response()->json(['error'=> trans('messages.oops_message')])
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

     /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        try {
             if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
             $user = Auth::user();
             $success['token'] =  $user->createToken('MyApp')->accessToken;
             return response()->json(['success'=>$success])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }
        else {
             return response()->json(['error'=> trans('messages.login_error_message')])
            ->setStatusCode(Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);
        }

        } catch(\Exeception $e) {
             \Log::error($e->getMessage());
            return response()->json(['error'=> trans('messages.oops_message')])
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
        }

    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */

    public function details()
    {
        try {
               $user = Auth::user();
               return response()->json(['success'=>$user])
               ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);

        } catch(\Exeception $e) {
            \Log::error($e->getMessage());
             return response()->json(['error'=> trans('messages.oops_message')])
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
        }

    }

    /**
     * logout api
     *
     * @return \Illuminate\Http\Response
     */

    public function logout()
    {
    if (Auth::check()) {
        Auth::user()->token()->revoke();
         return response()->json(['success'=> 'logout_success'])
            ->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
    } else {
         return response()->json(['error'=> 'api.something_went_wrong'])
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
      }
    }

     function changePassword(Request $request)
     {
     $data = $request->all();
     $user = Auth::guard('api')->user();

     //Changing the password only if is different of null
     if( isset($data['oldPassword']) && !empty($data['oldPassword']) && $data['oldPassword'] !== "" && $data['oldPassword'] !=='undefined') {
         //checking the old password first
         $check  = Auth::guard('web')->attempt([
             'username' => $user->username,
             'password' => $data['oldPassword']
         ]);
         if($check && isset($data['newPassword']) && !empty($data['newPassword']) && $data['newPassword'] !== "" && $data['newPassword'] !=='undefined') {
             $user->password = bcrypt($data['newPassword']);
             $user->isFirstTime = false; //variable created by me to know if is the dummy password or generated by user.
             $user->token()->revoke();
             $token = $user->createToken('newToken')->accessToken;

             //Changing the type
             $user->save();

             return json_encode(array('token' => $token)); //sending the new token
         }
         else {
             return "Wrong password information";
         }
     }
     return "Wrong password information";
 }
}
