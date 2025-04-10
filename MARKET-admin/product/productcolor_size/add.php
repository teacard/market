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
$title = "新增商品照片";
ob_start();
?>

<div class="row w-100" id="edit">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">{{ seriesName }}-{{ producttypeName }}-新增商品顏色&尺寸</div>
            </div>
        </div>
        <div class="card-body mt-3 mx-auto">
            <div class="row d-flex justify-content-center">
                <template v-for="(item, index) in sizes_colors" :key="index">
                    <div class="col-12 col-md-10 mt-3 row">
                        <div class="col-3 text-color333333 fw-500">顏色 {{ index+1 }}</div>
                        <div class="col-9">
                            <input type="text" :name="'color' + index" id="" class="form-control" placeholder="黑色" v-model="sizes_colors[index].color">
                        </div>
                    </div>
                    <div class="col-12 col-md-10 mt-3 row">
                        <div class="col-3 text-color333333 fw-500">色表(16進位制)</div>
                        <div class="col-9">
                            <input type="text" :name="'colorsample' + index" id="" class="form-control" placeholder="#000000" v-model="sizes_colors[index].colorsample">
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
                        <button type="button" class="btn col-3" style="color: #ececec; background: #666666" @click="addcolors" v-if="sizes_colors.length != 5 - colorlength" :class="{ 'me-3' : sizes_colors.length != 1}">新增顏色</button>
                        <button type="button" class="btn col-3" style="color: #ececec; background: #666666" @click="delcolors" v-if="sizes_colors.length != 1">刪減顏色</button>
                    </div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" @click="addproductcolor">送出</button>
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
                // old data
                seriesId: '',
                seriesName: '',
                productId: '',
                productTypeId: '',
                producttypeName: '',
                colorlength: '',
                sizes_colors: [{
                    color: '',
                    colorsample: '',
                    sizes: [''],
                }],
                color_flag: false,
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
            vm.colorlength = urlparams.get('photolength');
        },
        methods: { // 新增顏色內的尺寸數量
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
                if (vm.sizes_colors.length < 5 - vm.colorlength) {
                    vm.sizes_colors.push({
                        color: '',
                        colorsample: '',
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
            addproductcolor() {
                const vm = this;
                vm.color_flag = vm.sizes_colors.every(item => {
                    return item.color.trim() !== '' && item.colorsample.trim() !== '' && item.colorsample.trim().startsWith('#') && item.colorsample.trim().length == 7 && item.sizes.every(size => size.trim() !== '');
                });
                // 顏色尺寸
                if (vm.color_flag) {
                    axios.post(apiurl + "addproductcolor", {
                            productId: vm.productId,
                            color_size: vm.sizes_colors
                        }, {
                            'Content-Type': 'multipart/form-data'
                        })
                        .then(response => {
                            console.log(response.data);
                            if (response.data.state == true) {
                                swal2("新增完成", "", "success", "確認", true, vm.review, false);
                            } else {
                                swal2("新增失敗", "", "error", "", false, () => {}, true);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else {
                    swal2("請檢查是否有未填寫的內容", "開幾個格子就填幾個", "warning", "", false, () => {}, true);
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