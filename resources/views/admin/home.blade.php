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
                @if($val->parent_id==1||$val->parent_id==2)
                    <a href="/admin/product/list/{{$val->parent_id==1?'ti-vi':'tu-lanh'}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                @else
                    <a href="/admin/product/list/{{$val->parent_id==3?'dieu-hoa':'may-giat'}}" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                @endif
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
            <a href="/admin/user/list" class="small-box-footer">Xem chi tiết <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
@endsection
