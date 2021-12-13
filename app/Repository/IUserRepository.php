<?php

namespace App\Repository;

interface IUserRepository
{

    public function changePassword($user, $password);
}
