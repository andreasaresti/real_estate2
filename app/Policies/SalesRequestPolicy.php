<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequest can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequests');
    }

    /**
     * Determine whether the salesRequest can view the model.
     */
    public function view(User $user, SalesRequest $model): bool
    {
        return $user->hasPermissionTo('view salesrequests');
    }

    /**
     * Determine whether the salesRequest can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequests');
    }

    /**
     * Determine whether the salesRequest can update the model.
     */
    public function update(User $user, SalesRequest $model): bool
    {
        return $user->hasPermissionTo('update salesrequests');
    }

    /**
     * Determine whether the salesRequest can delete the model.
     */
    public function delete(User $user, SalesRequest $model): bool
    {
        return $user->hasPermissionTo('delete salesrequests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequests');
    }

    /**
     * Determine whether the salesRequest can restore the model.
     */
    public function restore(User $user, SalesRequest $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequest can permanently delete the model.
     */
    public function forceDelete(User $user, SalesRequest $model): bool
    {
        return false;
    }
}
