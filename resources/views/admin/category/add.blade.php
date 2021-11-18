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
                        <label for="categoryname">Tên danh mục</label>
                        <input type="text" name="categoryname" class="form-control" id="categoryname" placeholder="Enter name" value="{{old('categoryname')}}">
                        @error('categoryname')
                            <span style="color: #da0101">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="menu">Danh mục</label>
                        <select name="parent_id" class="form-control">
                            <option value="0">Danh mục cha</option>
                            @foreach ($categories as $categoriy)
                                <option value="{{$categoriy->id}}" {{old('parent_id')?'selected':''}}>{{$categoriy->categoryname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea rows="5" name="description" class="form-control" id="description">{{old('description')}}</textarea>
                    </div>
                    <label>Ảnh</label>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label id="select_img" for="file" data-img="thumb" onclick="selectImg(this)">
                                <img src="{{old('thumb')}}" id="thumb" alt='Chọn ảnh sản phẩm' style='width:100%;'>
                            </label>
                            <input type="hidden" name="thumb" id="thumb" value="{{old('thumb')}}">
                            @error('thumb')
                            <span style="color: #da0101">{{$message}}</span>
                            @enderror
                        </div>
                        <input type="file" class="form-control" name="file" id="file" hidden>
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
        </div>
        <!-- /.card -->
    </div>
@endsection
@section('footer')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then( editor => {
                editor.ui.view.editable.element.style.height = '200px';
            })
            .catch(error => {
                console.error(error);
            });

    </script>
@endsection
