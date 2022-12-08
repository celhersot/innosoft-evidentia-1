<?php

namespace Tests\Feature;

use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\KanbanIssues;

class KanbanTest extends TestCase
{
    private function loginWithAlumno1(){
        $request = [
            'username' => 'alumno1',
            'password' => 'alumno1'
        ];
        $response = $this->post('login',$request);
    }

    private function loginWithCoordinador1(){
        $request = [
            'username' => 'coordinador1',
            'password' => 'coordinador1'
        ];
        $response = $this->post('login',$request);
    }

    public function testTableSuccess()
    {
        
        $this->loginWithAlumno1();


        $response = $this->get('/21/kanban/table');
        $response->assertStatus(302);
    }

    public function testCreateTaskPositive()
    {
        
        $this->loginWithCoordinador1();

        
        $request = [
            'task' => 'Test task',
            'description' => 'Test task description',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING'
        ];

        $response = $this->post('publish',$request);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegative1()
    {
        
        $this->loginWithCoordinador1();

        
        $request = [
            'task' => 'Test task failed',
            'description' => 'a',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING'
        ];

        $response = $this->post('publish',$request);
        
        $issues = KanbanIssues::where(['task' => 'Test task failed'])->get();

        $this -> assertEmpty($issues);
    }
}