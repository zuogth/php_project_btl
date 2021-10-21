@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{old('name')}}">
                @error('name')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="menu">Thể loại</label>
                <select name="menu_id" class="form-control">
                    <option value="">---Chọn thể loại---</option>
                    @foreach ($menus as $menuParent)
                        @if ($menuParent->parent_id!=0)
                            <option value="{{$menuParent->id}}">{{$menuParent->name}}</option>
                        @endif
                    @endforeach
                </select>
                @error('menu_id')
                <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="price">Giá gốc</label>
                <input type="number" name="price" class="form-control" id="price" value="{{old('price')}}">
                @error('price')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="price_sale">Giá giảm</label>
                <input type="number" name="price_sale" class="form-control" id="price_sale" value="{{old('price_sale')}}">
                @error('price_sale')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <label for="content">Mô tả chi tiết</label>
            <textarea name="content" id="content" class="form-control">{{old('content')}}</textarea>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="file">Image</label>
                <input type="file" name="file" class="form-control" id="file">
                @error('thumb')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="col-sm-6" id="show-thumb">

            </div>
            <input type="hidden" name="thumb" id="thumb">
        </div>
        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="active" name="active" value="1" checked>
                <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="non-active" name="active" value="0">
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

@section('footer')
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });

</script>
@endsection
