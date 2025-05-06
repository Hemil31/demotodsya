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
                    {{ __('messages.categorys_list') }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('messages.category_add') }}
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
            <table class="table table-bordered table-hover table-checkable" id="categorysTable">
                <thead>
                    <tr>
                        <th>{{ __('messages.id') }}</th>
                        <th>{{ __('messages.name') }}</th>
                        <th>{{ __('messages.gujarati_name') }}</th> <!-- Typo fixed: gujarat**i** -->
                        <th>{{ __('messages.hindi_name') }}</th>
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
            $('#categorysTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('category.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'gujarati_name',
                        name: 'gujarati_name'
                    },
                    {
                        data: 'hindi_name',
                        name: 'hindi_name'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            return data == 1 ? 'Active' : 'Inactive';
                        }
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
            var categoryId = $(this).data('id'); // Get the address ID from the button
            var row = $(this).closest('tr'); // Get the row to be deleted
            // Confirm the deletion with the user
            var confirmDelete = confirm(
                'Are you sure you want to delete this address? This action cannot be undone.');
            if (confirmDelete) {
                $.ajax({
                    url: "{{ route('category.destroy', ':id') }}".replace(':id', categoryId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        // Handle success response
                        row.remove();
                        categorysTable.ajax.reload();
                    },
                    error: function() {
                        alert('There was an error deleting the address.');
                    }
                });
            }
        });
    </script>
@endpush
