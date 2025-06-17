<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function sendJson($status, $message, $data = [], $status_code = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status_code);
    }
}
