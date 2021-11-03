@extends('admin.main')
@section('content')
    @foreach($countR as $key =>$val)
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <div class="quantity-prod">
                        <h3>{{$val->count}}</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                        <h4>{{$countB[$key]->count}}</h4>
                    </div>
                    <p>{{$catename[$key]->categoryname}}</p>
                </div>
                <div class="icon">
                    <i class="fal fa-shopping-bag"></i>
                </div>
                <a href="/admin/product/list/{{$val->parent_id}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endforeach
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$countUser->count}}</h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="fal fa-user-plus"></i>
            </div>
            <a href="/admin/user/list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
@endsection
