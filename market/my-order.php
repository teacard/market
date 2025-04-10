<?php
$title = "購物車";
ob_start();
?>

<style>
    .shoppingcart {
        width: 100%;
        margin-top: 1rem;
    }

    .shoppingcart .table {
        width: 100%;
    }

    .shoppingcart .table {
        width: 100%;
    }

    .shoppingcart .table .thead {
        background-color: var(--color333333);
        height: 100px;
        width: 100%;
    }

    .shoppingcart .table .thead th {
        color: var(--colorececec);
        padding: 0;
    }

    .shoppingcart .table tbody tr {
        height: 200px;
        aspect-ratio: 1;
        width: 100%;
    }

    .shoppingcart .table tbody tr td {
        height: 200px;
    }

    .shoppingcart .table tbody tr td.color {
        height: 200px;

    }

    .shoppingcart .table tbody tr td .colorbox {
        aspect-ratio: 1;
        width: 75px;
        height: 75px;
        border: var(--color999999) 1px solid;
        margin-left: auto;
        margin-right: auto;
    }

    .shoppingcart .total {
        width: auto;
        margin-left: auto;
        max-width: 40%;
    }
</style>

<?php
$css = ob_get_clean();
ob_start();
?>

<div class="shoppingcart" id="shoppingcart">
    <table class="table">
        <tr class="text-center align-middle thead">
            <th class="col-5">商品名稱</th>
            <th class="col-1">顏色</th>
            <th class="col-1">尺寸</th>
            <th class="col-2">數量</th>
            <th class="col-2">價格</th>
            <th class="col-1"></th>
        </tr>
        <tbody id="orderlist">
            <tr class="align-middle text-center" v-for="(order, okey) in shoppingcart" :key="okey">
                <td class="row">
                    <div class="col-5 d-flex justify-content-center align-items-center">
                        <img :src="'http://122.117.32.6:83/' + order.photo[0].photoPath" alt="" class="img-fluid">
                    </div>
                    <div class="col-7 d-flex justify-content-start align-items-center">
                        {{ order.product.ProductName }}
                    </div>
                </td>
                <td class="color">
                    <div class="colorbox" :style="'background-color:' + order.color.ColorSample + ';'"></div>
                </td>
                <td>{{ order.size.Size }}</td>
                <td>
                    <select name="" id="" class="form-select" @change="updateOrder(order.id, $event.target.value)">
                        <option :value="citem" :selected=" order.count == citem" v-for="(citem, ckey) in Array.from({ length: 99 }, (_, index) => index + 1)" :key="citem">{{ citem }}</option>
                    </select>
                </td>
                <td>NT. {{ order.product.Price }}</td>
                <td><button class="btn" @click="checkdel(order.id)"><i class="fa-solid fa-xmark"></i></button></td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        <div class="coin">
            <div class="row" style="margin-left: 0; margin-right: 0; font-size: 1rem;">
                <div class="col-3 text-center" style="padding: 0;"><span>共<span>{{ shoppingcart.length }}</span>件</span></div>
                <div class="col-9 text-center" style="padding: 0;"><span>產品金額：<span>{{ totalprice }}</span>元</span></div>
            </div>
        </div>
        <div class="sendcoin mt-3" style="font-size: 1rem;">
            <div class="row" style="margin-left: 0; margin-right: 0;">
                <div class="col-3 text-center" style="padding: 0;"></div>
                <div class="col-9 text-center" style="padding: 0;"><span>運費金額：<span>49</span>元</span></div>
            </div>
        </div>
        <hr style="margin: 0.5rem 0; opacity: 1;">
        <div class="totalcoin text-center" style="margin-left: 0; margin-right: 0; font-size: 1rem;">
            <span>總計：<span class="text-danger" style="font-size: 2rem;">{{ totalprice+49 }}</span>元</span>
        </div>
        <button type="button" class="btn btn-dark w-100" @click="sendup">下一步</button>
    </div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>

<script>
    const shoppingcart = {
        data() {
            return {
                shoppingcart: [],
                totalprice: '',
            }
        },
        created() {
            const vm = this;
            const urlparams = new URLSearchParams(window.location.search);
            let keyA = getCookie('keyA');
            let keyB = getCookie('keyB');
            vm.getorder(keyA, keyB);
        },
        methods: {
            getorder(gkeyA, gkeyB) {
                const vm = this;
                axios.get(apiurl + 'getorder', {
                        params: {
                            keyA: gkeyA,
                            keyB: gkeyB,
                        }
                    })
                    .then(response => {
                        console.log(response);
                        if (response.data.state == true) {
                            const vm = this;
                            vm.shoppingcart = response.data.data;
                            console.log(vm.shoppingcart);
                            let total = 0;
                            vm.shoppingcart.forEach(function(item) {
                                total += item.product.Price * item.count;
                            });
                            vm.totalprice = total;
                        } else {
                            console.log("搜尋失敗");
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            delOrder(Id) {
                axios.post(apiurl + 'delorder', {
                        id: Id
                    })
                    .then(response => {
                        console.log(response);
                        if (response.data.state == true) {
                            const vm = this;
                            let keyA = getCookie('keyA');
                            let keyB = getCookie('keyB');
                            vm.getorder(keyA, keyB);
                        } else {
                            console.log("搜尋失敗");
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            checkdel(Id) {
                Swal.fire({
                    title: "確定要刪除嗎?",
                    icon: "question",
                    confirmButtonText: "確定",
                    cancelButtonText: "取消",
                    showConfirmButton: true,
                    showCancelButton: true,
                }).then((result) => {
                    const vm = this;
                    vm.delOrder(Id);
                });
            },
            updateOrder(OId, Ocount) {
                const vm = this;
                let count = parseInt(Ocount);

                axios.post(apiurl + 'updateorder', {
                        id: OId,
                        count: count
                    })
                    .then(response => {
                        console.log(response);
                        if (response.data.state == true) {
                            const vm = this;
                            let keyA = getCookie('keyA');
                            let keyB = getCookie('keyB');
                            vm.getorder(keyA, keyB);
                        } else {
                            console.log("搜尋失敗");
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            sendup() {
                const vm = this;
                let count = 49;
                let cartid = [];
                vm.shoppingcart.forEach(function(item) {
                    count += item.count * item.product.Price;
                    cartid.push({
                        'id': item.id,
                        'count': item.count,
                        'color': item.color.Id,
                        'size': item.size.Id,
                    });
                });

                if (count > 0 && vm.shoppingcart.length > 0) {
                    localStorage.setItem('shoppingcart', JSON.stringify(cartid));
                    window.location.href = "orderdata.php";
                } else {
                    Swal.fire({
                        title: "購物車沒有商品",
                        icon: "warning",
                        confirmButtonText: "確定",
                        showConfirmButton: true,
                    });
                }
            }
        }
    }
    Vue.createApp(shoppingcart).mount("#shoppingcart");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>