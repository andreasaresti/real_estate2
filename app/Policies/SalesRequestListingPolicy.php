<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestListing;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestListingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestListing can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequestlistings');
    }

    /**
     * Determine whether the salesRequestListing can view the model.
     */
    public function view(User $user, SalesRequestListing $model): bool
    {
        return $user->hasPermissionTo('view salesrequestlistings');
    }

    /**
     * Determine whether the salesRequestListing can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequestlistings');
    }

    /**
     * Determine whether the salesRequestListing can update the model.
     */
    public function update(User $user, SalesRequestListing $model): bool
    {
        return $user->hasPermissionTo('update salesrequestlistings');
    }

    /**
     * Determine whether the salesRequestListing can delete the model.
     */
    public function delete(User $user, SalesRequestListing $model): bool
    {
        return $user->hasPermissionTo('delete salesrequestlistings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequestlistings');
    }

    /**
     * Determine whether the salesRequestListing can restore the model.
     */
    public function restore(User $user, SalesRequestListing $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestListing can permanently delete the model.
     */
    public function forceDelete(User $user, SalesRequestListing $model): bool
    {
        return false;
    }
}
