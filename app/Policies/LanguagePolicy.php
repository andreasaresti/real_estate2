<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Language;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the language can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list languages');
    }

    /**
     * Determine whether the language can view the model.
     */
    public function view(User $user, Language $model): bool
    {
        return $user->hasPermissionTo('view languages');
    }

    /**
     * Determine whether the language can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create languages');
    }

    /**
     * Determine whether the language can update the model.
     */
    public function update(User $user, Language $model): bool
    {
        return $user->hasPermissionTo('update languages');
    }

    /**
     * Determine whether the language can delete the model.
     */
    public function delete(User $user, Language $model): bool
    {
        return $user->hasPermissionTo('delete languages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete languages');
    }

    /**
     * Determine whether the language can restore the model.
     */
    public function restore(User $user, Language $model): bool
    {
        return false;
    }

    /**
     * Determine whether the language can permanently delete the model.
     */
    public function forceDelete(User $user, Language $model): bool
    {
        return false;
    }
}
