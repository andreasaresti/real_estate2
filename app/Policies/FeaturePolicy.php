<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feature;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeaturePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the feature can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list features');
    }

    /**
     * Determine whether the feature can view the model.
     */
    public function view(User $user, Feature $model): bool
    {
        return $user->hasPermissionTo('view features');
    }

    /**
     * Determine whether the feature can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create features');
    }

    /**
     * Determine whether the feature can update the model.
     */
    public function update(User $user, Feature $model): bool
    {
        return $user->hasPermissionTo('update features');
    }

    /**
     * Determine whether the feature can delete the model.
     */
    public function delete(User $user, Feature $model): bool
    {
        return $user->hasPermissionTo('delete features');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete features');
    }

    /**
     * Determine whether the feature can restore the model.
     */
    public function restore(User $user, Feature $model): bool
    {
        return false;
    }

    /**
     * Determine whether the feature can permanently delete the model.
     */
    public function forceDelete(User $user, Feature $model): bool
    {
        return false;
    }
}
