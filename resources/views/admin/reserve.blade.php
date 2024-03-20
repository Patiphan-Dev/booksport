@extends('admin.layout')

@section('body')
    <div class="d-grid gap-2 d-md-flex justify-content-end">
        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addstadium">
            <i class="fa-solid fa-plus"></i> จองสนาม
        </button>
        <div class="modal fade" id="addstadium" aria-hidden="true" aria-labelledby="addstadiumLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addstadiumLabel">จองสนามกีฬา</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('formBooking')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <h3 class="strong">รายงานการจองสนามกีฬา</h3>
        <table class="display responsive  nowrap" id="reserveTable" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">เจ้าของสนาม</th>
                    <th scope="col">สนาม</th>
                    <th scope="col">ชื่อผู้จอง</th>
                    <th scope="col">วันที่จอง</th>
                    <th scope="col">เวลาจอง</th>
                    <th scope="col">สถานะ</th>
                    <th scope="col">วันที่ทำรายการ</th>
                    <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $key => $row)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->std_name }}</td>
                        <td>{{ $row->bk_username }}</td>
                        <td>{{ $row->bk_date }}</td>
                        <td>{{ $row->bk_str_time }} ถึง {{ $row->bk_end_time }}</td>
                        <td class="text-center">
                            @if ($row->bk_status == 1)
                                <span class="badge text-bg-warning"> รอชำระเงิน</span>
                            @elseif ($row->bk_status == 2)
                                <span class="badge text-bg-primary"> รอตรวจสอบ</span>
                            @elseif ($row->bk_status == 3)
                                <span class="badge text-bg-success"> ยืนยัน</span>
                            @else
                                <span class="badge text-bg-danger"> ยกเลิก</span>
                            @endif
                        </td>
                        <td>{{ $row->created_at }}</td>
                        <td>
                            <button type="button" class="btn badge text-bg-warning" data-bs-toggle="modal"
                                data-bs-target="#confirm{{ $row->id }}">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn badge text-bg-danger"
                                onclick="deleteReserve('{{ $row->id }}')">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @foreach ($bookings as $key => $row)
        <div class="modal fade" id="confirm{{ $row->id }}" tabindex="-1" aria-labelledby="confirmLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <i class="fa-regular fa-pen-to-square"></i>
                            แก้ไขข้อมูลการจอง {{ $row->created_at }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('admin.editReserve')
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .edit_bk_slip {
            max-width: 300px;
            border: 1px solid #88888850;
            border-radius: 6px;
            padding: 6px;
            width: 15vw;
            height: 40vh;
            background-color: rgb(255, 242, 228);
            align-items: center;
            text-align: center
        }
    </style>
    {{-- dataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.4.1/js/dataTables.rowReorder.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#reserveTable").DataTable({
                responsive: true,
            });
        });

        function Confirm(id) {
            document.getElementById("bk_node" + id).hidden = true;
        }

        function NoConfirm(id) {
            document.getElementById("bk_node" + id).hidden = false;
        }

        function deleteReserve(id) {
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
                        url: '/deletereserve/' + id,
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

@endsection
