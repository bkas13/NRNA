@extends('commonDashboard.master')
@section('content')

    <div class="row layout-top-spacing">
        <div class="col-11" style="margin-left:6%;">
            <div class="card m-b-25">
                <div class="card-body">
                    <div class="row mt-2 mb-3">
                        <div class="col-md-6">
                            <h4 class="mt-2 ml-3 header-title">Add Regional</h4>

                        </div>
                        <div class="col-md-6 text-md-right">
                            <a href="{{route('admin.user.all')}}" class="btn btn-primary" type="button">
                                Back to all users
                            </a>
                        </div>
                    </div>


                    <div class="col-md-8 ml-0">
                        <form action="{{route('admin.user.addSubmit')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('admin.users.commonform')
                            <div class="form-group mt-1">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
