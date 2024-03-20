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
                        <span class="badge bg-danger rounded-pill cursor-pointer" data-bs-custom-class="custom-popover"
                            data-bs-container="body" data-bs-toggle="popover" data-bs-title="หมายเหตุ"
                            data-bs-placement="top" data-bs-content="{{ $row->bk_node }}" data-toggle="tooltip"
                            data-placement="top">
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
                <div class="row g-3 needs-validation mb-3" novalidate>
                    <div class="col-12">
                        <label for="bk_stadium" class="form-label">สนามกีฬา <span>*</span></label>
                        <select class="form-select" name="bk_std_id" id="modal_bk_std_id{{ $row->id }}"
                            onchange="modalCalculate('{{ $row->id }}')" required>
                            <option value="" disabled selected>--- กรุณาเลือกสนาม ---
                            </option>
                            @foreach ($stadiums as $stadium)
                                <option value="{{ $stadium->id }}" data-price="{{ $stadium->std_price }}"
                                    @if ($row->bk_std_id == $stadium->id) selected @endif>
                                    {{ $stadium->std_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="bk_price" class="form-label">ราคา/ชั่วโมง : </label>
                        <input type="text" class="form-control" name="bk_price"
                            id="modal_bk_price{{ $row->id }}" value="" disabled required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="bk_date" class="form-label">วันที่จอง
                            <span>*</span></label>
                        <input type="date" class="form-control" name="bk_date" id="modal_bk_date{{ $row->id }}"
                            value="{{ $row->bk_date }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="bk_str_time" class="form-label">เวลาเข้า
                            <span>*</span></label>
                        <input type="time" class="form-control" name="bk_str_time"
                            id="modal_bk_str_time{{ $row->id }}" value="{{ $row->bk_str_time }}"
                            onchange="modalCalculate('{{ $row->id }}')" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="bk_end_time" class="form-label">เวลาออก
                            <span>*</span></label>
                        <input type="time" class="form-control" name="bk_end_time"
                            id="modal_bk_end_time{{ $row->id }}" value="{{ $row->bk_end_time }}"
                            onchange="modalCalculate('{{ $row->id }}')" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="bk_sumtime" class="form-label">เวลาเช่า (นาที)</label>
                        <input type="text" class="form-control" name="bk_sumtime"
                            id="modal_bk_sumtime{{ $row->id }}" value="{{ $row->bk_sumtime }}" disabled required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="bk_total_price" class="form-label">ราคารวม (บาท)</label>
                        <input type="text" class="form-control" name="bk_total_price"
                            id="modal_bk_total_price{{ $row->id }}" value="{{ $row->bk_total_price }}" disabled
                            required>
                    </div>
                </div>
            @endif
        </div>
        @if (Auth::user()->username == $row->bk_username)
            <div class="col-12 col-lg-5">
                <div class="col-12 text-center mt-3">
                    <img src="{{ asset($row->qrcode) }}" id="qrcode" alt="อัพโหลดสลิปโอนเงิน"
                        class="mb-3 img_bk_slip">
                </div>
                <div class="col-12 text-center mt-2">
                    <label for="bk_end_time" class="form-label">
                        หลักฐานการชำระเงิน <span>*</span>
                    </label>
                    <img id="img_bk_slip{{ $row->id }}" alt="อัพโหลดสลิปโอนเงิน"
                        @if ($row->bk_slip != null) src="{{ asset($row->bk_slip) }}" @endif
                        class="mx-auto d-block img-thumbnail mb-3 img_bk_slip">
                    <input type="file" id="bk_slip{{ $row->id }}" name="bk_slip" class="form-control mb-3"
                        onchange="displayImage('{{ $row->id }}')">
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

<style>
    .img_bk_slip {
        max-width: 220px;
        border: 1px solid #88888850;
        border-radius: 6px;
        padding: 6px;
        width: 50vw;
        height: 40vh;
        background-color: rgb(255, 242, 228);
        align-items: center;
        text-align: center
    }
</style>
{{-- JS อัพโหลดสลิปโอนเงิน --}}
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip()

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(
            popoverTriggerEl))

    });

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
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'deletebooking/' + id,
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        Swal.fire({
                            title: "ลบแล้ว!",
                            text: "ไฟล์ของคุณถูกลบแล้ว.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "ลบไม่สำเร็จ!",
                            text: "ไฟล์ของคุณยังไม่ถูกลบ.",
                            icon: "error"
                        });
                        console.log("AJAX Request Error:", status, error);
                    }
                });

            }
        });
    }
</script>

<script>
    function modalCalculate(id) {
        // Get the input values
        const bookInTime = document.getElementById("modal_bk_str_time" + id).value;
        const bookOutTime = document.getElementById("modal_bk_end_time" + id).value;
        // Get the selected option
        var selectedOption = $('#modal_bk_std_id' + id + ' option:selected');
        // console.log('#modal_bk_std_id'+id+ 'option:selected');
        // Retrieve the data-price attribute value
        var price = parseFloat(selectedOption.data('price'));
        // Convert the input values to Date objects
        const bookInDate = new Date(`2000-01-01T${bookInTime}:00Z`);
        const bookOutDate = new Date(`2000-01-01T${bookOutTime}:00Z`);

        // Calculate the time difference in minutes
        const timeDifference = (bookOutDate - bookInDate) / (1000 * 60);

        // Calculate the Total Price 
        const totalPrice = (price / 60) * timeDifference

        const roundedNumber = Math.round(totalPrice);

        // Display
        document.getElementById("modal_bk_price" + id).value = `${price}`;
        document.getElementById("modal_bk_sumtime" + id).value = `${timeDifference}`;
        document.getElementById("modal_bk_total_price" + id).value = `${roundedNumber}`;
    }
</script>
