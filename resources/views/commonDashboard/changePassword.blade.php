@extends('commonDashboard.master')

@push('styles')

@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <h3 class="text-center">Change Password - {{ $user->name }}</h3>
        </div>
        <div class="col-12">
            <form method="post" action="{{ route('auth.changePassword') }}">
                @csrf
                <div class="card mt-3 mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="form-group">
                                    <label for="#email">Email</label>
                                    <input type="text" id="email" class="form-control" value="{{ $user->email }}"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="#old">Old Password</label>
                                    <input type="password" name="old_password" id="old" class="form-control">
                                    @error('old_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="#new">New Password</label>
                                    <input type="password" name="new_password" id="new" class="form-control">
                                    @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="#confirm">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm" class="form-control">
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')

@endpush
