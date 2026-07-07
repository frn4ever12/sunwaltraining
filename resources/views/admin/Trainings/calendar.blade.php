@extends('admin.includes.main')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <style>
        #calendar {
            padding: 20px;
        }
        .fc-event {
            cursor: pointer;
        }
        .fc-daygrid-day-number {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
        .fc-toolbar-title {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
        .nepali-date {
            font-family: 'Noto Sans Devanagari', sans-serif;
            font-size: 0.85em;
            color: #fff;
            margin-top: 4px;
        }
        .fc-tooltip {
            background: #333 !important;
            color: white !important;
            padding: 8px !important;
            border-radius: 4px !important;
            font-size: 12px !important;
            z-index: 1000 !important;
            pointer-events: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="mb-3 fw-bold">तालिम क्यालेन्डर</h3>
        <ul class="mb-3 breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('dashboard') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.training.index') }}">तालिम</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">क्यालेन्डर</a>
            </li>
        </ul>
    </div>

    <div class="card">
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ne',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
                },
                buttonText: {
                    today: 'आज',
                    month: 'महिना',
                    week: 'हप्ता',
                    day: 'दिन',
                    list: 'सूची'
                },
                events: '{{ route("admin.training.calendar-events") }}',
                eventDidMount: function(info) {
                    // Add Nepali date to event
                    var nepaliDate = document.createElement('div');
                    nepaliDate.className = 'nepali-date';
                    nepaliDate.innerHTML = info.event.extendedProps.start_bs + ' - ' + info.event.extendedProps.end_bs;
                    info.el.appendChild(nepaliDate);
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    if (info.event.url) {
                        window.location.href = info.event.url;
                    }
                },
                eventMouseEnter: function(info) {
                    var tooltip = document.createElement('div');
                    tooltip.className = 'fc-tooltip';
                    tooltip.innerHTML = '<strong>' + info.event.title + '</strong><br>' +
                        'अवस्था: ' + info.event.extendedProps.status_np + '<br>' +
                        'बि.सं.: ' + info.event.extendedProps.start_bs + ' - ' + info.event.extendedProps.end_bs;
                    tooltip.style.cssText = 'position: absolute; background: #333; color: white; padding: 8px; border-radius: 4px; font-size: 12px; z-index: 1000; pointer-events: none;';
                    document.body.appendChild(tooltip);
                    
                    var rect = info.el.getBoundingClientRect();
                    tooltip.style.left = rect.left + 'px';
                    tooltip.style.top = (rect.top - tooltip.offsetHeight - 5) + 'px';
                    
                    info.el.addEventListener('mouseleave', function() {
                        tooltip.remove();
                    });
                }
            });
            calendar.render();
        });
    </script>
@endsection
