<?php

namespace App\Repository;

interface INewsRepository
{

    public function all();

    public function getNewsByRegion($regionId);

    public function getActiveNewsByRegion($regionId);

    public function findById($id);

    public function findBySlug($slug);

    public function createData($data);

    public function updateData($data, $news);

    public function deleteData($file_path, $singleNews);

    public function getRegionalRecentNews($regionalUser, $count=5, $exclude=null);

    public function getAllRecentNews($count = 5, $exclude=null);
}
