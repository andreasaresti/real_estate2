<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the blogPost can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list blogposts');
    }

    /**
     * Determine whether the blogPost can view the model.
     */
    public function view(User $user, BlogPost $model): bool
    {
        return $user->hasPermissionTo('view blogposts');
    }

    /**
     * Determine whether the blogPost can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create blogposts');
    }

    /**
     * Determine whether the blogPost can update the model.
     */
    public function update(User $user, BlogPost $model): bool
    {
        return $user->hasPermissionTo('update blogposts');
    }

    /**
     * Determine whether the blogPost can delete the model.
     */
    public function delete(User $user, BlogPost $model): bool
    {
        return $user->hasPermissionTo('delete blogposts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete blogposts');
    }

    /**
     * Determine whether the blogPost can restore the model.
     */
    public function restore(User $user, BlogPost $model): bool
    {
        return false;
    }

    /**
     * Determine whether the blogPost can permanently delete the model.
     */
    public function forceDelete(User $user, BlogPost $model): bool
    {
        return false;
    }
}
