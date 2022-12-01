<?php

namespace Tests\Unit;

use App\Http\Services\KanbanIssueService;
use App\Http\Services\Service;
use App\Models\KanbanIssues;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class KanbanIssuesTest extends TestCase
{

    private Service $kanbanIssueService;

    public function __construct()
    {
        parent::__construct();
        $this->kanbanIssueService = new KanbanIssueService();
    }

    public function setUp() : void
    {
        parent::setUp();
        $this->init();
    }

    public function tearDown() : void
    {
        // write code that runs at the end of each test
    }

    public function testCreateKanbanIssuesSuccess()
    {

        $kanban_issue_data = [
            'task' => 'Kanban Test',
            'description' => 'This is a kanban test',
            'hours' => 3,
            'user_id' => 1,
            'comittee_id' => 2,
            'type' => 'TODO'];

        $kanban_issue = $this->kanbanIssueService->create($kanban_issue_data);

        $this->assertNotNull($kanban_issue->task);

        $kanban_issue->delete();

    }
}