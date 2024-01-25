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
            {{-- <div class="row justify-content-center" id="gallery{{ $std->id }}">
            </div> --}}

            <img id="std_img_path{{ $std->id }}" alt="อัพโหลดสลิปโอนเงิน"
                @if ($std->bk_slip != null) src="{{ asset($std->bk_slip) }}" @endif
                class="mx-auto d-block img-thumbnail mb-3 std_img_path">
            <input type="file" id="img_path{{ $std->id }}" name="bk_slip" class="form-control mb-3"
                onchange="StadiumImage('{{ $std->id }}')" multiple accept="image/gif, image/jpeg, image/png">


            <input type="file" id="imageInput" multiple accept="image/*">
            <div id="imagePreview"></div>

        </div>
    </div>
    <div class="modal-footer">
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
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
</style>
<script>
    function StadiumImage(id) {
        const input = document.getElementById("img_path" + id);
        const filesAmount = input.files.length;

        for (i = 0; i < filesAmount; i++) {

            const reader = new FileReader();

            reader.onload = function(event) {
                const imageDataUrl = event.target.result;
                updateStadiumSrc(imageDataUrl, id);
            };
            reader.onerror = function(error) {
                console.error("Error:", error)
            };
            reader.readAsDataURL(input.files[i]);

        }

    }

    function updateStadiumSrc(imageDataUrl, id) {
        const imageElement = document.getElementById("std_img_path" + id);
        imageElement.src = imageDataUrl;
    }


    document.getElementById('imageInput').addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imagePreview');

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
