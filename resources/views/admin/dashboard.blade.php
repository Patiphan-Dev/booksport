@extends('admin.layout')
@section('body')
    <div class="container text-center">
        <div class="row g-3">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-bookmark"></i>
                        <h5 class="card-title">การจองวันนี้</h5>
                        <h1>{{ count($bookday) }}</h1>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-book-bookmark"></i>
                        <h5 class="card-title">การจองทั้งหมด</h5>
                        <h1>{{ count($bookings) }}</h1>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <h5 class="card-title">รอตรวจสอบ</h5>
                        <h1>{{ count($bookstatus) }}</h1>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-medal"></i>
                        <h5 class="card-title">สนามกีฬาทั้งหมด</h5>
                        <h1>{{ count($stadiums) }}</h1>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
