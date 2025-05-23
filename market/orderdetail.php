<?php
$title = "訂單查詢";
ob_start();
?>
<style>
    .order {

        margin-top: 1rem;
        width: 100%;
    }

    .order .orderdetail .dcontent {
        padding: 0 1rem;
    }

    .order .orderdetail .pcontent {
        padding: 0 1rem;
    }
</style>
<?php
$css = ob_get_clean();
ob_start();
?>
<div class="order" id="order">
    <a href="allorder.php" style="text-decoration: none; color: var(--color333333); margin: 1rem 0;">
        <i class="fa-solid fa-chevron-left"></i>回上頁
    </a>
    <hr>
    <div class="schedule d-flex justify-content-between align-items-center position-relative" style="height: 200px;">
        <div class="MenuImgText text-center" style="width: 200px;">
            <div class="menuimg d-flex justify-content-center align-items-center" style="border-radius: 50%; width: 70px; height: 70px; margin:auto; background-color: var(--colorececec);" :style="Schedule>=0 ? 'border: 4px solid #2dc258;' : 'border: 4px solid var(--color000000);'">
                <i class="fa-solid fa-bars" style="font-size: 1.5rem;" :style="Schedule>=0 ? 'color: #2dc258;' : 'color: var(--color000000);'"></i>
            </div>
            <div class="menutext">
                <span>訂單已成立</span>
                <br>
                <span v-if="Schedule>=0 && orderdetail.orderstatus && orderdetail.orderstatus[0]" style="font-size: 0.75rem; color: var(--color666666);">{{ orderdetail.orderstatus[0].CreateTime }}</span>
            </div>
        </div>
        <div class="TruckImgText text-center" style="width: 200px;">
            <div class="menuimg d-flex justify-content-center align-items-center" style="border-radius: 50%; width: 70px; height: 70px; margin:auto; background-color: var(--colorececec);" :style="Schedule>=1 ? 'border: 4px solid #2dc258;' : 'border: 4px solid var(--color000000);'">
                <i class="fa-solid fa-truck-moving" style="font-size: 1.5rem;" :style="Schedule>=1 ? 'color: #2dc258;' : 'color: var(--color000000);'"></i>
            </div>
            <div class="trucktext">
                <span>訂單已出貨</span>
                <br>
                <span v-if="Schedule>=1 && orderdetail.orderstatus && orderdetail.orderstatus[1]" style="font-size: 0.75rem; color: var(--color666666);">{{ orderdetail.orderstatus[1].CreateTime }}</span>
                <span v-if="Schedule<=1">&nbsp;</span>
            </div>
        </div>
        <div class="ArriveImgText text-center" style="width: 200px;">
            <div class="menuimg d-flex justify-content-center align-items-center" style="border-radius: 50%; width: 70px; height: 70px; margin:auto; background-color: var(--colorececec);" :style="Schedule>=2 ? 'border: 4px solid #2dc258;' : 'border: 4px solid var(--color000000);'">
                <i class="fa-solid fa-truck-ramp-box" style="font-size: 1.5rem;" :style="Schedule>=2 ? 'color: #2dc258;' : 'color: var(--color000000);'"></i>
            </div>
            <div class="arrivetext">
                <span>訂單已送達</span>
                <br>
                <span v-if="Schedule>=2 && orderdetail.orderstatus && orderdetail.orderstatus[2]" style="font-size: 0.75rem; color: var(--color666666);">{{ orderdetail.orderstatus[2].CreateTime }}</span>
                <span v-if="Schedule<=2">&nbsp;</span>
            </div>
        </div>
        <div class="stepper_line" style="height: 4px; width: 100%; position: absolute; top: 70px;z-index: -1;">
            <div class="backline" style="height: 4px; width: calc(100% - 150px); position: absolute; top: 0px; background-color: var(--colorececec); margin: 0 100px;"></div>
            <div class="stepper" style="height: 4px; position: absolute; top: 0px; background-color: #2dc258; margin: 0 100px; transition: width 1s cubic-bezier(.4,0,.2,1);" :style="'width: calc(' + Stepper + '% - 150px;'"></div>
        </div>
    </div>
    <hr>
    <div class="orderdetail">
        <div class="dtitle h3 text-center">訂單訊息</div>
        <div class="dcontent">
            <div class="row">
                <div class="col-6" style="color: var(--color333333);">
                    <span>姓名：{{ orderdetail.Name }}</span>
                </div>
                <div class="col-6" style="color: var(--color333333);">
                    <span>電話：{{ orderdetail.Tel }}</span>
                </div>
                <div class="col-6" style="color: var(--color333333);">
                    <span>備註：{{ orderdetail.Other }}</span>
                </div>
                <div class="col-6" style="color: var(--color333333);">
                    <span>地址：{{ orderdetail.Address }}</span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="orderproduct">
        <div class="ptitle h3 text-center">購買內容</div>
        <div class="pcontent">
            <table class="table">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="col-4">商品名稱</th>
                        <th class="col-2">顏色</th>
                        <th class="col-2">尺寸</th>
                        <th class="col-2">價格</th>
                        <th class="col-2">數量</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="align-middle text-center" v-for="(order, okey) in orderdetail.orderproduct" :key="okey">
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <img :src="order.ProductPhoto" alt="" class="img-fluid">
                                </div>
                                <div class="col-6 my-auto">
                                    {{ order.ProductName }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="mx-auto my-auto" style="width: 50px; height: 50px;border: var(--color000000) 1px solid;" :style="'background-color: ' + order.ProductColor + ';'"></div>
                        </td>
                        <td>
                            {{ order.ProductSize }}
                        </td>
                        <td>
                            {{ order.ProductCoin }} <span>元</span>
                        </td>
                        <td>
                            {{ order.Count }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="others">
        <div class="ocontent ms-auto text-center" style="width: 300px;">
            <div class="row">
                <div class="col-4">
                    共<span>{{ allproducts }}</span>件
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-12 text-start">
                            商品金額：<span>{{ productsprice }}</span>元
                        </div>
                        <div class="col-12 mt-2 text-start">
                            運費價格：<span v-if="orderdetail.DiscountType == 0">0</span><span v-if="orderdetail.DiscountType == 1">49</span>元
                        </div>
                        <div class="col-12 mt-2 text-start">
                            商品優惠：<span v-if="orderdetail.DiscountType == 0">0</span><span v-if="orderdetail.DiscountType == 1">{{ orderdetail.DiscountCoin }}</span>元
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12">
                    總金額：<span>{{ total-orderdetail.DiscountCoin }}</span>元
                </div>
                <div class="col-6 mt-2">
                    <button type="button" class="btn btn-dark">聯絡客服</button>
                </div>
                <div class="col-6 mt-2">
                    <button type="button" class="btn btn-warning" v-if="orderdetail && orderdetail.orderstatus && orderdetail.orderstatus[orderdetail.orderstatus.length-1].OrdersStatus == 0" @click="cannelorder(orderdetail.Id)">取消訂單</button>
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
    const order = {
        data() {
            return {
                orderId: null,
                orderdetail: [],
                allproducts: 0,
                productsprice: 0,
                total: 0,
                Schedule: null,
                Stepper: 10,
            }
        },
        created() {
            const vm = this;
            const urlparams = new URLSearchParams(window.location.search);
            vm.orderId = urlparams.get('Id');
            axios.get(apiurl + "getorderdetail", {
                    params: {
                        keyA: getCookie("keyA"),
                        keyB: getCookie("keyB"),
                        orderId: vm.orderId
                    }
                })
                .then(response => {
                    // console.log(response.data); // 拿到回傳資料
                    vm.orderdetail = response.data.data; // 將資料存入 discount
                    vm.total = response.data.data.Total; // 總金額
                    vm.allproducts = response.data.data.orderproduct.length; // 總商品數量
                    vm.orderdetail.orderproduct.forEach(item => {
                        item.ProductPhoto = photourl + item.ProductPhoto; // 將圖片路徑加上網址
                        vm.productsprice += item.ProductCoin * item.Count; // 商品金額
                    });
                    vm.Schedule = vm.orderdetail.orderstatus.length - 1;
                    if (vm.Schedule == 0) {
                        vm.Stepper = 10;
                    } else if (vm.Schedule == 1) {
                        vm.Stepper = 40;
                    }else if (vm.Schedule == 2) {
                        vm.Stepper = 95;
                    }
                })
                .catch(error => {
                    console.error(error); // 錯誤處理
                });
        },
        methods: {
            cannelorder(Id) {
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
                        axios.post(apiurl + "cannelorder", {
                            orderId: Id,
                            status: -1,
                        }).then((response) => {
                            // console.log(response.data);
                            if (response.data.state == true) {
                                swal.fire({
                                    title: '訂單已取消',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.href = "allorder.php";
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
    Vue.createApp(order).mount("#order");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>