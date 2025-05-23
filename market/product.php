<?php
$title = "商品分類";
ob_start();
?>

<style>
    .big-product {
        width: 100%;
        height: 100%;
    }

    .big-product .back a {
        text-decoration: none;
        color: var(--color333333);
    }

    .product {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        width: 100%;
        height: 100%;
    }

    .product .photo {
        width: 50%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .product .photo .bigphoto {
        height: 80%;
        flex-shrink: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product .photo .otherphoto .leftbutton,
    .rightbutton {
        width: 10%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }

    .product .photo .otherphoto .leftbutton i,
    .rightbutton i {
        width: 100%;
        height: auto;
        font-size: 2.5rem;
        text-align: center;
    }

    .product .photo .bigphoto .img {
        max-width: 500px;
        height: 100%;
        overflow: hidden;
        background-color: var(--color000000);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product .photo .bigphoto .img img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        /* 保持圖片比例，不會被裁切 */
    }

    .product .photo .otherphoto {
        width: 100%;
        height: 20%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1rem;
    }

    .product .photo .otherphoto .allphoto {
        width: 250px;
        overflow: hidden;
        display: block;
    }

    .product .photo .otherphoto .allphoto .photo-container {
        display: flex;
        transition: transform 0.5s ease-in-out;
        width: max-content;
    }


    .product .photo .otherphoto .allphoto .photo-container div {
        width: 75px;
        height: 75px;
        background-size: cover;
        background-position: center;
        margin: 5px;
        cursor: pointer;
        flex-shrink: 0;
        /* 防止小圖片縮小 */
    }

    .product .photo .otherphoto .allphoto div.selected {
        box-shadow: inset 0 0 0 3px var(--color999999);
    }

    .product .text {
        width: 50%;
        height: 100%;
        margin-left: 1rem;
    }

    .product .text .title {
        border-bottom: var(--color333333) 2px solid;
        height: 150px;
    }

    .product .text .title .display-5 {
        font-weight: 500;
    }

    .product .text .title .productId,
    .price {
        color: var(--color333333);
        margin-top: 0.25rem;
    }

    .product .text .color {
        width: 100%;
        margin-top: 1rem;
        height: 250px;
    }

    .product .text .color .colortitle {
        font-weight: 500;
    }

    .product .text .color .content {
        margin-top: 1rem;
        margin-left: 0px;
        width: 100%;
    }

    .product .text .color .row .col-md-4 {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .product .text .color .row:nth-child(n+2) .col-md-4 {
        margin-top: 10px;
    }

    .product .text .color .content .col-md-4 .colors {
        width: 75px;
        height: 75px;
        border: var(--color000000) 1px solid;
    }

    .product .text .color .content .col-md-4 .colors.selected {
        border: var(--color999999) 3px solid;
    }

    .product .text .size {
        width: 100%;
        margin-top: 1rem;
        height: 250px;
    }

    .product .text .sizetitle {
        font-weight: 500;
    }

    .product .text .size .content {
        margin-top: 1rem;
        margin-left: 0;
        width: 100%;
    }

    .product .text .size .row:nth-child(n+2) .col-md-4 {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
    }

    .product .text .size .content .sizes {
        width: 80px;
        height: 55px;
        border: var(--color000000) 1px solid;
        border-radius: 5px;
    }

    .product .text .size .content .sizes button {
        padding: 0;
        width: 100%;
        height: 100%;
    }

    .product .text .size .content .sizes button.selected {
        background-color: var(--color333333);
        color: var(--colorececec);
    }

    .product .text .other {
        margin-top: 1rem;
    }

    .product .text .row {
        margin-left: 0;
    }

    .product .text .other .col-md-6 {
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<?php
$css = ob_get_clean();
ob_start();
?>

<div class="big-product" id="product">
    <div class="back mt-3">
        <a :href="'/series_type.php?seriesId=' + product[0].SeriesId + '&typeId=' + product[0].TypeId">
            <i class="fa-solid fa-chevron-left"></i>回上頁
        </a>
    </div>
    <div class="product">
        <div class="photo">
            <div class="bigphoto">
                <div class="img">
                    <img :src="currentPhoto" alt="" class="">
                </div>
            </div>

            <div class="otherphoto">
                <div class="leftbutton" @click="prevPhotos"><i class="fa-solid fa-chevron-left"></i></div>
                <div class="allphoto">
                    <div class="photo-container" ref="photoContainer">
                        <div v-for="(pitem, pkey) in product[0].photo" :style="{ backgroundImage: `url(${pitem.photoPath})` }" @click="setBigPhoto(pitem.photoPath)" :class="{ selected: currentPhoto === pitem.photoPath }">
                        </div>
                    </div>
                </div>
                <div class="rightbutton" @click="nextPhotos"><i class="fa-solid fa-chevron-right"></i></div>
            </div>
        </div>
        <div class="text" v-for="(pitem, pkey) in product">
            <div class="title">
                <div class="display-5">{{ pitem.ProductName }}</div>
                <div class="productId">商品編號：{{ pitem.Id }}</div>
                <div class="price text-end">NT. <span class="text-danger" style="font-size: 1.5rem;">{{ pitem.Price }}</span>元</div>
            </div>
            <div class="color">
                <div class="colortitle display-5">顏色</div>
                <div class="content row">
                    <div class="col-md-4" v-for="(citem, ckey) in pitem.color">
                        <div class="colors" :style="'background-color: ' + citem.ColorSample + ';'" :class="{ 'selected' : colorkey === ckey }" @click="changecolor(ckey, citem.Id)">
                        </div>
                    </div>
                </div>
            </div>
            <div class="size">
                <div class="sizetitle display-5">尺寸</div>
                <div class="content row">
                    <div class="col-md-4" v-for="(sitem, skey) in pitem.color[colorkey].size">
                        <div class="sizes" @click="changesize(sitem.Id)">
                            <button type="button" class="btn" :class="{ 'selected' : sId === sitem.Id }">{{ sitem.Size }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="other row">
                <div class="col-md-6">
                    <div class="input-group d-flex justify-content-center">
                        <span class="input-group-text" @click="minus" style="background-color: #D9D9D9; color: var(--color333333); border: 1px solid var(--color000000);"><i class="fa-solid fa-minus"></i></span>
                        <input type="number" name="" id="" class="form-control text-center" min="1" max="99" v-model="many" style="background-color: var(--colorececec); color: var(--color333333); border: 1px solid var(--color000000); max-width: 100px">
                        <span type="button" class="input-group-text" @click="add" style="background-color: #D9D9D9; color: var(--color333333); border: 1px solid var(--color000000);"><i class="fa-solid fa-plus"></i></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-dark" @click="addcart">加入購物車</button>
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
    const product = {
        data() {
            return {
                Id: '',
                product: [{
                    color: [{
                        size: []
                    }],
                    photo: []
                }], // 預設為空陣列，避免 `undefined` 錯誤
                currentPhoto: '',
                currentIndex: 0, // 控制小圖顯示的第一張索引
                photoWidth: 75, // 小圖片的寬度
                margin: 5, // 每張小圖片的 margin
                colorkey: 0,
                cId: '',
                sId: '',
                many: 1,
            }
        },
        watch: {
            many(item) {
                const vm = this;
                if (item > 99) {
                    vm.many = 99;
                }
                if (item < 1 || vm.sId == '') {
                    vm.many = 1;
                }
            },
            sId(item) {
                const vm = this;
                vm.many = 1;
            }
        },
        created() {
            const vm = this;
            const urlparams = new URLSearchParams(window.location.search);
            vm.Id = urlparams.get('product');
            axios.get(apiurl + 'getproduct', {
                    params: {
                        id: vm.Id
                    }
                })
                .then(response => {
                    // console.log(response);
                    if (response.data.state == true) {
                        vm.product = response.data.data;
                        vm.currentPhoto = photourl + response.data.data[0].photo[0].photoPath;
                        vm.cId = response.data.data[0].color[0].Id;
                        vm.product.forEach((item, key) => {
                            item.photo.forEach((pitem, pkey) => {
                                pitem.photoPath = photourl + pitem.photoPath;
                            });
                        });
                    } else {
                        console.log("搜尋失敗");
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            setBigPhoto(photoPath) {
                const vm = this;
                vm.currentPhoto = photoPath;
            },
            nextPhotos() {
                // 每次向右移動 1 張圖片 + margin 的距離
                if (this.currentIndex < this.product[0].photo.length - 3) {
                    this.currentIndex++;
                    this.updateTransform();
                }
            },
            prevPhotos() {
                // 每次向左移動 1 張圖片 + margin 的距離
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                    this.updateTransform();
                }
            },
            updateTransform() {
                // 根據 currentIndex 計算位移
                const transformValue = -this.currentIndex * this.moveDistance;
                const allphoto = this.$refs.photoContainer;
                allphoto.style.transform = `translateX(${transformValue}px)`;
            },
            changecolor(key, cId) {
                const vm = this;
                vm.colorkey = key;
                vm.cId = cId;
                vm.sId = null;
            },
            changesize(sId) {
                const vm = this;
                vm.sId = sId;
            },
            minus() {
                const vm = this;
                if (vm.many > 1) {
                    vm.many--;
                }
            },
            add() {
                const vm = this;
                if (vm.many < 99) {
                    vm.many++;
                }
            },
            addcart() {
                const vm = this;
                const keyA = getCookie('keyA') ?? '';
                const keyB = getCookie('keyB') ?? '';
                const pid = vm.product[0].Id ?? '';
                const cid = vm.cId ?? '';
                const sid = vm.sId ?? '';
                const many = vm.many ?? '';
                if (keyA != '' && keyB != '' && pid != '' && cid != '' && sid != '' && many != '') {
                    axios.post(apiurl + 'addcart', {
                            keyA: keyA,
                            keyB: keyB,
                            productid: pid,
                            colorid: vm.cId,
                            sizeid: vm.sId,
                            many: vm.many,
                        })
                        .then(response => {
                            console.log(response.data);
                            if (response.data.state == true) {
                                swal2("新增成功", "已加入購物車", "success", '', false, () => {}, true);
                            } else {
                                swal2("新增失敗", "請重新嘗試", "error", '', false, () => {}, true);
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else {
                    swal2("新增失敗", "至少選擇一個顏色及尺寸，數量最小為1", "error", '', false, () => {}, true);
                }

            }
        },
        computed: {
            moveDistance() {
                // 計算每次移動的距離（每張圖片寬度 + margin）
                return this.photoWidth + this.margin * 2;
            }
        },
    }
    Vue.createApp(product).mount("#product");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>