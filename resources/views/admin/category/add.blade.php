@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="form-group">
            <label for="categoryname">Tên danh mục</label>
            <input type="text" name="categoryname" class="form-control" id="categoryname" placeholder="Enter name">
            @error('name')
                <span style="color: #da0101">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="menu">Danh mục</label>
            <select name="parent_id" class="form-control">
                <option value="0">Danh mục cha</option>
                @foreach ($categories as $categoriy)
                    <option value="{{$categoriy->id}}">{{$categoriy->categoryname}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="status" name="status" value="1" checked>
                <label for="status" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="non-active" name="status" value="0">
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
@endsection
