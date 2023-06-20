<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FavoriteProperty;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoritePropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the favoriteProperty can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list favoriteproperties');
    }

    /**
     * Determine whether the favoriteProperty can view the model.
     */
    public function view(User $user, FavoriteProperty $model): bool
    {
        return $user->hasPermissionTo('view favoriteproperties');
    }

    /**
     * Determine whether the favoriteProperty can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create favoriteproperties');
    }

    /**
     * Determine whether the favoriteProperty can update the model.
     */
    public function update(User $user, FavoriteProperty $model): bool
    {
        return $user->hasPermissionTo('update favoriteproperties');
    }

    /**
     * Determine whether the favoriteProperty can delete the model.
     */
    public function delete(User $user, FavoriteProperty $model): bool
    {
        return $user->hasPermissionTo('delete favoriteproperties');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete favoriteproperties');
    }

    /**
     * Determine whether the favoriteProperty can restore the model.
     */
    public function restore(User $user, FavoriteProperty $model): bool
    {
        return false;
    }

    /**
     * Determine whether the favoriteProperty can permanently delete the model.
     */
    public function forceDelete(User $user, FavoriteProperty $model): bool
    {
        return false;
    }
}
