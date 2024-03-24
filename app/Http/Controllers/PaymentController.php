<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments, 200);
    }
}
