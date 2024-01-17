<form action="{{ url('updatestadium/' . $std->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="std_name" class="form-label">ชื่อสนาม <span>*</span></label>
            <input type="text" class="form-control" id="std_name" name="std_name" placeholder="สนามกีฬา"
                value="{{ $std->std_name }}" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="std_price" class="form-label">ราคา <span>*</span></label>
            <input type="number" class="form-control" id="std_price" name="std_price" placeholder="999"
                value="{{ $std->std_price }}" required>

        </div>
        <div class="col-12 mb-3">
            <label for="std_details" class="form-label">รายละเอียด</label>
            <textarea id="edit_std_details{{ $std->id }}" name="std_details" required>{!! $std->std_details !!}</textarea>
        </div>
        <div class="col-12 mb-3">
            <label for="std_facilities" class="form-label">สิ่งอำนวยความสะดวก</label>
            <textarea id="edit_std_facilities{{ $std->id }}" name="std_facilities" required>{!! $std->std_facilities !!}</textarea>
        </div>
        <div class="col-12 mb-3">
            <div class="form-group">
                <label>สถานะสนาม <span>*</span> </label>
                <div class="form-group clearfix">
                    <div class="btn btn-primary icheck-success">
                        <input class="d-inline" type="radio" id="std_status1" value="1" name="std_status"
                            @if ($std->std_status == 1) checked @endif required>
                        <label for="car1">
                            เปิดใช้บริการสนาม
                        </label>
                    </div>
                    <div class="btn btn-danger icheck-success">
                        <input class="d-inline" type="radio" id="std_status2" value="0" name="std_status"
                            @if ($std->std_status == 0) checked @endif required>
                        <label for="car2">
                            ปิดใช้บริการสนาม
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">รูปภาพสนาม <span>*</span></label>
            <input type="file" class="form-control" id="files{{ $std->id }}" name="std_img_path[]"
                accept="image/gif, image/jpeg, image/png" multiple>
        </div>
        <div class="row mb-3">
            <div id="std_img_path{{ $std->id }}"></div>
            <div id="max_size{{ $std->id }}"></div>
            @foreach ($image as $key => $img)
                <div class="col-6 col-md-4 mb-2">
                    <div class="card" style="max-height:300px">
                        <img src="{{ asset($img) }}" class="d-block w-100" alt="...">
                    </div>
                </div>
            @endforeach
            <div class="row justify-content-center" id="gallery{{ $std->id }}">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" id="submit" value="บันทึก">
    </div>
</form>
