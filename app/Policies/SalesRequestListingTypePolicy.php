<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestListingType;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestListingTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestListingType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequestlistingtypes');
    }

    /**
     * Determine whether the salesRequestListingType can view the model.
     */
    public function view(User $user, SalesRequestListingType $model): bool
    {
        return $user->hasPermissionTo('view salesrequestlistingtypes');
    }

    /**
     * Determine whether the salesRequestListingType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequestlistingtypes');
    }

    /**
     * Determine whether the salesRequestListingType can update the model.
     */
    public function update(User $user, SalesRequestListingType $model): bool
    {
        return $user->hasPermissionTo('update salesrequestlistingtypes');
    }

    /**
     * Determine whether the salesRequestListingType can delete the model.
     */
    public function delete(User $user, SalesRequestListingType $model): bool
    {
        return $user->hasPermissionTo('delete salesrequestlistingtypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequestlistingtypes');
    }

    /**
     * Determine whether the salesRequestListingType can restore the model.
     */
    public function restore(User $user, SalesRequestListingType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestListingType can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        SalesRequestListingType $model
    ): bool {
        return false;
    }
}
