$(document).ready(function () {
    // nav id="adminnav"
    $("#adminnav").load("/nav.html", function () {
        var navheight = $("#adminnav .main-header").outerHeight();
        $("#adminnav").height(navheight);
        // slidebar id="slidebar"
        $("#sidebar").load("/sidebar.html", function () {
            // main-sidebar的點擊事件
            $("#sidemenu").on("click", function () {
                $("#sidebar").toggleClass("active");
                $(".content").toggleClass("shifted");
            });

            // 點擊 sidebar & sidemenu 以外的地方時關閉 active
            $(document).on("click", function (e) {
                if (!$(e.target).closest("#sidebar, #sidemenu").length) {
                    $("#sidebar").removeClass("active");
                    $(".content").removeClass("shifted");
                }
            });

            const App = {
                data() {
                    return {
                        title: '系列商品',
                        activeClickNumber: null,
                        activeClickNumberType: null,
                        series: [],
                        producttype: [],
                    }
                },
                created() {
                    const vm = this;
                    // 取得系列名稱
                    axios.get(apiurl + "productseries")
                        .then(response => {
                            // 確認 API 連接成功
                            if (response.data.state === true) {
                                // 跑 producttype 資料迴圈
                                response.data.data.forEach(function (item) {
                                    // 填入 series 內
                                    vm.series.push(item);
                                });
                            } else {
                                console.log(response.data.msg);
                            }
                        })
                        .catch(error => {
                            console.log('請求失敗', error);
                        })
                        .finally(function () { });

                    // 取得系列的種類名稱
                    axios.get(apiurl + "producttype")
                        .then(response => {
                            // 確認 API 連接成功
                            if (response.data.state === true) {
                                // console.log(response.data.data);
                                // 跑 producttype 資料迴圈
                                response.data.data.forEach(function (item) {
                                    // 填入 producttype 內
                                    vm.producttype.push(item);
                                });
                            } else {
                                console.log(response.data.msg);
                            }
                        })
                        .catch(error => {
                            console.log("請求失敗", error);
                        })
                        .finally(function () { });
                },
                methods: {
                    setClickNumber(number) {
                        const vm = this;
                        // 移除所有 menu-open & 最大高度設定 0 px
                        $(".side-treeview").removeClass("menu-open").css("max-height", "0");
                        // 檢查點擊的位置
                        const treeview = vm.$refs['treeview' + number][0];
                        // 如果點擊的跟打開的一樣
                        if (vm.activeClickNumber === number) {
                            // 設定為空,預備下次點擊
                            vm.activeClickNumber = null;
                            treeview.style.maxHeight = '0px';
                        } else {
                            // 設定為 seriesId
                            vm.activeClickNumber = number;
                            // 設定li的高為內容的高
                            const scrollHeight = treeview.scrollHeight;
                            treeview.style.maxHeight = scrollHeight + 'px';
                        }

                    },
                    setTypeNameClickNumber(number) {
                        const vm = this;
                        // 點擊的直接改
                        vm.activeClickNumberType = number;
                    }
                },
            }
            Vue.createApp(App).mount('#sidebar');

        });
    });
});

function logout() {
    deleteCookie("keyA");
    deleteCookie("keyB");
    window.location.href = "/";
}