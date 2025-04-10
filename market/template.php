<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ($title) ?></title>
</head>
<!-- basic.css -->
<link rel="stylesheet" href="/css/basic.css">
<!-- bootstrap -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<!-- 引入 Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- google font -->
<link rel="stylesheet" href="/css/css2.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<!-- body grid -->
<style>
    body {
        margin: 0;
        height: auto;
        display: grid;
        grid-template-rows: auto 1fr auto;
        /* 上中下 */
        grid-template-columns: 1fr;
        /* 單欄 */
        background-color: var(--colorececec);
    }

    .content {
        height: auto;
        width: 80%;
    }
</style>

<!-- navbar -->
<style>
    .navbar {
        width: 100%;
        height: 100px;
        padding: 0;
    }

    .container-fluid {
        margin-right: 10vw;
        margin-left: 10vw;
        padding: 0;
        height: 100%;
    }

    .bg-light {
        background-color: var(--colorFDBF00) !important;
    }

    .navbar .container-fluid .menu {
        display: none;
    }

    .navbar-light .navbar-brand {
        padding: 0px;
        margin: 0px;
        height: 100%;
    }

    .navbar-light .navbar-brand img {
        height: 80%;
    }

    .navbar-expand-lg .navbar-collapse {
        display: flex;
        justify-content: flex-end;
        flex-basis: auto;
        font-size: 2rem;
        flex-grow: 0;
        height: 50%;
    }

    .navbar-expand-lg .navbar-collapse * {
        margin-left: 0;
        font-size: 2rem;
    }

    .navbar-expand-lg .navbar-collapse a {
        text-decoration: none;
        color: var(--color333333);
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .navbar-expand-lg .navbar-collapse a i {
        margin: 0;
    }

    .navbar-expand-lg .navbar-collapse form {
        position: relative;
        height: 50px;
        width: 200px;
    }

    .navbar-expand-lg .navbar-collapse form input {
        position: absolute;
        left: 0;
        z-index: 10;
        padding: 0px;
        height: 100%;
        margin: 0px;
        color: var(--color333333);
        border-radius: 50px;
        font-size: 1.25rem;
    }

    .navbar-expand-lg .navbar-collapse form input:focus {
        box-shadow: none;
    }

    .navbar-expand-lg .navbar-collapse form a {
        text-decoration: none;
        color: var(--color333333);
        height: 100%;
        width: 50px;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 100;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .navbar-expand-lg .navbar-collapse form a i {
        margin: 0;
        font-size: 1.8rem;
    }

    .navbar-expand-lg .navbar-collapse form button {
        display: none;
    }

    .navbar-expand-lg .navbar-collapse .person {
        padding: 0;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 1rem;
        margin-right: 1rem;
    }

    @media screen and (max-width:768px) {
        .navbar {
            width: 100%;
            height: 50px;
            padding: 0;
        }

        .container-fluid {
            width: 100%;
            height: 100%;
            margin-right: 10px;
            margin-left: 10px;
            flex-wrap: nowrap !important;
        }

        .navbar .container-fluid .menu {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 80%;
            padding: 0;
        }

        .navbar .container-fluid button i {
            color: var(--color333333);
            font-size: 1.5rem;
        }

        .navbar-light .navbar-brand {
            height: 80%;
            position: absolute;
            left: 40%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-light .navbar-brand img {
            height: 35px;
        }

        .navbar .container-fluid .navbar-collapse form {
            width: 2rem;
            height: 2rem;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .navbar .container-fluid .navbar-collapse form input {
            display: none;
        }

        .navbar .container-fluid .navbar-collapse form a {
            display: none;
        }

        .navbar .container-fluid .navbar-collapse form button {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar .container-fluid .navbar-collapse form button i {
            margin: 0;
            font-size: 1.5rem;
        }

        .navbar-expand-lg .navbar-collapse .person {
            padding: 0;
            margin: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-expand-lg .navbar-collapse .person i {
            padding: 0;
            margin: 0;
        }

        .navbar-expand-lg .navbar-collapse .shopcart {
            padding: 0;
            margin: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-expand-lg .navbar-collapse .shopcart i {
            padding: 0;
            margin: 0;
            font-size: 1.5rem;
        }
    }
</style>

<!-- nav ul li -->
<style>
    .menu-div {
        width: 100vw;
        height: 100vh;
        text-decoration: none;
        color: var(--color333333);
        background-color: var(--colorececec);
        position: fixed;
        top: 50px;
        left: 0;
        /* 固定在左側 */
        transform: translateX(-100%);
        transition: transform 1s ease;
        /* 平滑動畫 */
    }

    .menu-div.show {
        transform: translateX(0);
        /* 顯示 */
    }

    .menu-div div {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 1rem;
        cursor: pointer;
        margin-top: 1rem;
    }

    .menu-div div i {
        transition: transform 0.5s ease;
    }

    .menu-div div p {
        margin: 0;
    }

    .menu-div .menu-ul {
        list-style: none;
        overflow: hidden;
        transition: max-height 0.5s ease;
        max-height: 0px;
    }

    .menu-ul.show {
        max-height: 200px;
        /* 設定一個足夠大的值，適應內容 */
    }

    .menu-div .menu-ul .menu-li:first-child {
        margin-top: 0.5rem;
    }

    .menu-div .menu-ul .menu-li:not(:first-child) {
        margin-top: 1rem;
    }
</style>

<!-- search -->
<style>
    .search-div {
        width: 100vw;
        height: 100vh;
        text-decoration: none;
        color: var(--color333333);
        background-color: var(--colorececec);
        position: fixed;
        top: 0;
        left: 0;
        /* 固定在左側 */
        transform: translateX(100%);
        transition: transform 1s ease;
        /* 平滑動畫 */
    }

    .search-div.show {
        transform: translateX(0);
        /* 顯示 */
    }

    .search-div .content {
        width: 100%;
        height: 50px;
        margin-top: 1rem;
        display: flex;
        justify-content: space-around;
        align-items: start;
    }

    .search-div .icon {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
    }

    .search-div .search-input {
        width: 80%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .search-div .search-input form {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .search-div .search-input .form-control {
        background-color: transparent;
        border: none;
        border-bottom: var(--color000000) 1px solid;
        border-radius: 0;
    }

    .search-div .search-input button {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
    }
</style>

<!-- user pc -->
<style>
    .pc-person-ul {
        width: 15%;
        height: auto;
        position: absolute;
        background-color: var(--colorececec);
        display: none;
        z-index: 1000;
        border-radius: 10px 0px 10px 10px;
    }

    .pc-person-ul.show {
        display: block;
    }

    .pc-person-ul a {
        display: block;
        text-decoration: none;
        color: var(--color333333);
        text-align: center;
        margin-top: 0.5rem;
    }

    .pc-person-ul a:last-child {
        margin-bottom: 0.5rem;
    }

    .pc-person-ul a p{
        margin: 0;
    }
</style>

<!-- user tel-->
<style>
    .user-div {
        width: 100%;
        height: 50px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        position: absolute;
        left: 0;
        top: 0;
        /* 固定在左側 */
        transform: translateY(-100%);
        transition: transform 1s ease;
        background-color: var(--colorececec);
    }

    .user-div.show {
        transform: translateY(0);
        /* 顯示 */
    }

    .user-div a {
        text-decoration: none;
        color: var(--color333333);
    }

    .user-div button i {
        color: var(--color333333);
    }

    .user-div * p {
        margin: 0;
    }
</style>

<?php echo ($css) ?>

<!-- footer -->
<style>
    .footer-tel {
        display: none;
    }

    .end-footer {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 324px;
        background-color: var(--colorececec);
        margin-top: 2rem;
    }

    .footer {
        width: 100%;
        height: 90%;
        display: flex;
        justify-content: space-around;
        align-items: start;
    }

    .footer .watch-us {
        width: 150px;
        height: 304px;
        display: flex;
        flex-direction: column;
        justify-content: start;
        align-items: start;
        margin-top: 1rem;
    }

    .footer .about-us,
    .support-us {
        height: 304px;
        width: 300px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: start;
        margin-top: 1rem;
    }

    .footer>* .title {
        width: 100%;
        text-align: center;
        font-weight: 700;
        font-size: 1.5em;
        flex: 0 1 auto;
    }

    .footer .watch-us .content {
        width: 100%;
        flex: 1 1 auto;
        display: flex;
        justify-content: space-around;
        align-items: start;
        flex-direction: column;
    }

    .footer .watch-us .content>* {
        width: 100%;
    }

    .footer .watch-us .content>* a {
        width: 100%;
        text-decoration: none;
        display: flex;
        align-items: center;
        font-size: 1rem;
        font-weight: 600;
    }

    .footer .watch-us .content>* i {
        margin-right: 1rem;
        font-size: 1.25rem;
    }

    .footer .watch-us .content>* p {
        width: auto;
        color: var(--color666666);
        margin: 0;
    }

    .footer>*>* .content {
        width: 100%;
        display: flex;
        justify-content: space-around;
        align-items: start;
        flex-direction: column;
        flex: 1 1 auto;
    }

    .footer .about-us>*,
    .support-us>* {
        width: 50%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .footer>*>* .content>* a {
        text-decoration: none;
        color: var(--color666666);
        font-weight: 600;
    }

    .footer .support-us {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
    }

    .footer .support-us .can-pay,
    .can-carry {
        width: 50%;
        height: 100%;
    }

    .footer>*>* .content>* {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cover-by {
        height: 10%;
        display: flex;
        justify-content: space-around;
        align-items: center;
        font-size: 0.75rem;
        color: var(--color666666);
    }

    .cover-by>* {
        width: auto;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cover-by>* p {
        margin: 0;
    }

    .btn:focus {
        box-shadow: none;
    }

    @media screen and (max-width: 768px) {
        .end-footer {
            display: none;
        }

        .footer-tel {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            height: 150px;
            background-color: var(--colorFDBF00);
        }

        .footer-tel>* {
            width: 100%;
            height: 50px;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .footer-tel>hr {
            width: calc(100% - 0.5rem);
            height: 1px;
            margin: 0 0.5rem;
            opacity: 1;
            background-color: var(--color333333);
        }

        .footer-tel .about-us hr {
            border: none;
            /* 移除預設的邊框 */
            width: 1px;
            /* 讓 hr 變細 */
            height: 50%;
            /* 設定適當的高度 */
            background-color: var(--color333333);
            opacity: 1;
            /* 設定黑色背景來當作線 */
        }

        .footer-tel .about-us>* a {
            text-decoration: none;
        }

        .footer-tel .about-us>* p {
            margin: 0;
            color: var(--color333333);
            font-size: 1rem;
        }

        .footer-tel .watch-us .title{
            width: 70%;
            text-align: center;
        }

        .footer-tel .watch-us .title p {
            margin: 0;
        }

        .footer-tel .watch-us .content {
            height: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-tel .watch-us .content>*:not(:last-child) {
            margin-right: 0.5rem;
        }

        .footer-tel .watch-us .content>* a {
            text-decoration: none;
            color: var(--color333333);
        }

        .footer-tel .cover-by {
            justify-content: flex-end;
            margin-right: 0.5rem;
            color: var(--color333333);
        }
    }
</style>

<body>
    <template id="menu" style="display: block;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid ">
                <button type="button" class="btn menu" @click="showmenu = !showmenu"><i class="fa-solid fa-bars"></i></button>
                <a class="navbar-brand fw-900" href="/home.php">
                    <img src="/images/MARKET_LOGO.png" alt="" class="img-fluid">
                </a>
                <div class="collapse navbar-collapse">
                    <form class="d-flex">
                        <input class="form-control" type="text" placeholder="搜尋商品">
                        <a href="/search.php">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <button type="button" class="btn" @click="showsearch = !showsearch">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                    <button type="button" class="btn person d-flex d-md-none" @click="showperson = !showperson">
                        <i class="fa-regular fa-user"></i>
                    </button>
                    <button type="button" id="personbutton" class="btn person d-none d-md-flex">
                        <i class="fa-regular fa-user"></i>
                    </button>
                    <a href="/my-order.php" class="shopcart">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </div>
        </nav>

        <div id="pc-user-div" class="pc-person-ul" :class="{ show: showpersonul }">
            <a href="/my-order.php" class="search-order">
                <p>訂單查詢</p>
            </a>
            <a href="/my-discount.php" class="my-discount">
                <p>我的優惠券</p>
            </a>
            <a href="/index.php" class="login-in-out" v-if="!login_in_out">
                <p>登入/註冊</p>
            </a>
            <a href="#" class="login-in-out" v-if="login_in_out" @click="vuelogout">
                <p>登出</p>
            </a>
        </div>

        <div class="menu-div" :class="{ show: showmenu }">
            <template v-for="(items, keys) in series_type.series">
                <div @click="toggleMenu(keys)">
                    <p>{{ items.Name }}</p><i class="fa-solid fa-chevron-right" :class="{ 'fa-rotate-90': isOpen(keys)}"></i>
                </div>
                <ul class="menu-ul" :class="{ 'show' : isOpen(keys) }">
                    <template v-for="(itemt, keyt) in series_type.type">
                        <li class="menu-li" v-if="itemt.SeriesId == items.Id">{{ itemt.TypeName }}</li>
                    </template>
                </ul>
            </template>
        </div>

        <div class="search-div" :class="{ show: showsearch }">
            <div class="content">
                <div class="icon" @click="showsearch = !showsearch">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>

                <div class="search-input row">
                    <form action="" method="post">
                        <div class="col-8">
                            <input type="search" name="" id="" class="form-control" placeholder="搜尋產品">
                        </div>
                        <button type="submit" class="btn col-4"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="user-div" :class="{ show: showperson }">
            <button class="btn left-icon" @click="showperson = !showperson">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <a href="/my-order.php" class="search-order">
                <p>訂單查詢</p>
            </a>
            <a href="/my-discount.php" class="my-discount">
                <p>我的優惠券</p>
            </a>
            <a href="/index.php" class="login-in-out" v-if="!login_in_out">
                <p>登入/註冊</p>
            </a>
            <a href="#" class="login-in-out" v-if="login_in_out" @click="vuelogout">
                <p>登出</p>
            </a>
        </div>
    </template>

    <div class="content mx-auto">
        <?php echo ($content) ?>
    </div>
    <!-- pc footer -->
    <div class="end-footer">
        <div class="footer">
            <div class="watch-us">
                <div class="title">關注我們</div>
                <div class="content">
                    <div class="fb">
                        <a href="#"><i class="fa-brands fa-facebook" style="color: #1877F2;"></i>
                            <p>Facebook</p>
                        </a>
                    </div>
                    <div class="ig">
                        <a href="#"><i class="fa-brands fa-square-instagram" style="color: #DC3175"></i>
                            <p>Instagram</p>
                        </a>
                    </div>
                    <div class="line">
                        <a href="#"><i class="fa-brands fa-line" style="color: #06C755"></i>
                            <p>Line</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="about-us">
                <div class="online-service">
                    <div class="title">客服中心</div>
                    <div class="content">
                        <div class="help-center"><a href="#">幫助中心</a></div>
                        <div class="phone"><a href="#">連絡電話</a></div>
                        <div class="merber-book"><a href="#">會員權益說明</a></div>
                    </div>
                </div>
                <div class="about-market">
                    <div class="title">關於買齊</div>
                    <div class="content">
                        <div class="help-center"><a href="#">品牌故事</a></div>
                        <div class="phone"><a href="#">門市資訊</a></div>
                        <div class="merber-book"><a href="#">隱私權政策</a></div>
                    </div>
                </div>
            </div>
            <div class="support-us">
                <div class="can-pay">
                    <div class="title">付款方式</div>
                    <div class="content">
                        <div class="visa"><img src="/images/VisaIcon.png" alt=""></div>
                        <div class="jcb"><img src="/images/JcbIcon.png" alt=""></div>
                        <div class="master-card"><img src="/images/MasterCardIcon.png" alt=""></div>
                    </div>
                </div>
                <div class="can-carry">
                    <div class="title">合作物流</div>
                    <div class="content">
                        <div class="hct"><img src="/images/HctIcon.png" alt=""></div>
                        <div class="7-11"><img src="/images/711Icon.png" alt=""></div>
                        <div class="familymart"><img src="/images/FamilyMartIcon.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cover-by">
            <div class="do-by">
                <p>© 2025 by 陳佳胤</p>
            </div>
            <div class="suggest-for">
                <p>本站最佳瀏覽環境請使用Google Chrome、Firefox或Edge以上版本</p>
            </div>
        </div>
    </div>
    <!-- tel footer -->
    <div class="footer-tel">
        <div class="about-us">
            <div class="market-story">
                <a href="#">
                    <p>品牌故事</p>
                </a>
            </div>
            <hr>
            <div class="onsale-data">
                <a href="#">
                    <p>門市資訊</p>
                </a>
            </div>
            <hr>
            <div class="help-center">
                <a href="#">
                    <p>幫助中心</p>
                </a>
            </div>
        </div>
        <hr>
        <div class="watch-us">
            <div class="title">
                <p>關注我們的</p>
            </div>
            <div class="content">
                <div class="fb"><a href="#"><i class="fa-brands fa-facebook"></i></a></div>
                <div class="ig"><a href="#"><i class="fa-brands fa-square-instagram"></i></a></div>
                <div class="line"><a href="#"><i class="fa-brands fa-line"></i></a></div>
            </div>
        </div>
        <hr>
        <div class="cover-by">
            <div class="do-by">
                <p>© 2025 by 陳佳胤</p>
            </div>
        </div>
    </div>
</body>
<!-- bootstrap -->
<script src="/js/bootstrap.bundle.min.js"></script>
<!-- jquery -->
<script src="/js/jquery-3.7.1.min.js"></script>
<!-- vue -->
<script src="/js/vue.global.js"></script>
<!-- sweetalert2 -->
<script src="/js/sweetalert2@11.js"></script>
<!-- axios -->
<script src="/js/axios.min.js"></script>
<!-- basic.js -->
<script src="/js/basic.js"></script>
<script>
    $(document).ready(function() {
        $("#personbutton").mouseenter(function() {
            var button = $(this);
            var menu = $("#pc-user-div");

            // 取得按鈕的位置與大小
            var buttonOffset = button.offset();
            var buttonWidth = button.outerWidth();
            var buttonHeight = button.outerHeight();
            var menuWidth = menu.outerWidth(); // 取得選單寬度
            // 設定 `ul` 的位置
            menu.css({
                top: buttonOffset.top + buttonHeight + "px", // 放在按鈕正下方
                left: buttonOffset.left + buttonWidth - menuWidth + "px", // 水平居中
                display: "block",
            });

            // 當滑鼠離開 `button` 或 `ul` 時，隱藏選單
            $("#personbutton, #pc-user-div").mouseleave(function() {
                if (!$("#personbutton:hover").length && !$("#pc-user-div:hover").length) {
                    $("#pc-user-div").hide();
                }
            });
        });
    });
    const App = {
        data() {
            return {
                series_type: [],
                openMenus: [], // 用來存儲開啟的 menu 索引
                showmenu: false,
                showsearch: false,
                showperson: false,
                login_in_out: false,
            }
        },
        created() {
            const vm = this;
            axios.get(apiurl + "getseries_type")
                .then(response => {
                    // console.log(response.data);
                    if (response.data.state == true) {
                        vm.series_type = response.data.data;
                        localStorage.setItem("series", JSON.stringify(response.data.data.series));
                        localStorage.setItem("type", JSON.stringify(response.data.data.type));
                    } else {
                        console.log("獲取失敗");
                    }
                })
                .catch(error => {
                    console.log(error);
                });

            axios.post(apiurl + "checkkey", {
                    keyA: getCookie('keyA'),
                    keyB: getCookie('keyB'),
                    Id: getCookie('id'),
                })
                .then(response => {
                    // console.log(response.data);
                    if (response.data.state == true) {
                        setCookie('keyA', response.data.data.keyA);
                        setCookie('keyB', response.data.data.keyB);
                        vm.login_in_out = true;
                    } else {
                        vm.login_in_out = false;
                    }
                })
                .catch(error => {
                    console.log(error);
                })

        },
        methods: {
            // 切換菜單的顯示狀態
            toggleMenu(index) {
                const vm = this;
                const menuIndex = vm.openMenus.indexOf(index);
                if (menuIndex === -1) {
                    vm.openMenus.push(index); // 顯示菜單
                } else {
                    vm.openMenus.splice(menuIndex, 1); // 隱藏菜單
                }
            },
            // 檢查菜單是否開啟
            isOpen(index) {
                const vm = this;
                return vm.openMenus.includes(index);
            },
            // 根據菜單的開啟狀態設置高度
            getMenuHeight(index) {
                const vm = this;
                return vm.isOpen(index) ? 'auto' : '0px'; // 展開時高度自適應，隱藏時高度為 0
            },
            vuelogout() {
                logout();
            }
        }
    }
    Vue.createApp(App).mount("#menu");
</script>

<?php echo ($script) ?>

</html>