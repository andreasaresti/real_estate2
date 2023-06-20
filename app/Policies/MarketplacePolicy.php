<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Marketplace;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketplacePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the marketplace can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list marketplaces');
    }

    /**
     * Determine whether the marketplace can view the model.
     */
    public function view(User $user, Marketplace $model): bool
    {
        return $user->hasPermissionTo('view marketplaces');
    }

    /**
     * Determine whether the marketplace can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create marketplaces');
    }

    /**
     * Determine whether the marketplace can update the model.
     */
    public function update(User $user, Marketplace $model): bool
    {
        return $user->hasPermissionTo('update marketplaces');
    }

    /**
     * Determine whether the marketplace can delete the model.
     */
    public function delete(User $user, Marketplace $model): bool
    {
        return $user->hasPermissionTo('delete marketplaces');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete marketplaces');
    }

    /**
     * Determine whether the marketplace can restore the model.
     */
    public function restore(User $user, Marketplace $model): bool
    {
        return false;
    }

    /**
     * Determine whether the marketplace can permanently delete the model.
     */
    public function forceDelete(User $user, Marketplace $model): bool
    {
        return false;
    }
}
