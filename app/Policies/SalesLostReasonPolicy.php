<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesLostReason;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesLostReasonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesLostReason can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list saleslostreasons');
    }

    /**
     * Determine whether the salesLostReason can view the model.
     */
    public function view(User $user, SalesLostReason $model): bool
    {
        return $user->hasPermissionTo('view saleslostreasons');
    }

    /**
     * Determine whether the salesLostReason can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create saleslostreasons');
    }

    /**
     * Determine whether the salesLostReason can update the model.
     */
    public function update(User $user, SalesLostReason $model): bool
    {
        return $user->hasPermissionTo('update saleslostreasons');
    }

    /**
     * Determine whether the salesLostReason can delete the model.
     */
    public function delete(User $user, SalesLostReason $model): bool
    {
        return $user->hasPermissionTo('delete saleslostreasons');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete saleslostreasons');
    }

    /**
     * Determine whether the salesLostReason can restore the model.
     */
    public function restore(User $user, SalesLostReason $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesLostReason can permanently delete the model.
     */
    public function forceDelete(User $user, SalesLostReason $model): bool
    {
        return false;
    }
}
