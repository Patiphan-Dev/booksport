<form action="{{ url('updatereserve/'.$row->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-0 g-3 needs-validation mb-3" novalidate>
        <div class="col-12 col-md-6">
            <label for="bk_stadium" class="form-label">สนามกีฬา<span>*</span></label>
            <select class="form-select" name="bk_std_id" id="bk_std_id" required>
                <option value="" disabled selected>--- กรุณาเลือกสนาม ---
                </option>
                @foreach ($stadiums as $stadium)
                    <option value="{{ $stadium->id }}" @if ($row->bk_std_id == $stadium->id) selected @endif>
                        {{ $stadium->std_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-6">
            <label for="bk_date" class="form-label">วันที่จอง
                <span>*</span></label>
            <input type="date" class="form-control" name="bk_date" id="bk_date" value="{{ $row->bk_date }}" required>
        </div>
        <div class="col-12 col-md-6">
            <label for="bk_str_time" class="form-label">เวลาเข้า
                <span>*</span></label>
            <input type="time" class="form-control" name="bk_str_time" id="bk_str_time" value="{{ $row->bk_str_time }}" required>
        </div>
        <div class="col-12 col-md-6">
            <label for="bk_end_time" class="form-label">เวลาออก
                <span>*</span></label>
            <input type="time" class="form-control" name="bk_end_time" id="bk_end_time" value="{{ $row->bk_end_time }}" required>
        </div>
    </div>
    <label class="mb-3" for="bk_status">
        สถานะ <span>*</span>
    </label>
    <div class="form-group mb-3">
        <div class="btn btn-success mb-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bk_status" id="3Radio{{ $row->username . $row->id }}"
                    value="3" onclick="Confirm('{{ $row->id }}')"
                    @if ($row->bk_status == '3' || $row->bk_status == null) checked @endif>
                <label class="form-check-label" for="3Radio{{ $row->bk_username . $row->id }}">อนุมัติ</label>
            </div>
        </div>
        <div class="btn btn-primary mb-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bk_status"
                    id="2Radio{{ $row->bk_username . $row->id }}" value="2"
                    onclick="NoConfirm('{{ $row->id }}')" @if ($row->bk_status == '2') checked @endif>
                <label class="form-check-label" for="2Radio{{ $row->bk_username . $row->id }}">รอตรวจสอบ</label>
            </div>
        </div>
        <div class="btn btn-warning mb-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bk_status"
                    id="1Radio{{ $row->bk_username . $row->id }}" value="1"
                    onclick="NoConfirm('{{ $row->id }}')" @if ($row->bk_status == '1') checked @endif>
                <label class="form-check-label" for="1Radio{{ $row->bk_username . $row->id }}">รอชำระเงิน</label>
            </div>
        </div>
        <div class="btn btn-danger mb-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="bk_status"
                    id="0Radio{{ $row->bk_username . $row->id }}" value="0"
                    onclick="NoConfirm('{{ $row->id }}')" @if ($row->bk_status == '0') checked @endif>
                <label class="form-check-label" for="0Radio{{ $row->bk_username . $row->id }}">ไม่อนุมัติ</label>
            </div>
        </div>
    </div>
    <div class="form-group mb-3">
        <div id="bk_node{{ $row->id }}" hidden>
            <label class="mb-2" for="bk_node">
                หมายเหตุ <span>*</span>
            </label>
            <textarea id="bk_node{{ $row->id }}" class="form-control" name="bk_node" rows="3" cols="40">{{ $row->bk_node }}</textarea>
        </div>
    </div>

    <div class="form-group text-center mb-3 float-end">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">ยกเลิก</button>
        <input type="submit" class="btn btn-success" id="submit" value="บันทึก">
    </div>
</form>
