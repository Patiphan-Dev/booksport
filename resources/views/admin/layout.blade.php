<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เว็บไซต์จองสนามกีฬา {{ isset($title) ? '| ' . $title : '' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/Icons.png') }}">
    <!-- Tempusdominus Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- sweetalert2 -->
    <link href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <!-- include libraries(jQuery, bootstrap) -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <style>
        .modal label span{
            color: red
        }
    </style>
</head>

<body>

    <main class="d-flex flex-nowrap" style="height: 100vh">
        @include('admin.navbar')
        <div class="container">
            <section class="content">
                @include('sweetalert::alert')
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0"> {{ isset($title) ? '' . $title : '' }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container-fluid">
                    @yield('body')
                </div>
            </section>
        </div>
    </main>

    <script>
        $(document).ready(function() {
            // $('#std_details').summernote({
            //     tabsize: 2,
            //     height: 200
            // });
            // $('#std_facilities').summernote({
            //     tabsize: 2,
            //     height: 200
            // });
            // $('#edit_std_details').summernote({
            //     tabsize: 2,
            //     height: 200
            // });
            // $('#edit_std_facilities').summernote({
            //     tabsize: 2,
            //     height: 200
            // });
        });
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

</body>

</html>
