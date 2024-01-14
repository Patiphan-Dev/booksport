@extends('admin.layout')

@section('body')
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ชื่อสนาม</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">ราคา</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">

                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">รายละเอียด</label>
                            <div id="details"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">สิ่งอำนวยความสะดวก</label>
                            <div id="facilities"></div>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">รูปภาพสนาม</label>
                            <input class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Seve</button>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button>
@endsection
