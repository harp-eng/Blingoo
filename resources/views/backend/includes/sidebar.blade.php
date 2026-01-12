<?php
$notifications = optional(auth()->user())->unreadNotifications;
$notifications_count = optional($notifications)->count();
$notifications_latest = optional($notifications)->take(5);
?>

<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">
    <div class="sidebar-header border-bottom">
        <div class="sidebar-brand d-sm-flex justify-content-center">
            <a href="/">
                <img class="sidebar-brand-full" src="{{ asset('img/logo-with-text.jpg') }}" alt="{{ app_name() }}"
                    height="46">
                <img class="sidebar-brand-narrow" src="{{ asset('img/logo-square.jpg') }}" alt="{{ app_name() }}"
                    height="46">
            </a>
        </div>
        <button class="btn-close d-lg-none" data-coreui-dismiss="offcanvas" data-coreui-theme="dark" type="button"
            aria-label="Close"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"></button>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.dashboard') }}">
                <i class="nav-icon fa-solid fa-cubes"></i>&nbsp;@lang('Dashboard')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('backend.notifications.index') }}">
                <i class="nav-icon fa-regular fa-bell"></i>&nbsp;@lang('Notifications')
                @if ($notifications_count)
                    &nbsp;<span class="badge badge-sm bg-info ms-auto">{{ $notifications_count }}</span>
                @endif
            </a>
        </li>

        @can('view_categories') {{-- You can use any permission that covers all sub-items --}}
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-cogs"></i>&nbsp;@lang('Catalog')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">

                    @php
                        $modules = [
                            ['name' => 'categories', 'text' => __('Categories'), 'icon' => 'fa-solid fa-folder'],
                            ['name' => 'brands', 'text' => __('Brands'), 'icon' => 'fa-solid fa-tag'],
                            ['name' => 'units', 'text' => __('Units'), 'icon' => 'fa-solid fa-ruler'],
                            ['name' => 'products', 'text' => __('Products'), 'icon' => 'fa-solid fa-cube'],
                        ];
                    @endphp

                    @foreach ($modules as $module)
                        @php
                            $permission = 'view_' . $module['name'];
                            $url = route('backend.' . $module['name'] . '.index');
                        @endphp

                        @can($permission)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $url }}">
                                    <span class="nav-icon"><i class="{{ $module['icon'] }}"></i></span> {{ $module['text'] }}
                                </a>
                            </li>
                        @endcan
                    @endforeach

                </ul>
            </li>
        @endcan


        @php
            $module_name = 'invoices';
            $text = __('Invoices');
            $icon = 'fa-solid fa-box'; // Set the icon for invoices
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'promotions';
            $text = __('Promotions');
            $icon = 'fa-solid fa-box'; // Set the icon for promotions
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'reports';
            $text = __('Reports');
            $icon = 'fa-solid fa-box'; // Set the icon for reports
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @can('view_delivery')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-truck"></i>&nbsp;@lang('Delivery')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    {{-- Delivery Routes --}}
                    @can('view_deliveryroutes')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.deliveryroutes.index') }}">
                                <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
                                @lang('Delivery Routes')
                            </a>
                        </li>
                    @endcan

                    {{-- Delivery Time Slots --}}
                    @can('view_deliverytimeslots')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.deliverytimeslots.index') }}">
                                <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
                                @lang('Delivery Time Slots')
                            </a>
                        </li>
                    @endcan

                    {{-- Areas --}}
                    @can('view_areas')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('backend.areas.index') }}">
                                <span class="nav-icon"><span class="nav-icon-bullet"></span></span>
                                <i class="nav-icon"></i>&nbsp;@lang('Delivery Areas')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan





        @php
            $module_name = 'orders';
            $text = __('Orders');
            $icon = 'fa-solid fa-box-open'; // Set the icon for orders
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />




        @php
            $module_name = 'settings';
            $text = __('Settings');
            $icon = 'fa-solid fa-gears';
            $permission = 'edit_' . $module_name;
            $url = route('backend.' . $module_name);
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'backups';
            $text = __('Backups');
            $icon = 'fa-solid fa-box-archive';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'users';
            $text = __('Users');
            $icon = 'fa-solid fa-user-group';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @php
            $module_name = 'roles';
            $text = __('Roles');
            $icon = 'fa-solid fa-user-shield';
            $permission = 'view_' . $module_name;
            $url = route('backend.' . $module_name . '.index');
        @endphp
        <x-backend.sidebar-nav-item :permission="$permission" :url="$url" :icon="$icon" :text="$text" />

        @can('view_logs')
            <li class="nav-group" aria-expanded="true">
                <a class="nav-link nav-group-toggle" href="#">
                    <i class="nav-icon fa-solid fa-list-ul"></i>&nbsp;@lang('Logs')
                </a>
                <ul class="nav-group-items compact" style="height: auto;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::dashboard') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Log Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('log-viewer::logs.list') }}">
                            <span class="nav-icon"><span class="nav-icon-bullet"></span></span> Daily Log
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

    </ul>
    <div class="sidebar-footer border-top d-none d-md-flex">
        <button class="sidebar-toggler" data-coreui-toggle="unfoldable" type="button"></button>
    </div>
</div>
