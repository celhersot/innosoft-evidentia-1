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


        $response = $this->get('/raffles');
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

        $response = $this->post('/raffles/publish',$request);

        $response->assertStatus(302);
    }    

    public function testCreateRaffleNegative1()
    {

        $this->loginWithRegisterCoordinador1();


        $request = [
            'title' => 'Test raffle failed',
            'prize' => 'a',
            'event_id' => '1'
        ];

        $response = $this->post('/raffles/publish',$request);

        $response->assertStatus(302);
    }

    public function testCreateRaffleNegative2()
    {

        $this->loginWithRegisterCoordinador1();


        $request = [
            'title' => 'a',
            'prize' => 'Wrong Title Raffle Prize',
            'event_id' => '1'
        ];

        $response = $this->post('/raffles/publish',$request);

        $response->assertStatus(302);
    }

    public function testRaffleRaffle()
    {

        $this->loginWithRegisterCoordinador1();


        $request = [
            'id' => '1',
            'title' => 'Test Raffle',
            'prize' => 'Raffle Prize',
            'event_id' => '1'
        ];

        $response = $this->post('/raffles/publish',$request);

        $response = $this->get('/raffles/raffle/1');

        $response->assertStatus(302);
    }

    public function testNegativeRaffleRaffle()
    {

        $this->loginWithRegisterCoordinador1();


        $request = [
            'id' => '2',
            'title' => 'Test Raffle',
            'prize' => 'Raffle Prize',
            'event_id' => '2'
        ];

        $response = $this->post('/raffles/publish',$request);

        $response = $this->get('/raffles/raffle/2');

        $response->assertStatus(302);
    }

}