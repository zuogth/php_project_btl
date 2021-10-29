@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Username</th>
                    <th>Hoạt động</th>
                    <th>Role</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->username}}</td>
                            <td>{!!\App\Helpers\Helper::status($user->status)!!}</td>
                            <td>{{$user->roles[0]->rolename}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
@endsection
