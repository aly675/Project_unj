@extends('layouts.admin-layout')

@section('title', 'Dashboard')

@section('main')

     <h1 class="text-2xl font-bold text-gray-900 mb-6">Ringkasan</h1>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Surat Dibuat</h3>
                    <p class="text-3xl font-bold text-gray-900">15</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Menunggu Persetujuan</h3>
                    <p class="text-3xl font-bold text-gray-900">15</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Total Ruangan</h3>
                    <p class="text-3xl font-bold text-gray-900">15</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-gray-900">15</p>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
                <div class="flex flex-wrap items-center justify-between mb-6">
                    <div class="flex flex-wrap items-center space-x-6 mb-4 sm:mb-0">
                        <button class="text-gray-900 font-medium border-b-2 border-gray-900 pb-1">Total Surat</button>
                        <button class="text-gray-500 hover:text-gray-700">Total Ruangan</button>
                        <button class="text-gray-500 hover:text-gray-700">Status Surat</button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-gray-800 rounded-full"></div>
                            <span class="text-sm text-gray-600">Tahun ini</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                            <span class="text-sm text-gray-600">Tahun lalu</span>
                        </div>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="chartCanvas"></canvas>
                </div>
            </div>

            <!-- User Table -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6 border-b">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Daftar Pengguna</h2>
                            <p class="text-sm text-gray-500 mt-1">Pengguna Aktif</p>
                        </div>
                        <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pustikom-teal focus:border-transparent">
                            </div>
                            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pustikom-teal focus:border-transparent">
                                <option>Sort by: Newest</option>
                                <option>Sort by: Oldest</option>
                                <option>Sort by: Name</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jane Cooper</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">jane@gmail.com</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Floyd Miles</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yahoo</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(205) 555-0100</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Inactive</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Ronald Richards</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Adobe</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(302) 555-0107</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Inactive</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Marvin McKinney</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Tesla</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(252) 555-0126</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jerome Bell</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Google</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(629) 555-0129</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Kathryn Murphy</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Microsoft</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(406) 555-0120</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Jacob Jones</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Yahoo</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(208) 555-0112</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Kristin Watson</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Facebook</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">(704) 555-0127</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Inactive</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                        <p class="text-sm text-gray-500">Showing data 1 to 8 of 256K entries</p>
                        <div class="flex items-center space-x-2">
                            <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-3 py-1 text-sm bg-pustikom-teal text-white rounded">1</button>
                            <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">2</button>
                            <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">3</button>
                            <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">4</button>
                            <span class="px-3 py-1 text-sm text-gray-500">...</span>
                            <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">40</button>
                            <button class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('js')
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script src="{{asset('assets/js/admin/dashboard-admin-ringkasan.js')}}"></script>
 <script>
            // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        function toggleMobileMenu() {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        }

        mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        mobileOverlay.addEventListener('click', toggleMobileMenu);

        // Chart initialization
        const ctx = document.getElementById('chartCanvas').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Tahun ini',
                    data: [12, 8, 14, 16, 25, 22, 24],
                    borderColor: '#374151',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    tension: 0.4
                }, {
                    label: 'Tahun lalu',
                    data: [10, 6, 12, 14, 20, 18, 20],
                    borderColor: '#9CA3AF',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 30,
                        ticks: {
                            stepSize: 10,
                            callback: function(value) {
                                return value + 'K';
                            }
                        },
                        grid: {
                            color: '#F3F4F6'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 4,
                        hoverRadius: 6
                    }
                }
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                mobileOverlay.classList.add('hidden');
            }
        });

 </script>
@endsection
