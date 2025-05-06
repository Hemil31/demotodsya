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
            <h3 class="card-title">Add Person</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}" class="kt-form">
                @csrf

                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="restaurant_name" class="form-label">Restaurant Name</label>
                        <input type="text" name="restaurant_name" id="restaurant_name" class="form-control"
                            value="{{ old('restaurant_name') }}" placeholder="Enter restaurant name">
                    </div>

                    <div class="col-md-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control"
                            value="{{ old('password') }}" placeholder="Enter last name" required>
                    </div>

                    <div class="col-md-3">
                        <label for="mobile_number" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input type="number" name="mobile_number" id="mobile_number" class="form-control"
                            value="{{ old('mobile_number') }}" placeholder="Enter last name" required>
                    </div>

                    <div class="col-md-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="1">User</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </div>

                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> Save
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
