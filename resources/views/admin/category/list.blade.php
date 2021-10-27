@extends('admin.main')

@section('content')
    <a href="/admin/category/add" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Tên</th>
            <th>Hoạt động</th>
            <th style="width:10%">&nbsp;</th>
        </thead>
        <tbody>
            {!!\App\Helpers\Helper::category($categories)!!}
        </tbody>
    </table>
@endsection
