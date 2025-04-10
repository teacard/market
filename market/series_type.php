<?php
$title = "商品分類";
ob_start();
?>

<style>
    .product {
        margin-top: 1rem;
    }

    .product .row {
        cursor: pointer;
    }

    .product .row .col-6 .card {
        background-color: transparent;
        border: none;
    }

    .product .row .col-6 .card .card-title p {
        color: var(--color333333);
        font-weight: 800;
        margin-bottom: 0px;
        font-size: calc(100% + 1vw);
    }

    .product .row .col-6 .card .card-body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product .row .col-6 .card .card-body .row {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: stretch;
    }

    .product .row .col-6 .card .card-body .row .col-4 {
        aspect-ratio: 1 / 1;
        padding-left: 0;
        padding-right: 0;
        width: 30%;
        height: 30%;
        max-width: 50px;
        max-height: 50px;
    }

    .product .row .col-6 .card .card-body .row .col-4 .color-sample {
        border: var(--color000000) 1px solid;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product .row .col-6 .card .card-body .row .col-12 {
        width: 100%;
        height: 75px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product .row .col-6 .card .card-body .row .col-12 p {
        margin: 0;
        font-size: calc(100% + 1vw);
    }
</style>

<?php
$css = ob_get_clean();
ob_start();
?>

<div class="product" id="product">
    <div class="row">
        <div class="col-6 col-md-4" v-for="(pitem, pkey) in product">
            <div class="card" @click="toproduct(pitem.Id)">
                <img :src="'http://122.117.32.6:83/' + pitem.photo[0].photoPath" alt="" class="card-img-top">
                <div class="card-title">
                    <p class="text-center align-middle">{{ pitem.ProductName }}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4" v-for="(citem, ckey) in pitem.color">
                            <div class="color-sample" style="width: 100%; height: 100%;" :style="'background-color: ' + citem.ColorSample + ';'"></div>
                        </div>
                        <div class="col-12">
                            <p>NT. {{ pitem.Price }}</p>
                        </div>
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
    const product = {
        data() {
            return {
                seriesId: '',
                typeId: '',
                product: '',
            }
        },
        created() {
            const vm = this;
            const urlparams = new URLSearchParams(window.location.search);
            vm.seriesId = urlparams.get('seriesId');
            vm.typeId = urlparams.get('typeId');
            axios.get(apiurl + 'getseries_type_product', {
                    params: {
                        seriesId: vm.seriesId,
                        typeId: vm.typeId
                    }
                })
                .then(response => {
                    console.log(response);
                    if (response.data.state == true) {
                        vm.product = response.data.data;
                    } else {
                        console.log("搜尋失敗");
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods:{
            toproduct(Id){
                window.location.href="/product.php?product=" + Id;
            }
        }
    }
    Vue.createApp(product).mount("#product");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>