<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
            @include('admin.alert')
            <form action="" method="post">
                <div class="input-group err-register">
                    <input type="text" name="fullname" class="form-control" placeholder="Full name" value="{{old('fullnam')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('fullname')
                <span style="color: #da0101">{{$message}}</span>
                @enderror
                <div class="input-group err-register">
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{old('username')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('username')
                <span style="color: #da0101">{{$message}}</span>
                @enderror
                <div class="input-group err-register">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                <span style="color: #da0101">{{$message}}</span>
                @enderror
                <div class="input-group err-register">
                    <input type="password" name="re-password" class="form-control" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('re-password')
                <span style="color: #da0101">{{$message}}</span>
                @enderror
                <div class="row err-register">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                        @error('terms')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
                @csrf
            </form>

            <a href="login.html" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.login-box -->
@include('admin.footer')
</body>
</html>
