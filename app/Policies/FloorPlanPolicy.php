<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FloorPlan;
use Illuminate\Auth\Access\HandlesAuthorization;

class FloorPlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the floorPlan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list floorplans');
    }

    /**
     * Determine whether the floorPlan can view the model.
     */
    public function view(User $user, FloorPlan $model): bool
    {
        return $user->hasPermissionTo('view floorplans');
    }

    /**
     * Determine whether the floorPlan can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create floorplans');
    }

    /**
     * Determine whether the floorPlan can update the model.
     */
    public function update(User $user, FloorPlan $model): bool
    {
        return $user->hasPermissionTo('update floorplans');
    }

    /**
     * Determine whether the floorPlan can delete the model.
     */
    public function delete(User $user, FloorPlan $model): bool
    {
        return $user->hasPermissionTo('delete floorplans');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete floorplans');
    }

    /**
     * Determine whether the floorPlan can restore the model.
     */
    public function restore(User $user, FloorPlan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the floorPlan can permanently delete the model.
     */
    public function forceDelete(User $user, FloorPlan $model): bool
    {
        return false;
    }
}
