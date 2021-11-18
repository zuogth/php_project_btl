@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <br/>
            <table class="table" id="table-data">
                <thead>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>SĐT</th>
                    <th>Địa chỉ</th>
                    <th>Hoạt động</th>
                    <th>Role</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->fullname}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->address}}</td>
                            <td>{!!\App\Helpers\Helper::status('users',$user->status,$user->id)!!}</td>
                            <td>{{$user->roles[0]->rolename}}</td>
                            <td>
                                <a href="/admin/user/edit/{{$user->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable({
                "dom": '<"toolbar">frtip',
                "info": false,
                columnDefs: [
                    { orderable: false, targets: [1,2,3,4,5,6,7] }
                ],
                "pageLength": 10
            });
            $("div.toolbar").html();
        } );

    </script>
@endsection
