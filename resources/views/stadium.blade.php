@extends('layout')
@section('body')
    <div class="row mb-4">
        <div id="carouselStadium" class="carousel slide">
            <div class="row">
                <div class="col-10">
                    <div class="carousel-inner">
                        @php
                            $image = explode(',', $stadium->std_img_path);
                        @endphp
                        @foreach ($image as $key => $img)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset($img) }}" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <a href="{{ route('booking', ['id' => $stadium->id]) }}" class="btn btn-warning">
                                        <i class="fa-solid fa-check"></i>จองสนาม
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselStadium"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselStadium"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-2 overflow-y-auto">
                    <div class="carousel-indicators">
                        @php
                            $image = explode(',', $stadium->std_img_path);
                        @endphp
                        @foreach ($image as $key => $img)
                            <img src="{{ asset($img) }}" data-bs-target="#carouselStadium"
                                data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                                aria-current="true" aria-label="Slide {{ $key }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h1> ราคา {{ $stadium->std_price }} บาท / ครั้ง</h1>
    </div>

    <div class="row">
        <h1>รายละเอียด</h1>
        {!! $stadium->std_details !!}
    </div>

    <div class="row">
        <h1>สิ่งอำนวยความสะดวก</h1>
        {!! $stadium->std_facilities !!}
    </div>

    <style>
        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #88888850;
            border-radius: 6px;
        }

        .carousel-item {
            width: 100%;
            max-height: 500px;
            border-top: 10px solid transparent;
        }

        .carousel-indicators {
            position: static !important;
            display: block !important;
            width: 100%;
            max-height: 150px;
            margin-right: 0;
            margin-bottom: 1rem;
            margin-left: 0;
            z-index: 0 !important;
        }

        .carousel-indicators [data-bs-target].active {
            opacity: 1;
        }

        .carousel-indicators [data-bs-target] {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
