<?php

namespace App\Policies;

use App\Models\NotaDelCalendario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NotaDelCalendarioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, NotaDelCalendario $notaDelCalendario): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, NotaDelCalendario $notaDelCalendario): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, NotaDelCalendario $notaDelCalendario): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, NotaDelCalendario $notaDelCalendario): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, NotaDelCalendario $notaDelCalendario): bool
    {
        //
    }
}
