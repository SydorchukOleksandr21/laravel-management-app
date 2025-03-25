@extends('app')

@section('sidebar')
    @include('components.sidebar')
@endsection

@section('header')
    <div class=" border-border">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 px-6 py-6">
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="absolute left-3 top-1/2 transform -translate-y-1/2 text-muted-foreground">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Search..."
                           class="pl-10 bg-secondary border-none h-10 w-full rounded-md px-3 py-2 text-base">
                </div>

                <button type="button" class="relative p-2 rounded-md hover:bg-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span class="absolute top-1 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <button type="button" class="p-2 rounded-md hover:bg-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="10" r="3"></circle>
                        <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                    </svg>
                </button>
            </div>

            <div>
                <h1 class="text-2xl font-bold tracking-tight">Dashboard</h1>
                <p class="text-muted-foreground">Welcome back, you have 12 notifications today</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users Card -->
            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-label">Total Users</div>
                    <div class="p-2 bg-primary/10 rounded-md text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                </div>
                <div class="stat-value">2,543</div>
                <div class="stat-change positive">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="mr-1">
                        <path d="M7 17l9.2-9.2M17 17V7H7"></path>
                    </svg>
                    +12.5%
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-label">Revenue</div>
                    <div class="p-2 bg-primary/10 rounded-md text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                </div>
                <div class="stat-value">$45,231</div>
                <div class="stat-change positive">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="mr-1">
                        <path d="M7 17l9.2-9.2M17 17V7H7"></path>
                    </svg>
                    +8.2%
                </div>
            </div>

            <!-- Orders Card -->
            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-label">Orders</div>
                    <div class="p-2 bg-primary/10 rounded-md text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </div>
                </div>
                <div class="stat-value">1,205</div>
                <div class="stat-change negative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="mr-1">
                        <path d="M7 7l9.2 9.2M17 7v10H7"></path>
                    </svg>
                    -3.1%
                </div>
            </div>

            <!-- Conversion Card -->
            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-label">Conversion</div>
                    <div class="p-2 bg-primary/10 rounded-md text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="20" x2="12" y2="10"></line>
                            <line x1="18" y1="20" x2="18" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="16"></line>
                        </svg>
                    </div>
                </div>
                <div class="stat-value">12.5%</div>
                <div class="stat-change positive">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="mr-1">
                        <path d="M7 17l9.2-9.2M17 17V7H7"></path>
                    </svg>
                    +2.5%
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <!-- Activity Chart -->
            <div class="lg:col-span-2 rounded-lg bg-card border border-border shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Activity Overview</h3>
                <div class="h-[300px] w-full">
                    <!-- This would typically be a chart, let's use a placeholder for now -->
                    <div class="w-full h-full flex items-center justify-center bg-muted/30 rounded-md">
                        <p class="text-muted-foreground">Chart data visualization would go here</p>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="rounded-lg bg-card border border-border shadow-sm p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Transactions</h3>
                <div class="space-y-4">
                    @for ($i = 0; $i < 5; $i++)
                        @include('components.dashboardPayment')
                    @endfor
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.getElementById('toggle-sidebar');
            const sidebar = document.getElementById('sidebar');

            sidebarToggle.addEventListener('click', function () {
                if (sidebar.classList.contains('w-64')) {
                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');

                    // Update toggle icon to menu icon
                    this.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                `;

                    // Hide text in sidebar links
                    document.querySelectorAll('.sidebar-link span').forEach(span => {
                        span.style.display = 'none';
                    });
                } else {
                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');

                    // Update toggle icon to X icon
                    this.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                `;

                    // Show text in sidebar links
                    document.querySelectorAll('.sidebar-link span').forEach(span => {
                        span.style.display = 'inline';
                    });
                }
            });
        });
    </script>
@endpush
