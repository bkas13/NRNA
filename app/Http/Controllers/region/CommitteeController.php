<?php

namespace App\Http\Controllers\region;

use App\Http\Controllers\Controller;
use App\Http\Requests\candidate\CandidateRequest;
use App\Http\Requests\candidate\UpdateCandidateRequest;
use App\Repository\ICandidateRepository;
use App\Repository\IRegionalRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommitteeController extends Controller
{
    protected $candidate, $regional;

    public function __construct(ICandidateRepository $candidate, IRegionalRepository $regional)
    {
        $this->candidate = $candidate;
        $this->regional = $regional;
    }

    public function index()
    {
        $user = Auth::user();
        $candidates = $this->candidate->candidateByRegion($user);
        return view('region.committee.index', compact('candidates'));
    }

    public function add()
    {
        $regionalUsers = $this->regional->regionalRoleUsers();
        return view('region.committee.add', compact('regionalUsers'));
    }

    public function addSubmit(CandidateRequest $request)
    {
        try {
            $saveData = $this->candidate->saveData($request);
            if ($saveData) {
                Toastr::success('Committee member Data saved', 'Operation Success');
                return redirect()->route('admin.candidate.all');
            } else {
                Toastr::error('Error! Committee member Data not saved', 'Operation Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }

    public function edit($slug)
    {
        $user = Auth::user();
        $candidate = $this->candidate->findBySlug($slug);
        if ($user->id != $candidate->regional_id) {
            Toastr::error("You do not have permission", "Access Denied");
            return redirect()->back();
        }
        $regionalUsers = $this->regional->regionalRoleUsers();
        return view('region.committee.edit', compact('candidate', 'regionalUsers'));
    }

    public function update(UpdateCandidateRequest $request)
    {
        try {
            $user = Auth::user();
            $candidate = $this->candidate->findById($request->candidate_id);
            if(!$candidate){
                Toastr::error("Member not found", "Error occurred");
                return redirect()->back();
            }
            if ($user->id != $candidate->regional_id) {
                Toastr::error("You do not have permission", "Access Denied");
            }
            $updateData = $this->candidate->updateData($request, $candidate);
            if ($updateData) {
                Toastr::success('Committee member Data saved', 'Operation Success');
                return redirect()->route('region.candidate.all');
            } else {
                Toastr::error('Error! Candidate Data not saved', 'Operation Error');

                return redirect()->route('region.committee.all');
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }

    public function destroy($slug)
    {
        try {
            $candidate = $this->candidate->findBySlug($slug);
            $profileImagePath = $candidate->profileImage->path;
            $deleteCandidate = $this->candidate->deleteCandidate($candidate, $profileImagePath);
            if ($deleteCandidate) {
                Toastr::success('Committee Member Deleted', 'Operation Success');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }

    public function profile($slug)
    {
        $user = Auth::user();
        $candidate = $this->candidate->findBySlug($slug);
        if (!$candidate) {
            Toastr::error("Committee member not found", "Error occurred");
            return redirect()->back();
        }
        if ($user->id != $candidate->regional_id) {
            Toastr::error("You do not have permission", "Access Denied");
            return redirect()->back();
        }
        $candidateMeta = $this->candidate->metaData($candidate);
        // dd($candidateMeta);
        return view('region.committee.profile', compact('candidate', 'candidateMeta'));
    }

    public function updateProfile(Request $request, $slug)
    {
        try {
            DB::beginTransaction();
            $candidate = $this->candidate->findBySlug($slug);
            if (!$candidate) {
                Toastr::error("Candidate not found", "Error occurred");
                return redirect()->back();
            }
            $imageData = $request->only('candidate_banner', 'candidate_image');
            $directData = $request->only([
                'address', 'email', 'phone', 'designation', 'facebook', 'instagram', 'twitter'
            ]);
            // dd($imageData);
            $this->candidate->saveImageMeta($imageData, $candidate);

            $this->candidate->updateCandidateMetas($directData, $candidate);
            $dynamicData = $request->only(['dynamic_title', 'dynamic_description']);
            $this->candidate->updateDynamicMetas($dynamicData, $candidate);
            DB::commit();
            Toastr::success("Candidate data updated", "Success");
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }
}
