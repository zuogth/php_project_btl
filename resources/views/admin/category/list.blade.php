@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <a href="/admin/category/add" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Tên</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                    {!!\App\Helpers\Helper::category($categories)!!}
                </tbody>
            </table>
        </div>
    </div>
@endsection
