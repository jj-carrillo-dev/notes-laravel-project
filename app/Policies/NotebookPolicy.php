<?php

namespace App\Policies;

use App\Models\Notebook;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotebookPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Notebook $notebook): bool
    {
        return $user->id === $notebook->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Any authenticated user can create a note.
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Notebook $notebook): bool
    {
        // A user can only update a notebook if they are the owner.
        return $user->id === $notebook->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Notebook $notebook): bool
    {
        // A user can only delete a notebook if they are the owner.
        return $user->id === $notebook->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Notebook $notebook): bool
    {
        // A user can only restore a trashed notebook if they are the owner.
        return $user->id === $notebook->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Notebook $notebook): bool
    {
        // A user can only permanently delete a notebook if they are the owner.
        return $user->id === $notebook->user_id;
    }
}
