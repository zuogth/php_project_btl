$(document).ready(function () {
    $('.imgs-prod-resp-item').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        draggable: true,
        arrows: true,
        Swipe: true,
        prevArrow: '<a class="prev-slick btn-slick"><img src="/user/img/carousel-left-over.svg" alt=""></a>',
        nextArrow: '<a class="next-slick btn-slick"><img src="/user/img/carousel-right-over.svg" alt=""></a>',
        responsive: [{
            breakpoint: 991,
            settings: "slick"
        },
            {
                breakpoint: 767,
                settings: {
                    arrows: false,
                    dots: true,
                    appendDots: '.dotClass'
                }
            }
        ]
    })
})

//Các tiện ích
$(document).ready(function(){
    $(window).scroll(function(){
        $('.nav-options div ul li a').removeClass("active");
        var scrolls=$(window).scrollTop();
        for (let index = 1; index <=4; index++) {
            var url='#section'+index;
            var scroll_sec=$(url).offset().top-100;
            if(index!=4){
                var i=index+1;
                var urln='#section'+i;
                var scroll_sec_n=$(urln).offset().top-100;
                if(scroll_sec>scrolls && index==1){
                    $('.nav-options div ul li:eq(0) a').addClass("active");
                }else if(scroll_sec<=scrolls && scrolls<scroll_sec_n){
                    $('.nav-options div ul li:eq('+(index-1)+') a').addClass("active");
                }
            }else{
                if(scroll_sec<=scrolls){
                    $('.nav-options div ul li:eq('+(index-1)+') a').addClass("active");
                }
            }

        }
    })
    $('.nav-options a').click(function(){
        var href=$(this).attr("href-link");
        $('body,html').animate({
            scrollTop:$(href).offset().top-60
        });
    })
    $('#btn-comment').click(function(){
        $(this).hide();
        $('#formComment').show();
    });
    $('#btn-comment2').click(function(){
        $('#btn-comment').show();
        $('#formComment').hide();
        $('body,html').animate({
            scrollTop:$('#section3').offset().top-60
        })
    });
    $('.rating-cus').click(function(){
        var rate=$(this).attr("rate-index");
        $('.rates-star-cus ul li').removeClass("on");
        $('.rates-star-cus strong').html(rate);
        $('.rates-star-cus ul li:eq('+(rate-1)+') input').attr("checked","true");
        for (let index = 0; index < rate; index++) {
            $('.rates-star-cus ul li').eq(index).addClass("on");

        }
    });

    $("#h-btn-search").click(function () {
        $("#h-search").show();
        $("body").addClass("scroll-hand");
    });
    $(".h-btn-close-search").click(function () {
        $("#h-search").hide();
        $("body").removeClass("scroll-hand");
    });

    $(window).scroll(function () {
        var e = $(window).scrollTop();
        if (e > 1000) {
            $('#myBtnTop').show();
        } else {
            $('#myBtnTop').hide();
        }
        // $('nav.nav-options div').hide();
    });
    $('#myBtnTop').click(function () {
        $('body,html').animate({
            scrollTop: 0
        });
    });
})

//Load img
$(document).ready(function () {
    var id = '';
    $('.gallery_01 a.img-item').click(function () {
        loadImg(this, '.gallery_01 a.img-item', '#zoom_04', 'data-image');
        $(this).addClass('active-imgs');
        id = $(this).attr('id');
    });
    $('.list-imgs-modal a').click(function () {
        loadImg(this, '.list-imgs-modal a', '#zoom_05', 'data-image');
        $(this).addClass('active-imgs');
    });
    $('#zoom_04').click(function () {
        loadImg(this, '.list-imgs-modal a', '#zoom_05', 'src');
        if (id == '') {
            $('.list-imgs-modal a#img_01').addClass('active-imgs');
        } else {
            $('.list-imgs-modal a#' + id).addClass('active-imgs');
        }
    })
});

function loadImg(obj, focus, imgMain, attr) {
    var url = $(obj).attr(attr);
    $(imgMain).attr('src', url);
    $(focus).removeClass("active-imgs");
}
