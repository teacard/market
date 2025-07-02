// 暫時無用

$(document).ready(function () {
    console.log("sidebar.js");

    // sidebar-item的點擊事件
    $(".sidebar-item > .item-link").on("click", function () {

        // 指定當前side-treeview後的treeview
        const treeview = $(this).next(".side-treeview");
        // 指定當前item-link下的fa-solid
        const faSolid = $(this).find(".fa-angle-right");


        // 移除其他sidebar-item & item-link-treeview的active
        if (!$(this).hasClass("active")) {
            // 針對全部的
            // 移除其他 item-link-treeview 的 active
            $(".sidebar-item-treeview").removeClass("active");
            $(".item-link").removeClass("active");
            $(".item-link-treeview").removeClass("active");
        }
        // 對當前 class 給予 active
        $(this).toggleClass("active");

        if (treeview.hasClass("menu-open")) {
            // 移除當前 class 的 active
            $(this).removeClass("active");
            // 關閉open-menu , 並設定max-height為0
            treeview.removeClass("menu-open").css("max-height", "0");
            // fa-solid的旋轉效果
            faSolid.removeClass("fa-rotate-90").addClass("fa-RErotate-90");
        } else {
            // 獲取treeview的高度 , 並設定給menu-open的max-height
            const scrollHeight = treeview.prop("scrollHeight");
            // 開啟open-menu , 並設定max-height為scrollHeight
            treeview.addClass("menu-open").css("max-height", scrollHeight + "px");
            // fa-solid的旋轉效果
            faSolid.addClass("fa-rotate-90").removeClass("fa-RErotate-90");

        }
    });

    // // item-link-treeview的點擊事件
    $(".side-treeview > .sidebar-item-treeview").on("click", function () {
        // 移除其他 item-link-treeview 的 active
        $(".sidebar-item-treeview").removeClass("active");

        // 移除所有 item-link 的 active
        $(".item-link").removeClass("active");
        // 對當前 class 的父級的上面一個元素給予 active
        $(this).parent().prev().toggleClass("active");
        // 對當前 class 給予 active
        $(this).toggleClass("active");
    });
});