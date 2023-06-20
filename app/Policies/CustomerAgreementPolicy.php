<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CustomerAgreement;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerAgreementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customerAgreement can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list customeragreements');
    }

    /**
     * Determine whether the customerAgreement can view the model.
     */
    public function view(User $user, CustomerAgreement $model): bool
    {
        return $user->hasPermissionTo('view customeragreements');
    }

    /**
     * Determine whether the customerAgreement can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create customeragreements');
    }

    /**
     * Determine whether the customerAgreement can update the model.
     */
    public function update(User $user, CustomerAgreement $model): bool
    {
        return $user->hasPermissionTo('update customeragreements');
    }

    /**
     * Determine whether the customerAgreement can delete the model.
     */
    public function delete(User $user, CustomerAgreement $model): bool
    {
        return $user->hasPermissionTo('delete customeragreements');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete customeragreements');
    }

    /**
     * Determine whether the customerAgreement can restore the model.
     */
    public function restore(User $user, CustomerAgreement $model): bool
    {
        return false;
    }

    /**
     * Determine whether the customerAgreement can permanently delete the model.
     */
    public function forceDelete(User $user, CustomerAgreement $model): bool
    {
        return false;
    }
}
