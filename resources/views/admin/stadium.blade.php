@extends('admin.layout')

@section('body')
    <div class="d-grid gap-2 d-md-flex justify-content-end mb-4">
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addstadium">
            <i class="fa-solid fa-plus"></i> เพิ่มสนาม
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
            {{-- 
            <div class="col-6 col-sm-4 col-md-3 text-center">
                <div class="card text-center h-100 viewStadium" data-id="{{ $std->std_name }}" data-bs-toggle="modal"
                    data-bs-target="#viewStadium{{ $std->id }}">
                    <img src="{{ asset($image[0]) }}" class="img-fluid" alt="...">

                    <h3>{{ $std->std_name }}</h3>
                </div>
            </div> --}}

            <div class="modal fade" id="viewStadium{{ $std->id }}" tabindex="-1" aria-labelledby="viewStadiumLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="StadiumName"></div>
                            <h1 class="modal-title fs-5">{{ $std->std_name }} </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-left">
                            @include('admin.detailsStadium')
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal fade" id="editStadium{{ $std->id }}" aria-hidden="true"
                aria-labelledby="editStadiumLabel{{ $std->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editStadiumLabel">แก้ไขสนามกีฬา</h1>
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

    <div class="row mt-3">
        <h3 class="strong">จัดการสนามกีฬา</h3>
        <table class="display responsive  nowrap" id="stadiumTable" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th scope="col">ลำดับ</th>
                    <th scope="col">เจ้าของสนาม</th>
                    <th scope="col">ชื่อสนาม</th>
                    <th scope="col">ราคาสนาม</th>
                    <th scope="col">สถานะสนาม</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stadiums as $key => $row)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->std_name }}</td>
                        <td>{{ $row->std_price }}</td>
                        <td>
                            @if ($row->std_status == 1)
                                พร้อมให้บริการ
                            @elseif($row->std_status == 0)
                                ไม่พร้อมใช้งาน
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn badge text-bg-primary" data-bs-toggle="modal"
                                data-bs-target="#viewStadium{{ $row->id }}">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button type="button" class="btn badge text-bg-warning" data-bs-toggle="modal"
                                data-bs-target="#editStadium{{ $row->id }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            @if (auth()->user()->status == 9 || $row->std_supperuser == auth()->user()->id)
                                <button type="button" class="btn badge text-bg-danger"
                                    onclick="deleteStadium('{{ $row->id }}')">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <style>
        .viewStadium {
            cursor: pointer;
        }
    </style>
    {{-- dataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#stadiumTable").DataTable({
                responsive: true,
            });
        });

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

            $('.edit_std_details').summernote({
                tabsize: 2,
                height: 150
            });
            $('.edit_std_facilities').summernote({
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
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/deletestadium/' + id,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "ลบแล้ว!",
                                text: "สนามของคุณถูกลบแล้ว.",
                                icon: "success"
                            }).then(() => {
                                // Reload the page after successful deletion
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "ลบไม่สำเร็จ!",
                                text: "สนามของคุณยังไม่ถูกลบ.",
                                icon: "error"
                            });
                            // console.log("AJAX Request Error:", status, error);
                        }
                    });

                }
            });
        }
    </script>
@endsection
