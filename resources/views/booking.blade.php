@extends('layout')
@section('body')
    <style>
        .custom-popover {
            --bs-popover-max-width: 100%;
            --bs-popover-border-color: red;
            --bs-popover-header-bg: red;
            --bs-popover-header-color: #fff;
            --bs-popover-body-padding-x: 1rem;
            --bs-popover-body-padding-y: .5rem;
        }

        .img_bk_slip {
            max-width: 300px;
            border: 1px solid #88888850;
            border-radius: 6px;
            padding: 6px;
            width: 15vw;
            height: 40vh;
            background-color: rgb(255, 242, 228);
            align-items: center;
            text-align: center
        }

        #calendar ::-webkit-scrollbar {
            width: 4px;
        }

        #calendar ::-webkit-scrollbar-thumb {
            background-color: #88888850;
            border-radius: 6px;
        }

        .carousel-item {
            width: 100%;
            max-height: 500px;
            border-top: 10px solid transparent;
        }

        #image-preview {
            max-width: 100%;
            max-height: 200px;
        }
    </style>
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
    <div class="row bg-dark rounded-bottom-5" id="booking">
        <div class="booking-form py-md-4 mt-3">
            @include('formBooking')
        </div>
    </div>
    <div class="row mt-5">
        {{-- ปฏิทิน --}}
        <div class="col-12 col-md-8 mb-5">
            <div id="calendar"></div>
        </div>
        {{-- ประวัติการจอง --}}
        <div class="col-12 col-md-4">
            <h3>ประวัติการจอง</h3>
            @if (count($history) == 0)
                <div class="alert alert-warning" role="alert">
                    ไม่มีประวัติการจองสนาม !!
                </div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($history as $row)
                        <div class="list-group-item d-flex justify-content-between align-items-start">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#eventModal{{ $row->id }}"
                                class="text-dark d-flex link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                <div class="me-auto">
                                    <div class="fw-bold">สถานที่ : {{ $row->std_name }}</div>
                                    วันที่ : {{ $row->bk_date }} <br>
                                    เวลา : {{ $row->bk_str_time }} น. ถึง {{ $row->bk_end_time }} น.
                                </div>
                            </a>
                            @if ($row->bk_status == 1)
                                <span class="badge bg-warning rounded-pill"> รอชำระเงิน</span>
                            @elseif($row->bk_status == 2)
                                <span class="badge bg-primary rounded-pill"> รอตรวจสอบ</span>
                            @elseif($row->bk_status == 3)
                                <span class="badge bg-success rounded-pill"> อนุมัติ</span>
                            @else
                                <span class="badge bg-danger rounded-pill cursor-pointer"
                                    data-bs-custom-class="custom-popover" data-bs-container="body" data-bs-toggle="popover"
                                    data-bs-title="หมายเหตุ" data-bs-placement="top" data-bs-content="{{ $row->bk_node }}"
                                    data-toggle="tooltip" data-placement="top" title="กดดูหมายเหตุ">
                                    ไม่อนุมัติ</span>
                            @endif
                        </div>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    {{-- Modal edit booking --}}
    @foreach ($bookings as $row)
        <div class="modal fade" id="eventModal{{ $row->id }}" tabindex="-1" aria-labelledby="eventModalLabel"
            aria-hidden="true">
            <div class="modal-dialog @if (Auth::user()->username == $row->bk_username) modal-lg @endif">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        @include('editBooking')
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- JS ปฏิทิน  --}}
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
