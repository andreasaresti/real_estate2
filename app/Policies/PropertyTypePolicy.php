<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PropertyType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the propertyType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list propertytypes');
    }

    /**
     * Determine whether the propertyType can view the model.
     */
    public function view(User $user, PropertyType $model): bool
    {
        return $user->hasPermissionTo('view propertytypes');
    }

    /**
     * Determine whether the propertyType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create propertytypes');
    }

    /**
     * Determine whether the propertyType can update the model.
     */
    public function update(User $user, PropertyType $model): bool
    {
        return $user->hasPermissionTo('update propertytypes');
    }

    /**
     * Determine whether the propertyType can delete the model.
     */
    public function delete(User $user, PropertyType $model): bool
    {
        return $user->hasPermissionTo('delete propertytypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete propertytypes');
    }

    /**
     * Determine whether the propertyType can restore the model.
     */
    public function restore(User $user, PropertyType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the propertyType can permanently delete the model.
     */
    public function forceDelete(User $user, PropertyType $model): bool
    {
        return false;
    }
}
