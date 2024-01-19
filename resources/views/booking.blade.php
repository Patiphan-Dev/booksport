@extends('layout')
@section('body')
    <div class="card p-5 mt-3">
        <form action="{{ route('addBooking') }}" method="post" enctype="multipart/form-data">
            @csrf
            @php
                $date = date('Y-m-d');
                $str_time = date('H:i');
                $end_time = date('H:i', strtotime('+1 hour'));
            @endphp
            <div class="row">
                <div class="col-3 col-md-3">
                    <label for="stadium_id">สนามกีฬา :</label>
                    <select class="form-select" name="bk_std_id" id="bk_std_id"
                        @if ($search != '') disabled @endif required>
                        <option value="" disabled>--- กรุณาเลือกสนาม ---</option>
                        @foreach ($stadiums as $stadium)
                            <option value="{{ $stadium->id }}" @if ($search->id == $stadium->id) selected @endif>
                                {{ $stadium->std_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label for="bk_date">วันที่จอง : </label>
                    <input type="date" class="form-control" name="bk_date" id="bk_date" value="{{ $date }}"
                        required>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label for="bk_str_time">เวลาเข้า : </label>
                    <input type="time" class="form-control" name="bk_str_time" id="bk_str_time"
                        value="{{ $str_time }}" required>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label for="bk_end_time">เวลาออก : </label>
                    <input type="time" class="form-control" name="bk_end_time" id="bk_end_time"
                        value="{{ $end_time }}" required>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label></label>
                    <input type="submit" class="form-control btn btn-primary" value="จองสนาม">
                </div>
            </div>
        </form>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-8">
                    <div id="calendar"></div>
                </div>
                <div class="col-4">
                    <h3>ประวัติการจอง</h3>
                    <ul class="list-group">
                        @foreach ($history as $row)
                            <li class="list-group-item">
                                {{ $row->std_name }}-{{ $row->bk_date }}-{{ $row->bk_str_time }}-{{ $row->bk_end_time }}-{{ $row->bk_status }}
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <style>
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #88888850;
            border-radius: 6px;
        }

        .carousel-item {
            width: 100%;
            max-height: 500px;
            border-top: 10px solid transparent;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.form-select').on('click', function(e) {
                const id = $('#bk_std_id').val();
                $.ajax({
                    url: '/booking/' + id,
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        e.preventDefault();
                        const newUrl = '/booking/' + id;
                        window.history.pushState({
                            path: newUrl
                        }, '', newUrl);
                        console.log(id);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            let searchParams = new url(window.location.href)
            console.log(searchParams);
            // if () {
                $('.form-select').on('change', function(e) {
                    $('#bk_std_id').val(searchParams);
                });
            // }
        });
    </script>

    <script>
        var calendar; // สร้างตัวแปรไว้ด้านนอก เพื่อให้สามารถอ้างอิงแบบ global ได้
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
                themeSystem: 'bootstrap5',
                events: [
                    @foreach ($bookings as $row)
                        {
                            id: '{{ $row->id }}',
                            title: '{{ $row->std_name }}',
                            start: '{{ date($row->bk_date) }}T{{ date($row->bk_str_time) }}',
                            end: '{{ date($row->bk_date) }}T{{ date($row->bk_end_time) }}',
                            allDay: false,
                            url: "{{ '/stadium/' . $row->id }}",
                            @if ($row->bk_status == '1')
                                backgroundColor: '#00a65a ',
                                borderColor: '#00a65a',
                                color: 'orange',
                                textColor: 'black',
                            @elseif ($row->bk_status == '2')
                                backgroundColor: '#0073b7',
                                    borderColor: '#0073b7',
                                    color: 'orange',
                                    textColor: 'black',
                            @elseif ($row->bk_status == '3')
                                backgroundColor: '#f39c12',
                                    borderColor: '#f39c12',
                                    color: 'orange',
                                    textColor: 'black',
                            @elseif ($row->bk_status == '4')
                                backgroundColor: '#f56954',
                                    borderColor: '#f56954',
                                    color: 'orange',
                                    textColor: 'black',
                            @endif
                        },
                    @endforeach
                ],

            });

            calendar.render();
        })
    </script>
@endsection
