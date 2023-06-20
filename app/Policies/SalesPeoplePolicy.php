<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesPeople;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesPeoplePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesPeople can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allsalespeople');
    }

    /**
     * Determine whether the salesPeople can view the model.
     */
    public function view(User $user, SalesPeople $model): bool
    {
        return $user->hasPermissionTo('view allsalespeople');
    }

    /**
     * Determine whether the salesPeople can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allsalespeople');
    }

    /**
     * Determine whether the salesPeople can update the model.
     */
    public function update(User $user, SalesPeople $model): bool
    {
        return $user->hasPermissionTo('update allsalespeople');
    }

    /**
     * Determine whether the salesPeople can delete the model.
     */
    public function delete(User $user, SalesPeople $model): bool
    {
        return $user->hasPermissionTo('delete allsalespeople');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allsalespeople');
    }

    /**
     * Determine whether the salesPeople can restore the model.
     */
    public function restore(User $user, SalesPeople $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesPeople can permanently delete the model.
     */
    public function forceDelete(User $user, SalesPeople $model): bool
    {
        return false;
    }
}
