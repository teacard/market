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
$title = "商品列表";
ob_start();
?>

<div class="row w-100" id="list">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">{{ seriesName }}-{{ productName }}-商品列表</div>
            </div>
        </div>
        <div class="card-body mt-3">
            <a :href="'/product/add.php?seriesId=' + seriesId + '&producttypeId=' + producttypeId + '&seriesname=' + seriesName + '&typename=' + productName" class="btn btn-primary me-3 mb-3">新增</a>
            <button type="button" class="btn btn-danger mb-3" @click="delproduct">刪除</button>
            <table class="table table-border table-bordered">
                <tr class="table-secondary fw-600 text-center align-middle">
                    <td class="">
                        <input type="checkbox" name="" id="" class="form-check-input" v-model="chooseAll">
                    </td>
                    <td>
                        商品名稱
                    </td>
                    <td>
                        商品介紹
                    </td>
                    <td>
                        價格
                    </td>
                    <td>
                        數量
                    </td>
                    <td>
                        狀態
                    </td>
                    <td>
                        修改
                    </td>
                </tr>
                <tr class="fw-400 text-center align-middle" v-for="(item) in product">
                    <td>
                        <input type="checkbox" name="" id="" :value="item.Id" class="form-check-input"  v-model="chooseId">
                    </td>
                    <td>
                        {{ item.ProductName}}
                    </td>
                    <td>
                        {{ checklength(item.Introduction) }}
                    </td>
                    <td>
                        {{ item.Price }}
                    </td>
                    <td>
                        {{ item.Quantity }}
                    </td>
                    <td>
                        {{ item.Status == 'Y' ? '上架' : '下架'}}
                    </td>
                    <td>
                        <a :href="'/product/edit.php?seriesId=' + seriesId + '&producttypeId=' + producttypeId + '&seriesname=' + seriesName + '&typename=' + productName + '&productId=' + item.Id + '&productName=' + item.ProductName" class="btn btn-warning">修改</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>

<script>
    const list = {
        data() {
            return {
                seriesId: '',
                seriesName: '',
                producttypeId: '',
                productName: '',
                product: [],
                chooseId: [],
                chooseAll: false,
            }
        },
        watch: {
            chooseId(item) {
                this.chooseAll = item.length === this.product.length && this.product.length > 0;
            },
            chooseAll(item) {
                const vm = this;
                if (item) {
                    vm.chooseId = vm.product.map(item => item.Id);
                } else if (vm.chooseId.length == vm.product.length) {
                    // 取消全選：清空 selectedItems 陣列
                    vm.chooseId = [];
                }
            },
            product(item) {
                // put products into localstorage
                const products = item.map(data => ({
                    ProductName: data.ProductName,
                    SizeId: data.SizeId,
                    ColorId: data.ColorId
                }));
                localStorage.setItem('sendproduct', JSON.stringify(products));
            }
        },
        created() {
            const vm = this;
            const urlparams = new URLSearchParams(window.location.search);
            vm.seriesId = urlparams.get('seriesId');
            vm.producttypeId = urlparams.get('producttypeId');
            vm.seriesName = urlparams.get('seriesname');
            vm.productName = urlparams.get('typename');

            axios.get(apiurl + "searchproductlist", {
                    params: {
                        seriesId: vm.seriesId,
                        producttypeId: vm.producttypeId,
                    },
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    // console.log(response.data);
                    if (response.data.state == true) {
                        // console.log(response.data.data);
                        vm.product = response.data.data;
                    } else {
                        console.log(response.msg);
                    }
                })
                .catch(response => {
                    console.log("error" + response);
                });
        },
        methods: {
            deletes() {
                const vm = this;
                if (vm.chooseId.length == 0) {
                    swal2("請選擇至少一個選項", "", "error", "", false, () => {}, true);
                } else {
                    swal2("確認是否刪除", '', "warning", "確定", true, vm.successDelete, true);
                }
            },
            checklength(item) {
                const length = 10
                if (item.length >= length) {
                    return item.slice(0, length) + '...'
                } else {
                    return item;
                }
            },
            delproduct(){
                const vm = this;
                axios.post(apiurl + 'delproduct',{
                    Id: vm.chooseId,
                }, {
                    'Content-Type' : 'application/json'
                })
                .then(response => {
                    console.log(response);
                    if(response.data.state === true){
                        console.log(response.data);
                        swal2("刪除成功", "", "success", "確定", true, vm.review, false);
                    }else{
                        swal2("刪除失敗", "", "error", "", false, ()=>{}, true);
                    }
                })
            },
            review(){
                const vm = this;
                window.location.href = "/product/list.php?seriesId=" + vm.seriesId + "&producttypeId=" + vm.producttypeId + "&seriesname=" + vm.seriesName + "&typename=" + vm.productName;
            }
        }
    };
    Vue.createApp(list).mount("#list");
</script>

<?php
$js_content = ob_get_clean();
include("../template.php");
?>