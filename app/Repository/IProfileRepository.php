<?php

namespace App\Repository;

interface IProfileRepository{

    public function getProfileData($user);

    public function getProfileImages($user);


    public function createData($directData, $individual);

    public function updateDynamicMetas($dynamicData, $individual);
}
