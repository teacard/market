<?php
$title = "購物車";
ob_start();
?>

<style>
    .content {
        width: 50%;
    }

    .content .orderdata {
        width: 100%;
        height: auto;
    }

    .content .orderdata .howtoswnd,
    .to,
    .whereget,
    .discounts,
    .invoice {
        margin-top: 1rem;
        border-radius: 10px;
        border: var(--color000000) solid 1px;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .content .orderdata .htitle,
    .ttitle,
    .wtitle,
    .dtitle,
    .ititle {
        border-bottom: var(--color000000) solid 1px;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .content .orderdata .hcontent {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .content .orderdata .hcontent>div {
        width: 100%;
        margin-top: 25px;
        margin-bottom: 25px;
        text-align: center;
    }

    .content .orderdata .hcontent>div>div {
        height: 50px;
        display: flex;
        justify-self: center;
        align-items: center;
    }

    .content .orderdata .hcontent>div>div input {
        margin: 0;
    }

    .content .orderdata .hcontent>div>div label {
        margin-left: 0.5rem;
        font-size: 1rem;
    }

    .content .orderdata .tcontent {
        width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .content .orderdata .tcontent>div {
        display: inline-flex;
        width: 100%;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .content .orderdata .tcontent>div:not(:last-child) {
        border-bottom: var(--color000000) solid 1px;
    }

    .content .orderdata .tcontent>div label {
        color: var(--color666666);
        font-weight: 600;
    }

    /* other css */
    .form-check-input[type="radio"]:checked {
        background-color: var(--color333333);
        /* 被選中時的背景色 */
        border-color: var(--color333333);
        /* 邊框色 */
    }

    .form-check-input:focus {
        box-shadow: none;
    }

    hr {
        width: 100%;
        margin: 0;
        opacity: 1;
        background-color: var(--color000000);
    }

    h3 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
    }

    .orderdata .form-control {
        background-color: transparent;
        border: none;
        border-radius: 0px;
        color: var(--color333333);
        padding: 0;
        width: auto;
        text-align: center;
    }

    .orderdata .form-control:focus {
        background-color: transparent;
        box-shadow: none;
        border-color: var(--color333333);
    }
</style>

<?php
$css = ob_get_clean();
ob_start();
?>

<div class="orderdata" id="orderdata">
    <div class="howtoswnd">
        <div class="htitle">
            <h3 class="text-center" style="color: var(--color000000);">付款與運送方式</h3>
        </div>
        <div class="hcontent">
            <div class="sevenelevenBox text-center">
                <div class="">
                    <input type="radio" name="send" id="seveneleven" class="form-check-input">
                    <label for="seveneleven">711-貨到付款</label>
                </div>
            </div>
            <hr>
            <div class="ATMBox">
                <div class="">
                    <input type="radio" name="send" id="ATM" class="form-check-input">
                    <label for="ATM">ATM-轉帳宅配到家</label>
                </div>
            </div>
            <hr>
            <div class="onlineCashToHomeBox">
                <div class="">
                    <input type="radio" name="send" id="onlineCashToHome" class="form-check-input">
                    <label for="onlineCashToHome">線上刷卡-宅配到家</label>
                </div>
            </div>
            <hr>
            <div class="onlineCashToSevenBox">
                <div class="">
                    <input type="radio" name="send" id="onlineCashToSeven" class="form-check-input">
                    <label for="onlineCashToSeven">線上刷卡-711取貨</label>
                </div>
            </div>
        </div>
    </div>
    <div class="to">
        <div class="ttitle">
            <h3>訂購人資訊</h3>
        </div>
        <div class="tcontent">
            <div class="namebox">
                <label for="name">姓名</label>
                <input type="text" name="name" id="" placeholder="王小名" class="form-control" required>
            </div>
            <div class="telbox">
                <label for="tel">電話</label>
                <input type="tel" name="name" id="" placeholder="輸入手機號碼" class="form-control" required>
            </div>
            <div class="otherbox">
                <label for="other">備註</label>
                <input type="text" name="other" id="" class="form-control" placeholder="其他需求" required>
            </div>
        </div>
    </div>
    <div class="whereget">
        <div class="wtitle">
            <h3>取貨資訊</h3>
        </div>
        <div class="wcontent">
            <div class="getaddbox">
                <label for="getadd">取貨地址</label>
                <input type="text" name="getadd" id="" class="form-control" placeholder="請輸入取貨地址" required>
            </div>
        </div>
    </div>
    <div class="discounts">
        <div class="dtitle">
            <h3>優惠折扣碼</h3>
        </div>
        <div class="dcontent">
            <div class="discountsbox">
                <label for="discounts">優惠折扣碼</label>
                <input type="text" name="discounts" id="" class="form-control" placeholder="請輸入優惠折扣碼" required>
            </div>
        </div>
    </div>
    <div class="invoice">
        <div class="ititle">
            <h3>發票類型</h3>
            <a href="https://emap.pcsc.com.tw/ecmap/default.aspx">選擇 7-11 門市</a>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>

<script>
    function openCvsMap() {
    }
</script>

<script>
    const orderdata = {
        data() {
            return {
                Id: '',
                tt: 1,
            }
        },
        created() {
            const vm = this;
            const urlparams = new URLSearchParams(window.location.search);
            vm.Id = getCookie('id');
        },
        methods: {}
    }
    Vue.createApp(orderdata).mount("#orderdata");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>