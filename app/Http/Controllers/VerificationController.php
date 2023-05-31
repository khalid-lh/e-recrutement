<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
class VerificationController extends Controller
{
    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }
    
        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        return redirect()->to('/verificationEmailSuccess');
    }
}
