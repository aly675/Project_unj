@extends('layouts.kepala-upt-layout')

@section('title', 'Kalender')

@section('style')
<style>
    body {
        background-color: #f9f9f9;
        margin: 20px;
    }

    #calendar {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }

    .fc .fc-daygrid-event {
        font-size: 0.85rem;
        padding: 4px 6px;
        border-radius: 4px;
        cursor: default;
    }

    /* Styling untuk event "Tidak Tersedia" */
    .badge-terbatas {
        background-color: #ef4444 !important; /* red-500 */
        color: white !important;
        border: 1px solid #dc2626 !important; /* red-600 */
    }
</style>
@endsection

@section('main')

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Kalender Ketersediaan Ruangan</h1>

    <div id="calendar" class="p-4 md:p-6 lg:p-10"></div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id', // Bahasa Indonesia
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                // Ganti 'events' statis dengan URL ke API kita
                events: '{{ route("kepalaupt.kalender-event") }}',

                // Tampilkan loading indicator saat data diambil
                loading: function(isLoading) {
                    if (isLoading) {
                        // Kamu bisa menambahkan efek loading di sini jika mau
                        calendarEl.style.opacity = '0.5';
                    } else {
                        calendarEl.style.opacity = '1';
                    }
                },

                // Kustomisasi tampilan event
                eventDisplay: 'block',
            });

            calendar.render();
        });
    </script>
@endsection
