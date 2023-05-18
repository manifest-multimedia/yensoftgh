@extends('layouts.admin-master')

@section('head')

@endsection

@section('title')

    <title>Dashboard | Calendar</title>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' rel='stylesheet' />
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/locale-all.js'></script>


@endsection

@section('content')

        <main class="main-container">
            <div class="main-title text secondary">
                <h2>All Existing Bills</h2>
            </div>

            <div class="big-card">
                <div class="card-title">
                    <h3 class="-">Calendar</h3>

                    <a href="{{route('billings.create')}}" class="button""><span class="material-icons-outlined">add</span></a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div id='calendar'></div>


            </div>
        </div>

        </main>

@endsection

@section('scripts')

    <script src="{{(asset('assets/js/script.js'))}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                navLinks: true,
                editable: true,
                eventLimit: true,
                events: '/calendar/events',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $.ajax({
                            url: '/calendar/store',
                            data: eventData,
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                calendar.fullCalendar('renderEvent', eventData, true);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                    calendar.fullCalendar('unselect');
                },
                eventDrop: function(event, delta, revertFunc) {
                    var eventData = {
                        id: event.id,
                        title: event.title,
                        start: event.start.format(),
                        end: (event.end == null) ? event.start.format() : event.end.format(),
                        allDay: event.allDay
                    };
                    $.ajax({
                        url: '/calendar/update/' + event.id,
                        data: eventData,
                        type: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            calendar.fullCalendar('renderEvent', eventData, true);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            revertFunc();
                        }
                    });
                },
                eventClick: function(event, jsEvent, view) {
                    if (confirm("Are you sure you want to delete this event?")) {
                        $.ajax({
                            url: '/calendar/destroy/' + event.id,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                calendar.fullCalendar('removeEvents', event.id);
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                }
            });
        });
    </script>

    <script>
        // Find the success alert and set a timeout to hide it
        var successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            var displayTime = {{ session('display_time') ?? 0 }};
            if (displayTime > 0) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, displayTime * 1000);
            }
        }
    </script>

@endsection

