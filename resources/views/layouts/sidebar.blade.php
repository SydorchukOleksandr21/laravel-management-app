<div id="sidebar"
     class="bg-sidebar flex flex-col h-screen duration-300 ease-in-out stat-card relative w-64 rounded-none">
    <div class="flex items-center justify-between p-4 border-b ">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 rounded-md bg-sidebar-primary flex items-center justify-center">
                <span class="text-white font-bold">A</span>
            </div>
            <span class="text-sidebar-foreground font-semibold">{{auth()->user()->name ?? "Guest"}}</span>
        </div>
        {{--            <button type="button" id="toggle-sidebar"--}}
        {{--                    class="text-sidebar-foreground hover:bg-sidebar-accent p-2 rounded-md">--}}
        {{--                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"--}}
        {{--                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
        {{--                    <line x1="18" y1="6" x2="6" y2="18"></line>--}}
        {{--                    <line x1="6" y1="6" x2="18" y2="18"></line>--}}
        {{--                </svg>--}}
        {{--            </button>--}}
    </div>

    <div class="flex-1 overflow-y-auto py-4 px-3">
        <!-- Icon Buttons Section -->
        <div class="mb-6 flex flex-wrap gap-2 justify-center">
            <button class="sidebar-icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                </svg>
            </button>
            <button class="sidebar-icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
            </button>
            <button class="sidebar-icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
            </button>
            <button class="sidebar-icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </button>
        </div>

        <div class="space-y-1">
            @include('components.sidebarButton', [
                'routeName' => 'dashboard',
                'iconName' => 'dashboard',
                'label' => 'Dashboard'
            ])

            @include('components.sidebarButton', [
                'routeName' => 'room-sample.index',
                'iconName' => 'room-template',
                'label' => __('property.room-sample.header')
            ])

            @include('components.sidebarButton', [
                'routeName' => 'room.index',
                'iconName' => 'bed',
                'label' => __('property.room.header')
            ])

            @include('components.sidebarButton', [
                'routeName' => 'guest.index',
                'iconName' => 'user',
                'label' => __('property.guest.header')
            ])

            @include('components.sidebarButton', [
                'routeName' => 'booking.index',
                'iconName' => 'booking',
                'label' => __('property.booking.header')
            ])


            <a href="#analytics" class="sidebar-link">
                <x-icon name="bar-chart"/>
                <span>Analytics</span>
            </a>
            <a href="#users" class="sidebar-link">
                <x-icon name="users"/>
                <span>Users</span>
            </a>
            <a href="#reports" class="sidebar-link">
                <x-icon name="document"/>
                <span>Reports</span>
            </a>
        </div>

        <div class="mt-8 pt-4 border-t ">
            <div class="space-y-1">
                <a href="#settings" class="sidebar-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    <span>Settings</span>
                </a>
                <a href="#help" class="sidebar-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <span>Help</span>
                </a>
                <a href="#notifications" class="sidebar-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span>Notifications</span>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t p-4">
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="sidebar-link flex items-center gap-2 w-full text-left">
                <x-icon name="exit"/>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>
