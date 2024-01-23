@extends('layout')
@section('body')
    <div class="card p-5 mt-3">
        <form action="{{ route('addBooking') }}" method="post" enctype="multipart/form-data">
            @csrf
            @php
                $date = date('Y-m-d');
                $str_time = date('H:00');
                $end_time = date('H:00', strtotime('+1 hour'));
            @endphp
            <div class="row">
                <div class="col-3 col-md-3">
                    <label for="stadium_id">สนามกีฬา :</label>
                    <select class="form-select" name="bk_std_id" id="bk_std_id" required>
                        <option value="" disabled selected>--- กรุณาเลือกสนาม ---</option>
                        @foreach ($stadiums as $stadium)
                            <option value="{{ $stadium->id }}"
                                @if (!empty($search)) @if ($search->id == $stadium->id) selected @endif
                                @endif>
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
                <div class="col-12 col-md-8">
                    <div id="calendar"></div>
                </div>
                <div class="col-12 col-md-4">
                    <h3>ประวัติการจอง</h3>
                    <ul class="list-group list-group-flush">
                        @foreach ($history as $row)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#eventModal{{ $row->id }}"
                                class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold">สถานที่ : {{ $row->std_name }}</div>
                                    วันที่ : {{ $row->bk_date }} <br>
                                    เวลา : {{ $row->bk_str_time }} น. ถึง {{ $row->bk_end_time }} น.
                                </div>

                                @if ($row->bk_status == 1)
                                    <span class="badge bg-warning rounded-pill"> รอชำระเงิน</span>
                                @elseif($row->bk_status == 2)
                                    <span class="badge bg-primary rounded-pill"> รอตรวจสอบ</span>
                                @elseif($row->bk_status == 3)
                                    <span class="badge bg-success rounded-pill"> อนุมัติ</span>
                                @else
                                    <span class="badge bg-danger rounded-pill"> ยกเลิก</span>
                                @endif
                            </a>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    @foreach ($history as $row)
        <div class="modal fade" id="eventModal{{ $row->id }}" tabindex="-1" aria-labelledby="eventModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close  float-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <ul class="list-group list-group-flush">
                            <a href="#" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2me-auto">
                                    <div class="fw-bold">สถานที่ : {{ $row->std_name }}</div>
                                    <span> วันที่ : {{ $row->bk_date }} </span><br>
                                    <span>เวลา : {{ $row->bk_str_time }} น. ถึง {{ $row->bk_end_time }} น. </span><br>
                                    <span>ผู้จอง : คุณ {{ $row->bk_username }} </span><br>
                                    <span>วันที่จอง : {{ $row->created_at }}</span><br>
                                </div>
                                @if ($row->bk_status == 1)
                                    <span class="badge bg-warning rounded-pill"> รอชำระเงิน</span>
                                @elseif($row->bk_status == 2)
                                    <span class="badge bg-primary rounded-pill"> รอตรวจสอบ</span>
                                @elseif($row->bk_status == 3)
                                    <span class="badge bg-success rounded-pill"> อนุมัติ</span>
                                @else
                                    <span class="badge bg-danger rounded-pill"> ยกเลิก</span>
                                @endif
                            </a>
                        </ul>
                        <div class="text-center">
                            <div id="slipeView"></div>
                            <input type="file" class="btn btn-primary" name="bk_slipe" id="files"
                                accept="image/jpeg, image/png">
                        </div>

                    </div>
                    <div class="modal-footer float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


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
            let imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img class="col-6 col-md-4 mb-3">')).attr('src', event
                                .target
                                .result)
                            .appendTo(
                                placeToInsertImagePreview);
                    }
                    reader.readAsDataURL(input.files);
                }
            };

            $('#files').on('change', function() {
                imagesPreview(this, '#slipeView');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var id = $('#bk_std_id').val();

            $('#bk_std_id').on('click', function(e) {
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
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
            $('#bk_std_id').val(id);
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
                // initialView: 'listWeek',
                editable: true,
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
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',

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
                            // url: "{{ '/stadium/' . $row->bk_std_id }}",
                            status: '{{ $row->bk_status }}',
                            @if ($row->bk_status == '1')
                                backgroundColor: '#FFBF00',
                                borderColor: '#FFBF00',
                            @elseif ($row->bk_status == '2')
                                backgroundColor: '#0000FF',
                                    borderColor: '#0000FF',
                            @elseif ($row->bk_status == '3')
                                backgroundColor: '#008000',
                                    borderColor: '#008000',
                            @else
                                backgroundColor: '#FF0000',
                                borderColor: '#FF0000',
                            @endif
                            color: 'orange',
                            textColor: 'black',
                        },
                    @endforeach
                ],

                eventClick: function(info) {
                    $('#eventModal' + info.event.id).modal('show');
                    // $('#eventModalTitle' + info.event.id).html(info.event.title);
                }

            });

            calendar.render();
        })
    </script>
@endsection
