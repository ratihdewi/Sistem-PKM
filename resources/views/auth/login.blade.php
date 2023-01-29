<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        crossorigin="anonymous"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <!-- Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style_manual.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('layout.navbar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="login-div">
                @if (session()->has('error'))
                    <div class="alert alert-danger text-center mx-auto w-75" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="form-container">
                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="username">
                                Username
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="inlineFormInputGroupUsername" placeholder="Username" name="username"
                                    aria-describedby="inputGroupPrepend3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">
                                Password
                            </label>
                            <div class="input-group" id="show_hide_password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-key"></i></div>
                                </div>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="inlineFormInputGroupUsername" placeholder="Password" name="password">
                                <div id="mouse-click" class="input-group-append">
                                    <div class="input-group-text"><i class="eye-change fa fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <label class="form-check-label" for="disabledFieldsetCheck">
                                Forgot Password?
                            </label>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <!-- DataTable -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-datatables-checkboxes@1.2.13/js/dataTables.checkboxes.min.js"></script>
    <!-- Moment -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Date Range Picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $('#mouse-click').mousedown(function() {
            var icon = $('.eye-change');

            $('#password').attr('type', 'text');
            $('.eye-change').attr('data-icon', 'eye-slash');
        })

        $('#mouse-click').mouseup(function() {
            var icon = $('.eye-change');

            $('#password').attr('type', 'password');
            $('.eye-change').attr('data-icon', 'eye');
        })
    </script>
</body>

</html>
