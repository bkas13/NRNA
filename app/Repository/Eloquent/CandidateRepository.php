<?php

namespace App\Repository\Eloquent;

use App\Model\Candidate;
use App\Model\CandidateMeta;
use App\Repository\ICandidateRepository;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CandidateRepository implements ICandidateRepository
{
    public function all()
    {
        return Candidate::with(['profileImage', 'region'])->orderBy('created_at', 'desc')->get();
    }

    public function candidateByRegion($regionalUser)
    {
        return Candidate::where('regional_id', $regionalUser->id)
            ->with('profileImage')
            ->get();
    }

    public function saveData($requestData)
    {
        // dd($requestData);
        $candidate = new Candidate();
        $candidate->first_name = $requestData->first_name;
        $candidate->last_name = $requestData->last_name;
        $candidate->email = $requestData->email;
        $candidate->phone = $requestData->phone;
        $candidate->regional_id = $requestData->region;
        $result = $candidate->save();
        if ($requestData->hasFile('image')) {
            $image = $requestData->file('image');
            $path = '/uploads/candidate/';
            $db_path = imageUpload($image, $path);
            $candidate->profileImage()->create([
                'type' => 'profile_image',
                'path' => $db_path,
                'name' => $image->getClientOriginalName(),
            ]);
        }
        if ($result)
            return true;
        else
            return false;
    }



    public function findById($id)
    {
        $candidate = Candidate::find($id);
        return $candidate;
    }

    public function findBySlug($slug)
    {
        $candidate = Candidate::where('slug', $slug)->first();
        return $candidate;
    }

    public function findByEmail($email)
    {
        $candidate = Candidate::where('email', $email)->first();
        return $candidate;
    }


    public function updateData($data, $candidate)
    {
        // dd($data);
        $candidate->first_name = $data->first_name;
        $candidate->last_name = $data->last_name;
        $candidate->email = $data->email;
        $candidate->phone = $data->phone;
        $result = $candidate->save();
        if ($data->hasFile('image')) {
            if ($candidate->profile_image) {
                imageDelete($candidate->profile_image->path);
            }
            $image = $data->file('image');
            $path = '/uploads/candidate/';
            $db_path = imageUpload($image, $path);
            $candidate->profileImage()->updateOrCreate([
                'type' => 'profile_image',
            ], [
                'path' => $db_path,
                'name' => $image->getClientOriginalName(),
            ]);
        }
        if ($result)
            return true;
        else
            return false;
    }

    public function deleteCandidate($candidate, $profileImagePath)
    {
        $user = Auth::user();
        if ($user->id != $candidate->regional_id) {
            Toastr::error("You do not have permission", "Access Denied");
            return redirect()->back();
        } else {

            if ($candidate->profileImage) {
                imageDelete($profileImagePath);
            }
            $deleteCandidate = $candidate->delete();
            if ($deleteCandidate) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function generateUsername($email)
    {
        $mailName = explode('@', $email);
        $username = $mailName = strtolower($mailName[0]);
        while (true) {
            $exists = User::where('username', $username)->count();
            if ($exists == 0) {
                break;
            }
            $chars = ['-', '@', '.', '_'];
            $randomElement = $chars[array_rand($chars)];
            $username = $mailName . $randomElement . rand(1, 100);
        }
        return $username;
    }

    public function metaData($candidate)
    {
        $metaData = CandidateMeta::where('candidate_id', $candidate->id)
            ->get();
        foreach ($metaData as $data) {
            if ($data->array == 1) {
                $data->value = $data->custom;
            }
        }
        return $metaData->pluck('value', 'key')->toArray();
    }

    public function updateCandidateMetas($request, $candidate)
    {
        foreach ($request as $key => $value) {
            $this->updateMeta($key, $value, $candidate);
        }
    }

    private function updateMeta($key, $value, $candidate, $array = false)
    {
        $candidate->metaData()->updateOrCreate([
            'key' => $key
        ], [
            'array' => $array,
            'value' => $array ? json_encode($value) : $value
        ]);
    }

    public function updateDynamicMetas($dynamicData, $candidate)
    {
        $keys = array_keys($dynamicData['dynamic_title'] ?? []);
        $description = [];
        foreach ($keys as $key) {
            $description[] = [
                "title" => $dynamicData["dynamic_title"][$key],
                "description" => $dynamicData["dynamic_description"][$key]
            ];
        }
        $this->updateMeta("dynamic_description", $description, $candidate, true);
    }
    public function saveImageMeta($imageData, $candidate)
    {
        // $candidateImage = $imageData->file('candidate_image');
        // dd($candidateImage);
        foreach ($imageData as $key => $value) {
            $candidateImage = $value;
            if (!$candidateImage) {
                continue;
            }
            switch ($key) {
                case "candidate_image":
                    // dd($candidateImage);
                    $db_path = imageUpload($candidateImage, '/uploads/candidate/');
                    $candidate->profileImage()->updateOrCreate([
                        'type' => 'profile_image',
                    ], [
                        'path' => $db_path,
                        'name' => $candidateImage->getClientOriginalName(),
                    ]);
                    break;

                case "candidate_banner":
                    $db_path = imageUpload($candidateImage, '/uploads/candidate/banner/');
                    $candidate->candidateBanner()->updateOrCreate([
                        'type' => 'candidate_banner',
                    ], [
                        'path' => $db_path,
                        'name' => $candidateImage->getClientOriginalName(),
                    ]);
                    break;
            }
        }
    }
}
