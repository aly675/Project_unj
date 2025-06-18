@extends('layouts.kepala-upt-layout')

@section('title', 'Pengajuan Surat')

@section('page', 'Pengajuan Surat')

@section('style')
     <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'modal-show': 'modal-show 0.3s cubic-bezier(0.34, 1.56, 0.64, 1)',
                        'fade-in': 'fade-in 0.3s ease-out',
                    },
                    keyframes: {
                        'modal-show': {
                            '0%': {
                                transform: 'scale(0.7) translateY(-50px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'scale(1) translateY(0)',
                                opacity: '1'
                            }
                        },
                        'fade-in': {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
     <style>
        .modal-enter {
            animation: modal-show 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .modal-overlay-enter {
            animation: fade-in 0.3s ease-out forwards;
        }
          /* Custom scrollbar for date section */
        .date-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .date-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .date-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .date-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection

@section('main')
      <h1 class="text-2xl font-semibold text-gray-900 mb-6">Pengajuan Surat</h1>

                <!-- Table -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="overflow-x-auto">
                         <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NOMOR SURAT</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAMA PEMINJAM</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STATUS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">08.006/ITS/III/2023</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Gustian REKT</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button  onclick="openModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Ronaldinho</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Disetujui</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button  onclick="openModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Lionel Messi</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Ditolak</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button  onclick="openModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


       <!-- Modal Overlay -->
    <div
        id="modalOverlay"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 opacity-0 invisible transition-all duration-300 ease-out"
    >
    @include('kepalaUpt.pengajuan-surat.detail-surat')
    </div>
@endsection

@section('js')
        <script>
                  // Get DOM elements
        const openModalBtn = document.getElementById('openModalBtn');
        const modalOverlay = document.getElementById('modalOverlay');
        const modal = document.getElementById('modal');
        const closeBtn = document.getElementById('closeBtn');
        const suratBtn = document.getElementById('suratBtn');
        const tolakBtn = document.getElementById('tolakBtn');
        const terimaBtn = document.getElementById('terimaBtn');

        // Function to open modal with smooth animation
        function openModal() {
            modalOverlay.classList.remove('opacity-0', 'invisible');
            modalOverlay.classList.add('opacity-100', 'visible');

            // Small delay to ensure overlay is visible before animating modal
            setTimeout(() => {
                modal.classList.remove('scale-75', '-translate-y-12');
                modal.classList.add('scale-100', 'translate-y-0');
            }, 10);

            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        // Function to close modal with smooth animation
        function closeModal() {
            modal.classList.remove('scale-100', 'translate-y-0');
            modal.classList.add('scale-75', '-translate-y-12');

            // Wait for modal animation to complete before hiding overlay
            setTimeout(() => {
                modalOverlay.classList.remove('opacity-100', 'visible');
                modalOverlay.classList.add('opacity-0', 'invisible');
            }, 200);

            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Event listeners
        openModalBtn.addEventListener('click', openModal);
        closeBtn.addEventListener('click', closeModal);

        // Close modal when clicking on overlay (outside the modal)
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalOverlay.classList.contains('visible')) {
                closeModal();
            }
        });

        // Add click handlers for action buttons
        suratBtn.addEventListener('click', function() {
            // Add loading state
            const originalText = this.innerHTML;
            this.innerHTML = `
                <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Loading...
            `;
            this.disabled = true;

            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
                alert('Surat Pengajuan berhasil diunduh!');
            }, 1500);
        });

        tolakBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menolak pengajuan ini?')) {
                // Add loading state
                const originalText = this.textContent;
                this.innerHTML = `
                    <svg class="animate-spin w-4 h-4 mr-2 inline" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menolak...
                `;
                this.disabled = true;

                setTimeout(() => {
                    alert('Pengajuan berhasil ditolak!');
                    closeModal();
                    this.textContent = originalText;
                    this.disabled = false;
                }, 1500);
            }
        });

        terimaBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menerima pengajuan ini?')) {
                // Add loading state
                const originalText = this.textContent;
                this.innerHTML = `
                    <svg class="animate-spin w-4 h-4 mr-2 inline" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menerima...
                `;
                this.disabled = true;

                setTimeout(() => {
                    alert('Pengajuan berhasil diterima!');
                    closeModal();
                    this.textContent = originalText;
                    this.disabled = false;
                }, 1500);
            }
        });
        </script>
@endsection
