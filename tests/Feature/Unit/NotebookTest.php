<?php

namespace Tests\Feature\Unit;

use App\Models\Notebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotebookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_notebook_can_be_created()
    {
        // 1. Arrange: Prepare the environment
        $user = User::factory()->create();

        // 2. Act: Perform the action
        $notebook = Notebook::factory()->for($user)->create();

        // 3. Assert: Check the result
        $this->assertDatabaseCount('notebooks', 1);
        $this->assertDatabaseHas('notebooks', [
            'id' => $notebook->id,
            'user_id' => $user->id,
            'name' => $notebook->name,
        ]);
    }
}
