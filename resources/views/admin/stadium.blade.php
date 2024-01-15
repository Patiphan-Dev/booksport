@extends('admin.layout')

@section('body')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#stadium">
        เพิ่มสนาม
    </button>
    <div class="modal fade" id="stadium" aria-hidden="true" aria-labelledby="stadiumLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="stadiumLabel">เพิ่มสนามกีฬา</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addStadium') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label for="std_name" class="form-label">ชื่อสนาม</label>
                                <input type="text" class="form-control" id="std_name" name="std_name"
                                    placeholder="สนามกีฬา">
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label for="std_price" class="form-label">ราคา</label>
                                <input type="number" class="form-control" id="std_price" name="std_price"
                                    placeholder="999">

                            </div>
                            <div class="col-12 mb-3">
                                <label for="std_details" class="form-label">รายละเอียด</label>
                                <textarea id="std_details" name="std_details"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="std_facilities" class="form-label">สิ่งอำนวยความสะดวก</label>
                                <textarea id="std_facilities" name="std_facilities"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">รูปภาพสนาม</label>
                                <input type="file" class="form-control" id="files" name="std_img_path[]"
                                    accept="image/gif, image/jpeg, image/png" multiple>
                            </div>
                            <div class="col-12 mb-3">
                                <div id="std_img_path"></div>
                                <div id="max_size"></div><br>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row justify-content-center mb-5" id="gallery">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="submit" value="บันทึก">
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                    // alert( input.files.length); 
                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img class="col-2 border mx-2 my-2">')).attr('src', event
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
    @endsection
