<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Inertia\Inertia;

class GuestController extends Controller
{
    public function index()
    {
        $office = null;
        $userIP = $_SERVER['REMOTE_ADDR'];
        //check if IP is registered
        $match = Ip::firstWhere('address', $userIP);
        if ($match) {
            $office = $match->office()->first()->name;
        }
        // dd($office);
        return Inertia::render('GuestStart', ['office' => $office]);
    }
}
