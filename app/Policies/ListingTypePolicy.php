<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ListingType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the listingType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list listingtypes');
    }

    /**
     * Determine whether the listingType can view the model.
     */
    public function view(User $user, ListingType $model): bool
    {
        return $user->hasPermissionTo('view listingtypes');
    }

    /**
     * Determine whether the listingType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create listingtypes');
    }

    /**
     * Determine whether the listingType can update the model.
     */
    public function update(User $user, ListingType $model): bool
    {
        return $user->hasPermissionTo('update listingtypes');
    }

    /**
     * Determine whether the listingType can delete the model.
     */
    public function delete(User $user, ListingType $model): bool
    {
        return $user->hasPermissionTo('delete listingtypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete listingtypes');
    }

    /**
     * Determine whether the listingType can restore the model.
     */
    public function restore(User $user, ListingType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the listingType can permanently delete the model.
     */
    public function forceDelete(User $user, ListingType $model): bool
    {
        return false;
    }
}
