@extends('commonDashboard.master')
@section('content')

    <div class="row">
        <div class="col-11" style="margin-left:6%;">
            <div class="card m-b-25">
                <div class="card-body">
                    <div class="row mt-2 mb-3">
                        <div class="col-md-6">
                            <h4 class="mt-2 ml-3 header-title">Edit User</h4>

                        </div>
                        <div class="col-md-6 text-md-right">
                            <a href="{{route('admin.user.all')}}" class="btn btn-primary" type="button">
                                Back to all Users
                            </a>
                        </div>
                    </div>


                    <div class="col-md-8 ml-0">
                        <form action="{{route('admin.user.update',$editUser->username)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$editUser->id}}">
                            @include('admin.users.commonform')
                            <div class="form-group mt-1">
                                <button class="btn btn-primary" type="submit">Edit</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
