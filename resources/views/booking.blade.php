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
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()

            const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
            const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(
                popoverTriggerEl))

        });

        function calculateMinutes() {
            // Get the input values
            const bookInTime = document.getElementById("bk_str_time").value;
            const bookOutTime = document.getElementById("bk_end_time").value;
            // Get the selected option
            var selectedOption = $('#bk_std_id option:selected');
            // Retrieve the data-price attribute value
            var roomPrice = parseFloat(selectedOption.data('price'));

            // Convert the input values to Date objects
            const bookInDate = new Date(`2000-01-01T${bookInTime}:00Z`);
            const bookOutDate = new Date(`2000-01-01T${bookOutTime}:00Z`);

            // Calculate the time difference in minutes
            const timeDifference = (bookOutDate - bookInDate) / (1000 * 60);

            const totalPrice = (roomPrice / 60) * timeDifference
            // Display the result
            document.getElementById("result").innerText = `Time difference: ${timeDifference} minutes`;
            document.getElementById("roomPrice").innerText = `Price : ${roomPrice}`;
            document.getElementById("totalPrice").innerText = `Price : ${totalPrice}`;


        }
    </script>
    {{-- form booking  --}}
    <div class="card py-md-5 p-3 mt-3 border border-primary">
        <form action="{{ route('addBooking') }}" method="post" enctype="multipart/form-data">
            @csrf
            @php
                $date = date('Y-m-d');
                $str_time = date('00:00:00');
                $end_time = date('00:00:00', strtotime('+1 hour'));
            @endphp
            <div class="row justify-content-center">
                <div id="result"></div>
                <div id="roomPrice"></div>
                <div id="totalPrice"></div>

                <div class="col-12 col-sm-6 col-md-2">
                    <label for="stadium_id" class="form-label">สนามกีฬา :</label>
                    <select class="form-select" name="bk_std_id" id="bk_std_id" required onchange="calculateMinutes()">
                        <option value="" disabled selected>--- กรุณาเลือกสนาม ---</option>
                        @foreach ($stadiums as $stadium)
                            <option value="{{ $stadium->id }}" data-price="{{ $stadium->std_price }}"
                                @if (!empty($search)) @if ($search->id == $stadium->id) selected @endif
                                @endif>
                                {{ $stadium->std_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label for="bk_date" class="form-label">วันที่จอง : </label>
                    <input type="date" class="form-control" name="bk_date" id="bk_date" value="{{ $date }}"
                        required>
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label for="bk_str_time" class="form-label">เวลาเข้า : </label>
                    <input type="time" class="form-control" name="bk_str_time" id="bk_str_time" value="" required
                        onchange="calculateMinutes()">
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label for="bk_end_time" class="form-label">เวลาออก : </label>
                    <input type="time" class="form-control" name="bk_end_time" id="bk_end_time" value="" required
                        onchange="calculateMinutes()">
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <label for="submit" class="form-label"></label>
                    <div class="my-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-regular fa-calendar-plus"></i> จองสนาม
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                {{-- ปฏิทิน --}}
                <div class="col-12 col-md-8">
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
                                            data-bs-custom-class="custom-popover" data-bs-container="body"
                                            data-bs-toggle="popover" data-bs-title="หมายเหตุ" data-bs-placement="top"
                                            data-bs-content="{{ $row->bk_node }}" data-toggle="tooltip"
                                            data-placement="top" title="กดดูหมายเหตุ">
                                            ไม่อนุมัติ</span>
                                    @endif
                                </div>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
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
                        <form action="{{ url('updatebooking/' . $row->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 @if (Auth::user()->username == $row->bk_username) col-lg-7 @endif">
                                    <ul class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2me-auto">
                                                <div class="fw-bold">สถานที่ : {{ $row->std_name }}</div>
                                                <span> วันที่ : {{ $row->bk_date }} </span><br>
                                                <span>เวลา : {{ $row->bk_str_time }} น. ถึง {{ $row->bk_end_time }} น.
                                                </span><br>
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
                                                <span class="badge bg-danger rounded-pill cursor-pointer"
                                                    data-bs-custom-class="custom-popover" data-bs-container="body"
                                                    data-bs-toggle="popover" data-bs-title="หมายเหตุ"
                                                    data-bs-placement="top" data-bs-content="{{ $row->bk_node }}"
                                                    data-toggle="tooltip" data-placement="top">
                                                    ไม่อนุมัติ</span>
                                            @endif

                                        </div>
                                        @if ($row->bk_status == 0)
                                            <span>หมายเหตุ <span class="text-danger">***</span></span>
                                            <small class="text-danger">
                                                {{ $row->bk_node }}
                                            </small>
                                        @endif
                                    </ul>
                                    @if (Auth::user()->username == $row->bk_username)
                                        <hr>
                                        <div class="row g-0 g-3 needs-validation mb-3" novalidate>
                                            <div class="col-12 col-md-6">
                                                <label for="bk_stadium" class="form-label">สนามกีฬา<span>*</span></label>
                                                <select class="form-select" name="bk_std_id" id="bk_std_id" required>
                                                    <option value="" disabled selected>--- กรุณาเลือกสนาม ---
                                                    </option>
                                                    @foreach ($stadiums as $stadium)
                                                        <option value="{{ $stadium->id }}"
                                                            @if ($row->bk_std_id == $stadium->id) selected @endif>
                                                            {{ $stadium->std_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="bk_date" class="form-label">วันที่จอง
                                                    <span>*</span></label>
                                                <input type="date" class="form-control" name="bk_date" id="bk_date"
                                                    value="{{ $row->bk_date }}" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="bk_str_time" class="form-label">เวลาเข้า
                                                    <span>*</span></label>
                                                <input type="time" class="form-control" name="bk_str_time"
                                                    id="bk_str_time" value="{{ $row->bk_str_time }}" required>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="bk_end_time" class="form-label">เวลาออก
                                                    <span>*</span></label>
                                                <input type="time" class="form-control" name="bk_end_time"
                                                    id="bk_end_time" value="{{ $row->bk_end_time }}" required>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if (Auth::user()->username == $row->bk_username)
                                    <div class="col-12 col-lg-5">
                                        <div class="col-12 text-center mt-3">
                                            <label for="bk_end_time" class="form-label">
                                                หลักฐานการชำระเงิน <span>*</span>
                                            </label>
                                            <img id="img_bk_slip{{ $row->id }}" alt="อัพโหลดสลิปโอนเงิน"
                                                @if ($row->bk_slip != null) src="{{ asset($row->bk_slip) }}" @endif
                                                class="mx-auto d-block img-thumbnail mb-3 img_bk_slip">
                                            <input type="file" id="bk_slip{{ $row->id }}" name="bk_slip"
                                                class="form-control mb-3" onchange="displayImage('{{ $row->id }}')">

                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if (Auth::user()->username == $row->bk_username)
                                <hr>
                                <div class="form-group text-center">
                                    <a class="btn btn-danger" onclick="deleteBooking('{{ $row->id }}')">
                                        ยกเลิกการจอง</a>
                                    <input type="submit" class="btn btn-success" id="submit" value="บันทึก">
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <style>
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
    {{-- JS อัพโหลดสลิปโอนเงิน --}}
    <script>
        function displayImage(id) {
            const input = document.getElementById("bk_slip" + id);
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const imageDataUrl = event.target.result;
                    updateImageSrc(imageDataUrl, id);
                };
                reader.onerror = function(error) {
                    console.error("Error:", error)
                };
                reader.readAsDataURL(file);
            }
        }

        function updateImageSrc(imageDataUrl, id) {
            const imageElement = document.getElementById("img_bk_slip" + id);
            imageElement.src = imageDataUrl;
        }

        function deleteBooking(id) {
            // alert(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                title: "คุณแน่ใจไหม?",
                text: "คุณจะไม่สามารถย้อนกลับสิ่งนี้ได้!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "แน่ใจ!",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: 'deletebooking/' + id,
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire({
                                title: "ลบแล้ว!",
                                text: "ไฟล์ของคุณถูกลบแล้ว.",
                                icon: "success"
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                title: "ลบไม่สำเร็จ!",
                                text: "ไฟล์ของคุณยังไม่ถูกลบ.",
                                icon: "error"
                            });
                            console.log(error);
                        }
                    });

                }
            });
        }
    </script>
    {{-- JS set URL  --}}
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
