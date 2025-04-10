<?php
$title = "首頁";
ob_start();
?>
<!-- pc carouse -->
<style>
    .pc .carousel {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
    }

    .pc .carousel .carousel-inner {
        width: 80%;
        border-radius: 1rem;
    }

    .pc .carousel .carousel-control-prev,
    .carousel-control-next {
        position: relative;
    }

    .pc .carousel .carousel-control-prev {
        left: 0;
        margin-right: 0.5rem;
        opacity: 1;
        width: auto;
        height: auto;
    }

    .pc .carousel .carousel-control-next {
        right: 0;
        margin-left: 0.5rem;
        opacity: 1;
        width: auto;
        height: auto;
    }

    .pc .carousel .carousel-control-prev span {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: var(--color666666);
        color: var(--colorececec);
    }

    .pc .carousel .carousel-control-next span {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: var(--color666666);
        color: var(--colorececec);
    }
</style>
<!-- tel carouse -->
<style>
    .tel {
        display: block;
        width: 100vw;
    }

    .tel .carousel {
        width: 100%;
        height: 100%;
    }

    .tel .carousel .carousel-inner {
        width: 100%;
        height: 100%;
    }

    .tel .carousel .carousel-inner .carousel-item {
        width: 100%;
        height: 100%;
    }

    .tel .carousel .carousel-inner .carousel-item img {
        width: 100%;
        height: 100%;
    }

    @media screen and (max-width: 768px) {
        .content {
            width: 100%;
            height: auto;
        }

        .pc {
            display: none;
        }
    }

    @media screen and (min-width: 769px) {
        .tel {
            display: none;
        }
    }
</style>

<!-- series_type -->
<style>
    .series_type {
        width: 100%;
        height: auto;
        margin-top: 2rem;
    }

    .series_type .row {
        justify-content: space-between;
        margin-top: 1rem;
    }

    .series_type .row .h1{
        font-weight: 900;
        color: var(--color333333);
    }

    .series_type .row .h3{
        font-weight: 600;
        color: var(--color333333);
    }

    .series_type .row .row{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .series_type .row .row .col-12{
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        width: auto;
    }
</style>

<?php
$css = ob_get_clean();
ob_start();
?>

<!-- pc carouse -->
<div class="pc">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <button class="carousel-control-prev up_next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/Carousel1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/Carousel2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/Carousel3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/Carousel4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>

        <button class="carousel-control-next up_next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- tel carouse -->
<div class="tel">
    <div class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/TelCarousel1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/TelCarousel2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/TelCarousel3.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/images/TelCarousel4.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</div>

<div class="series_type" id="home">
    <div class="row" v-for="(item, key) in series">
        <div class="col-12 text-center h1">
            {{ item.Name }}
        </div>
        <template v-for="(itemType, key) in type">
            <div class="col-6 col-md-4 text-center row" v-if="itemType.SeriesId == item.Id">
                <div class="col-12 h3">
                    {{ itemType.TypeName }}
                </div>
                <div class="col-12" style="color: var(--color999999)" @click="choose_series_type(item.Id, itemType.Id)">
                    <i class="fa-brands fa-redhat" v-if=" itemType.TypeName == '帽子' " style="font-size: 80px; width: auto; height: 80px;"></i>
                    <i class="fa-solid fa-shirt" v-if=" itemType.TypeName == '衣服' " style="font-size: 80px; width: auto; height: 100px;"></i>
                    <img src="/images/pants.png" alt="" class="img-fluid" v-if=" itemType.TypeName == '下身' " style="font-size: 100px; width: 100px; height: 100px;">
                    <i class="fa-solid fa-socks" v-if=" itemType.TypeName == '襪子' " style="font-size: 80px; width: auto; height: 80px;"></i>
                    <i class="fa-solid fa-shoe-prints" v-if=" itemType.TypeName == '鞋類' " style="font-size: 80px; width: auto; height: 80px;"></i>
                </div>
            </div>
        </template>
    </div>
</div>


<?php
$content = ob_get_clean();
ob_start();
?>

<script>
    function resizeElement() {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var $element = $('.up_next');

        if (windowHeight > windowWidth) {
            // 當高度大於寬度時，使用 10vh 和 10vw
            $element.css({
                'width': '10vw',
                'height': '10vw'
            });
        } else {
            // 當寬度大於高度時，使用 10vh 和 10vw
            $element.css({
                'width': '10vh',
                'height': '10vh'
            });
        }
    }

    // 初始載入時執行
    $(document).ready(resizeElement);
    // 當視口大小改變時動態更新
    $(window).resize(resizeElement);

    const home = {
        data() {
            return {
                series: JSON.parse(localStorage.getItem('series')),
                type: JSON.parse(localStorage.getItem('type')),
            }
        },
        methods:{
            choose_series_type(seriesId, typeId){
                window.location.href="/series_type.php?seriesId=" + seriesId + "&typeId=" + typeId;
            }
        }

    };
    Vue.createApp(home).mount("#home");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>