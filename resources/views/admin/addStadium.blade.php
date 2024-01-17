
<form action="{{ route('addStadium') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6 mb-3">
            <label for="std_name" class="form-label">ชื่อสนาม <span>*</span></label>
            <input type="text" class="form-control" id="std_name" name="std_name" placeholder="สนามกีฬา" required>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="std_price" class="form-label">ราคา <span>*</span></label>
            <input type="number" class="form-control" id="std_price" name="std_price" placeholder="999" required>

        </div>
        <div class="col-12 mb-3">
            <label for="std_details" class="form-label">รายละเอียด</label>
            <textarea id="std_details" name="std_details" required></textarea>
        </div>
        <div class="col-12 mb-3">
            <label for="std_facilities" class="form-label">สิ่งอำนวยความสะดวก</label>
            <textarea id="std_facilities" name="std_facilities" required></textarea>
        </div>
        <div class="col-12 mb-3">
            <label class="form-label">รูปภาพสนาม <span>*</span></label>
            <input type="file" class="form-control" id="files" name="std_img_path[]"
                accept="image/gif, image/jpeg, image/png" required multiple>
        </div>
        <div class="col-12 mb-3">
            <div id="std_img_path"></div>
            <div id="max_size"></div>
            <div class="row justify-content-center" id="gallery">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" id="submit" value="บันทึก">
    </div>
</form>
<script>
    $(document).ready(function() {

        let maxSize = 500000; //5MB

        $("#files").on("change", function(e) {
            let files = e.target.files,
                filesLength = files.length;
            for (let i = 0; i < filesLength; i++) {
                let f = files[i];
                if (f.size > maxSize) {
                    $("#max_size").append("<span class='link-danger'>ขนาดไฟล์: " + f.size +
                        " KB. ใหญ่เกินไป (กำหนดไม่เกิน 5MB.)<span>");
                    $("#std_img_path").val("");
                }

            }

        });

        let imagesPreview = function(input, placeToInsertImagePreview) {
            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img class="col-6 col-md-4 mb-3">')).attr('src', event
                                .target
                                .result)
                            .appendTo(
                                placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#files').on('change', function() {
            imagesPreview(this, '#gallery');
        });
    });
</script>
