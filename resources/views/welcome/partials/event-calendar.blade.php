<div class="col-lg-4 col-md-6 col-sm-12 my-3">
    <div class="card h-100 border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>तालिम क्यालेन्डर</h6>
        </div>
        <div class="card-body p-0">
            <div id="landing-calendar" style="min-height: 300px;"></div>
        </div>
        <div class="card-footer bg-white text-center">
            <a href="{{ route('training.calendar') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-external-link-alt me-1"></i>पूरै क्यालेन्डर हेर्नुहोस्
            </a>
        </div>
    </div>
</div>

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <style>
        #landing-calendar {
            padding: 10px;
        }
        #landing-calendar .fc-toolbar {
            margin-bottom: 10px;
        }
        #landing-calendar .fc-toolbar-title {
            font-size: 14px;
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
        #landing-calendar .fc-button {
            padding: 4px 8px;
            font-size: 12px;
        }
        #landing-calendar .fc-daygrid-day-number {
            font-size: 12px;
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
        #landing-calendar .fc-event {
            font-size: 11px;
            padding: 2px 4px;
            cursor: pointer;
        }
        #landing-calendar .fc-daygrid-event {
            margin-top: 2px;
        }
        .landing-nepali-date {
            font-family: 'Noto Sans Devanagari', sans-serif;
            font-size: 10px;
            color: #fff;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('landing-calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'ne',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: ''
                },
                height: 'auto',
                events: '{{ route("training.calendar-events") }}',
                eventDidMount: function(info) {
                    var nepaliDate = document.createElement('div');
                    nepaliDate.className = 'landing-nepali-date';
                    nepaliDate.innerHTML = info.event.extendedProps.start_bs;
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
                    tooltip.style.cssText = 'position: fixed; background: #333; color: white; padding: 8px; border-radius: 4px; font-size: 11px; z-index: 10000; pointer-events: none; max-width: 200px;';
                    document.body.appendChild(tooltip);
                    
                    tooltip.style.left = (info.jsEvent.pageX + 10) + 'px';
                    tooltip.style.top = (info.jsEvent.pageY - 10) + 'px';
                    
                    info.el.addEventListener('mouseleave', function() {
                        tooltip.remove();
                    });
                }
            });
            calendar.render();
        });
    </script>
@endpush
