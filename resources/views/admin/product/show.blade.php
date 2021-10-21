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
                <input type="text" name="productname" class="form-control" id="productname" placeholder="Enter name" value="{{$product->productname}}">
                @error('productname')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="category_id">Thể loại</label>
                <select name="category_id" class="form-control">
                    <option value="">---Chọn thể loại---</option>
                    @foreach ($categories as $cateParent)
                        @if ($cateParent->parent_id!=0)
                            <option value="{{$cateParent->id}}" {{$cateParent->id==$product->category_id?'selected':''}}>{{$cateParent->categoryname}}</option>
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
                <label for="pricesell">Giá gốc</label>
                <input type="number" name="pricesell" class="form-control" id="pricesell" value="{{$product->pricesell}}">
                @error('pricesell')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                <label for="priceentry">Giá giảm</label>
                <input type="number" name="priceentry" class="form-control" id="priceentry" value="{{$product->priceentry}}">
                @error('priceentry')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" class="form-control">{{$product->description}}</textarea>
        </div>
        <div class="row">
            <div class="form-group col-sm-8">
                <label for="file">Image</label>
                <input type="file" name="file" class="form-control" id="file">
                @error('images')
                    <span style="color: #da0101">{{$message}}</span>
                @enderror
            </div>
            <div class="col-sm-4" id="show-thumb">
                <a href="{{$product->images}}" target="_blank">
                    <img src="{{$product->images}}" alt="" width="100%">
                </a>
            </div>
            <input type="hidden" name="images" id="image" value="{{$product->images}}">
        </div>
        <div class="form-group">
            <label for="">Kích hoạt</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="status" name="status" value="1"
                {{$product->status==1?'checked':''}}>
                <label for="status" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="non-active" name="status" value="0"
                    {{$product->status==0?'checked':''}}>
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
