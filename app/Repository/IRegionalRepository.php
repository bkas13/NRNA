<?php

namespace App\Repository;

interface IRegionalRepository
{
    public function saveData($requestData);

    public function regionalRoleUsers();

    public function individualRoleUsers();

    public function allUsers();

    public function fetchAllRoles();

    public function findByUsername($regionalUsername);

    public function findAllUserByUsername($username);

    public function findById($regionalId);

    public function findAllById($id);

    public function updateData($data, $regionalUser);

    public function toggleUserStatus($username);
}
