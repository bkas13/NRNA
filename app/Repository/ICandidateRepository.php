<?php

namespace App\Repository;

interface ICandidateRepository
{
    public function all();

    public function candidateByRegion($regionalUser);

    public function saveData($requestData);

    public function findById($id);

    public function findBySlug($slug);

    public function findByEmail($email);

    public function updateData($data, $regionalUser);

    public function deleteCandidate($candidate, $profileImagePath);

    public function metaData($candidate);

    public function updateCandidateMetas($request, $candidate);

    public function updateDynamicMetas($dynamicData, $candidate);

    public function saveImageMeta($imageData, $candidate);
}
