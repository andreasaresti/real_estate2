<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestNote;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestNotePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestNote can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list SalesRequestNote');
    }

    /**
     * Determine whether the salesRequestNote can view the model.
     */
    public function view(User $user, SalesRequestNote $model): bool
    {
        return $user->hasPermissionTo('view SalesRequestNote');
    }

    /**
     * Determine whether the salesRequestNote can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create SalesRequestNote');
    }

    /**
     * Determine whether the salesRequestNote can update the model.
     */
    public function update(User $user, SalesRequestNote $model): bool
    {
        return $user->hasPermissionTo('update SalesRequestNote');
    }

    /**
     * Determine whether the salesRequestNote can delete the model.
     */
    public function delete(User $user, SalesRequestNote $model): bool
    {
        return $user->hasPermissionTo('delete SalesRequestNote');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete SalesRequestNote');
    }

    /**
     * Determine whether the salesRequestNote can restore the model.
     */
    public function restore(User $user, SalesRequestNote $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestNote can permanently delete the model.
     */
    public function forceDelete(User $user, SalesRequestNote $model): bool
    {
        return false;
    }
}
