<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ListingAdditionalDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingAdditionalDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the listingAdditionalDetail can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list listingadditionaldetails');
    }

    /**
     * Determine whether the listingAdditionalDetail can view the model.
     */
    public function view(User $user, ListingAdditionalDetail $model): bool
    {
        return $user->hasPermissionTo('view listingadditionaldetails');
    }

    /**
     * Determine whether the listingAdditionalDetail can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create listingadditionaldetails');
    }

    /**
     * Determine whether the listingAdditionalDetail can update the model.
     */
    public function update(User $user, ListingAdditionalDetail $model): bool
    {
        return $user->hasPermissionTo('update listingadditionaldetails');
    }

    /**
     * Determine whether the listingAdditionalDetail can delete the model.
     */
    public function delete(User $user, ListingAdditionalDetail $model): bool
    {
        return $user->hasPermissionTo('delete listingadditionaldetails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete listingadditionaldetails');
    }

    /**
     * Determine whether the listingAdditionalDetail can restore the model.
     */
    public function restore(User $user, ListingAdditionalDetail $model): bool
    {
        return false;
    }

    /**
     * Determine whether the listingAdditionalDetail can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        ListingAdditionalDetail $model
    ): bool {
        return false;
    }
}
