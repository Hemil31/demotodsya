<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
    <!-- begin:: Header Menu -->
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
        </div>
    </div>
    <!-- end:: Header Menu -->

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <!-- Display the greeting and username of the logged-in user -->
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">{{ __('Messages.hi') }}</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ auth()->user()->name }}</span>
                    <!-- Alternatively, use the first letter of the username in a badge -->
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">
                        {{ strtoupper(auth()->user()->name[0]) }}
                    </span>
                </div>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0);" class="dropdown-item"
                        onclick="window.location.href='{{ route('admin.logout') }}'">
                        <i class="fas fa-user-circle text-primary"></i>{{ __('Messages.profile') }}
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.logout') }}"
                        class="dropdown-item"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt text-primary"></i> {{ __('Messages.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <!--end: User Bar -->
    </div>
    <!-- end:: Header Topbar -->
</div>
