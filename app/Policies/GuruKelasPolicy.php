<?php

namespace App\Policies;

use App\Models\Guru;
use App\Models\GuruKelas;
use Illuminate\Auth\Access\Response;

class GuruKelasPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Guru $guru): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Guru $guru, GuruKelas $guruKelas): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Guru $guru): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Guru $guru, GuruKelas $guruKelas): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Guru $guru, GuruKelas $guruKelas): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Guru $guru, GuruKelas $guruKelas): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Guru $guru, GuruKelas $guruKelas): bool
    {
        //
    }
}
