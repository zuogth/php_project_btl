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
                        <input type="text" name="typename" class="form-control" id="typename" readonly value="{{$speciality->typename}}">
                    </div>
                    <div class="form-group">
                        <label for="mata">Đặc tính</label>
                        <input type="text" name="mata" class="form-control" id="mata" value="{{old('mata')??$speciality->mata}}">
                        @error('mata')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea rows="5" name="description" class="form-control" id="description">{{old('description')??$speciality->description}}</textarea>
                        @error('description')
                        <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cate">Thể loại</label>
                        <input type="text" class="form-control" id="cate" value="{{$catename}}" readonly>
                    </div>
                    <input name="typeproduct" type="hidden" value="{{$speciality->typeproduct}}">
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
