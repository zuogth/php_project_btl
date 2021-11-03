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
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>
                                {{$bill->user->fullname}}
                            </td>
                            <td>{{$bill->bill_date}}</td>
                            <td>{{$bill->deliverytime}}</td>
                            <td>{{$bill->totalprice}}</td>
                            <td>{!! \App\Helpers\Helper::statusBill($bill->status) !!}</td>
                            <td>
                                <a href="/admin/bill/edit/{{$bill->id}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-{{$bill->status==2?'info':'edit'}}"></i>
                                </a>
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
                    { orderable: false, targets: [5,6] },
                    {
                        targets: 4,
                        render: $.fn.dataTable.render.intlNumber('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        })
                    }
                ],
                "pageLength": 10
            });
            $("div.toolbar").html();
        } );
    </script>
@endsection
