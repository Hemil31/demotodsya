@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <!-- Header -->
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __('messages.dashboard') }}
                </h3>
            </div>

            <!-- Right Side Button -->
            <div class="kt-portlet__head-toolbar">
                <a href="{{ route('order.today-download') }}" class="btn btn-primary btn-lg shadow-sm" data-toggle="tooltip"
                    title="Download Today's Orders">
                    <i class="la la-download mr-2"></i> {{ __('messages.download_orders_today') }}
                </a>
            </div>
        </div>

        <!-- Body -->
        <div class="kt-portlet__body">
            <div class="row">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card card-custom bg-light-primary card-stretch gutter-b">
                        <div class="card-body">
                            <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                <i class="la la-users"></i>
                            </span>
                            <h3 class="font-weight-bold">150+</h3>
                            <p class="text-muted">Total Users</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card card-custom bg-light-success card-stretch gutter-b">
                        <div class="card-body">
                            <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                <i class="la la-shopping-cart"></i>
                            </span>
                            <h3 class="font-weight-bold">75+</h3>
                            <p class="text-muted">Orders Today</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card card-custom bg-light-warning card-stretch gutter-b">
                        <div class="card-body">
                            <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                <i class="la la-dollar"></i>
                            </span>
                            <h3 class="font-weight-bold">$10K+</h3>
                            <p class="text-muted">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
