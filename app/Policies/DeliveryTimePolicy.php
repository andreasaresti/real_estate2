<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DeliveryTime;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryTimePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the deliveryTime can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list deliverytimes');
    }

    /**
     * Determine whether the deliveryTime can view the model.
     */
    public function view(User $user, DeliveryTime $model): bool
    {
        return $user->hasPermissionTo('view deliverytimes');
    }

    /**
     * Determine whether the deliveryTime can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create deliverytimes');
    }

    /**
     * Determine whether the deliveryTime can update the model.
     */
    public function update(User $user, DeliveryTime $model): bool
    {
        return $user->hasPermissionTo('update deliverytimes');
    }

    /**
     * Determine whether the deliveryTime can delete the model.
     */
    public function delete(User $user, DeliveryTime $model): bool
    {
        return $user->hasPermissionTo('delete deliverytimes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete deliverytimes');
    }

    /**
     * Determine whether the deliveryTime can restore the model.
     */
    public function restore(User $user, DeliveryTime $model): bool
    {
        return false;
    }

    /**
     * Determine whether the deliveryTime can permanently delete the model.
     */
    public function forceDelete(User $user, DeliveryTime $model): bool
    {
        return false;
    }
}
