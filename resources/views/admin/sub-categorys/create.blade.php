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
            <h3 class="card-title">{{ __('messages.sub_category_add') }}</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('sub-category.store') }}" class="kt-form" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="category_id" class="form-label">{{ __('messages.category_name') }}</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="name" class="form-label">{{ __('messages.name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="name_gu" class="form-label">{{ __('messages.gujarati_name') }}<span
                                class="text-danger">*</span></label>
                        <input type="text" id="name_gu" name="name_i18n[gu]" class="form-control"
                            placeholder="Enter Gujaratri" value="{{ old('name_i18n[gu]') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label for="name_hi" class="form-label">{{ __('messages.hindi_name') }}<span
                                class="text-danger">*</span></label>
                        <input type="text" id="name_hi" name="name_i18n[hi]" class="form-control"
                            placeholder="Enter Hindi" value="{{ old('name_i18n[hi]') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="image" class="form-label">{{ __('messages.image') }}</label>
                        <input type="file" id="image" name="image" class="form-control"
                            value="{{ old('image') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label">{{ __('messages.status') }}</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">{{ __('messages.action') }}</option>
                            <option value="0">{{ __('messages.inactive') }}</option>
                        </select>
                    </div>

                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> {{ __('messages.save') }}
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
