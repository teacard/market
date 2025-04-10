<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARKET-後台系統</title>
    <!-- support light, dark mode -->
    <meta name="color-scheme" content="light dark">
</head>
<!-- bootstrap -->
<link rel="stylesheet" href="/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<!-- google fonts -->
<link rel="stylesheet" href="/css/css2.css">
<!-- basic -->
<link rel="stylesheet" href="/css/basic.css">
<style>
    .wrapper {
        position: relative;
        display: grid;
        grid-template-areas:
            "header header"
            "sidebar content";
        grid-template-rows: auto 1fr;
        grid-template-columns: auto minmax(100%, max-content);
        ;
        min-height: 100vh;
    }

    .header {
        grid-area: header;
    }

    .sidebar {
        grid-area: sidebar;
    }

    .content {
        margin-left: 0px;
        grid-area: content;
        transition: margin-left 0.25s linear;
    }

    @media screen and (min-width: 576px) {
        .content.shifted {
            margin-left: 300px;
        }
    }
</style>
<?php echo $css_style ?? ''; ?>

<body>
    <div class="wrapper">
        <nav id="adminnav" class="header">
            <nav class="main-header navbar navbar-expand navbar-light bg-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button" id="sidemenu">
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-sm-block">
                        <a href="#" class="nav-link">前台首頁</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">
                        <a href="/home.php" class="nav-link">後台首頁</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link">XXX_使用者</a>
                    </li>
                    <button type="button" class="btn btn-primary" id="logout" onclick="logout()">登出</button>
                </ul>
            </nav>
        </nav>
        <aside id="sidebar" class="active sidebar">
            <aside class="main-sidebar sidebar-light">
                <div class="logo-container">
                    <a href="#" class="brand-link">
                        <img src="/images/logo_icon.png" alt="MARKET Logo" class="" style="height: 1.5rem;">
                        <span class="fw-900"><?php echo ($title ?? '一個bug是bug一堆bug能work') ?></span>
                    </a>
                </div>
                <div class="sidebar" data-accordion="false">
                    <nav>
                        <ul class="sidebar-menu">
                            <li class="sidebar-list fw-600">
                                商品系列
                            </li>
                            <li class="sidebar-list">
                                <a href="/product_series_types/add.php" class="btn btn-success">新增</a>
                                <a href="/product_series_types/edit.php" class="btn btn-warning ms-2 me-2">修改</a>
                                <a href="/product_series_types/delete.php" class="btn btn-danger">刪除</a>
                            </li>
                            <li class="sidebar-item" v-for="(item, key) in series">
                                <a href="javascript:;" class="item-link" :class="{ 'active' : activeClickNumber == item.Id}"
                                    @click="setClickNumber(item.Id)">
                                    <i class="fa-brands fa-product-hunt"></i>
                                    <p>{{ item.Name }}</p>
                                    <i class="fa-solid fa-angle-right" :class="{ 'fa-rotate-90' : activeClickNumber == item.Id}"></i>
                                </a>
                                <ul class="side-treeview" :class="{ 'menu-open' : activeClickNumber == item.Id}" :ref="'treeview' + item.Id">
                                    <template v-for="(types, typekey) in producttype">
                                        <li class="sidebar-item-treeview" v-if="types.SeriesId == item.Id">
                                            <a :href="'/product/list.php?seriesId=' + types.SeriesId + '&producttypeId=' + types.Id + '&seriesname=' + item.Name + '&typename=' + types.TypeName" class="item-link-treeview" :class="{ 'active' : activeClickNumberType == types.Id}"
                                                @click="setTypeNameClickNumber(types.Id)">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>{{ types.TypeName }}</p>
                                            </a>
                                        </li>
                                    </template>
                                </ul>
                            </li>

                            <li class="sidebar-list fw-600">訂單</li>
                            <li class="sidebar-item">
                                <a href="javascript:;" class="item-link">
                                    <i class="fa-solid fa-clipboard-list"></i>
                                    <p>訂單詳情</p>
                                </a>
                            </li>
                            <li class="sidebar-list fw-600">折扣</li>
                            <li class="sidebar-item">
                                <a href="javascript:;" class="item-link">
                                    <i class="fa-solid fa-percent"></i>
                                    <p>折扣詳情</p>
                                </a>
                            </li>
                            <li class="sidebar-list fw-600">會員</li>
                            <li class="sidebar-item">
                                <a href="javascript:;" class="item-link">
                                    <i class="fa-solid fa-user"></i>
                                    <p>會員詳情</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
        </aside>
        <div class="content">
            <?php echo $content ?? ''; ?>
        </div>

    </div>
</body>

<!-- bootstrap -->
<script src="/js/bootstrap.bundle.min.js"></script>
<!-- jeuary -->
<script src="/js/jquery-3.7.1.min.js"></script>
<!-- mitt vue.js -->
<script src="/js/mitt.umd.js"></script>
<script src="/js/vue.global.js"></script>
<!-- axios -->
<script src="/js/axios.min.js"></script>
<!-- basic.js -->
<script src="/js/basic.js"></script>
<!-- Sweetalert2 -->
<script src="/js/sweetalert2@11.js"></script>
<script>
    const eventBus = mitt();
    $(document).ready(function() {
        if ($("#sidebar").hasClass("active")) {
            $(".content").addClass("shifted");
        } else {
            $(".content").removeClass("shifted");
        }
    });
</script>
<?php echo $js_content ?? '' ?>

</html>