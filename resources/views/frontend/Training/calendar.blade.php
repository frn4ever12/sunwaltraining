@extends('frontend.includes.main')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <style>
        #calendar {
            max-width: 1200px;
            margin: 0 auto;
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
            color: #666;
        }
    </style>
@endsection

@section('content')
    <div aria-label="breadcrumb" style="border-bottom: 1px solid rgb(237, 237, 237);">
        <div class="container mb-0">
            <ol class="breadcrumb p-2 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-main"><i
                            class="bi bi-house-door me-2"></i>गृह पृष्ठ</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('training.index') }}" class="text-main">तालिमहरू</a></li>
                <li class="breadcrumb-item active">तालिम क्यालेन्डर</li>
            </ol>
        </div>
    </div>

    <div class="container py-4">
        <div class="card border-0">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="fw-bold"><i class="fas fa-calendar-alt me-2"></i>तालिम क्यालेन्डर</h5>
                    <p class="text-muted">सबै तालिमहरूको मिति र विवरण हेर्नुहोस्</p>
                </div>
                <div id="calendar"></div>
            </div>
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
                events: '{{ route("training.calendar-events") }}',
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
