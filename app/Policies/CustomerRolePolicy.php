<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CustomerRole;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerRolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customerRole can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list customerroles');
    }

    /**
     * Determine whether the customerRole can view the model.
     */
    public function view(User $user, CustomerRole $model): bool
    {
        return $user->hasPermissionTo('view customerroles');
    }

    /**
     * Determine whether the customerRole can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create customerroles');
    }

    /**
     * Determine whether the customerRole can update the model.
     */
    public function update(User $user, CustomerRole $model): bool
    {
        return $user->hasPermissionTo('update customerroles');
    }

    /**
     * Determine whether the customerRole can delete the model.
     */
    public function delete(User $user, CustomerRole $model): bool
    {
        return $user->hasPermissionTo('delete customerroles');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete customerroles');
    }

    /**
     * Determine whether the customerRole can restore the model.
     */
    public function restore(User $user, CustomerRole $model): bool
    {
        return false;
    }

    /**
     * Determine whether the customerRole can permanently delete the model.
     */
    public function forceDelete(User $user, CustomerRole $model): bool
    {
        return false;
    }
}
