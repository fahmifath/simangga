<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RKAKL;
use Illuminate\Auth\Access\HandlesAuthorization;

class RKAKLPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_r::k::a::k::l');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RKAKL $rKAKL): bool
    {
        return $user->can('view_r::k::a::k::l');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_r::k::a::k::l');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RKAKL $rKAKL): bool
    {
        return $user->can('update_r::k::a::k::l');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RKAKL $rKAKL): bool
    {
        return $user->can('delete_r::k::a::k::l');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_r::k::a::k::l');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, RKAKL $rKAKL): bool
    {
        return $user->can('force_delete_r::k::a::k::l');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_r::k::a::k::l');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, RKAKL $rKAKL): bool
    {
        return $user->can('restore_r::k::a::k::l');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_r::k::a::k::l');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, RKAKL $rKAKL): bool
    {
        return $user->can('replicate_r::k::a::k::l');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_r::k::a::k::l');
    }
}
