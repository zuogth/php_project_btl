@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="POST">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="productname">Tên sản phẩm</label>
                <input type="text" name="productname" class="form-control" id="productname" placeholder="Enter name" value="{{old('productname')}}">
                @error('productname')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="category_id">Thể loại</label>
                <select name="category_id" class="form-control">
                    <option value="">---Chọn thể loại---</option>
                    @foreach ($categories as $category)
                        @if ($category->parent_id!=0)
                            <option value="{{$category->id}}" {{$category->id==old('category_id')?'selected':''}}>
                                {{$category->categoryname}}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('category_id')
                <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="price">Giá bán</label>
                <input type="number" name="pricesell" class="form-control" id="pricesell" value="{{old('pricesell')}}">
                @error('pricesell')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="price_sale">Giá nhập</label>
                <input type="number" name="priceentry" class="form-control" id="priceentry" value="{{old('priceentry')}}">
                @error('priceentry')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" class="form-control">{{old('description')}}</textarea>
        </div>
        <div class="form-group col-sm-6">
            <label for="brand_id">Brand</label>
            <select name="brand_id" class="form-control">
                <option value="">---Brand---</option>
                @foreach ($brands as $brand)
                    <option value="{{$brand->id}}" {{$brand->id==old('brand_id')?'selected':''}}>
                        {{$brand->brandname}}
                    </option>
                @endforeach
            </select>
            @error('brand_id')
            <span style="color: #da0101">{{$message}}</span>
            @enderror
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="images">Image</label>
                <input type="file" class="form-control" id="file">
                @error('images')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="col-sm-6" id="show-thumb">

            </div>
            <input type="hidden" name="images" id="image">
            <input type="hidden" name="productcode" id="productcode">
        </div>
        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="status" name="status" value="1" checked>
                <label for="status" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="non-status" name="status" value="0">
                <label for="non-status" class="custom-control-label">Không</label>
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
