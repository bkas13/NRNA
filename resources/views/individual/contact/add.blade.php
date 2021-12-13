@extends('commonDashboard.master')
@push('styles')

@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" class="form-control">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="message">Message</label>
                    <textarea name="message" class="summernote">
                                                {{-- {{ old('message', $settingsData['banner_subtitle'] ?? '') }} --}}
                                            </textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
