<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesPeopleAgreement;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesPeopleAgreementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesPeopleAgreement can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salespeopleagreements');
    }

    /**
     * Determine whether the salesPeopleAgreement can view the model.
     */
    public function view(User $user, SalesPeopleAgreement $model): bool
    {
        return $user->hasPermissionTo('view salespeopleagreements');
    }

    /**
     * Determine whether the salesPeopleAgreement can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salespeopleagreements');
    }

    /**
     * Determine whether the salesPeopleAgreement can update the model.
     */
    public function update(User $user, SalesPeopleAgreement $model): bool
    {
        return $user->hasPermissionTo('update salespeopleagreements');
    }

    /**
     * Determine whether the salesPeopleAgreement can delete the model.
     */
    public function delete(User $user, SalesPeopleAgreement $model): bool
    {
        return $user->hasPermissionTo('delete salespeopleagreements');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salespeopleagreements');
    }

    /**
     * Determine whether the salesPeopleAgreement can restore the model.
     */
    public function restore(User $user, SalesPeopleAgreement $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesPeopleAgreement can permanently delete the model.
     */
    public function forceDelete(User $user, SalesPeopleAgreement $model): bool
    {
        return false;
    }
}
