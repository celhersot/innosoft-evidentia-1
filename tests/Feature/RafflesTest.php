<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Raffle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RafflesTest extends TestCase
{
    private function loginWithRegisterCoordinador1(){
        $request = [
            'username' => 'coordinadorregistro1',
            'password' => 'coordinadorregistro1'
        ];
        $response = $this->post('login',$request);
    }

    public function testRaffleSuccess()
    {

        $this->loginWithRegisterCoordinador1();


        $response = $this->get('/21/raffles');
        $response->assertStatus(302);
    }

    public function testCreateRafflePositive()
    {

        $this->loginWithRegisterCoordinador1();


        $request = [
            'title' => 'Test raffle',
            'prize' => 'Test raffle prize',
            'event_id' => '1'
        ];

        $response = $this->post('publish',$request);

        $response->assertStatus(302);
    }    

    // public function testCreateRaffleNegative1()
    // {

    //     $this->loginWithRegisterCoordinador1();


    //     $request = [
    //         'title' => 'Test raffle failed',
    //         'prize' => 'a',
    //         'event_id' => '1'
    //     ];

    //     $response = $this->post('publish',$request);

    //     $raffle = Raffle::where(['title' => 'Test raffle failed'])->get();

    //     $this -> assertEmpty($raffle);
    // }

    // public function testCreateRaffleNegative2()
    // {

    //     $this->loginWithRegisterCoordinador1();


    //     $request = [
    //         'title' => 'a',
    //         'prize' => 'Wrong Title Raffle Prize',
    //         'event_id' => '1'
    //     ];

    //     $response = $this->post('publish',$request);

    //     $raffle = Raffle::where(['title' => 'a'])->get();

    //     $this -> assertEmpty($raffle);
    // }
}