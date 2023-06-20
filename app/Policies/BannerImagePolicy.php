<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BannerImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bannerImage can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list bannerimages');
    }

    /**
     * Determine whether the bannerImage can view the model.
     */
    public function view(User $user, BannerImage $model): bool
    {
        return $user->hasPermissionTo('view bannerimages');
    }

    /**
     * Determine whether the bannerImage can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create bannerimages');
    }

    /**
     * Determine whether the bannerImage can update the model.
     */
    public function update(User $user, BannerImage $model): bool
    {
        return $user->hasPermissionTo('update bannerimages');
    }

    /**
     * Determine whether the bannerImage can delete the model.
     */
    public function delete(User $user, BannerImage $model): bool
    {
        return $user->hasPermissionTo('delete bannerimages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete bannerimages');
    }

    /**
     * Determine whether the bannerImage can restore the model.
     */
    public function restore(User $user, BannerImage $model): bool
    {
        return false;
    }

    /**
     * Determine whether the bannerImage can permanently delete the model.
     */
    public function forceDelete(User $user, BannerImage $model): bool
    {
        return false;
    }
}
