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
$title = "修改商品顏色&尺寸";
ob_start();
?>

<div class="row w-100" id="edit">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">{{ seriesName }}-{{ producttypeName }}-新增商品照片</div>
            </div>
        </div>
        <div class="card-body mt-3 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <a :href="'/product/edit.php?seriesId=' + seriesId + '&producttypeId=' + productTypeId + '&seriesname=' + seriesName + '&typename=' + producttypeName + '&productId=' + productId" class="btn btn-primary">回上頁</a>
                    </div>
                </div>
                <div class="col-12 col-md-10 mt-3 row">
                    <div class="col-6 text-color333333 fw-400">顏色 {{ color }}</div>
                    <div class="col-6">
                        <input type="text" id="" class="form-control" placeholder="黑色" v-model="color">
                    </div>
                </div>
                <div class="col-12 col-md-10 mt-3 row">
                    <div class="col-6 text-color333333 fw-400">色表(16進位制)</div>
                    <div class="col-6">
                        <input type="text" id="" class="form-control" placeholder="#000000" v-model="colorsample">
                    </div>
                </div>
                <template v-for="(size, sizeIndex) in sizes" :key="sizeIndex">
                    <div class="col-12 col-md-10 mt-3 row">
                        <div class="col-3 text-color333333 fw-500">尺寸 {{ sizeIndex+1 }}</div>
                        <div class="col-9">
                            <input type="text" :name="'size' + sizeIndex" id="" class="form-control" placeholder="M , 31" v-model="sizes[sizeIndex].Size">
                        </div>
                    </div>
                </template>
                <template v-for="(size, sizeIndex) in newsizes" :key="sizeIndex">
                    <div class="col-12 col-md-10 mt-3 row">
                        <div class="col-3 text-color333333 fw-500">尺寸 {{ sizeIndex+1 + sizes.length }}</div>
                        <div class="col-9">
                            <input type="text" :name="'size' + sizeIndex" id="" class="form-control" placeholder="M , 31" v-model="newsizes[sizeIndex].Size">
                        </div>
                    </div>
                </template>
                <div class="col-12 col-md-10 mt-5">
                    <div class="d-flex justify-content-center row">
                        <button type="button" class="btn col-3 me-3" style="color: #ececec; background: #666666" @click="addsize" v-if="sizes != 5">新增尺寸</button>
                        <button type="button" class="btn col-3" style="color: #ececec; background: #666666" @click="delsize" v-if="sizes != 1">刪減尺寸</button>
                    </div>
                </div>
                <div class="col-12 col-md-10 mt-5 text-center">
                    <button type="button" class="btn btn-primary" @click="addphoto()">送出</button>
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
                productTypeId: '',
                producttypeName: '',
                colorId: '',
                color: '',
                colorsample: '',
                sizes: [],
                delsizes: [],
                newsizes: [],
            }
        },
        watch: {

        },
        // at web create to do
        created() {
            const vm = this;
            // get msg for url
            const urlparams = new URLSearchParams(window.location.search);
            vm.seriesName = urlparams.get('seriesname');
            vm.seriesId = urlparams.get('seriesId');
            // get msg for url
            vm.productTypeId = urlparams.get('producttypeId');
            vm.producttypeName = urlparams.get('typename');
            vm.productId = urlparams.get('productId');
            vm.colorId = urlparams.get('colorId');
            vm.color = urlparams.get('color');
            vm.colorsample = decodeURIComponent(urlparams.get('colorsample'));
            vm.sizes = JSON.parse(decodeURIComponent(urlparams.get('size')));

            // get products from localstorage
            vm.series_producttype_products = JSON.parse(localStorage.getItem('sendproduct'));
        },
        methods: {
            // 新增顏色內的尺寸數量
            addsize() {
                const vm = this;
                if (vm.newsizes.length + vm.sizes.length < 5) {
                    vm.newsizes.push({
                        ProductColorId: vm.colorId,
                        Size: ''
                    });
                } else {
                    swal2("最多五個尺寸", "", "warning", "", false, () => {}, true);
                }
            },
            delsize() {
                const vm = this;
                if (vm.newsizes.length + vm.sizes.length > 1) {
                    if (vm.newsizes.length > 0) {
                        vm.newsizes.pop();
                    } else {
                        vm.delsizes.push(vm.sizes[vm.sizes.length - 1].Id);
                        vm.sizes.pop();
                    }
                } else {
                    swal2("最少一個尺寸", "", "warning", "", false, () => {}, true);
                }
            },
            addphoto() {
                const vm = this;
                // 照片
                let color_flag = vm.color.trim() !== '';
                let colorsample_flag = vm.colorsample.trim().startsWith("#") && vm.colorsample.trim().length == 7;
                let size_flag = vm.sizes.every(item => item.Size.trim() !== '');

                if (color_flag && colorsample_flag && size_flag) {
                    axios.post(apiurl + 'updateproductsize', {
                            colorid: vm.colorId,
                            color: vm.color,
                            colorsample: vm.colorsample,
                            updatesize: vm.sizes,
                            delsize: vm.delsizes,
                            newsize: vm.newsizes
                        }, {
                            'Content-Type': 'application/json'
                        })
                        .then(response => {
                            if (response.data.state == true) {
                                console.log(response.data);
                                swal2("修改成功", "", "success", "確定", true, () => {}, false);
                            } else {
                                console.log(response);
                                swal2("修改失敗", "", "error", "", false, () => {}, true);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        })
                } else {
                    swal2("請檢查是否有未填寫的內容或填寫錯誤", "開幾個格子就填幾個", "warning", "", false, () => {}, true);
                }
            },
            review() {
                const vm = this;
                window.location.href = "/product/edit.php?seriesId=" + vm.seriesId + "&producttypeId=" + vm.productTypeId + "&seriesname=" + vm.seriesName + "&typename=" + vm.producttypeName + "&productId=" + vm.productId;
            }
        }
    };
    Vue.createApp(edit).mount("#edit");
</script>

<?php
$js_content = ob_get_clean();
include("../../template.php");
?>