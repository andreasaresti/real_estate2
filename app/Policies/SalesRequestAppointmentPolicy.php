<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesRequestAppointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesRequestAppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesRequestAppointment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesrequestappointments');
    }

    /**
     * Determine whether the salesRequestAppointment can view the model.
     */
    public function view(User $user, SalesRequestAppointment $model): bool
    {
        return $user->hasPermissionTo('view salesrequestappointments');
    }

    /**
     * Determine whether the salesRequestAppointment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesrequestappointments');
    }

    /**
     * Determine whether the salesRequestAppointment can update the model.
     */
    public function update(User $user, SalesRequestAppointment $model): bool
    {
        return $user->hasPermissionTo('update salesrequestappointments');
    }

    /**
     * Determine whether the salesRequestAppointment can delete the model.
     */
    public function delete(User $user, SalesRequestAppointment $model): bool
    {
        return $user->hasPermissionTo('delete salesrequestappointments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesrequestappointments');
    }

    /**
     * Determine whether the salesRequestAppointment can restore the model.
     */
    public function restore(User $user, SalesRequestAppointment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesRequestAppointment can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        SalesRequestAppointment $model
    ): bool {
        return false;
    }
}
