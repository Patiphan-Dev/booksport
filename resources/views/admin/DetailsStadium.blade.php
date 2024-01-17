<div class="">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div id="carousel{{ $std->id }}" class="carousel slide mb-4">
                <div class="carousel-inner">
                    @foreach ($image as $key => $img)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset($img) }}" class="img-fluid w-100" alt="...">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $std->id }}"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $std->id }}"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <h5><i class="fa-solid fa-hand-holding-dollar"></i> ราคา {{ $std->std_price }} บาท / ครั้ง</h5>
    </div>
    <div class="row">
        <h5><i class="fa-solid fa-list"></i> รายละเอียด</h5>
        <div class="col"> {!! $std->std_details !!}</div>
    </div>
    <div class="row">
        <h5><i class="fa-solid fa-wand-magic-sparkles"></i> สิ่งอำนวยความสะดวก</h5>
        <div class="col"> {!! $std->std_facilities !!}</div>
    </div>
    <div class="clearfix">
        <h5><i class="fa-solid fa-shield-halved"></i> สถานะ</h5>
        @if ($std->std_status == 1)
            <button class="btn btn-primary">เปิดใช้บริการสนาม</button>
        @else
            <button class="btn btn-danger">ปิดใช้บริการสนาม</button>
        @endif
    </div>
</div>
