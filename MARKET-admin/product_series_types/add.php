<?php
ob_start();
?>
<style>
    .content .row {
        margin: 0;
    }

    .content .row .card {
        padding: 0;
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }
</style>
<?php
$css_style = ob_get_clean();
$title = "新增系列";
ob_start();
?>

<div class="row w-100" id="add">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">新增商品系列</div>
            </div>
        </div>
        <div class="card-body mt-3">
            <form action="" method="post" @submit.prevent="submitcheck">
                <table class="table table-border">
                    <tr class="row">
                        <td class="text-center align-middle col-4 fw-600">商品系列</td>
                        <td class="text-center align-middle col-8">
                            <input type="text" name="series" id="series" class="form-control w-100" placeholder="請輸入商品系列的名稱(1~10個字)" maxlength="10" required v-model="seriesValues" :class="{ 'is-valid' : series_flag , 'is-invalid' : !series_flag }">
                            <div class="invalid-feedback">不可空白或有已新增的商品系列</div>
                        </td>
                    </tr>
                    <tr class="row">
                        <td class="text-center align-middle fw-600 col-4">系列種類</td>
                        <td class="text-center align-middle col-8">
                            <div class="d-flex justify-content-around">
                                <div>
                                    <input type="checkbox" name="hat" id="hat" class="form-check-input" value="帽子" v-model="productType">
                                    <label for="hat">帽子</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="shirt" id="shirt" class="form-check-input" value="衣服" v-model="productType">
                                    <label for="shirt">衣服</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="pant" id="pant" class="form-check-input" value="下身" v-model="productType">
                                    <label for="pant">下身</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="socks" id="socks" class="form-check-input" value="襪子" v-model="productType">
                                    <label for="socks">襪子</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="shoes" id="shoes" class="form-check-input" value="鞋類" v-model="productType">
                                    <label for="shoes">鞋類</label>
                                </div>
                            </div>
                            <div class="invalid-feedback col-12" :class="{ 'd-none' : type_flag, 'd-block' : !type_flag}">請至少選擇一個種類</div>
                        </td>
                    </tr>
                </table>
                <div class="text-center align-middle">
                    <button type="button" class="btn btn-primary" @click="submitcheck()">送出</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>
<script>
    const add = {
        data() {
            return {
                seriesValues: '',
                productType: [],
                addseries: [],
                series_flag: false,
                type_flag: false,
            }
        },
        created() {
            eventBus.on('sendSeries', (data) => {
                this.addseries = data;
            });
        },
        methods: {
            // 送出資料
            submitcheck() {
                const vm = this;
                if (vm.series_flag && vm.type_flag) {
                    axios.post(apiurl + "addseries_producttype", {
                            seriesName: vm.seriesValues,
                            productType: vm.productType,
                        }, {
                            'Content-Type': 'application/json'
                        })
                        .then(response => {
                            console.log(response);
                            if (response.data.state == true) {
                                swal2(response.data.msg, "", "success", "確定", true, vm.review);
                            } else {
                                swal2("新增失敗", "", "error");
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else {
                    console.log("NOT");
                }
            },
            review() {
                window.location.href = "/home.php"
            }
        },
        watch: {
            // 監聽 seriesValues 有無改變
            seriesValues: function(item) {
                const vm = this;
                const seriesValues = item;
                // 檢查是否符合標準
                if (seriesValues.length == 0 && seriesValues.length <= 10) {
                    vm.series_flag = false;

                } else {
                    // 檢查有無重複命名相同系列
                    vm.series_flag = vm.addseries.every(function(item) {
                        if (item.Name == seriesValues) {
                            return false;
                        }
                        return true;
                    });
                }
            },
            // 監聽 productType 有無改變 checked
            productType: function(item) {
                const vm = this;

                if (vm.productType.length == 0 || vm.productType.length > 10) {
                    vm.type_flag = false;
                } else {
                    vm.type_flag = true;
                }
            }
        }
    }
    Vue.createApp(add).mount("#add");
</script>
<?php
$js_content = ob_get_clean();
include("../template.php");
?>