<?php

namespace App\Repository;

interface IContactRepository
{
    public function all();

    public function findById($id);

    public function findRegionalContact($id);

    public function destroy($id);

    public function getRegionContacts($regionId);

    public function saveData($request);

    public function saveRegionalContact($regionalUser, $request);
}
