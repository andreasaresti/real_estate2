<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ListingAttachment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ListingAttachmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the listingAttachment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list listingattachments');
    }

    /**
     * Determine whether the listingAttachment can view the model.
     */
    public function view(User $user, ListingAttachment $model): bool
    {
        return $user->hasPermissionTo('view listingattachments');
    }

    /**
     * Determine whether the listingAttachment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create listingattachments');
    }

    /**
     * Determine whether the listingAttachment can update the model.
     */
    public function update(User $user, ListingAttachment $model): bool
    {
        return $user->hasPermissionTo('update listingattachments');
    }

    /**
     * Determine whether the listingAttachment can delete the model.
     */
    public function delete(User $user, ListingAttachment $model): bool
    {
        return $user->hasPermissionTo('delete listingattachments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete listingattachments');
    }

    /**
     * Determine whether the listingAttachment can restore the model.
     */
    public function restore(User $user, ListingAttachment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the listingAttachment can permanently delete the model.
     */
    public function forceDelete(User $user, ListingAttachment $model): bool
    {
        return false;
    }
}
