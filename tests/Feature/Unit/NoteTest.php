<?php

namespace Tests\Feature\Unit;

use App\Models\Note;
use App\Models\Notebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_note_can_be_created()
    {
        // 1. Arrange: Prepare the environment
        $user = User::factory()->create();

        // 2. Act: Perform the action
        $note = Note::factory()->for($user)->create();

        // 3. Assert: Check the result
        $this->assertDatabaseCount('notes', 1);
        $this->assertDatabaseHas('notes', [
            'uuid' => $note->uuid,
            'user_id' => $user->id,
        ]);
    }


    /** @test */
    public function a_note_can_be_updated()
    {
        // 1. Arrange: Create a user and a note associated with them.
        $user = User::factory()->create();
        $notebook = Notebook::factory()->for($user)->create(); // Create a notebook
        $note = Note::factory()->for($user)->create();

        // 2. Act: Send a PUT request to the update endpoint.
        $newData = [
            'title' => 'Updated Title',
            'text' => 'Updated text for the note.',
            'notebook_id' => $notebook->id, // Pass the notebook_id
        ];

        $response = $this->actingAs($user)->put(route('notes.update', $note), $newData);

        // 3. Assert: Check the result.
        $response->assertSessionHas('success', 'Changes Saved');
        $response->assertRedirectToRoute('notes.show', $note);

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => 'Updated Title',
            'text' => 'Updated text for the note.',
        ]);
    }

    /** @test */
    public function a_note_can_be_soft_deleted()
    {
        // 1. Arrange: Create a user and a note.
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();

        // 2. Act: Soft delete the note.
        $response = $this->actingAs($user)->delete(route('notes.destroy', $note));

        // 3. Assert: Check the result.
        $response->assertRedirectToRoute('notes.index');

        // This is the correct assertion for soft deletes
        $this->assertSoftDeleted($note);
    }


     /** @test */
    public function a_soft_deleted_note_can_be_restored()
    {
        // 1. Arrange: Create a user and a soft-deleted note.
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();
        $note->delete(); // Soft-delete the note

        // 2. Act: Send a PUT request to the restore endpoint.
        $response = $this->actingAs($user)->put(route('trashed.update', $note));

        // 3. Assert: Check the result.
        $response->assertRedirectToRoute('notes.show', $note);
        
        // Assert that the note is no longer soft-deleted.
        $this->assertNotSoftDeleted($note);

        // Assert: Check the result.
        $response->assertSessionHas('success', 'Note restored');

        // Assert that the note now appears in the main notes table.
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'deleted_at' => null,
        ]);
    }


    /** @test */
    public function a_soft_deleted_note_can_be_force_deleted()
    {
        // 1. Arrange: Create a user and a soft-deleted note.
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();
        $note->delete(); // Soft delete the note to get it into the correct state

        // 2. Act: Send a DELETE request to the force-delete endpoint.
        $response = $this->actingAs($user)->delete(route('trashed.destroy', $note));

        // 3. Assert: Check the result.
        $response->assertRedirectToRoute('trashed.index');
        
        // Assert that the record is completely missing from the database.
        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
    }
}
