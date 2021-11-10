{{--@if($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                {{$error}}--}}
{{--            @endforeach--}}
{{--    </div>--}}
{{--@endif--}}

@if(Session::has('error'))
    <div class="alert-noti alert alert-warning">
        <i class="fas fa-times close-alert"></i>
        <span>{{Session::get('error')}}</span>
    </div>
@endif

@if(Session::has('success'))
    <div class="alert-noti alert alert-success">
        <i class="fas fa-times close-alert"></i>
        <span>{{Session::get('success')}}</span>
    </div>
@endif
