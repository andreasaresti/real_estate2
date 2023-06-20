<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Municipality;
use Illuminate\Auth\Access\HandlesAuthorization;

class MunicipalityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the municipality can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list municipalities');
    }

    /**
     * Determine whether the municipality can view the model.
     */
    public function view(User $user, Municipality $model): bool
    {
        return $user->hasPermissionTo('view municipalities');
    }

    /**
     * Determine whether the municipality can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create municipalities');
    }

    /**
     * Determine whether the municipality can update the model.
     */
    public function update(User $user, Municipality $model): bool
    {
        return $user->hasPermissionTo('update municipalities');
    }

    /**
     * Determine whether the municipality can delete the model.
     */
    public function delete(User $user, Municipality $model): bool
    {
        return $user->hasPermissionTo('delete municipalities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete municipalities');
    }

    /**
     * Determine whether the municipality can restore the model.
     */
    public function restore(User $user, Municipality $model): bool
    {
        return false;
    }

    /**
     * Determine whether the municipality can permanently delete the model.
     */
    public function forceDelete(User $user, Municipality $model): bool
    {
        return false;
    }
}
