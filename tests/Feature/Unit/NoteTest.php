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
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_note_can_be_created()
    {
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();

        $this->assertDatabaseCount('notes', 1);
        $this->assertDatabaseHas('notes', [
            'uuid' => $note->uuid,
            'user_id' => $user->id,
        ]);
    }


    /** @test */
    public function a_note_can_be_updated()
    {
        $user = User::factory()->create();
        $notebook = Notebook::factory()->for($user)->create();
        $note = Note::factory()->for($user)->for($notebook)->create();
        $title =  $this->faker->sentence();
        $text = $this->faker->paragraph();
        
        $note->update([
            'title' => $title,
            'text' => $text,
            'notebook_id' => $notebook->id,
        ]);

        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => $title,
            'text' => $text,
        ]);
    }


    /** @test */
    public function a_note_can_be_soft_deleted()
    {
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();
        $note->delete();
        $this->assertSoftDeleted($note);
    }


     /** @test */
    public function a_soft_deleted_note_can_be_restored()
    {
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();
        $note->delete();
        $note->restore();
        $this->assertNotSoftDeleted($note);
    }


    /** @test */
    public function a_soft_deleted_note_can_be_force_deleted()
    {
        $user = User::factory()->create();
        $note = Note::factory()->for($user)->create();
        $note->delete();
        $note->forceDelete();
        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
    }
}
