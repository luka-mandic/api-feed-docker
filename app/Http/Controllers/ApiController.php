<?php


namespace App\Http\Controllers;


class ApiController extends Controller
{
    public function respond($message, $status)
    {
        return response()->json([
            'message' => $message,
            'status' => $status
        ], $status);
    }
}