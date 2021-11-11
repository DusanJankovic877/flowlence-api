<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ReCaptchaController extends Controller
{
    //

    public function index(Request $request){
        $response = Http::asForm()->post(env('RECAPTCHA_GOOGLE_URL'), [
            'secret' => env('RECAPTCHA_SECRET_KEY'),  
            'response' => request('response')
        ])->json();
        return $response;
    }
}
