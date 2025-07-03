const apiurl = 'http://localhost:83/admin-api.php?action=';
const photourl = 'http://localhost:82/';

$(document).ready(function () {
    checkLogin();
    var navheight = $("#adminnav .main-header").outerHeight();
    $("#adminnav").height(navheight);
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
                activeClickNumber: null,
                activeClickNumberType: null,
                series: [],
                producttype: [],
                nowpage: null,
            }
        },
        created() {
            const vm = this;
            eventBus.emit('sendSeries', this.series);
            eventBus.emit('sendProducttype', this.producttype);

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

            const urlparams = new URLSearchParams(window.location.search);
            vm.activeClickNumber = urlparams.get('seriesId') ?? null;
            vm.nowpage = urlparams.get('seriesId') ?? null;
            vm.activeClickNumberType = urlparams.get('producttypeId') ?? null;

        },
        mounted() {
            const vm = this;
            this.$nextTick(() => {
                setTimeout(() => {
                    vm.setClickNumber(vm.activeClickNumber);
                }, 500);
            });
        },
        methods: {
            setClickNumber(number) {
                const vm = this;
                // 移除所有 menu-open & 最大高度設定 0 px
                $(".side-treeview").removeClass("menu-open").css("max-height", "0");
                // 檢查點擊的位置
                const tree = vm.$refs['treeview' + number];
                if (tree && tree.length > 0) {
                    const treeview = tree[0];
                    // 設定為 seriesId
                    vm.activeClickNumber = number;
                    // 設定li的高為內容的高
                    const scrollHeight = treeview.scrollHeight;
                    treeview.style.maxHeight = scrollHeight + 'px';
                } else {
                    console.log("false");
                }
            },
            setTypeNameClickNumber(number) {
                const vm = this;
                // 點擊的直接改
                vm.activeClickNumberType = number;
            },
        }
    }
    Vue.createApp(App).mount('#sidebar');
});

function checkLogin() {
    var data = {};
    data['keyA'] = getCookie('keyA');
    data['keyB'] = getCookie('keyB');
    $.ajax({
        type: "POST",
        url: apiurl + "checkKey",
        dataType: "json",
        data: JSON.stringify(data),
        success: function (data) {
            if (data.state === true) {
                // console.log(data);
                if (window.location.pathname.endsWith("/")) {
                    window.location.href = '/home.php';
                }
            } else {
                if (!window.location.pathname.endsWith("/")) {
                    window.location.href = "/";
                }
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
}

function logout() {
    deleteCookie("keyA");
    deleteCookie("keyB");
    window.location.href = "/";
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function deleteCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function swal2(stitle = '', stext = '', sicon = '', confirmButtonText = '', confirmButtonTF = false, ok_function = () => { }, allowousideclick = false) {
    Swal.fire({
        title: stitle,
        html: stext,
        icon: sicon,
        confirmButtonText: confirmButtonText,
        showConfirmButton: confirmButtonTF,
        allowOutsideClick: allowousideclick,
    }).then((result) => {
        if (result.isConfirmed) {
            ok_function();
        }
    });
}