<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestNoteType;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestNoteTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestNoteType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequestnotetypes');
    }

    /**
     * Determine whether the salesRequestNoteType can view the model.
     */
    public function view(User $user, SalesRequestNoteType $model): bool
    {
        return $user->hasPermissionTo('view salesrequestnotetypes');
    }

    /**
     * Determine whether the salesRequestNoteType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequestnotetypes');
    }

    /**
     * Determine whether the salesRequestNoteType can update the model.
     */
    public function update(User $user, SalesRequestNoteType $model): bool
    {
        return $user->hasPermissionTo('update salesrequestnotetypes');
    }

    /**
     * Determine whether the salesRequestNoteType can delete the model.
     */
    public function delete(User $user, SalesRequestNoteType $model): bool
    {
        return $user->hasPermissionTo('delete salesrequestnotetypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequestnotetypes');
    }

    /**
     * Determine whether the salesRequestNoteType can restore the model.
     */
    public function restore(User $user, SalesRequestNoteType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestNoteType can permanently delete the model.
     */
    public function forceDelete(User $user, SalesRequestNoteType $model): bool
    {
        return false;
    }
}
