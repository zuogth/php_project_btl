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
                    <div class="form-group">
                        <label for="typename">Tên</label>
                        <input type="text" name="typename" class="form-control" id="typename" placeholder="Nhập tên" value="{{old('typename')}}">
                        @error('typename')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mata">Đặc tính</label>
                        <input type="text" name="mata" class="form-control" placeholder='Nhập đặc tính (ví dụ: 4k, 50", 250L,...)' id="mata" value="{{old('mata')}}">
                        @error('mata')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea rows="5" name="description" class="form-control" id="description">{{old('description')}}</textarea>
                        @error('description')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="cate">Thể loại</label>
                        <select name="typeproduct" class="form-control">
                            <option value="">--Chọn thể loại--</option>
                            <option value="ti-vi">Ti vi</option>
                            <option value="tu-lanh">Tủ lạnh</option>
                            <option value="dieu-hoa">Điều hòa</option>
                            <option value="may-giat">Máy giặt</option>
                        </select>
                        @error('typeproduct')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
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
