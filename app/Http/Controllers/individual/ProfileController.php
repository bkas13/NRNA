<?php

namespace App\Http\Controllers\individual;

use App\Http\Controllers\Controller;
use App\Http\Requests\candidate\UpdateProfileRequest;
use App\Http\Requests\individual\UpdateIndividualProfileRequest;
use App\Repository\IProfileRepository;
use App\Repository\IRegionalRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $profile, $regional;


    public function __construct(IProfileRepository $profile, IRegionalRepository $regional)
    {
        $this->profile = $profile;
        $this->regional = $regional;
    }

    public function index(){
        $individualUser = Auth::user();
        $candidateMeta = $this->profile->getProfileData($individualUser);
        $candidateImages = $this->profile->getProfileImages($individualUser);
        return view('individual.profile.index',compact('individualUser', 'candidateMeta','candidateImages'));
    }

    public function update(UpdateIndividualProfileRequest $request){
        // dd($request);
        try {
            DB::beginTransaction();
            $individual = Auth::user();
            if (!$individual) {
                Toastr::error("Candidate not found", "Error occurred");
                return redirect()->back();
            }
            // $imageData = $request->only('profileImage', 'profileBannerImage');
            $directData = $request->only([
                'profileImage', 'profileBannerImage',
                'address', 'email', 'phone', 'designation', 'facebook', 'instagram', 'twitter'
            ]);
            // dd($imageData);
            // $this->profile->saveImageMeta($imageData, $individual);

            $this->profile->createData($directData, $individual);
            $dynamicData = $request->only(['dynamic_title', 'dynamic_description']);
            $this->profile->updateDynamicMetas($dynamicData, $individual);
            DB::commit();
            Toastr::success("Profile data updated", "Success");
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }

}
