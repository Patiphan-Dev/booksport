@extends('admin.layout')

@section('body')
    <div class="row justify-content-center mt-5 ">
        <form
            @if ($rule != '') action="{{ route('updateRule') }}"@else action="{{ route('addRule') }}" @endif
            method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-12 mb-4">
                <textarea id="rule" name="rule_detail" required>
                    @if ($rule != '')
                        {!! $rule->rule_detail !!}
                    @endif
                </textarea>
            </div>
            <div class="col-12 text-center">
                <input type="submit" class="btn btn-primary" id="submit" value="บันทึก">
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#rule').summernote({
                tabsize: 2,
                height: 600
            });
        });
    </script>
@endsection
