@extends('layouts.super-admin-layout')

@section('title', 'Manejemen Users')

@section('page', 'Manejemen Users')

@section('main')
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-4 sm:mb-0">Manajemen Pengguna</h1>
                    <button class="bg-teal-custom hover:bg-teal-dark text-white px-6 py-2 rounded-lg font-medium transition-colors">
                        Tambah Data
                    </button>
                </div>

                <!-- Table Container -->
                <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                    <!-- Desktop Table -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Nama</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Email</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Role</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Status</th>
                                    <th class="text-left py-4 px-6 font-medium text-gray-700 uppercase text-xs tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">RF</span>
                                            </div>
                                            <span class="font-medium text-gray-900">Robert Fox</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">robert@gmail.com</td>
                                    <td class="py-4 px-6 text-gray-600">Admin</td>
                                    <td class="py-4 px-6">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                            <span class="ml-3 text-sm font-medium text-teal-custom">ON</span>
                                        </label>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">RF</span>
                                            </div>
                                            <span class="font-medium text-gray-900">Robert Fox</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">asep@gmail.com</td>
                                    <td class="py-4 px-6 text-gray-600">Kepala PUSTIKOM</td>
                                    <td class="py-4 px-6">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                            <span class="ml-3 text-sm font-medium text-teal-custom">ON</span>
                                        </label>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">RF</span>
                                            </div>
                                            <span class="font-medium text-gray-900">Robert Fox</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">agus@gmail.com</td>
                                    <td class="py-4 px-6 text-gray-600">Super Admin</td>
                                    <td class="py-4 px-6">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                            <span class="ml-3 text-sm font-medium text-red-500">OFF</span>
                                        </label>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">RF</span>
                                            </div>
                                            <span class="font-medium text-gray-900">Robert Fox</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">fadlan@gmail.com</td>
                                    <td class="py-4 px-6 text-gray-600">Koordinator</td>
                                    <td class="py-4 px-6">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                            <span class="ml-3 text-sm font-medium text-red-500">OFF</span>
                                        </label>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                                <span class="text-white font-semibold text-sm">RF</span>
                                            </div>
                                            <span class="font-medium text-gray-900">Robert Fox</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">(201) 555-0124</td>
                                    <td class="py-4 px-6 text-gray-600">Admin</td>
                                    <td class="py-4 px-6">
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                            <span class="ml-3 text-sm font-medium text-teal-custom">ON</span>
                                        </label>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards -->
                    <div class="lg:hidden">
                        <div class="p-4 space-y-4">
                            <div class="bg-white border rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">RF</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-900">Robert Fox</h3>
                                            <p class="text-sm text-gray-600">robert@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600">Role: <span class="font-medium">Admin</span></p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                        <span class="ml-3 text-sm font-medium text-teal-custom">ON</span>
                                    </label>
                                </div>
                            </div>

                            <div class="bg-white border rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">RF</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-900">Robert Fox</h3>
                                            <p class="text-sm text-gray-600">asep@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600">Role: <span class="font-medium">Kepala PUSTIKOM</span></p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" checked class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                        <span class="ml-3 text-sm font-medium text-teal-custom">ON</span>
                                    </label>
                                </div>
                            </div>

                            <div class="bg-white border rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-cyan-400 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">RF</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-900">Robert Fox</h3>
                                            <p class="text-sm text-gray-600">agus@gmail.com</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </button>
                                        <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-600">Role: <span class="font-medium">Super Admin</span></p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-custom"></div>
                                        <span class="ml-3 text-sm font-medium text-red-500">OFF</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="bg-white px-6 py-4 border-t flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center space-x-2 mb-4 sm:mb-0">
                            <span class="text-sm text-gray-600">Showing</span>
                            <select class="border border-gray-300 rounded px-2 py-1 text-sm">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                            </select>
                            <span class="text-sm text-gray-600">of 50</span>
                        </div>

                        <div class="flex items-center space-x-1">
                            <button class="p-2 text-gray-400 hover:text-gray-600 disabled:opacity-50" disabled>
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </button>
                            <button class="px-3 py-1 bg-teal-custom text-white rounded text-sm">1</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">2</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">3</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">4</button>
                            <button class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded text-sm">5</button>
                            <button class="p-2 text-gray-600 hover:text-gray-800">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
@endsection

@section('js')
   <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Toggle sidebar for mobile
        function toggleSidebar() {
            const overlay = document.getElementById('sidebar-overlay');
            overlay.classList.toggle('hidden');
        }

        // Close sidebar when clicking overlay
        document.getElementById('sidebar-overlay').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleSidebar();
            }
        });

        // Toggle switch functionality
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const statusText = this.parentElement.querySelector('span');
                if (this.checked) {
                    statusText.textContent = 'ON';
                    statusText.className = 'ml-3 text-sm font-medium text-teal-custom';
                } else {
                    statusText.textContent = 'OFF';
                    statusText.className = 'ml-3 text-sm font-medium text-red-500';
                }
            });
        });
    </script>
@endsection
