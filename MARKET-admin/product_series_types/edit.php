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
ob_start();
$title = '修改系列';
?>

<div class="row w-100" id="edit">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">修改商品系列</div>
            </div>
        </div>
        <div class="card-body mt-3">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <select name="chooseSeries" id="" class="form-control text-center" v-model="chooseseries">
                        <option value="" disabled selected>---請選擇要修改的系列---</option>
                        <option :value="item.Name" v-for="(item) in seriesdata">
                            {{ item.Name }}
                        </option>
                    </select>
                </div>
                <div v-if="chooseseries != ''" class="col-12 col-md-7">
                    <div class="mt-3 row">
                        <div class="col-12 h4 text-center">商品系列內容
                        </div>
                        <div class="col-12 row text-center">
                            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center fw-600">商品系列</div>
                            <div class="col-12 col-md-8">
                                <input type="text" name="editseries" id="" class="form-control text-center" v-model="inputseries">
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-around">
                            <div v-for="(item) in allcheckedptoducttype">
                                <template v-for="(notcheckitem) in notcheckproducttype">
                                    <!-- 其他可勾選的產品類型 -->
                                    <div v-if="notcheckitem == item">
                                        <input type="checkbox" :name="notcheckitem" :id="notcheckitem" class="form-check-input" :value="notcheckitem">
                                        <label :for="notcheckitem">{{ notcheckitem }}</label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <button type="button" class="btn btn-primary" @click.prevent="submit_data()">送出</button>
                    </div>
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
    const edit = {
        data() {
            return {
                seriesdata: [],
                producttype: [],
                chooseseries: '',
                chooseseriesid: '',
                inputseries: '',
                checkedproducttype: [], // 預設已勾選的產品類型
                allcheckedptoducttype: ["帽子", "衣服", "下身", "襪子", "鞋類"], // 所有可選產品類型
                notcheckproducttype: [], // 未勾選的產品類型
                series_flag: false,
                type_flag: false,
                checkNewProductType: [], // 存放勾選的產品類型
            }
        },
        created() {
            eventBus.on('sendSeries', (data) => {
                this.seriesdata = data;
            });
            eventBus.on('sendProducttype', (data) => {
                this.producttype = data;
            });
        },
        watch: {
            // 選擇系列改 input 的 val
            chooseseries(item) {
                const vm = this;
                vm.inputseries = item;
                vm.seriesdata.forEach(function(seriesitem) {
                    if (item == seriesitem.Name) {
                        vm.chooseseriesid = seriesitem.Id;
                    }
                });
                // 更新勾選和未勾選的產品類型
                vm.updateProductTypes();
            }
        },
        methods: {
            // 更新勾選和未勾選的產品類型
            updateProductTypes() {
                const vm = this;

                // 有勾選的 producttype 種類
                vm.checkedproducttype = [];
                vm.producttype.forEach(function(typeitem) {
                    if (typeitem.SeriesId == vm.chooseseriesid) {
                        vm.checkedproducttype.push(typeitem);
                    }
                });

                // 沒有勾選的 producttype 種類
                vm.notcheckproducttype = [];
                vm.allcheckedptoducttype.forEach(function(allitem) {
                    let notcheck_flag = false;
                    vm.checkedproducttype.forEach(function(checkitem) {
                        if (checkitem.TypeName == allitem) {
                            notcheck_flag = true;
                        }
                    });
                    if (!notcheck_flag) {
                        vm.notcheckproducttype.push(allitem);
                    }
                });
            },

            // 提交資料的處理
            submit_data() {
                console.log("DO");
                const vm = this;
                vm.series_flag = vm.seriesdata.every(function(item) {
                    if (item.Name == vm.inputseries && vm.inputseries != vm.chooseseries) {
                        return false;
                    }
                    return true;
                });
                vm.checkNewProductType = [];
                // 遍歷所有勾選的 input 元素
                document.querySelectorAll("input[type='checkbox']:checked").forEach(checkbox => {
                    vm.checkNewProductType.push(checkbox.value);
                });

                if (vm.checkNewProductType.length == 0) {
                    vm.type_flag = false;
                } else {
                    vm.type_flag = true;
                }
                // 送出資料
                if (vm.type_flag && vm.series_flag) {
                    console.log("DO HERE");
                    // 需要刪除的 producttype 種類
                    const needDeleteproducttype = vm.checkedproducttype.filter(item => !vm.checkNewProductType.includes(item.TypeName));
                    // 需要新增的 producttype 種類
                    const needAddproducttype = vm.notcheckproducttype.filter(item => vm.checkNewProductType.includes(item));

                    axios.post(apiurl + "updateseries_producttype", {
                            seriesId: vm.chooseseriesid,
                            seriesName: vm.inputseries,
                            AddproductType: needAddproducttype,
                            DeleteProductType: needDeleteproducttype,
                        }, {
                            'Content-Type': 'application/json'
                        })
                        .then(response => {
                            console.log(response);
                            if (response.data.state == true) {
                                swal2(response.data.msg, "", "success", "確定", true, vm.review, false);
                            } else {
                                swal2("新增失敗", "", "error");
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            },
            // 重新導向
            review() {
                window.location.href = "/product_series_types/edit.php"
            }
        }
    };

    Vue.createApp(edit).mount('#edit');
</script>

<?php
$js_content = ob_get_clean();
include("../template.php");
?>