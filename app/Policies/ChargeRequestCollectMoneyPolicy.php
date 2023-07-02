<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ChargeRequestCollectMoney;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChargeRequestCollectMoneyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the chargeRequestCollectMoney can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list chargerequestcollectmonies');
    }

    /**
     * Determine whether the chargeRequestCollectMoney can view the model.
     */
    public function view(User $user, ChargeRequestCollectMoney $model): bool
    {
        return $user->hasPermissionTo('view chargerequestcollectmonies');
    }

    /**
     * Determine whether the chargeRequestCollectMoney can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create chargerequestcollectmonies');
    }

    /**
     * Determine whether the chargeRequestCollectMoney can update the model.
     */
    public function update(User $user, ChargeRequestCollectMoney $model): bool
    {
        return $user->hasPermissionTo('update chargerequestcollectmonies');
    }

    /**
     * Determine whether the chargeRequestCollectMoney can delete the model.
     */
    public function delete(User $user, ChargeRequestCollectMoney $model): bool
    {
        return $user->hasPermissionTo('delete chargerequestcollectmonies');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete chargerequestcollectmonies');
    }

    /**
     * Determine whether the chargeRequestCollectMoney can restore the model.
     */
    public function restore(User $user, ChargeRequestCollectMoney $model): bool
    {
        return false;
    }

    /**
     * Determine whether the chargeRequestCollectMoney can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        ChargeRequestCollectMoney $model
    ): bool {
        return false;
    }
}
