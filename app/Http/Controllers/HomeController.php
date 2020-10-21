<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');

        // $office = null;
        // $userIP = $_SERVER['REMOTE_ADDR'];
        // //check if IP is registered
        // $match = Ip::firstWhere('address', $userIP);
        // if ($match) {
        //     $office = $match->office()->first()->name;
        // }
        // // dd($office);
        // return Inertia::render('GuestStart', ['office' => $office]);
    }
}
