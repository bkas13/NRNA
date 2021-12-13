<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\regional\RegionalRequest;
use App\Http\Requests\regional\UpdateRegionalRequest;
use Illuminate\Http\Request;
use App\Repository\IRegionalRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $regional;

    public function __construct(IRegionalRepository $regional)
    {
        $this->regional = $regional;
    }

    public function index()
    {
        $allUsers = $this->regional->allUsers();
        return view('admin.users.index', compact('allUsers'));
    }
    public function add()
    {
        $allRoles = $this->regional->fetchAllRoles();
        return view('admin.users.add', compact('allRoles'));
    }

    public function addSubmit(RegionalRequest $request)
    {
        try{
            DB::beginTransaction();
            $user = $this->regional->saveData($request);
            if ($user){
                DB::commit();
                Toastr::success("New user created", "Operation success");
                return redirect()->back();
            }else{
                Toastr::error("Failed to create user", "Operation failed");
                return redirect()->back();
            }
        }
        catch(\Exception $e){
            DB::rollBack();
            Toastr::error($e->getMessage(), "Operation failed");
            return redirect()->back();
        }

    }

    public function edit($username)
    {
        $editUser = $this->regional->findAllUserByUsername($username);
        $allRoles = $this->regional->fetchAllRoles();
        if (!$editUser) {
            Toastr::error('Regional User not Found', 'Operation Error');
            return redirect()->back();
        }
        return view('admin.users.edit', compact('editUser','allRoles'));
    }

    public function update(UpdateRegionalRequest $request)
    {
        // dd($request);
        $editUser = $this->regional->findAllById($request->user_id);
        if (!$editUser) {
            Toastr::error('Regional User not Found', 'Operation Error');
            return redirect()->back();
        }
        $this->regional->updateData($request, $editUser);
        Toastr::success("Regional Data Updated", "Operation Success");
        return redirect()->route('admin.user.all');
    }

    public function toggleActive($username){
        try{
            $this->regional->toggleUserStatus($username);
            Toastr::success("User status changed","Operation Success");
            return redirect()->back();
        }catch(\Exception $e){
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }
}
