@extends('admin.layout')

@section('body')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <div class="clearfix">
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addstadium">
            เพิ่มสนาม
        </button>
        <div class="modal fade" id="addstadium" aria-hidden="true" aria-labelledby="addstadiumLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addstadiumLabel">เพิ่มสนามกีฬา</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addStadium') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="std_name" class="form-label">ชื่อสนาม <span>*</span></label>
                                    <input type="text" class="form-control" id="std_name" name="std_name"
                                        placeholder="สนามกีฬา" required>
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="std_price" class="form-label">ราคา <span>*</span></label>
                                    <input type="number" class="form-control" id="std_price" name="std_price"
                                        placeholder="999" required>

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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-2">
            @foreach ($stadiums as $std)
                @php
                    $image = explode(',', $std->std_img_path);
                @endphp

                <div class="col-6 col-sm-4 col-md-3 text-center">
                    <a class="card text-center h-100 viewStadium" href="" data-id="{{ $std->std_name }}"
                        data-bs-toggle="modal" data-bs-target="#StadiumDetail{{ $std->id }}">
                        <img src="{{ asset($image[0]) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            {{ $std->std_name }}
                        </div>
                    </a>
                </div>

                <div class="modal fade" id="StadiumDetail{{ $std->id }}" tabindex="-1"
                    aria-labelledby="StadiumDetailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div id="StadiumName"></div>
                                <h1 class="modal-title fs-5">{{ $std->std_name }} </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-left">
                                <div id="carousel{{ $std->id }}" class="carousel slide mb-4">
                                    <div class="carousel-inner">
                                        @foreach ($image as $key => $img)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}"
                                                style="max-height:300px">
                                                <img src="{{ asset($img) }}" class="d-block w-100" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carousel{{ $std->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carousel{{ $std->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                <div class="row">
                                    <h4><u>รายละเอียด</u></h4>
                                    {!! $std->std_details !!}
                                </div>
                                <div class="row">
                                    <h4><u>สิ่งอำนวยความสะดวก</u></h4>
                                    {!! $std->std_facilities !!}
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="modal-footer">
                                    <button class="btn btn-primary editModal" data-id="{{ $std->id }}"
                                        data-bs-target="#editModal{{ $std->id }}"
                                        data-bs-toggle="modal">แก้ไขข้อมูล</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal fade" id="editModal{{ $std->id }}" aria-hidden="true"
                    aria-labelledby="editModalLabel{{ $std->id }}" data-bs-backdrop="static"
                    data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editModalLabel">เพิ่มสนามกีฬา</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('updateStadium') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="std_name" class="form-label">ชื่อสนาม <span>*</span></label>
                                            <input type="text" class="form-control" id="std_name" name="std_name"
                                                placeholder="สนามกีฬา" value="{{ $std->std_name }}" required>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="std_price" class="form-label">ราคา <span>*</span></label>
                                            <input type="number" class="form-control" id="std_price" name="std_price"
                                                placeholder="999" value="{{ $std->std_price }}" required>

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
                                            <label class="form-label">รูปภาพสนาม <span>*</span></label>
                                            <input type="file" class="form-control" id="files"
                                                name="std_img_path[]" accept="image/gif, image/jpeg, image/png" required
                                                multiple>
                                        </div>
                                        <div class="row mb-3">
                                            <div id="std_img_path"></div>
                                            <div id="max_size"></div>
                                            @foreach ($image as $key => $img)
                                            <div class="col-6 col-md-4">
                                                <div class="card {{ $key == 0 ? 'active' : '' }}"
                                                    style="max-height:300px">
                                                    <img src="{{ asset($img) }}" class="d-block w-100" alt="...">
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="row justify-content-center" id="gallery">
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
                </div>
            @endforeach
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

            $('.viewStadium').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const currentUrl = window.location.href;
                const newUrl = '?=' + id;
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);



            });

            $('.editModal').on('click', function(e) {
                const id = $(this).data('id');
                $('#edit_std_details' + id).summernote({
                    tabsize: 2,
                    height: 150
                });
                $('#edit_std_facilities' + id).summernote({
                    tabsize: 2,
                    height: 150
                });
            });

            $('#std_details').summernote({
                tabsize: 2,
                height: 150
            });
            $('#std_facilities').summernote({
                tabsize: 2,
                height: 150
            });




        });
    </script>
@endsection
