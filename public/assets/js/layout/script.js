    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarTexts = document.querySelectorAll('.sidebar-text');
        const sidebarLabels = document.getElementById('sidebar-labels');

        // Toggle width
        sidebar.classList.toggle('w-64');
        sidebar.classList.toggle('w-20');


        // Toggle visibility of text labels
        sidebarTexts.forEach(text => text.classList.toggle('hidden'));
        sidebarLabels?.classList.toggle('hidden');

        }

    const button = document.getElementById('profile-button');
    const dropdown = document.getElementById('profile-dropdown');

    button.addEventListener('click', () => {
        const isHidden = dropdown.classList.contains('pointer-events-none');

        if (isHidden) {
            dropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
            dropdown.classList.add('opacity-100', 'scale-100');
        } else {
            dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            dropdown.classList.remove('opacity-100', 'scale-100');
        }
    });

    // Close when clicking outside
    document.addEventListener('click', function (e) {
        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
            dropdown.classList.remove('opacity-100', 'scale-100');
        }
    });


        function logoutConfirm() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: "Apakah Anda yakin ingin keluar?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, logout',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('logout-form');
                    const formData = new FormData(form);

                    try {
                        const response = await fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        const data = await response.json();

                        if (response.ok) {
                            Swal.fire({
                                toast: true,
                                position: 'bottom-end',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            // Hapus token dari localStorage jika ada (untuk SPA/API)
                            localStorage.removeItem('sanctum_token');
                            localStorage.removeItem('user_data');

                            setTimeout(() => {
                                window.location.href = '/login'; // Redirect ke halaman login
                            }, 1000);
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'bottom-end',
                                icon: 'error',
                                title: data.message || 'Gagal logout.',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    } catch (error) {
                        console.error('Error logout:', error);
                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Terjadi kesalahan saat logout.',
                            showConfirmButton: false,
                            timer: 3000
                        });
                    }
                }
            });
        }
