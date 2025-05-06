@extends('admin.layouts.master')
@section('title', 'User DataTable')
@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.user_list') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.user_add') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="kt-portlet__body">
            <!-- Datatable -->
            <table class="table table-bordered table-hover table-checkable" id="usersTable">
                <thead>
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.restaurant_name') }}</th>
                        <th>{{ __('messages.mobile_number') }}</th>
                        <th>{{ __('messages.role') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.action') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('user.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'restaurant_name',
                        name: 'restaurant_name'
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });

        $(document).on('click', '.delete-btn', function() {
            var UsersId = $(this).data('id'); // Get the address ID from the button
            var row = $(this).closest('tr'); // Get the row to be deleted
            // Confirm the deletion with the user
            var confirmDelete = confirm(
                'Are you sure you want to delete this address? This action cannot be undone.');
            if (confirmDelete) {
                $.ajax({
                    url: "{{ route('user.destroy', ':id') }}".replace(':id', UsersId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        // Handle success response
                        row.remove();
                        usersTable.ajax.reload();
                    },
                    error: function() {
                        alert('There was an error deleting the address.');
                    }
                });
            }
        });
    </script>
@endpush
