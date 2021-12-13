
<div class="form-row mb-4">

    <div class="form-group col-md-12">
        <label for="role">Type <span class="text-danger">*</span></label>
        <select class="form-control" name="type" id="role" required
                {{isset($editUser) ? "disabled" : ""}}
            >
            <option value="">Select user type</option>
            @foreach($allRoles as $role)
                <option value="{{$role}}"
                    {{ isset($editUser) && $editUser->hasRole($role) ? "selected" : ""}}
                    >{{$role}}</option>
            @endforeach
        </select>
        @error('type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-12">
        <label for="name">Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name"
            value="{{ old('name', $editUser->name ?? '') }}" >
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="email">Email <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
            value="{{ isset($editUser->email) ? $editUser->email : ' ' }}">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label for="username">Username <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Username"
            value="{{ isset($editUser->username) ? $editUser->username : ' ' }}">
        @error('username')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" @if (!isset($regionalUser)) required
        @endif>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="password-confirm">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="password-confirm"
            placeholder="Confirm Password">
    </div>
</div>
