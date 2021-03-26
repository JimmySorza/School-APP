<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Tenant\User;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Mail;
use Carbon\Carbon;
class ForgotController extends Controller

{

   
    public function forgot(ForgotRequest $request)
    {
        if(!$this->validEmail($request->email)) {
            return response()->json([
                'message' => 'Email not found.'
            ], 400);
        } else {
            $this->sendEmail($request->email);
            return response()->json([
                'message' => 'Password reset mail has been sent.'
            ], 200);            
        }
    }

    public function reset(ResetRequest $request)
    {
        $token = $request->input('token');

        if(!$passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response([
                'message' => 'This link is expired.'
            ],400);
        }

        /** var User $user */
        if(!$user = User::where('email', $passwordResets->email)->first())
        {
            return response([
                'message' => 'User doesn\'t exist!'
            ],404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();
        if($user)
        {
            DB::table('password_resets')->where('token', $token)->delete();
        }
        
        return response([
            'message' => 'Your password was successfully reset.'
        ]);
    }


    public function sendEmail($email){
        $token = $this->createToken($email);
        Mail::send('mails.forgot', ['token' => $token], function($message) use ($email) {
            $message->to($email);
            $message->subject('Reset your password');
        });
    }

    public function validEmail($email) {
       return !!User::where('email', $email)->first();
    }

    public function createToken($email){
      $isToken = DB::table('password_resets')->where('email', $email)->first();

      if($isToken) {
        return $isToken->token;
      }

      $token = Str::random(80);;
      $this->saveToken($token, $email);
      return $token;
    }

    public function saveToken($token, $email){
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()            
        ]);
    }
}
