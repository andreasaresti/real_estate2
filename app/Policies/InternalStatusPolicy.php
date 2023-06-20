<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InternalStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternalStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the internalStatus can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list internalstatuses');
    }

    /**
     * Determine whether the internalStatus can view the model.
     */
    public function view(User $user, InternalStatus $model): bool
    {
        return $user->hasPermissionTo('view internalstatuses');
    }

    /**
     * Determine whether the internalStatus can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create internalstatuses');
    }

    /**
     * Determine whether the internalStatus can update the model.
     */
    public function update(User $user, InternalStatus $model): bool
    {
        return $user->hasPermissionTo('update internalstatuses');
    }

    /**
     * Determine whether the internalStatus can delete the model.
     */
    public function delete(User $user, InternalStatus $model): bool
    {
        return $user->hasPermissionTo('delete internalstatuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete internalstatuses');
    }

    /**
     * Determine whether the internalStatus can restore the model.
     */
    public function restore(User $user, InternalStatus $model): bool
    {
        return false;
    }

    /**
     * Determine whether the internalStatus can permanently delete the model.
     */
    public function forceDelete(User $user, InternalStatus $model): bool
    {
        return false;
    }
}
