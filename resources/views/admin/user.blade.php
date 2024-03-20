@extends('admin.layout')

@section('body')
    <style>
        #imagePreview {
            display: flex;
            flex-wrap: wrap;
        }

        .previewImage {
            margin: 5px;
            max-width: 25vw;
            max-height: 35vh;
            object-fit: cover;
            border: 1px solid #000009;
            border-radius: 6px;
            padding: 2px;
        }
    </style>
    <div class="d-grid gap-2 d-md-flex justify-content-end">
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#adduser">
            <i class="fa-solid fa-plus"></i> เพิ่มผู้ใช้งาน
        </button>
        <div class="modal fade" id="adduser" aria-hidden="true" aria-labelledby="adduserLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="adduserLabel">เพิ่มผู้ใช้งาน</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('addUser') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="username">ชื่อผู้ใช้ <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Username" id="username"
                                    name="username" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="email">อีเมล <span>*</span></label>
                                <input type="email" class="form-control" placeholder="email" id="email" name="email"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">รหัสผ่าน <span>*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="status">สถานะผู้ใช้ <span>*</span></label>
                                <select class="form-select" aria-label="Default select example" id="status"
                                    name="status" required>
                                    <option disabled selected>--- กรุณาเลือกสถานะผู้ใช้ ---</option>
                                    <option value="1">ผู้ใช้ทั่วไป</option>
                                    <option value="7">เจ้าของสนาม</option>
                                    <option value="9">แอดมิน</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="qrcode" class="form-label">
                                    QR Code รับเงินค่าสนาม
                                </label>
                                <input type="file" class="form-control" id="qrcode" name="qrcode"
                                    accept="image/jpeg, image/png">
                            </div>
                            <div class="form-group mb-5 text-center">
                                <div id="qrcodePreview"></div>
                            </div>
                            <input type="submit" class="btn btn-primary float-end" value="บันทึก">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <h3 class="strong">จัดการผู้ใช้งาน</h3>
        <table class="display responsive  nowrap" id="userTable" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">ชื่อผู้ใช้</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">สถานะผู้ใช้</th>
                    <th scope="col">วันที่สมัคร</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $row)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->email }}</td>
                        <td>
                            @if ($row->status == 9)
                                แอดมิน
                            @elseif($row->status == 7)
                                เจ้าของสนาม
                            @elseif($row->status == 1)
                                ผู้ใช้ทั่วไป
                            @endif
                        </td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            <button type="button" class="btn badge text-bg-warning" data-bs-toggle="modal"
                                data-bs-target="#editUser{{ $row->id }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            @if ($row->status != 9)
                                <button type="button" class="btn badge text-bg-danger"
                                    onclick="deleteUser('{{ $row->id }}')">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($users as $key => $row)
        <div class="modal fade" id="editUser{{ $row->id }}" tabindex="-1" aria-labelledby="editUserLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="UserModalLabel">
                            <i class="fa-regular fa-pen-to-square"></i>
                            แก้ไขข้อมูลผู้ใช้ {{ $row->username }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('updateUser', ['id' => $row->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="label" for="username">ชื่อผู้ใช้ <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Username" id="username"
                                    name="username" value="{{ $row->username }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="email">อีเมล <span>*</span></label>
                                <input type="email" class="form-control" placeholder="email" id="email"
                                    name="email" value="{{ $row->email }}" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="status">สถานะผู้ใช้ <span>*</span></label>
                                <select class="form-select" aria-label="Default select example" id="status"
                                    name="status" required>
                                    <option disabled>--- กรุณาเลือกสถานะผู้ใช้ ---</option>
                                    <option @if ($row->status == 1) selected @endif value="1">
                                        ผู้ใช้ทั่วไป
                                    </option>
                                    <option @if ($row->status == 7) selected @endif value="7">
                                        เจ้าของสนาม
                                    </option>
                                    <option @if ($row->status == 9) selected @endif value="9">
                                        แอดมิน
                                    </option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="qrcode" class="form-label">
                                    QR Code รับเงินค่าสนาม
                                </label>
                                <input type="file" class="form-control" id="imageInput{{ $row->id }}" name="qrcode"
                                    accept="image/gif, image/jpeg, image/png" onchange="inputFile('{{ $row->id }}')" multiple>
                            </div>
                            <div class="form-group mb-5 text-center">
                                <div id="imagePreview{{ $row->id }}">
                                        <img src="{{ asset($row->qrcode) }}" class="previewImage" alt="...">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary float-end" value="บันทึก">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- dataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#userTable").DataTable({
                responsive: true,
            });
        });

        function deleteUser(id) {
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
                        url: '/deleteuser/' + id,
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "ลบแล้ว!",
                                text: "ไฟล์ของคุณถูกลบแล้ว.",
                                icon: "success"
                            }).then(() => {
                                // Reload the page after successful deletion
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "ลบไม่สำเร็จ!",
                                text: "ไฟล์ของคุณยังไม่ถูกลบ.",
                                icon: "error"
                            });
                            console.log("AJAX Request Error:", status, error);
                        }
                    });

                }
            });
        }
    </script>
    <script>
        document.getElementById('qrcode').addEventListener('change', handleFileQRCode);

        function handleFileQRCode(event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('qrcodePreview');

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
@endsection
