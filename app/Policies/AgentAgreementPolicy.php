<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AgentAgreement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentAgreementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the agentAgreement can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list agentagreements');
    }

    /**
     * Determine whether the agentAgreement can view the model.
     */
    public function view(User $user, AgentAgreement $model): bool
    {
        return $user->hasPermissionTo('view agentagreements');
    }

    /**
     * Determine whether the agentAgreement can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create agentagreements');
    }

    /**
     * Determine whether the agentAgreement can update the model.
     */
    public function update(User $user, AgentAgreement $model): bool
    {
        return $user->hasPermissionTo('update agentagreements');
    }

    /**
     * Determine whether the agentAgreement can delete the model.
     */
    public function delete(User $user, AgentAgreement $model): bool
    {
        return $user->hasPermissionTo('delete agentagreements');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete agentagreements');
    }

    /**
     * Determine whether the agentAgreement can restore the model.
     */
    public function restore(User $user, AgentAgreement $model): bool
    {
        return false;
    }

    /**
     * Determine whether the agentAgreement can permanently delete the model.
     */
    public function forceDelete(User $user, AgentAgreement $model): bool
    {
        return false;
    }
}
