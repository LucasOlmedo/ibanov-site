<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * @return Application|Factory|View
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.send-link-password');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param string $response
     * @return Factory|View
     */
    protected function sendResetLinkResponse($response)
    {
        return view('admin.auth.wait-reset');
    }
}
