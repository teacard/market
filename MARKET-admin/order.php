<?php
$title = "首頁";
ob_start();
?>
<style>
    .active {
        background-color: var(--color666666);
        color: var(--colorececec);
    }
</style>
<?php
$css_style = ob_get_clean();
ob_start();
?>
<table class="table m-2">
    <thead class="table-light">
        <tr>
            <th>訂單編號</th>
            <th>訂購者</th>
            <th>電話</th>
            <th>地址</th>
            <th>付款&貨運方式</th>
            <th>付款狀態</th>
            <th>訂單狀態</th>
            <th>總金額</th>
            <th>訂單時間</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <template v-for="(item, key) in order">
            <tr @click="orderId = (orderId === key ? null : key)" :class="{ 'active' : orderId == key }">
                <td>{{ item.Id }}</td>
                <td>{{ item.Name }}</td>
                <td>{{ item.Tel }}</td>
                <td>{{ item.Address }}</td>
                <td>{{ item.HowSend }}</td>
                <td>
                    <span v-if="item.PayStatus == 0">未付款</span>
                    <span v-else-if="item.PayStatus == 1">已付款</span>
                </td>
                <td>
                    <span v-if="item.orderstatus[item.orderstatus.length-1].OrdersStatus == 0">未出貨</span>
                    <span v-else-if="item.orderstatus[item.orderstatus.length-1].OrdersStatus == 1">已出貨</span>
                    <span v-else-if="item.orderstatus[item.orderstatus.length-1].OrdersStatus == 2">已到達</span>
                    <span v-else-if="item.orderstatus[item.orderstatus.length-1].OrdersStatus == -1">已取消</span>
                </td>
                <td>{{ item.Total }}</td>
                <td>{{ item.CreateTime }}</td>
                <td><i class="fa-solid fa-chevron-right" :class="{'fa-rotate-90' : orderId==key}"></i></td>
            </tr>
            <tr v-if="orderId == key">
                <td colspan="9" style="padding: 0;">
                    <div class="collapse show mb-2">
                        <table class="table text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>商品名稱</th>
                                    <th>尺寸</th>
                                    <th>顏色</th>
                                    <th>數量</th>
                                    <th>單價</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product, productkey) in item.orderproduct" :key="productkey">
                                    <td>
                                        <img :src="product.ProductPhoto" class="img-fluid" alt="Product Image" style="width: 100px; height: 100px;">
                                        {{ product.ProductName }}
                                    </td>
                                    <td>{{ product.ProductSize}}</td>
                                    <td>
                                        <div class="color mx-auto" style="width: 75px; height: 75px; border: solid 1px black;" :style="'background-color:' + product.ProductColor"></div>
                                    </td>
                                    <td>{{ product.Count }}</td>
                                    <td>{{ product.ProductCoin }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row text-center">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="text row" style="width: auto;">
                                    <div class="col-6 text-end">
                                        <h5>商品總金額：</h5>
                                    </div>
                                    <div class="col-6 text-start">
                                        <h5>{{ item.Total }}元</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h5>商品優惠：</h5>
                                    </div>
                                    <div class="col-6 text-start">
                                        <h5>{{ item.DiscountCoin }}元</h5>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h5>運費價格：</h5>
                                    </div>
                                    <div class="col-6 text-start">
                                        <h5><span v-if="item.DiscountType==0">0元</span><span v-if="item.DiscountType==1">49元</span></h5>
                                    </div>
                                    <div class="col-6 mt-2 text-end">
                                        <h3>總價格：</h3>
                                    </div>
                                    <div class="col-6 mt-2 text-start">
                                        <h3>{{ item.Total }}元</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-success" @click="sendproduct(item.Id)" v-if="item.orderstatus[item.orderstatus.length-1].OrdersStatus == 0">安排出貨</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger" @click="cannelorder(item.Id)" v-if="item.orderstatus[item.orderstatus.length-1].OrdersStatus == 0">取消訂單</button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

        </template>
    </tbody>
</table>
<?php
$content = ob_get_clean();
ob_start();
?>
<script>
    const App = {
        data() {
            return {
                order: null,
                orderId: null,
            }
        },
        created() {
            const vm = this;
            axios.get(apiurl + "getorder")
                .then((response) => {
                    // console.log(response.data);
                    if (response.data.state == true) {
                        // console.log(response.data.data);
                        vm.order = response.data.data;
                        vm.order.forEach((item, key) => {
                            item.orderproduct.forEach((product, productkey) => {
                                product.ProductPhoto = photourl + product.ProductPhoto;
                            });
                        });
                    } else {
                        console.error("Error fetching series data:", response.data.message);
                    }
                }).catch((error) => {
                    console.error("Error fetching series data:", error);
                });
        },
        methods: {
            sendproduct(orderId) {
                const vm = this;
                swal.fire({
                    title: '已出貨',
                    icon: 'success',
                    showConfirmButton: false,
                });
                axios.post(apiurl + "sendorder", {
                    orderId: orderId,
                    status: 1,
                }).then((response) => {
                    // console.log(response.data);
                    if (response.data.state == true) {
                        axios.get(apiurl + "getorder")
                            .then((response) => {
                                // console.log(response.data);
                                if (response.data.state == true) {
                                    // console.log(response.data.data);
                                    vm.order = response.data.data;
                                    vm.order.forEach((item, key) => {
                                        item.orderproduct.forEach((product, productkey) => {
                                            product.ProductPhoto = photourl + product.ProductPhoto;
                                        });
                                    });
                                } else {
                                    console.error("Error fetching series data:", response.data.message);
                                }
                            }).catch((error) => {
                                console.error("Error fetching series data:", error);
                            });
                    } else {
                        console.error("Error fetching series data:", response.data.message);
                    }
                }).catch((error) => {
                    console.error("Error fetching series data:", error);
                });
            },
            cannelorder(orderId) {
                const vm = this;
                swal.fire({
                    title: '是否取消訂單',
                    icon: 'warning',
                    showConfirmButton: true,
                    showCancelButton: true,
                    confirmButtonText: '是',
                    cancelButtonText: '否',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post(apiurl + "sendorder", {
                            orderId: orderId,
                            status: -1,
                        }).then((response) => {
                            // console.log(response.data);
                            if (response.data.state == true) {
                                axios.get(apiurl + "getorder")
                                    .then((response) => {
                                        // console.log(response.data);
                                        if (response.data.state == true) {
                                            // console.log(response.data.data);
                                            vm.order = response.data.data;
                                            vm.order.forEach((item, key) => {
                                                item.orderproduct.forEach((product, productkey) => {
                                                    product.ProductPhoto = photourl + product.ProductPhoto;
                                                });
                                            });
                                        } else {
                                            console.error("Error fetching series data:", response.data.message);
                                        }
                                    }).catch((error) => {
                                        console.error("Error fetching series data:", error);
                                    });
                            } else {
                                console.error("Error fetching series data:", response.data.message);
                            }
                        }).catch((error) => {
                            console.error("Error fetching series data:", error);
                        });
                    }
                });
            }
        }
    }
    Vue.createApp(App).mount('#content');
</script>
<?php
$js_content = ob_get_clean();
include("template.php");
?>