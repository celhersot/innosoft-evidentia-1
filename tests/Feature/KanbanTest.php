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
    public function testLoginWithAlumno1(){
        $request = [
            'username' => 'alumno1',
            'password' => 'alumno1'
        ];
        $response = $this->post('/login_p',$request);
        $response->assertSessionDoesntHaveErrors();
    }

    public function testLoginWithCoordinador1(){
        $request = [
            'username' => 'coordinador1',
            'password' => 'coordinador1'
        ];
        $response = $this->post('/login_p',$request);
        $response->assertSessionDoesntHaveErrors();
    }

    public function testTableSuccess()
    {
        
        $this->testLoginWithAlumno1();
        $response = $this->get('/21/kanban/table');
        $response->assertStatus(302);
    }

    public function testCreateTaskPositive()
    {
        
        $this->testLoginWithCoordinador1();

        
        $request = [
            'task' => 'Test task',
            'description' => 'Test task description',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish',$request);

        $response->assertStatus(302);
        
    }

    public function testCreateTaskNegativeEmptyDescription()
    {
        
        $this->testLoginWithCoordinador1();

        
        $request = [
            'task' => 'Test task failed',
            'description' => '',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$request);
        
        $issues = KanbanIssues::where(['task' => 'Test task failed'])->get();
        $this -> assertEmpty($issues);
        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeTooShortDescription()
    {
        
        $this->testLoginWithCoordinador1();

        
        $request = [
            'task' => 'Test task failed',
            'description' => 'aa',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$request);
        
        $issues = KanbanIssues::where(['task' => 'Test task failed'])->get();
        $this -> assertEmpty($issues);

        $response->assertStatus(302);
    }
}