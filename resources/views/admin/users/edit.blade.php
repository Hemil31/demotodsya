@extends('admin.layouts.master')
@section('title', 'Add Person')
@section('content')

    <div class="card">
        {{-- Display success message --}}
        @if (session('success'))
            <div id="flashMessage" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Display error message --}}
        @if (session('error'))
            <div id="error" class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div id="validationErrorMessage" class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-header">
            <h3 class="card-title">{{ __('messages.user_edit') }}</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $user->id) }}" class="kt-form">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="name" class="form-label">{{ __('messages.name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="restaurant_name" class="form-label">{{__('messages.restaurant_name')}}</label>
                        <input type="text" name="restaurant_name" id="restaurant_name" class="form-control"
                            value="{{ old('restaurant_name', $user->restaurant_name) }}"
                            placeholder="Enter restaurant name">
                    </div>

                    <div class="col-md-3">
                        <label for="email" class="form-label">{{__('messages.email')}}<span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    {{-- <div class="col-md-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            value="{{ old('password') }}" placeholder="Enter last name" required>
                    </div> --}}

                    <div class="col-md-3">
                        <label for="mobile_number" class="form-label">{{__('messages.mobile_number')}}<span class="text-danger">*</span></label>
                        <input type="number" name="mobile_number" id="mobile_number" class="form-control"
                            value="{{ old('mobile_number', $user->mobile_number) }}" placeholder="Enter last name"
                            required>
                    </div>

                    <div class="col-md-3">
                        <label for="role" class="form-label">{{__('messages.role')}}</label>
                        <select name="role" id="role" class="form-control">
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>{{__('messages.user')}}</option>
                            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>{{__('messages.admin')}}</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">{{__('messages.status')}}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>{{__('messages.active')}}</option>
                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>{{__('messages.inactive')}}</option>
                        </select>
                    </div>

                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> {{ __('messages.update') }}
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection
<script>
    setTimeout(function() {
        $('#flashMessage, #error, #validationErrorMessage').fadeOut('slow');
    }, 1000);
</script>
