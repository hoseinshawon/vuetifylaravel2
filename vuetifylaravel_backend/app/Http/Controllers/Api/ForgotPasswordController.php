<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        $response = $this->broker()->sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT ? $this->sendResetLinkResponse($request, $response) : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Email Sent', 'response' => $response], 200);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed!', 'response' => $response], 500);
    }
}
