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
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" class="form-control" id="discount" value="{{old('discount')??0}}">
                            @error('discount')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
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
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea name="description" rows="5" id="description" class="form-control">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="content">Mổ tả chi tiết</label>
                        <textarea name="content" rows="5" id="content" class="form-control">{{old('content')}}</textarea>
                    </div>
                    <div class="row">
                        @php
                            $old="";
                        @endphp
                        @foreach($specialities as $key => $speciality)
                            @if($old!=$speciality->code)
                                <div class="form-group col-sm-6">
                                    <label {{$old=$speciality->code}} style="text-transform: capitalize;">{{$speciality->typename}}</label>
                                    <select name="{{$speciality->code}}" class="form-control">
                                        <option value="">---Chọn {{$speciality->typename}}---</option>
                                        @foreach($specialities as $speciality)
                                            @if($speciality->code==$old)
                                                <option value="{{$speciality->id}}" {{$speciality->id==old($speciality->code)?'selected':''}}>{{$speciality->mata}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <label>Ảnh</label>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label id="select_img" for="file" data-img="image" onclick="selectImg(this)">
                                <img src="{{old('images')}}" id="image" alt='Chọn ảnh sản phẩm' style='width:100%;'>
                            </label>
                            <input type="hidden" name="images" id="image" value="{{old('images')}}">
                            @error('images')
                                <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6">
                            <div id="addImages">

                            </div>
                            <button type="button" class="btn btn-primary btn-xs" onclick="addImages(this)" data-count="1">
                                <i class="fas fa-plus"></i>
                            </button>
                            <input type="hidden" name="countImg" id="countImg" value="">
                        </div>
                        <input type="file" class="form-control" name="file" id="file" hidden>
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
        </div>
    </div>
@endsection

@section('footer')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then( editor => {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(error => {
                console.error(error);
            });

    </script>
@endsection
