@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <a href="/admin/speciality/add" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            <table class="table" id="table-data">
                <thead>
                    <th style="width: 5%;">ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($specialities as $speciality)
                        <tr>
                            <td>{{$speciality->id}}</td>
                            <td>{{$speciality->typename.' '.$speciality->mata}}</td>
                            <td>{{$speciality->description}}</td>
                            <td>
                                <a href='/admin/speciality/edit/{{$speciality->id}}' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a>
                                <a href='#' class='btn btn-danger btn-sm' onclick='removeRow({{$speciality->id}},"/admin/speciality/delete")'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                    { orderable: false, targets: [1,2,3] }
                ],
                "pageLength": 10
            });
            $("div.toolbar").html();
        } );
    </script>
@endsection
