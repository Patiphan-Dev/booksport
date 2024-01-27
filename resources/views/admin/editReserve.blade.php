<form action="{{ url('updatereserve/' . $row->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="row">
                <div class="col-12 col-md-12 mb-3">
                    <label for="bk_stadium" class="form-label">สนามกีฬา<span>*</span></label>
                    <select class="form-select" name="bk_std_id" id="modal_bk_std_id{{ $row->id }}"
                        onchange="modalCalculate('{{ $row->id }}')" required>
                        <option value="" disabled selected>--- กรุณาเลือกสนาม ---
                        </option>
                        @foreach ($stadiums as $stadium)
                            <option value="{{ $stadium->id }}" data-price="{{$stadium->std_price}}"
                                @if ($row->bk_std_id == $stadium->id) selected @endif>
                                {{ $stadium->std_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="bk_price" class="form-label">ราคา/ชั่วโมง : </label>
                    <input type="text" class="form-control" name="bk_price" id="modal_bk_price{{ $row->id }}"
                        value="{{ $row->bk_price }}" disabled required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="bk_date" class="form-label">วันที่จอง
                        <span>*</span></label>
                    <input type="date" class="form-control" name="bk_date" id="modal_bk_date{{ $row->id }}"
                        value="{{ $row->bk_date }}" required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="bk_str_time" class="form-label">เวลาเข้า
                        <span>*</span></label>
                    <input type="time" class="form-control" name="bk_str_time"
                        id="modal_bk_str_time{{ $row->id }}" value="{{ $row->bk_str_time }}"
                        onchange="modalCalculate('{{ $row->id }}')" required>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <label for="bk_end_time" class="form-label">เวลาออก
                        <span>*</span></label>
                    <input type="time" class="form-control" name="bk_end_time"
                        id="modal_bk_end_time{{ $row->id }}" value="{{ $row->bk_end_time }}"
                        onchange="modalCalculate('{{ $row->id }}')" required>
                </div>
                <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label for="bk_sumtime" class="form-label">เวลาเช่า (นาที)</label>
                    <input type="text" class="form-control" name="bk_sumtime"
                        id="modal_bk_sumtime{{ $row->id }}" value="{{ $row->bk_sumtime }}" disabled required>
                </div>
                <div class="col-12 col-sm-6 col-md-6 mb-3">
                    <label for="bk_total_price" class="form-label">ราคารวม (บาท)</label>
                    <input type="text" class="form-control" name="bk_total_price"
                        id="modal_bk_total_price{{ $row->id }}" value="{{ $row->bk_total_price }}" disabled
                        required>
                </div>
                <div class="col-12 mb-3">
                    <label class="mb-3" for="bk_status">
                        สถานะ <span>*</span>
                    </label>
                    <div class="row justify-content-center g-2">
                        <div class="col-12 col-md-6">
                            <div class="btn btn-success w-100">
                                <input class="form-check-input" type="radio" name="bk_status"
                                    id="3Radio{{ $row->username . $row->id }}" value="3"
                                    onclick="Confirm('{{ $row->id }}')"
                                    @if ($row->bk_status == '3' || $row->bk_status == null) checked @endif>
                                <label class="form-check-label"
                                    for="3Radio{{ $row->bk_username . $row->id }}">อนุมัติ</label>

                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="btn btn-primary w-100">

                                <input class="form-check-input" type="radio" name="bk_status"
                                    id="2Radio{{ $row->bk_username . $row->id }}" value="2"
                                    onclick="NoConfirm('{{ $row->id }}')"
                                    @if ($row->bk_status == '2') checked @endif>
                                <label class="form-check-label"
                                    for="2Radio{{ $row->bk_username . $row->id }}">รอตรวจสอบ</label>

                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="btn btn-warning w-100">

                                <input class="form-check-input" type="radio" name="bk_status"
                                    id="1Radio{{ $row->bk_username . $row->id }}" value="1"
                                    onclick="NoConfirm('{{ $row->id }}')"
                                    @if ($row->bk_status == '1') checked @endif>
                                <label class="form-check-label"
                                    for="1Radio{{ $row->bk_username . $row->id }}">รอชำระเงิน</label>

                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="btn btn-danger w-100">

                                <input class="form-check-input" type="radio" name="bk_status"
                                    id="0Radio{{ $row->bk_username . $row->id }}" value="0"
                                    onclick="NoConfirm('{{ $row->id }}')"
                                    @if ($row->bk_status == '0') checked @endif>
                                <label class="form-check-label"
                                    for="0Radio{{ $row->bk_username . $row->id }}">ไม่อนุมัติ</label>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="form-group mb-3">
                        <div id="bk_node{{ $row->id }}" hidden>
                            <label class="mb-2" for="bk_node">
                                หมายเหตุ <span>*</span>
                            </label>
                            <textarea id="bk_node{{ $row->id }}" class="form-control" name="bk_node" rows="3" cols="40">{{ $row->bk_node }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="col text-center">
                <label for="bk_slip" class="form-label">หลักฐานการชำระเงิน
                    <span>*</span></label>
                <img alt="อัพโหลดสลิปโอนเงิน"
                    @if ($row->bk_slip != null) src="{{ asset($row->bk_slip) }}" @endif
                    id="edit_bk_slip{{ $row->id }}"
                    class="mx-auto d-block img-thumbnail mb-3 edit_bk_slip">
                <input type="file" id="edit_slip{{ $row->id }}" name="bk_slip"
                    class="form-control mb-3" onchange="slipImage('{{ $row->id }}')">
            </div>
        </div>
    </div>
    <div class="form-group text-center mb-3">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
            aria-label="Close">ยกเลิก</button>
        <input type="submit" class="btn btn-success" id="submit" value="บันทึก">
    </div>
</form>
<style>
    .edit_bk_slip {
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
</style>
<script>
    function slipImage(id) {
        const input = document.getElementById("edit_slip" + id);
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imageDataUrl = event.target.result;
                updateSlipSrc(imageDataUrl, id);
            };
            reader.onerror = function(error) {
                console.error("Error:", error)
            };
            reader.readAsDataURL(file);
        }
    }

    function updateSlipSrc(imageDataUrl, id) {
        const imageElement = document.getElementById("edit_bk_slip" + id);
        imageElement.src = imageDataUrl;
    }
</script>
<script>
   function modalCalculate(id) {
        // Get the input values
        const bookInTime = document.getElementById("modal_bk_str_time" + id).value;
        const bookOutTime = document.getElementById("modal_bk_end_time" + id).value;
        // Get the selected option
        var selectedOption = $('#modal_bk_std_id'+id+' option:selected');
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
