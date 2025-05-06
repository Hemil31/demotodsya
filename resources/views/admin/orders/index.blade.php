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
                    {{ __('messages.order_list') }}
                </h3>
            </div>

            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('order.today-download-restaurant') }}"
                   class="btn btn-primary"
                   data-toggle="tooltip"
                   title="Download Today's Orders">
                    <i class="la la-download mr-2"></i> {{ __('messages.order_resturant') }}
                </a>
            </div>
            {{-- <div class="kt-portlet__head-toolbar">
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.user.add_user') }}
                </a>
            </div> --}}
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                Launch demo modal
            </button>
            <!-- Datatable -->
            <table class="table table-bordered table-hover table-checkable" id="usersTable">
                <thead>
                    <tr>
                        <th>{{ __('messages.restaurant_name') }}</th>
                        <th>{{ __('messages.created_at') }}</th>
                        <th>{{ __('messages.actions') }}</th>
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
                ajax: '{{ route('order.data') }}',
                columns: [
                    {
                        data: 'restaurant_name',
                        name: 'restaurant_name',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
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
