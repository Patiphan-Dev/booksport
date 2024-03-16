@extends('layout')
@section('body')
    <div class="row mt-2 gy-3 gy-md-4 gy-lg-4 align-items-lg-center">
        <div class="col-12 col-lg-6 col-xl-5">
            <img class="img-fluid rounded" loading="lazy" src="{{ asset('assets/images/login.png') }}" alt="About 1">
        </div>
        <div class="col-12 col-lg-6 col-xl-7">
            <div class="row justify-content-xl-center">
                <div class="col-12 col-xl-11">
                    <h2 class="mb-3">เกี่ยวกับเรา</h2>
                    <p class="lead fs-4 text-secondary mb-3">
                        เว็บไซต์นี้จัดทำ ขึ้นเพื่อพัฒพันาระบบการจองสนามกีฬาออนไลน์ <br>
                        โดยนักศึกษาคณะเทคโนโลยีสื่อสารมวลชน สาขาสื่อดิจิดิทัจิทัล <br>
                        มหาวิทวิยาลัยเทคโนโลยีรยีาชมงคลธัญธับุรี <br>
                        ไม่ได้มีเจตนาใช้เพื่อหารายได้แต่อย่างใด หากมีข้อผิดพลาดหรือบกพร่องประการใดขออภัยมา ณ ที่นี้ด้นี้ด้วย
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
