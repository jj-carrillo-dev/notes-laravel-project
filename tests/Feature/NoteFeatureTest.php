<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use App\Models\Notebook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_logged_in_user_can_create_a_note()
    {
        $user = User::factory()->create();
        $notebook = Notebook::factory()->for($user)->create();
        
        $noteData = [
            'title' => $this->faker->sentence(),
            'text' => $this->faker->paragraph(),
            'notebook_id' => $notebook->id,
        ];

        $response = $this->actingAs($user)->post(route('notes.store'), $noteData);

        $lastNote = Note::latest()->first();
        
        $response->assertRedirect(route('notes.show', $lastNote));
        $response->assertSessionHas('success', 'Note Created');

        // Assert on the data sent.
        $this->assertDatabaseHas('notes', array_merge($noteData, ['user_id' => $user->id]));
    }


    /** @test */
    public function a_logged_in_user_can_update_a_note()
    {
        $user = User::factory()->create();
        $notebook = Notebook::factory()->for($user)->create();
        $note = Note::factory()->for($user)->for($notebook)->create();
        $updatedTitle = $this->faker->sentence();
        $updatedText = $this->faker->paragraph();

        $newData = [
            'title' =>  $updatedTitle,
            'text' => $updatedText,
            'notebook_id' => $notebook->id,
        ];

        $response = $this->actingAs($user)->put(route('notes.update', $note), $newData);

        //Check the results.
        $response->assertRedirect(route('notes.show', $note));
        $response->assertSessionHas('success', 'Changes Saved');

        $expectedData = [
            'id' => $note->id,
            'user_id' => $user->id,
            'title' => $newData['title'],
            'text' => $newData['text'],
            'notebook_id' => $newData['notebook_id'],
        ];

        // Assert that the database contains the expected record
        $this->assertDatabaseHas('notes', $expectedData);
    }


    /** @test */
    public function a_logged_in_user_can_soft_delete_a_note()
    {
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();

        $response = $this->actingAs($user)->delete(route('notes.destroy', $note));

        $response->assertRedirect(route('notes.index'));
        $response->assertSessionHas('success', 'Note moved to trash');

        // Assert that the note is in the database but soft-deleted.
        $this->assertSoftDeleted($note);
    }


    /** @test */
    public function a_soft_deleted_note_can_be_restored()
    {
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();
        $note->delete(); // Soft-delete the note to put it in the "trashed" state

        $response = $this->actingAs($user)->put(route('trashed.update', $note));

        $response->assertRedirect(route('notes.show', $note));
        $response->assertSessionHas('success', 'Note Restored');

        $this->assertNotSoftDeleted($note);
        
        // Assert that the note now appears in the main notes table.
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'deleted_at' => null,
        ]);
    }


    /** @test */
    public function a_soft_deleted_note_can_be_force_deleted()
    {
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();
        $note->delete(); // Soft-delete the note to put it in the correct state

        $response = $this->actingAs($user)->delete(route('trashed.destroy', $note));

        $response->assertRedirect(route('trashed.index'));
        $response->assertSessionHas('success', 'Note was permanently deleted');

        // Assert that the record is completely missing from the database.
        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
    }
}
