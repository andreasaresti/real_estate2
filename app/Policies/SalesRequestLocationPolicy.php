<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestLocation;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestLocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestLocation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequestlocations');
    }

    /**
     * Determine whether the salesRequestLocation can view the model.
     */
    public function view(User $user, SalesRequestLocation $model): bool
    {
        return $user->hasPermissionTo('view salesrequestlocations');
    }

    /**
     * Determine whether the salesRequestLocation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequestlocations');
    }

    /**
     * Determine whether the salesRequestLocation can update the model.
     */
    public function update(User $user, SalesRequestLocation $model): bool
    {
        return $user->hasPermissionTo('update salesrequestlocations');
    }

    /**
     * Determine whether the salesRequestLocation can delete the model.
     */
    public function delete(User $user, SalesRequestLocation $model): bool
    {
        return $user->hasPermissionTo('delete salesrequestlocations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequestlocations');
    }

    /**
     * Determine whether the salesRequestLocation can restore the model.
     */
    public function restore(User $user, SalesRequestLocation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestLocation can permanently delete the model.
     */
    public function forceDelete(User $user, SalesRequestLocation $model): bool
    {
        return false;
    }
}
