<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($data = [], $message = "Success Operation !", $code = 200)
    {
        return response([
            'data' => $data,
            'message' => $message
        ], $code);
    }
}
