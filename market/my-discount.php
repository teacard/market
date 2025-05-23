<?php
$title = "優惠券";
ob_start();
?>

<style>
    .discount {
        width: 100%;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .discount .row .col-6 {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .discount .row .col-6:nth-child(n+3) {
        margin-top: 1rem;
    }

    .discount .row .col-6 .freesend,
    .coupons {
        display: inline-flex;
        border-radius: 5px;
        background-color: var(--color999999);
    }
</style>

<?php
$css = ob_get_clean();
ob_start();
?>
<div class="discount" id="discount">
    <div class="row">
        <div class="col-6" v-for="(ditem , dkey) in discount" :key="dkey" @click="choose(ditem.DiscountValue)">
            <div v-if="ditem.DiscountType == 0" class="freesend">
                <div class="pic">
                    <img src="/images/freesend.png" alt="" class="img-fluid">
                </div>
                <div class="text d-flex flex-column justify-content-around align-items-center">
                    <div class="discount-title">全館免運券</div>
                    使用期限：{{ ditem.EndDate }}
                </div>
            </div>
            <div v-if="ditem.DiscountType == 1" class="coupons">
                <div class="pic">
                    <img src="/images/dicounts.png" alt="" class="img-fluid">
                </div>
                <div class="text d-flex flex-column justify-content-around align-items-center">
                    <div class="discount-title">{{ ditem.DiscountCoin/10 }}折價券</div>
                    使用期限：{{ ditem.EndDate }}
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
ob_start();
?>
<script>
    const discount = {
        data() {
            return {
                discount: [],
            }
        },
        created() {
            const vm = this;
            axios.get(apiurl + "getdiscount", {
                    params: {
                        keyA: getCookie("keyA"),
                        keyB: getCookie("keyB"),
                    }
                })
                .then(response => {
                    // console.log(response.data); // 拿到回傳資料
                    vm.discount = response.data.data; // 將資料存入 discount
                })
                .catch(error => {
                    console.error(error); // 錯誤處理
                });
        },
        methods: {
            choose(dvalue) {
                const vm = this;
                const urlparams = new URLSearchParams(window.location.search);
                let rollback = urlparams.get("url");
                if (rollback != null) {
                    // console.log(rollback);
                    swal.fire({
                        title: "確認使用優惠券",
                        text: "是否使用此優惠券？",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "確認",
                        cancelButtonText: "取消",
                    }).then((result) => {
                        if (result.isConfirmed == true) {
                            axios.post(rollback, {
                                    keyA: getCookie("keyA"),
                                    keyB: getCookie("keyB"),
                                    discount: dvalue,
                                })
                                .then(response => {
                                    if (response.data.state === true) {
                                        const data = response.data.data;
                                        if (window.opener) {
                                            console.log(data);
                                            window.opener.postMessage(data, "http://13.112.220.63/orderdata.php");
                                            window.close();
                                        } else {
                                            document.body.innerText = "找不到主視窗";
                                        }
                                    } else {
                                        alert("優惠券使用失敗，請重新選擇");
                                    }
                                })
                                .catch(error => {
                                    console.error(error); // 錯誤處理
                                });
                        }
                    });
                }
            },
        }
    }
    Vue.createApp(discount).mount("#discount");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>