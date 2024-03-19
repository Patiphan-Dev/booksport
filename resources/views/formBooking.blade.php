<style>
    .booking-form {
        max-width: 400px;
        width: 100%;
        margin: auto;
        margin-right: 50px;
    }

    .booking-form>form {
        background-color: #101113;
        padding: 20px 30px;
        border-radius: 3px;
    }

    .booking-form .form-group {
        position: relative;
        margin-bottom: 15px;
    }

    .booking-form .form-label {
        color: #fff;
        font-size: 16px;
        font-weight: 400;
        margin-bottom: 5px;
        display: block;
        text-transform: uppercase;
    }
</style>
<script>
    function Calculate() {
        // Get the input values
        const bookInTime = document.getElementById("bk_str_time").value;
        const bookOutTime = document.getElementById("bk_end_time").value;
        // Get the selected option
        var selectedOption = $('#bk_std_id option:selected');
        // Retrieve the data-price attribute value
        var price = parseFloat(selectedOption.data('price'));
        // Convert the input values to Date objects
        const bookInDate = new Date(`2000-01-01T${bookInTime}:00Z`);
        const bookOutDate = new Date(`2000-01-01T${bookOutTime}:00Z`);

        // Calculate the time difference in minutes
        const timeDifference = (bookOutDate - bookInDate) / (1000 * 60);

        // Calculate the Total Price 
        const totalPrice = (price / 60) * timeDifference

        const roundedNumber = Math.round(totalPrice);

        // Display
        document.getElementById("bk_price").value = `${price}`;
        document.getElementById("bk_sumtime").value = `${timeDifference}`;
        document.getElementById("bk_total_price").value = `${roundedNumber}`;
    }
</script>
{{-- <div class="row bg-dark rounded-bottom-5" id="booking">
    <div class="booking-form py-md-4 mt-3"> --}}
<form action="{{ route('addBooking') }}" method="post" enctype="multipart/form-data">
    @csrf
    @php
        $date = date('Y-m-d');
        $str_time = date('00:00:00');
        $end_time = date('00:00:00', strtotime('+1 hour'));
    @endphp
    <div class="row justify-content-center mb-3">
        <div class="col-12 col-sm-12 col-md-12 mb-3">
            <label for="stadium_id" class="form-label">สนามกีฬา :</label>
            <select class="form-select" name="bk_std_id" id="bk_std_id" required onchange="Calculate()">
                <option value="" disabled selected>--- กรุณาเลือกสนาม ---</option>
                @foreach ($stadiums as $stadium)
                    <option value="{{ $stadium->id }}" data-price="{{ $stadium->std_price }}"
                        @if (!empty($search)) @if ($search->id == $stadium->id) selected @endif
                        @endif>
                        {{ $stadium->std_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-6 mb-3">
            <label for="bk_price" class="form-label">ราคา/ชั่วโมง : </label>
            <input type="text" class="form-control" name="bk_price" id="bk_price" value="" disabled required>
        </div>
        <div class="col-12 col-sm-6 col-md-6 mb-3">
            <label for="bk_date" class="form-label">วันที่จอง : </label>
            <input type="date" class="form-control" name="bk_date" id="bk_date" value="{{ $date }}"
                required>
        </div>
        <div class="col-12 col-sm-6 col-md-6 mb-3">
            <label for="bk_str_time" class="form-label">เวลาเข้า : </label>
            <input type="time" class="form-control" name="bk_str_time" id="bk_str_time" value="" required
                onchange="Calculate()">
        </div>
        <div class="col-12 col-sm-6 col-md-6 mb-3">
            <label for="bk_end_time" class="form-label">เวลาออก : </label>
            <input type="time" class="form-control" name="bk_end_time" id="bk_end_time" value="" required
                onchange="Calculate()">
        </div>
        <div class="col-12 col-sm-6 col-md-6 mb-3">
            <label for="bk_sumtime" class="form-label">เวลาเช่า (นาที)</label>
            <input type="text" class="form-control" name="bk_sumtime" id="bk_sumtime" value="" disabled
                required>
        </div>
        <div class="col-12 col-sm-6 col-md-6 mb-3">
            <label for="bk_total_price" class="form-label">ราคารวม</label>
            <input type="text" class="form-control" name="bk_total_price" id="bk_total_price" value="" disabled
                required>
        </div>
        <div class="col-8 col-sm-6 col-md-6 mt-3">
            <div class="form-btn">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fa-regular fa-calendar-plus"></i> จองสนาม
                </button>
            </div>
        </div>
    </div>
</form>
{{-- </div>
</div> --}}
