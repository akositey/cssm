<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $office = auth()->user()->office;
        $officeName = '';
        if ($office) {
            $officeName = $office->abbr;
        }
        // dd($officeName);
        return Inertia::render('Home', ['office' => $officeName]);

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
