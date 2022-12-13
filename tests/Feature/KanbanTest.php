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
        $user = [
            'username' => 'alumno1',
            'password' => 'alumno1'
        ];
        $response = $this->post('/login_p',$user);
        $response->assertSessionDoesntHaveErrors();
    }

    public function testLoginWithCoordinador1(){
        $coordinator = [
            'username' => 'coordinador1',
            'password' => 'coordinador1'
        ];
        $response = $this->post('/login_p',$coordinator);
        $response->assertSessionDoesntHaveErrors();
    }

    public function testTableSuccess()
    {
        $response = $this->get('/kanban/table');
        $response->assertStatus(302);
    }

    public function testCreateTaskPositive()
    {

        $issue = [
            'task' => 'Test task',
            'description' => 'Test task description',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish',$issue);

        $response->assertStatus(302);
        
    }

    public function testCreateTaskNegativeEmptyDescription()
    {
        
        $issue = [
            'task' => 'Test task failed',
            'description' => '',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);
        
        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeTooShortDescription()
    {
        
        $issue = [
            'task' => 'Test task failed',
            'description' => 'aa',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeEmptyTask()
    {
             
        $issue = [
            'task' => '',
            'description' => 'Failed task creation description',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeTooShortTask()
    {
   
        $issue = [
            'task' => 'a',
            'description' => 'Failed task creation description',
            'hours' => '1',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeEmptyHours()
    {
             
        $issue = [
            'task' => 'Failed Task',
            'description' => 'Failed task creation description',
            'hours' => '',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeExcessiveHours()
    {
   
        $issue = [
            'task' => 'Failed Task',
            'description' => 'Failed task creation description',
            'hours' => '1000000',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeEmptyUser()
    {
             
        $issue = [
            'task' => 'Failed Task',
            'description' => 'Failed task creation description',
            'hours' => '2',
            'user_id' => '',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeWrongUser()
    {
   
        $issue = [
            'task' => 'Failed Task',
            'description' => 'Failed task creation description',
            'hours' => '2',
            'user_id' => '999',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeEmptyComittee()
    {
             
        $issue = [
            'task' => 'Failed Task',
            'description' => 'Failed task creation description',
            'hours' => '2',
            'user_id' => '1',
            'comittee_id' => '',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeWrongComittee()
    {
   
        $issue = [
            'task' => 'Failed Task',
            'description' => 'Failed task creation description',
            'hours' => '2',
            'user_id' => '1',
            'comittee_id' => '999',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeStringHours()
    {
             
        $issue = [
            'task' => 'Failed Task',
            'description' => 'Failed task creation description',
            'hours' => 'dos',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }

    public function testCreateTaskNegativeLimitMinTask()
    {
   
        $issue = [
            'task' => 'Fail',
            'description' => 'Failed task creation description',
            'hours' => '2',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);

        $issue = [
            'task' => 'aaaaa',
            'description' => 'Failed task creation description',
            'hours' => '2',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);

        $issue = [
            'task' => 'aaaaaa',
            'description' => 'Failed task creation description',
            'hours' => '2',
            'user_id' => '1',
            'comittee_id' => '1',
            'type' => 'PENDING',
        ];

        $response = $this->post('/kanban/publish/',$issue);

        $response->assertStatus(302);
    }
}