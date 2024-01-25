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
            <input type="file" class="form-control" id="imageStadium" name="std_img_path[]"
                accept="image/gif, image/jpeg, image/png" multiple required>
        </div>
        <div class="row mb-3">
            
            <div id="imageStadiumPreview"></div>
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
        max-width: 15vw;
        max-height: 30vh;
        object-fit: cover;
        border: 1px solid #000009;
        border-radius: 6px;
        padding: 2px;
    }
</style>
<script>
    document.getElementById('imageStadium').addEventListener('change', handleFileStadium);

    function handleFileStadium(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imageStadiumPreview');

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
