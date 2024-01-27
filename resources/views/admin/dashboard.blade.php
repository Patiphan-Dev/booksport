@extends('admin.layout')
@section('body')
    <div class="container text-center">
        <div class="row g-3">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center text-bg-danger">
                    <div class="card-body">
                        <p><i class="fa-solid fa-bookmark" style="font-size: 6vh;"></i></p> 
                        <h5 class="card-title fw-bold">การจองวันนี้</h5>
                        <h1 class="fw-bold">{{ count($bookday) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center text-bg-warning text-white">
                    <div class="card-body">
                        <p><i class="fa-solid fa-book-bookmark" style="font-size: 6vh;"></i></p> 
                        <h5 class="card-title fw-bold">การจองทั้งหมด</h5>
                        <h1 class="fw-bold">{{ count($bookings) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center text-bg-success">
                    <div class="card-body">
                       <p><i class="fa-solid fa-hand-holding-dollar" style="font-size: 6vh;"></i></p> 
                        <h5 class="card-title fw-bold">รอตรวจสอบ</h5>
                        <h1 class="fw-bold">{{ count($bookstatus) }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card text-center text-bg-primary">
                    <div class="card-body">
                        <p><i class="fa-solid fa-medal" style="font-size: 6vh;"></i></p> 
                        <h5 class="card-title">สนามกีฬาทั้งหมด</h5>
                        <h1 class="fw-bold">{{ count($stadiums) }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
