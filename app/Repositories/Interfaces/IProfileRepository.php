<?php

namespace App\Repositories\Interfaces;

use App\Models\Profile;
use Illuminate\Support\Collection;

interface IProfileRepository
{
    public function getProfilesAll() : Collection;

    public function getProfilesAllByActive() : Collection;

    public function GetProfilesAllSelect() : Collection;

    public function getProfileById(int $id) : Profile;

    public function insertProfile(array $dados) : bool;

    public function updateProfile(int $id, array $dados) : bool;

    public function deleteProfile(int $id, string $field) : bool;
}