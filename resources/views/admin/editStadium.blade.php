<form action="{{ url('updatestadium/' . $std->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            <label for="std_supperuser" class="form-label">ชื่อเจ้าของสนาม <span>*</span></label>
            <select class="form-select" name="std_supperuser" id="std_supperuser" required  @if(auth()->user()->status != 9) disabled @endif>
                <option value="" disabled selected>--- กรุณาเลือกเจ้าของสนาม ---</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"  @if(auth()->user()->id == $user->id) selected @endif >{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <label for="std_name" class="form-label">ชื่อสนาม <span>*</span></label>
            <input type="text" class="form-control" id="std_name" name="std_name" placeholder="สนามกีฬา"
                value="{{ $std->std_name }}" required>
        </div>
        <div class="col-12 col-md-4 mb-3">
            <label for="std_price" class="form-label">ราคา <span>*</span></label>
            <input type="number" class="form-control" id="std_price" name="std_price" placeholder="999"
                value="{{ $std->std_price }}" required>

        </div>
        <div class="col-12 mb-3">
            <label for="edit_details" class="form-label">รายละเอียด</label>
            <textarea class="edit_std_details" id="edit_std_details{{ $std->id }}" name="std_details" required>{!! $std->std_details !!}</textarea>
        </div>
        <div class="col-12 mb-3">
            <label for="edit_facilities" class="form-label">สิ่งอำนวยความสะดวก</label>
            <textarea class="edit_std_facilities" id="edit_std_facilities{{ $std->id }}" name="std_facilities" required>{!! $std->std_facilities !!}</textarea>
        </div>
        <div class="col-12 mb-3">
            <div class="form-group">
                <label for="std_status" class="form-label">สถานะสนาม <span>*</span> </label>
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
            <input type="file" class="form-control" id="imageInput{{ $std->id }}" name="std_img_path[]"
                accept="image/gif, image/jpeg, image/png" onchange="inputFile('{{ $std->id }}')" multiple>
        </div>
        <div class="row mb-3">
            <div id="imagePreview{{ $std->id }}">
                @foreach ($image as $key => $img)
                    <img src="{{ asset($img) }}" class="previewImage" alt="...">
                @endforeach
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <input type="submit" class="btn btn-primary" id="submit" value="บันทึก">
    </div>
</form>
<style>
    #imagePreview {
        display: flex;
        flex-wrap: wrap;
    }

    .previewImage {
        margin: 5px;
        max-width: 15vw;
        max-height: 30vh;
        object-fit: cover;
        border: 1px solid #000009;
        border-radius: 6px;
        padding: 2px;
    }
</style>
<script>
    function inputFile(id) {
        document.getElementById('imageInput' + id);
        handleFileSelect(event, id);
    }

    function handleFileSelect(event, id) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imagePreview' + id);

        // Clear the existing preview
        previewContainer.innerHTML = '';

        for (const file of files) {
            // Check if the file is an image
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewImage = document.createElement('img');
                    previewImage.classList.add('previewImage');
                    previewImage.src = e.target.result;
                    previewContainer.appendChild(previewImage);
                };

                // Read the image file as a data URL
                reader.readAsDataURL(file);
            }
        }
    }
</script>
