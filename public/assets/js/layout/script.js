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
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
