<?php
ob_start();
?>

<style>
    .content .row {
        margin: 0;
    }

    p {
        margin-bottom: 0px;
    }

    .content .row .card {
        padding: 0;
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }

    /* tab style */
    .nav-link {
        color: var(--color666666);
    }

    .nav-link:focus {
        color: var(--color666666);
    }

    .nav-link:hover {
        color: var(--color666666);
    }

    .nav-tabs .nav-link.active {
        color: var(--colorececec);
        background-color: var(--color333333);
        border-color: #dee2e6 #dee2e6 #fff;
    }

    .text-color333333 {
        font-size: 1.5rem;
        color: var(--color333333);
    }

    .text-color666666 {

        color: var(--color666666);
    }
</style>

<?php
$css_style = ob_get_clean();
$title = "商品修改";
ob_start();
?>

<div class="row w-100" id="edit">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">{{ seriesName }}-{{ producttypeName }}-商品修改</div>
            </div>
        </div>
        <div class="card-body mt-3 mx-auto">
            <nav class="">
                <div class="nav nav-tabs row" id="nav-tab" role="tablist">
                    <button class="nav-link fw-500 col-4 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">商品詳情</button>
                    <button class="nav-link fw-500 col-4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">顏色&尺寸</button>
                    <button class="nav-link fw-500 col-4" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">照片</button>
                </div>
            </nav>
            <div class="tab-content text-center" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-10 row mt-3">
                            <div class="col-12 row">
                                <div class="col-3 text-color333333 fw-500">商品名稱</div>
                                <div class="col-9">
                                    <input type="text" name="productName" id="" class="form-control" placeholder="春季休閒棉衣" v-model="product.ProductName">
                                </div>
                            </div>
                            <div class="col-12 mt-3 row">
                                <div class="col-3 text-color333333 fw-500">價格</div>
                                <div class="col-9">
                                    <input type="number" name="price" id="" class="form-control" minlength="100" maxlength="10000" placeholder="10" v-model="product.Price">
                                </div>
                            </div>
                            <div class="col-12 mt-3 row">
                                <div class="col-3 text-color333333 fw-500">數量</div>
                                <div class="col-9">
                                    <input type="number" name="quantity" id="" class="form-control" minlength="1" maxlength="10000" placeholder="10" v-model="product.Quantity">
                                </div>
                            </div>
                            <div class="col-12 mt-3 row">
                                <div class="col-3 text-color333333 fw-500">狀態</div>
                                <div class="col-9 text-start d-flex align-items-center">
                                    <input type="checkbox" name="status" id="" class="form-check-input m-0" true-value="Y" false-value="" :checked="product.Status=='Y'" v-model="product.Status">
                                    <label class="form-label m-0">上架</label>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="text-center text-color333333 fw-500">商品介紹</div>
                                <div class="">
                                    <textarea name="introduction" id="" class="form-control" rows="5" placeholder="本產品..." v-model="product.Introduction"></textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="button" class="btn btn-primary mx-auto" @click="productsubmit">送出</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <a :href="'/product/productcolor_size/add.php?seriesId=' + seriesId + '&seriesname=' + seriesName + '&producttypeId=' + productTypeId + '&typename=' + producttypeName + '&productId=' + productId + '&colorlength=' + color.length" class="btn btn-primary" v-if="color.length < 5">新增顏色及尺寸</a>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger" @click="delcolor">刪除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-rwd">
                        <tr class="table-warning">
                            <td class="">
                                <input type="checkbox" name="" id="" class="form-check-input" v-model="chooseAllColor">
                            </td>
                            <td class="col-8">內容</td>
                            <td class="col-3">修改</td>
                        </tr>
                        <tr v-for="(item, index) in color" :key="index">
                            <td class="align-middle">
                                <input type="checkbox" name="" id="" class="form-check-input" :value="item.Id" v-model="checkcolor">
                            </td>
                            <td class="row">
                                <div class="col-12 col-md-6 mt-3 row">
                                    <div class="col-5 text-color333333 fw-400">顏色</div>
                                    <div class="col-7 d-flex justify-content-center align-items-center">
                                        <p class="fw-600" style="font-size: 1.25rem;">{{ item.Color }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 mt-3 row">
                                    <div class="col-5 text-color333333 fw-400">色表</div>
                                    <div class="col-7 d-flex justify-content-center align-items-center">
                                        <p class="fw-600" style="font-size: 1.25rem;">{{ item.ColorSample }}</p>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 row">
                                    <div class="col-4 text-color333333 fw-400">尺寸</div>
                                    <template v-for="(sizeitem, sizeIndex) in size.filter(s => s.ProductColorId == item.Id)" :key="sizeIndex">
                                        <div class="d-flex justify-content-center align-items-center col-1 fw-600" style="font-size: 1.25rem;"><span v-if="sizeIndex != 0">,</span> {{ sizeitem.Size }} </div>
                                    </template>
                                </div>
                            </td>
                            <td class="align-middle">
                                <a :href="'/product/productcolor_size/edit.php?seriesId=' + seriesId + '&seriesname=' + seriesName + '&producttypeId=' + productTypeId + '&typename=' + producttypeName + '&productId=' + productId + '&colorlength=' + color.length + '&colorId=' + item.Id + '&color=' + item.Color + '&colorsample=' + encodeURIComponent(item.ColorSample) + '&size=' + encodeURIComponent(JSON.stringify(size.filter(s => s.ProductColorId == item.Id)))" class="btn btn-success">修改</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <a :href="'/product/productphoto/add.php?seriesId=' + seriesId + '&seriesname=' + seriesName + '&producttypeId=' + productTypeId + '&typename=' + producttypeName + '&productId=' + productId + '&photolength=' + photo.length" class="btn btn-primary" v-if="photo.length < 5">新增</a>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-danger" @click="delphoto">刪除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-border border border-dark">
                        <tr class="table-warning">
                            <td class="col-3 text-center border border-dark">
                                <input type="checkbox" name="" id="all" class="form-check-input border border-dark" v-model="chooseall">
                            </td>
                            <td class="col-9 text-center border border-dark"> 產品圖</td>
                        </tr>
                        <tr v-for="(item, index) in photo">
                            <td class="text-center border border-dark align-middle">
                                <input type="checkbox" name="photo[]" id="" :value="item.Id" class="chk form-check-input border border-dark" v-model="checkphoto">
                            </td>
                            <td class="text-center border border-dark">
                                <img :src="imgurl + item.photoPath" class="img-fluid w-50">
                            </td>
                        </tr>
                    </table>
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
                // old data
                seriesId: '',
                seriesName: '',
                productId: '',
                productName: '',
                productTypeId: '',
                producttypeName: '',
                imgurl: photourl,
                product: [],
                color: [],
                size: [],
                photo: [],
                // check photo
                checkphoto: [],
                chooseall: false,
                checkcolor: [],
                chooseAllColor: false,
                // this series & type all product
                allproductname: '',
            }
        },
        watch: {
            chooseall(item) {
                const vm = this;
                if (item == true) {
                    vm.checkphoto = vm.photo.map(item => item.Id);
                } else if (vm.checkphoto.length == vm.photo.length) {
                    vm.checkphoto = [];
                }
            },
            chooseAllColor(item) {
                const vm = this;
                if (item == true) {
                    vm.checkcolor = vm.color.map(item => item.Id);
                } else if (vm.checkcolor.length == vm.color.length) {
                    vm.checkcolor = [];
                }
            },

        },
        // at web create to do
        created() {
            const vm = this;
            // get msg for url
            const urlparams = new URLSearchParams(window.location.search);
            vm.seriesId = urlparams.get('seriesId');
            vm.seriesName = urlparams.get('seriesname');
            // get msg for url
            vm.productTypeId = urlparams.get('producttypeId');
            vm.producttypeName = urlparams.get('typename');
            vm.productId = urlparams.get('productId');
            vm.productName = urlparams.get('productName');

            // get products from localstorage
            vm.allproductname = JSON.parse(localStorage.getItem('sendproduct'));
            vm.allproductname = vm.allproductname.filter(item => item.ProductName !== vm.productName);
            // find product for Id
            axios.get(apiurl + "searcheditproduct", {
                    params: {
                        productId: vm.productId,
                    },
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.data.state == true) {
                        vm.product = response.data.data.product;
                        vm.color = response.data.data.color;
                        vm.size = response.data.data.size;
                        vm.photo = response.data.data.photo;
                    } else {
                        console.log(response.msg);
                    }
                })
                .catch(response => {
                    console.log("error" + response);
                });
        },
        methods: {
            delphoto() {
                const vm = this;
                axios.post(apiurl + "delproductphoto", {
                        photoId: vm.checkphoto,
                    }, {
                        'Content-Type': 'application/json'
                    })
                    .then(response => {
                        console.log(response.data);
                        if (response.data.state == true) {
                            console.log(response.data);
                            swal2(response.data.msg, "", "success", "確定", true, vm.review, false);
                        } else {
                            swal2("新增失敗", "", "error", "", false, () => {}, true);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            review() {
                const vm = this;
                window.location.href = "/product/edit.php?seriesId=" + vm.seriesId + "&producttypeId=" + vm.productTypeId + "&seriesname=" + vm.seriesName + "&typename=" + vm.producttypeName + "&productId=" + vm.productId;
            },
            delcolor() {
                const vm = this;
                axios.post(apiurl + "delproductcolorsize", {
                        colorId: vm.checkcolor,
                    }, {
                        'Content-Type': 'application/json'
                    })
                    .then(response => {
                        console.log(response.data);
                        if (response.data.state == true) {
                            console.log(response.data);
                            swal2(response.data.msg, "", "success", "確定", true, vm.review, false);
                        } else {
                            swal2("新增失敗", "", "error", "", false, () => {}, true);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            productsubmit() {
                const vm = this;
                let product_flag = vm.allproductname.every(item => item.ProductName !== vm.product.ProductName) && vm.product.Introduction.length != 0 && vm.product.Price > 0 && vm.product.Quantity > 0 && vm.product.ProductName.length != 0;
                console.log(product_flag);
                if (product_flag) {
                    axios.post(apiurl + "updateproduct", {
                            productId: vm.productId,
                            productName: vm.product.ProductName,
                            introduction: vm.product.Introduction,
                            price: vm.product.Price,
                            quantity: vm.product.Quantity,
                            status: vm.product.Status
                        }, {
                            "Content-Type": 'application/json'
                        })
                        .then(response => {
                            if (response.data.state == true) {
                                console.log(response.data);
                                swal2(response.data.msg, "", "success", "確定", true, vm.review, false);
                            } else {
                                swal2("新增失敗", "", "error", "", false, () => {}, true);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }
            }
        }
    };
    Vue.createApp(edit).mount("#edit");
</script>

<?php
$js_content = ob_get_clean();
include("../template.php");
?>