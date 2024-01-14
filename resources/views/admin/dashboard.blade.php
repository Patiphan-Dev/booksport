@extends('admin.layout')
@section('body')
    
    <div class="container text-center">
        <div class="row g-2">
            <div class="col-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-bookmark"></i>
                        <h5 class="card-title">การจองวันนี้</h5>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <h5 class="card-title">การจองทั้งหมด</h5>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">รอตรวจสอบการชำระเงิน</h5>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                    </div>
                    <div class="card-footer text-body-secondary">
                        ตรวจสอบข้อมูล <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
