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
                        <button type="button" class="btn col-3 me-3" style="color: #ececec; background: #666666" @click="addphotos" v-if="photos != 5-photolength">新增照片</button>
                        <button type="button" class="btn col-3" style="color: #ececec; background: #666666" @click="delphotos" v-if="photos != 1">刪減照片</button>
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
                photos: 1,
                invalidFiles: [false],
                photo: [],
                photolength: '',
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
            vm.photolength = urlparams.get('photolength');

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
            // 新增照片數量
            addphotos() {
                const vm = this;
                if (vm.photos < 5 - vm.photolength) {
                    vm.photos++;
                    vm.invalidFiles.push(false);
                }
            },
            delphotos() {
                const vm = this;
                if (vm.photos > 1) {
                    vm.photos--;
                    vm.invalidFiles.pop();
                }
            },
            addphoto() {
                const vm = this;
                // 照片
                let photo_flag = vm.invalidFiles.every(isValid => isValid);
                if (photo_flag) {
                    const formData = new FormData();
                    formData.append("productId", vm.productId);
                    vm.photo.forEach((file, index) => {
                        formData.append('photo[]', file);
                    });
                    axios.post(apiurl + "addproductphoto", formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
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