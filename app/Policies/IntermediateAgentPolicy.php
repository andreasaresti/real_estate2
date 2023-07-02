<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IntermediateAgent;
use Illuminate\Auth\Access\HandlesAuthorization;

class IntermediateAgentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the intermediateAgent can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list intermediateagents');
    }

    /**
     * Determine whether the intermediateAgent can view the model.
     */
    public function view(User $user, IntermediateAgent $model): bool
    {
        return $user->hasPermissionTo('view intermediateagents');
    }

    /**
     * Determine whether the intermediateAgent can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create intermediateagents');
    }

    /**
     * Determine whether the intermediateAgent can update the model.
     */
    public function update(User $user, IntermediateAgent $model): bool
    {
        return $user->hasPermissionTo('update intermediateagents');
    }

    /**
     * Determine whether the intermediateAgent can delete the model.
     */
    public function delete(User $user, IntermediateAgent $model): bool
    {
        return $user->hasPermissionTo('delete intermediateagents');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete intermediateagents');
    }

    /**
     * Determine whether the intermediateAgent can restore the model.
     */
    public function restore(User $user, IntermediateAgent $model): bool
    {
        return false;
    }

    /**
     * Determine whether the intermediateAgent can permanently delete the model.
     */
    public function forceDelete(User $user, IntermediateAgent $model): bool
    {
        return false;
    }
}
