<?php

namespace App\Repository;

interface IAdminSiteSettingRepository
{

    public function createData($request);

    public function getSetting($regionalUser);

    public function getSettingImages($regionalUser);

    public function createBanner($request, $regional);

    public function updateBanner($request, $regional);

    public function findBanner($id);

    public function getBannerData($regionalUser);

    public function getActiveBannerData($id);

    public function deleteBanner($banner);
}
