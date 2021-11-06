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
                            <label for="nameuser">Tên người nhập</label>
                            <input type="text" class="form-control" id="nameuser" value="{{\Illuminate\Support\Facades\Auth::user()->fullname}}" readonly>
                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="totalprice">Tổng tiền</label>
                            <input type="text" class="form-control" id="totalprice_s" readonly>
                            <input type="hidden" name="totalprice" id="totalprice">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="bill_date">Ngày đặt</label>
                            <input class="form-control" type="text" id="bill_date" value="{{date("Y-m-d")}}" readonly>
                        </div>
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
                <div class="container">
                    <input type="hidden" name="product_selected" id="product_selected">
                    <label>Danh sách sản phẩm:</label>
                    @error('product_selected')
                        <span style="color: #da0101">{{$message}}</span>
                    @enderror
                    <table class="table">
                        <thead>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Giá nhập</th>
                        <th>Số lượng mua</th>
                        <th>Thể loại</th>
                        <th>
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addProduct">
                                <i class="fas fa-plus"></i>
                            </button>
                        </th>
                        </thead>
                        <tbody id="productsSelected">

                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="count_prod" id="count_prod">
                @csrf
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductLabel">Chọn sản phẩm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table" id="tableModal">
                                <thead>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá nhập</th>
                                    <th>Thể loại</th>
                                    <th></th>
                                </thead>
                                <tbody id="tableProducts">
                                    @foreach($products as $product)
                                        <tr>
                                            <td><img src="{{$product->images}}" style="width: 80px"></td>
                                            <td>{{$product->productname}}</td>
                                            <td>{{$product->priceentry}}</td>
                                            <td>{{$product->category->categoryname}}</td>
                                            <td id="selectProd"><input type="checkbox" data="{{$product->id}}"></td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnAddProd" class="btn btn-primary" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="/template/admin/js/receipt.js"></script>
    <script>
        $(document).ready(function (){
            $('#tableModal').DataTable({
                "dom": '<"toolbar">frtip',
                "info": false,
                columnDefs: [
                    { orderable: false, targets: [0,1,3,4] },
                    {
                        targets: 2,
                        render: $.fn.dataTable.render.intlNumber('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        })
                    }
                ],
                "pageLength": 5
            });
            $("div.toolbar").html();
        });
    </script>
@endsection
