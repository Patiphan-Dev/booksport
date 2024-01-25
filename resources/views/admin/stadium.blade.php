@extends('admin.layout')

@section('body')
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
                        @include('admin.addStadium')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        @foreach ($stadiums as $std)
            @php
                $image = explode(',', $std->std_img_path);
            @endphp

            <div class="col-6 col-sm-4 col-md-3 text-center">
                <div class="card text-center h-100 viewStadium" data-id="{{ $std->std_name }}"
                    data-bs-toggle="modal" data-bs-target="#StadiumDetail{{ $std->id }}">
                    <img src="{{ asset($image[0]) }}" class="img-fluid" alt="...">
                    <div class="card-body">
                        {{ $std->std_name }}
                    </div>
                </div>
            </div>

            <div class="modal fade" id="StadiumDetail{{ $std->id }}" tabindex="-1"
                aria-labelledby="StadiumDetailLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="StadiumName"></div>
                            <h1 class="modal-title fs-5">{{ $std->std_name }} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-left">
                            @include('admin.DetailsStadium')
                        </div>
                        <div class="clearfix">
                            <div class="modal-footer">
                                <button class="btn btn-danger"
                                    onclick="deleteStadium('{{ $std->id }}')">ลบสนาม</button>
                                <button class="btn btn-warning editModal" data-id="{{ $std->id }}"
                                    data-bs-target="#editModal{{ $std->id }}"
                                    data-bs-toggle="modal">แก้ไขข้อมูล</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="modal fade" id="editModal{{ $std->id }}" aria-hidden="true"
                aria-labelledby="editModalLabel{{ $std->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel">แก้ไขสนามกีฬา</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @include('admin.editStadium')
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <style>
        .viewStadium{
            cursor: pointer;
        }
    </style>
    <script>
        $(document).ready(function() {

            let maxSize = 500000; //5MB

            $('.viewStadium').on('click', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                const currentUrl = window.location.href;
                const newUrl = '?=' + id;
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);
            });

            $('.editModal').on('click', function() {
                const id = $(this).data('id');
                $('#edit_std_details' + id).summernote({
                    tabsize: 2,
                    height: 150
                });
                $('#edit_std_facilities' + id).summernote({
                    tabsize: 2,
                    height: 150
                });

                $("#files" + id).on("change", function(e) {
                    let files = e.target.files,
                        filesLength = files.length;
                    for (let i = 0; i < filesLength; i++) {
                        let f = files[i];
                        if (f.size > maxSize) {
                            $("#max_size" + id).append("<span class='link-danger'>ขนาดไฟล์: " +
                                f.size +
                                " KB. ใหญ่เกินไป (กำหนดไม่เกิน 5MB.)<span>");
                            $("#std_img_path" + id).val("");
                        }

                    }

                });

                let imagesPreview = function(input, placeToInsertImagePreview) {
                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img class="col-6 col-md-4">')).attr('src',
                                        event
                                        .target
                                        .result)
                                    .appendTo(
                                        placeToInsertImagePreview);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                };

                $('#files' + id).on('change', function() {
                    imagesPreview(this, '#gallery' + id);
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

        function deleteStadium(id) {
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
                        url: '/deletestadium/' + id,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "ลบแล้ว!",
                                text: "ไฟล์ของคุณถูกลบแล้ว.",
                                icon: "success"
                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                title: "ลบไม่สำเร็จ!",
                                text: "ไฟล์ของคุณยังไม่ถูกลบ.",
                                icon: "error"
                            });
                            console.log(error);
                        }
                    });

                }
            });
        }
    </script>
@endsection
