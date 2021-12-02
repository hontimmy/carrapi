<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomAPIController extends Controller
{
    public function walletBalance()
    {
        return $this->sendResponse(auth()->user()->balance, 'Services retrieved successfully');
    }
}
