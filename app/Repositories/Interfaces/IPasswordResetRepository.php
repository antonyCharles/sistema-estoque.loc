<?php

namespace App\Repositories\Interfaces;

use App\Models\PasswordReset;

interface IPasswordResetRepository
{
    public function getPasswordResetsByToken(string $token) : PasswordReset;

    public function insertPasswordReset(string $email) : PasswordReset;

    public function removePasswordReset($value, $column) : bool;
}