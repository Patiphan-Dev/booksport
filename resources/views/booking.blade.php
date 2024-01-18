@extends('layout')
@section('body')
    <div class="card p-5 mt-3">
        <form action="{{ url('/booking') }}" method="post">
            @csrf
            @php
                $date = date('Y-m-d');
                $str_time = date('H:i');
                $end_time = date('H:i', strtotime('+1 hour'));
            @endphp
            <div class="row">
                <div class="col-3">
                    <label for="stadium_id">สนามกีฬา :</label>
                    <select class="form-select" name="std_id" id="std_id" @if ($search != '') disabled @endif
                        required>
                        <option value="" disabled selected>--- กรุณาเลือกสนาม ---</option>
                        @foreach ($stadiums as $stadium)
                            <option value="{{ $stadium->id }}"
                                @if ($search != '') @if ($search->id == $stadium->id) selected @endif
                                @endif >
                                {{ $stadium->std_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="booking_date">วันที่จอง : </label>
                    <input type="date" class="form-control" name="booking_date" id="booking_date"
                        value="{{ $date }}" required>
                </div>
                <div class="col-2">
                    <label for="booking_date">เวลาเข้า : </label>
                    <input type="time" class="form-control" name="booking_date" id="booking_date"
                        value="{{ $str_time }}" required>
                </div>
                <div class="col-2">
                    <label for="booking_date">เวลาออก : </label>
                    <input type="time" class="form-control" name="booking_date" id="booking_date"
                        value="{{ $end_time }}" required>
                </div>
                <div class="col-2">
                    <label></label>
                    <input type="submit" class="form-control btn btn-outline-primary" value="Book Stadium">
                </div>
            </div>
        </form>

    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.form-select').on('click', function(e) {
                const id = $('#std_id').val();
                $.ajax({
                    url: '/booking/' + id,
                    method: 'GET',
                    success: function(response) {
                        e.preventDefault();
                        window.history.pushState({
                            path: '/booking/' + id
                        }, '', '/booking/' + id);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');
            var calendar = new Calendar(calendarEl, {
                locale: 'th',
                timeZone: 'Asia/Bangkok',
                titleFormat: {
                    month: 'long',
                    year: 'numeric',
                    day: 'numeric'
                },
                buttonText: {
                    today: 'วันนี้',
                    timeGridDay: 'วัน',
                    timeGridWeek: 'สัปดาห์',
                    dayGridMonth: 'เดือน'

                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                events: [
                    @foreach ($bookings as $row)
                        {
                            id: '{{ $row->bk_std_id }}',
                            title: '{{ $row->bk_username }}',
                            start: '{{ $row->bk_str_time }}',
                            end: '{{ $row->bk_end_time }}',
                            allDay: false,
                            //  url: '{{ '/reservecar/detail/' . $row->id }}',
                            //  @if ($row->car_id == '1')
                            //      backgroundColor: '#00a65a ',
                            //      borderColor: '#00a65a',
                            //      color: 'orange',
                            //      textColor: 'black',
                            //  @elseif ($row->car_id == '2')
                            //      backgroundColor: '#0073b7', 
                            //          borderColor: '#0073b7', 
                            //          color: 'orange',
                            //          textColor: 'black',
                            //  @elseif ($row->car_id == '3')
                            //      backgroundColor: '#f39c12', 
                            //          borderColor: '#f39c12', 
                            //          color: 'orange',
                            //          textColor: 'black',
                            //  @elseif ($row->car_id == '4')
                            //      backgroundColor: '#f56954', 
                            //          borderColor: '#f56954', 
                            //          color: 'orange',
                            //          textColor: 'black',
                            //  @endif
                        },
                    @endforeach
                ],

            });

            calendar.render();
        })
    </script>
@endsection
