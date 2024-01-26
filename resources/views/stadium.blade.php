@extends('layout')
@section('body')
    <div class="row mb-4">
        <div id="carouselStadium" class="carousel slide">
            <div class="row">
                <div class="col-9">
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
                <div class="col-3 overflow-y-auto mt-2">
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

    <div class="row mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="pb-4 mb-4 fst-italic border-bottom">
                        {{ $stadium->std_name }} ราคา {{ $stadium->std_price }} บาท / ชั่วโมง
                    </h2>

                    <article class="blog-post">
                        <h3>รายละเอียด</h3>
                        {!! $stadium->std_details !!}
                    </article>
                    <article class="blog-post">
                        <h3>สิ่งอำนวยความสะดวก</h3>
                        {!! $stadium->std_facilities !!}
                    </article>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-sticky" style="top: 5.5rem;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="fst-italic">สนามกีฬาเพิ่มเติม</h4>
                        <ul class="list-unstyled">
                            @foreach ($stadiums as $key => $std)
                                <li @if ($stadium->id == $std->id) hidden @endif>
                                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                                        href="{{ route('getStadium', ['id' => $std->id]) }}">
                                        @php
                                            $image = explode(',', $std->std_img_path);
                                        @endphp
                                        <img src="{{ asset($image[0]) }}" data-bs-target="#carouselStadiums"
                                            data-bs-slide-to="{{ $key }}" class="bd-placeholder-img"
                                            width="100%" height="85" aria-current="true">
                                        <div class="col-lg-8">
                                            <h5 class="mb-0">{{ $std->std_name }}</h5>
                                            <span class="text-body-secondary">ราคา {{ $std->std_price }} บาท /
                                                ชั่วโมง</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection
