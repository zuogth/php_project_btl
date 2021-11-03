@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <form action="" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="fullname">Tên người dùng</label>
                            <input type="text" class="form-control" id="fullname" value="{{$user->fullname}}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phone">Điện thoại</label>
                            <input type="text" class="form-control" id="phone" value="{{$user->phone}}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" value="{{$user->address}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Kích hoạt</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="status" name="status" value="1" {{$user->status==1?'checked':''}}>
                            <label for="status" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="non-active" name="status" value="0" {{$user->status==0?'checked':''}}>
                            <label for="non-active" class="custom-control-label">Không</label>
                        </div>
                    </div>
                </div>
                @csrf
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

