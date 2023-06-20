<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestMunicipality;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestMunicipalityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestMunicipality can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequestmunicipalities');
    }

    /**
     * Determine whether the salesRequestMunicipality can view the model.
     */
    public function view(User $user, SalesRequestMunicipality $model): bool
    {
        return $user->hasPermissionTo('view salesrequestmunicipalities');
    }

    /**
     * Determine whether the salesRequestMunicipality can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequestmunicipalities');
    }

    /**
     * Determine whether the salesRequestMunicipality can update the model.
     */
    public function update(User $user, SalesRequestMunicipality $model): bool
    {
        return $user->hasPermissionTo('update salesrequestmunicipalities');
    }

    /**
     * Determine whether the salesRequestMunicipality can delete the model.
     */
    public function delete(User $user, SalesRequestMunicipality $model): bool
    {
        return $user->hasPermissionTo('delete salesrequestmunicipalities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequestmunicipalities');
    }

    /**
     * Determine whether the salesRequestMunicipality can restore the model.
     */
    public function restore(User $user, SalesRequestMunicipality $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestMunicipality can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        SalesRequestMunicipality $model
    ): bool {
        return false;
    }
}
