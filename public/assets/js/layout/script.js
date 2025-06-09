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

      if (window.myChart) {
        setTimeout(() => {
            window.myChart.resize();
        }, 250); // Delay opsional buat animasi
    }
    }

    const button = document.getElementById('profile-button');
    const dropdown = document.getElementById('profile-dropdown');

  button.addEventListener('click', () => {
    dropdown.classList.toggle('hidden');
  });

  // Optional: Close when clicking outside
  document.addEventListener('click', function (e) {
    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
      dropdown.classList.add('hidden');
    }
  });

  function logoutConfirm() {
    if (confirm('Apakah Anda yakin ingin logout?')) {
        document.getElementById('logout-form').submit();
    }
}
