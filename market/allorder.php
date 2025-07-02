<?php
$title = "訂單查詢";
ob_start();
?>
<style>
    .order {
        background-color: var(--color333333);
        margin-top: 1rem;
        width: 100%;
    }

    .order .table {
        width: 100%;
    }

    .order .table .thead {
        background-color: var(--color333333);
        height: 100px;
        width: 100%;
    }

    .order .table .thead th {
        color: var(--colorececec);
        padding: 0;
    }

    .order .table tbody {
        background-color: var(--colorececec);
        color: var(--color333333);
    }
</style>
<?php
$css = ob_get_clean();
ob_start();
?>
<div class="order" id="order">
    <table class="table">
        <thead>
            <tr class="text-center align-middle thead">
                <th class="col-6">商品名稱</th>
                <th class="col-2">訂單狀態</th>
                <th class="col-2">付款狀態</th>
                <th class="col-2">價格</th>
            </tr>
        </thead>
        <tbody>
            <tr class="align-middle text-center" v-for="(order, okey) in orderlist" :key="okey">
                <td @click="toorderdetail(order.Id, okey)" style="cursor: pointer;">
                    <img :src="order.orderproduct.ProductPhoto" alt="" class="img-fluid" style="width: 100px; height: 100px;">
                    {{ order.orderproduct.ProductName }}
                </td>
                <td>
                    <span v-if="order.orderstatus[order.orderstatus.length-1].OrdersStatus == 0">未寄出</span>
                    <span v-else-if="order.orderstatus[order.orderstatus.length-1].OrdersStatus == 1">運送中</span>
                    <span v-else-if="order.orderstatus[order.orderstatus.length-1].OrdersStatus == 2">已送達</span>
                    <span v-else-if="order.orderstatus[order.orderstatus.length-1].OrdersStatus == -1">已取消</span>
                </td>
                <td>
                    <span v-if="order.PayStatus==0">未付款</span>
                    <span v-if="order.PayStatus==1">已付款</span>
                </td>
                <td>
                    {{ order.Total }} <span>元</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
ob_start();
?>
<script>
    const order = {
        data() {
            return {
                orderlist: [],
            }
        },
        created() {
            const vm = this;
            axios.get(apiurl + "getorder", {
                    params: {
                        keyA: getCookie("keyA"),
                        keyB: getCookie("keyB"),
                    }
                })
                .then(response => {
                    // console.log(response.data); // 拿到回傳資料
                    vm.orderlist = response.data.data; // 將資料存入 discount
                    vm.orderlist.forEach(order => {
                        order.orderproduct.ProductPhoto = photourl + order.orderproduct.ProductPhoto; // 將圖片路徑加上網址
                    });
                })
                .catch(error => {
                    console.error(error); // 錯誤處理
                });
        },
        methods: {
            toorderdetail(Id, key) {
                const vm = this;
                if(vm.orderlist[key].orderstatus[vm.orderlist[key].orderstatus.length-1].OrdersStatus != -1){
                    window.location.href = "orderdetail.php?Id=" + Id;
                }else{
                    swal.fire({
                        title: "訂單已取消",
                        text: "無法查看訂單詳情",
                        icon: "error",
                        showConfirmButton: false,
                    });
                }
            }
        }
    }
    Vue.createApp(order).mount("#order");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>