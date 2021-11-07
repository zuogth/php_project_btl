
@extends('user.main')
@section('head')
    <link rel="stylesheet" href="/user/css/search.css">
    <script src="/user/js/bootstrap.min.js"></script>
    <script src="/paging/jquery.twbsPagination.js" type="text/javascript"></script>
@endsection
@section('content')
    <div class="main">
        <div class="container">
            <div class="m-search-top">
                <h1>Kết quả tìm kiếm của "<span id="m-text-search">hehe</span>" là <span id="m-count-search">0</span> kết quả</h1>
            </div>
            <form action="/search">
            <div class="m-search-middle">

                <input type="text" placeholder="Nhập tên sản phẩm muốn tìm" id="m-input-search-two-page" name="name">
                <i class="fas fa-search"></i>

            </div>
            </form>
            <div class="m-search-bottom d-flex row" id="m-search-page-result">


            </div>
            <div class = 'd-flex w-100 justify-content-center pagination'>
                <input type="text" id="m-search-total-page" value="{{$count}}" hidden>
                <input type="text" id="m-search-name-page" value="{{$name}}" hidden>
                <nav aria-label="Page navigation">
                    <ul class="pagination" id="pagination"></ul>
                </nav>
            </div>
        </div>
    </div>

@endsection

@section('footer')

<script src="/user/js/product-search.js"></script>

@endsection

