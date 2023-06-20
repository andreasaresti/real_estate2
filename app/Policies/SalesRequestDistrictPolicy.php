<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestDistrict;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestDistrictPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestDistrict can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequestdistricts');
    }

    /**
     * Determine whether the salesRequestDistrict can view the model.
     */
    public function view(User $user, SalesRequestDistrict $model): bool
    {
        return $user->hasPermissionTo('view salesrequestdistricts');
    }

    /**
     * Determine whether the salesRequestDistrict can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequestdistricts');
    }

    /**
     * Determine whether the salesRequestDistrict can update the model.
     */
    public function update(User $user, SalesRequestDistrict $model): bool
    {
        return $user->hasPermissionTo('update salesrequestdistricts');
    }

    /**
     * Determine whether the salesRequestDistrict can delete the model.
     */
    public function delete(User $user, SalesRequestDistrict $model): bool
    {
        return $user->hasPermissionTo('delete salesrequestdistricts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequestdistricts');
    }

    /**
     * Determine whether the salesRequestDistrict can restore the model.
     */
    public function restore(User $user, SalesRequestDistrict $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestDistrict can permanently delete the model.
     */
    public function forceDelete(User $user, SalesRequestDistrict $model): bool
    {
        return false;
    }
}
