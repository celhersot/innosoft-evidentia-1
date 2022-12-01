<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Raffle;

class RafflesController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkroles:PRESIDENT|COORDINATOR|REGISTER_COORDINATOR');
    }
    public function list()
    {
        $instance = \Instantiation::instance();

        $raffles = Raffle::all();

        return view('raffle.list',
            ['instance' => $instance, 'raffles' => $raffles]);
    }
}