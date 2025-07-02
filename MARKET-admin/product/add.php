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
$title = "新增商品";
ob_start();
?>

<div class="row w-100" id="add">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">{{ seriesName }}-{{ producttypeName }}-新增商品</div>
            </div>
        </div>
        <div class="card-body mt-3">
            <nav>
                <div class="nav nav-tabs row" id="nav-tab" role="tablist">
                    <button class="nav-link fw-500 col-4 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">商品詳情</button>
                    <button class="nav-link fw-500 col-4" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">顏色&尺寸</button>
                    <button class="nav-link fw-500 col-4" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">照片</button>
                </div>
            </nav>
            <form action="122.117.32.6:81/index.php?action" method="post" enctype="multipart/form-data" @submit.prevent="handleSubmit">
                <div class="tab-content text-center" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 col-md-10 row mt-3">
                                <div class="col-12 row">
                                    <div class="col-3 text-color333333 fw-500">商品名稱</div>
                                    <div class="col-9">
                                        <input type="text" name="productName" id="" class="form-control" placeholder="春季休閒棉衣" v-model="newproduct.productName">
                                    </div>
                                </div>
                                <div class="col-12 mt-3 row">
                                    <div class="col-3 text-color333333 fw-500">價格</div>
                                    <div class="col-9">
                                        <input type="number" name="price" id="" class="form-control" minlength="100" maxlength="10000" placeholder="10" v-model="newproduct.price">
                                    </div>
                                </div>
                                <div class="col-12 mt-3 row">
                                    <div class="col-3 text-color333333 fw-500">數量</div>
                                    <div class="col-9">
                                        <input type="number" name="quantity" id="" class="form-control" minlength="1" maxlength="10000" placeholder="10" v-model="newproduct.quantity">
                                    </div>
                                </div>
                                <div class="col-12 mt-3 row">
                                    <div class="col-3 text-color333333 fw-500">狀態</div>
                                    <div class="col-9 text-start d-flex align-items-center">
                                        <input type="checkbox" name="status" id="" class="form-check-input m-0" v-model="newproduct.status" true-value="Y" false-value="">
                                        <label class="form-label m-0">上架</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="text-center text-color333333 fw-500">商品介紹</div>
                                    <div class="">
                                        <textarea name="introduction" id="" class="form-control" rows="5" placeholder="本產品..." v-model="newproduct.introduction" @input="clearspace"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row d-flex justify-content-center">
                            <template v-for="(item, index) in sizes_colors" :key="index">
                                <div class="col-12 col-md-10 mt-3 row">
                                    <div class="col-3 text-color333333 fw-500">顏色 {{ index+1 }}</div>
                                    <div class="col-9">
                                        <input type="text" :name="'color' + index" id="" class="form-control" placeholder="黑色" v-model="sizes_colors[index].colors">
                                    </div>
                                </div>
                                <div class="col-12 col-md-10 mt-3 row">
                                    <div class="col-3 text-color333333 fw-500">色表(16進位制)</div>
                                    <div class="col-9">
                                        <input type="text" :name="'colorsample' + index" id="" class="form-control" placeholder="#000000" v-model="sizes_colors[index].colorstamp">
                                    </div>
                                </div>
                                <template v-for="(size, sizeIndex) in item.sizes" :key="sizeIndex">
                                    <div class="col-12 col-md-10 mt-3 row">
                                        <div class="col-3 text-color333333 fw-500">尺寸 {{ sizeIndex+1 }}</div>
                                        <div class="col-9">
                                            <input type="text" :name="'size' + sizeIndex" id="" class="form-control" placeholder="M , 31" v-model="sizes_colors[index].sizes[sizeIndex]">
                                        </div>
                                    </div>
                                </template>
                                <div class="col-12 col-md-10 mt-5 mb-5">
                                    <div class="d-flex justify-content-center row">
                                        <button type="button" class="btn col-3 me-3" style="color: #666666; background: #ececec" @click="addsizes(index)" v-if="sizes_colors[index].sizes.length != 5">新增尺寸</button>
                                        <button type="button" class="btn col-3" style="color: #666666; background: #ececec" @click="delsizes(index)" v-if="sizes_colors[index].sizes.length != 1">刪減尺寸</button>
                                    </div>
                                </div>
                            </template>
                            <hr>
                            <div class="col-12 col-md-10 mt-5">
                                <div class="d-flex justify-content-center row">
                                    <button type="button" class="btn col-3 me-3" style="color: #ececec; background: #666666" @click="addcolors" v-if="sizes_colors.length != 5">新增顏色</button>
                                    <button type="button" class="btn col-3" style="color: #ececec; background: #666666" @click="delcolors" v-if="sizes_colors.length != 1">刪減顏色</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row d-flex justify-content-center">
                            <template v-for="(item, photoIndex) in photos" :key="photoIndex">
                                <div class="col-12 col-md-10 mt-3 row">
                                    <div class="col-3 text-color333333 fw-500">照片 {{ item }}</div>
                                    <div class="col-9">
                                        <input type="file" :name="'photo' + photoIndex" id="" class="form-control" @change="checkfile_exe($event, photoIndex)" :class="{'is-invalid' : !invalidFiles[photoIndex]}">
                                        <div class="invalid-feedback text-danger d-block" :name="'feedback' + photoIndex" v-if="!invalidFiles[photoIndex]">上傳格式為jpg or png</div>
                                    </div>
                                </div>
                            </template>
                            <div class="col-12 col-md-10 mt-5">
                                <div class="d-flex justify-content-center row">
                                    <button type="button" class="btn col-3 me-3" style="color: #ececec; background: #666666" @click="addphotos" v-if="photos != 5">新增照片</button>
                                    <button type="button" class="btn col-3" style="color: #ececec; background: #666666" @click="delphotos" v-if="photos != 1">刪減照片</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button type="submit" class="btn btn-primary">送出</button>
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
                // old data
                seriesId: '',
                seriesName: '',
                producttypeId: '',
                producttypeName: '',
                product: [],
                series_producttype_products: [],
                // new data
                newproduct: {
                    seriesId: '',
                    productTypeId: '',
                    productName: '',
                    price: '',
                    quantity: '',
                    status: '',
                    introduction: ''
                },
                /* 顏色的預設值 色票預設值 預設一個空尺寸 */
                sizes_colors: [{
                    colors: '',
                    colorstamp: '',
                    sizes: ['']
                }],
                photos: 1,
                invalidFiles: [false],
                // submitcheck
                photo: [],
            }
        },
        watch: {},
        // at web create to do
        created() {
            const vm = this;
            // get msg for url
            const urlparams = new URLSearchParams(window.location.search);
            vm.seriesId = urlparams.get('seriesId');
            vm.producttypeId = urlparams.get('producttypeId');
            vm.newproduct.seriesId = urlparams.get('seriesId');
            vm.newproduct.productTypeId = urlparams.get('producttypeId');
            vm.seriesName = urlparams.get('seriesname');
            vm.producttypeName = urlparams.get('typename');

            // get products from localstorage
            vm.series_producttype_products = JSON.parse(localStorage.getItem('sendproduct'));

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
                        const product = response.data.data;
                        vm.product = response.data.data;
                        vm.newproductname = product.ProductName;
                        vm.newIntroduction = product.Introduction;
                    } else {
                        console.log(response.msg);
                    }
                })
                .catch(response => {
                    console.log("error" + response);
                });
        },
        methods: {
            // 新增顏色內的尺寸數量
            addsizes(index) {
                const vm = this;
                if (vm.sizes_colors[index].sizes.length < 5) {
                    vm.sizes_colors[index].sizes.push('');
                }
            },
            delsizes(index) {
                const vm = this;
                if (vm.sizes_colors[index].sizes.length > 1) {
                    vm.sizes_colors[index].sizes.pop();
                }
            },
            // 新增顏色數量
            addcolors() {
                const vm = this;
                if (vm.sizes_colors.length < 5) {
                    vm.sizes_colors.push({
                        colors: '',
                        colorstamp: '',
                        sizes: ['']
                    });
                }
            },
            delcolors() {
                const vm = this;
                if (vm.sizes_colors.length > 1) {
                    vm.sizes_colors.pop();
                }
            },
            // 新增照片數量
            addphotos() {
                const vm = this;
                if (vm.photos < 5) {
                    vm.photos++;
                }
            },
            delphotos() {
                const vm = this;
                if (vm.photos > 1) {
                    vm.photos--;
                }
            },
            checkfile_exe(event, index) {
                const vm = this;
                const file = event.target.files[0];
                if (file) {
                    const filetype = file.type;
                    console.log(filetype);
                    if (filetype == "image/jpeg" || filetype == "image/png") {
                        vm.invalidFiles[index] = true;
                    } else {
                        vm.invalidFiles[index] = false;
                    }
                }
                vm.photo.push(file);
            },
            clearspace() {
                const vm = this;
                vm.newproduct.introduction = vm.newproduct.introduction.replace(/\s+/g, "");
            },
            handleSubmit() {
                const vm = this;

                let productName_flag=false, price_flag=false, quantity_flag=false, introduction_flag=false, color_size_flag=false,  photo_flag=false;

                const product = vm.newproduct;
                // 品名
                productName_flag = product.productName.trim() !== '';
                // 價格
                price_flag = product.price > 0;
                // 數量
                quantity_flag = product.quantity > 0;
                // 介紹
                introduction_flag = product.introduction.trim() !== '';
                // 顏色尺寸
                color_size_flag = vm.sizes_colors.every(item => {
                    return item.colors.trim() !== '' && item.colorstamp.trim() !== '' && item.colorstamp.trim().startsWith('#') && item.colorstamp.trim().length == 7 && item.sizes.every(size => size.trim() !== '');
                });
                // 照片
                photo_flag = vm.invalidFiles.every(isValid => isValid);

                if (productName_flag && price_flag && quantity_flag && introduction_flag && color_size_flag && photo_flag) {
                    const formData = new FormData();
                    formData.append("product", JSON.stringify(vm.newproduct));
                    formData.append("color_size", JSON.stringify(vm.sizes_colors));

                    vm.photo.forEach((file, index) => {
                        formData.append('photo[]', file);
                    });

                    axios.post(apiurl + "insertproduct", formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            console.log(response.data);
                            if(response.data.state == true){
                                swal2("新增成功", "", "success", "確定", true, vm.review, false);
                            }else{
                                swal2("新增失敗", "", "error");
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                }else{
                    swal2("請檢查是否有未填寫的內容", "開幾個格子就填幾個", "warning", "", false, ()=>{}, true);
                }
            },
            review(){
                const vm = this;
                window.location.href = "/product/list.php?seriesId=" + vm.seriesId + "&producttypeId=" + vm.producttypeId + "&seriesname=" + vm.seriesName + "&typename=" + vm.producttypeName;
            }
        }
    };
    Vue.createApp(add).mount("#add");
</script>

<?php
$js_content = ob_get_clean();
include("../template.php");
?>