<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Models\User ;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Mail;
class VerificationController extends Controller
{
    /*public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }
    
        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        return redirect()->to('/verificationEmailSuccess');
    }*/
    public function verify($user_id, Request $request)
{
    if (!$request->hasValidSignature()) {
        return response()->json(["msg" => "Invalid/Expired url provided."], 401);
    }

    $user = User::findOrFail($user_id);
    if (!$user->hasVerifiedEmail()){
        $user->markEmailAsVerified();
    }

    return redirect()->to('/verificationEmailSuccess');
}
}
