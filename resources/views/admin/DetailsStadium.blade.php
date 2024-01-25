<div class="row justify-content-center">
    <div id="carousel{{ $std->id }}" class="carousel slide mb-3">
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
    <div class="px-4">
        <h4 class="pb-4 mb-3 fst-italic border-bottom">
            {{ $std->std_name }} ราคา {{ $std->std_price }} บาท / ชั่วโมง
        </h4>
        <article class="blog-post mb-3">
            <h3>รายละเอียด</h3>
            {!! $std->std_details !!}
        </article>
        <article class="blog-post mb-3">
            <h3>สิ่งอำนวยความสะดวก</h3>
            {!! $std->std_facilities !!}
        </article>
        <div class="clearfix">
            <h5><i class="fa-solid fa-shield-halved"></i> สถานะ</h5>
            @if ($std->std_status == 1)
                <button class="btn btn-primary">เปิดใช้บริการสนาม</button>
            @else
                <button class="btn btn-danger">ปิดใช้บริการสนาม</button>
            @endif
        </div>
    </div>
</div>
