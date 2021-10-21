@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th style="width:10%">&nbsp;</th>
        </thead>
        <tbody>
            {!!\App\Helpers\Helper::category($categories)!!}
        </tbody>
    </table>
@endsection
