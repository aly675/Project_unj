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
      font-size: 0.9rem;
      padding: 2px 4px;
    }

    .badge-terbatas {
      background-color: #e60000 !important;
      color: white !important;
      border: none;
      border-radius: 4px;
      padding: 2px 6px;
      font-weight: bold;
    }
</style>

@endsection

@section('main')

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Kalender Ketersediaan Ruangan</h1>

        <div id="calendar" class="p-10"></div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                events: [
                {
                    title: 'Ruangan tersedia : 2',
                    start: '2025-06-10',
                    className: 'badge-terbatas'
                }
                ]
            });

            calendar.render();
            });

    </script>
@endsection
