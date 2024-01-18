@extends('layout')
@section('body')
    <div>
        <form action="{{ url('/booking') }}" method="post">
            @csrf
            @php
                $date = date('Y-m-d');
                $str_time = date('H:i');
                $end_time = date('H:i', strtotime('+1 hour'));
            @endphp
            <div class="row">
                <div class="col-3"><label for="stadium_id">สนามกีฬา :</label>
                    <select class="form-select" aria-label="Default select example" name="stadium_id" id="stadium_id" required>
                        @foreach ($stadiums as $stadium)
                            <option value="{{ $stadium->id }}">{{ $stadium->std_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">

                    <label for="booking_date">วันที่จอง : </label>
                    <input type="date" class="form-control" name="booking_date" id="booking_date"
                        value="{{ $date }}" required>
                </div>
                <div class="col-2">
                    <label for="booking_date">เวลาเข้า : </label>
                    <input type="time" class="form-control" name="booking_date" id="booking_date"
                        value="{{ $str_time }}" required>
                </div>
                <div class="col-2">
                    <label for="booking_date">เวลาออก : </label>
                    <input type="time" class="form-control" name="booking_date" id="booking_date"
                        value="{{ $end_time }}" required>
                </div>
                <div class="col-2">
                    <label></label>
                    <input type="submit" class="form-control btn btn-outline-primary" value="Book Stadium">
                </div>
            </div>

        </form>
    </div>
@endsection
