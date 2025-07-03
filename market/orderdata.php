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

    .content .orderdata .wcontent {
        width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .content .orderdata .wcontent>div {
        width: 100%;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .content .orderdata .wcontent>div:not(:last-child) {
        border-bottom: var(--color000000) solid 1px;
    }

    .content .orderdata .wcontent>div label {
        color: var(--color666666);
        font-weight: 600;
    }

    .content .orderdata .dcontent {
        width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .content .orderdata .dcontent>div {
        width: 100%;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .content .orderdata .dcontent>div:not(:last-child) {
        border-bottom: var(--color000000) solid 1px;
    }

    .content .orderdata .dcontent>div label {
        color: var(--color666666);
        font-weight: 600;
    }

    .content .orderdata .icontent {
        width: 100%;
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .content .orderdata .icontent>div {
        width: 100%;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .send-button {
        border: 1px solid var(--color000000);
        color: var(--color333333);
    }

    .send-button:hover {
        background-color: var(--color333333);
        color: var(--colorececec);
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
        border: none;
        border-width: 1px;
        border-style: inset;
    }

    h3 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
    }

    .row {
        --bs-gutter-x: 0rem;
    }

    .orderdata .form-control {
        background-color: transparent;
        border: none;
        border-radius: 0px;
        color: var(--color333333);
        padding: 0;
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
    <form action="" method="post" @submit.prevent="submitForm">
        <div class="howtoswnd">
            <div class="htitle">
                <h3 class="text-center" style="color: var(--color000000);">付款與運送方式</h3>
            </div>
            <div class="hcontent">
                <div class="sevenelevenBox text-center">
                    <div class="">
                        <input type="radio" name="send" id="seveneleven" class="form-check-input" value="0" v-model="howSend" required>
                        <label for="seveneleven">711-貨到付款</label>
                    </div>
                </div>
                <hr>
                <div class="ATMBox">
                    <div class="">
                        <input type="radio" name="send" id="ATM" class="form-check-input" value="1" v-model="howSend">
                        <label for="ATM">ATM-轉帳宅配到家</label>
                    </div>
                </div>
                <hr>
                <div class="onlineCashToHomeBox">
                    <div class="">
                        <input type="radio" name="send" id="onlineCashToHome" class="form-check-input" value="3" v-model="howSend">
                        <label for="onlineCashToHome">線上刷卡-宅配到家</label>
                    </div>
                </div>
                <hr>
                <div class="onlineCashToSevenBox">
                    <div class="">
                        <input type="radio" name="send" id="onlineCashToSeven" class="form-check-input" value="2" v-model="howSend">
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
                    <div class="row">
                        <div class="col-3 text-center">
                            <label for="name">姓名</label>
                        </div>
                        <div class="col-9 text-center">
                            <input type="text" name="name" id="" placeholder="王小名" class="form-control" v-model="name" pattern="^[\u4e00-\u9fa5]{3}$" required>
                        </div>
                    </div>
                </div>
                <div class="telbox">
                    <div class="row">
                        <div class="col-3 text-center">
                            <label for="tel">電話</label>
                        </div>
                        <div class="col-9 text-center">
                            <input type="tel" name="name" id="" placeholder="0912345678" class="form-control" v-model="tel" pattern="09\d{8}" required>
                        </div>
                    </div>
                </div>
                <div class="otherbox">
                    <div class="row">
                        <div class="col-3 text-center">
                            <label for="other">備註</label>
                        </div>
                        <div class="col-9 text-center">
                            <input type="text" name="other" id="" class="form-control" placeholder="其他需求" v-model="other">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="whereget" v-if="howSend % 2 == 0 && howSend != null">
            <div class="wtitle">
                <h3>取貨資訊</h3>
            </div>
            <div class="wcontent">
                <div class="getaddbox">
                    <div class="row">
                        <div class="col-3 text-center">
                            <label for="getadd">取貨地址</label>
                        </div>
                        <div class="col-6 text-center">
                            <input type="text" name="getadd" id="" class="form-control" placeholder="請選擇取貨門市" v-model="store.storename" disabled>
                        </div>
                        <div class="col-3 text-center">
                            <p @click="openMap" style="margin: 0px; text-decoration: underline; cursor: pointer; display: inline-block;">選擇門市</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="whereget" v-if="howSend % 2 == 1 && howSend != null">
            <div class="wtitle">
                <h3>取貨資訊</h3>
            </div>
            <div class="wcontent">
                <div class="getaddbox">
                    <div class="row">
                        <div class="col-3 text-center my-auto">
                            <label for="getadd">取貨地址</label>
                        </div>
                        <div class="col-9 row">
                            <div class="col-6 row">
                                <div class="col-4 text-center my-auto">
                                    選擇縣市
                                </div>
                                <div class="col-8 text-center">
                                    <select name="" id="" class="form-select text-center" v-model="city" @change="handleCityChange" required>
                                        <option :value="citem.CityName" v-for="(citem, ckey) in cityData" :key="ckey">{{ citem.CityName }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 row">
                                <div class="col-4 text-center my-auto">
                                    選擇鄉鎮
                                </div>
                                <div class="col-8 text-center">
                                    <select name="" id="" class="form-select text-center" v-model="country" required>
                                        <option :value="citem.AreaName" v-for="(citem, ckey) in countyData" :key="ckey">{{ citem.AreaName }}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12 mt-2 text-center">
                                <input type="text" name="getadd" id="" class="form-control" placeholder="請輸入地址" v-model="add" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="discounts">
            <div class="dtitle">
                <h3>優惠折扣碼</h3>
            </div>
            <div class="dcontent">
                <div class="discountsbox">
                    <div class="row">
                        <div class="col-3 text-center">
                            <label for="discounts">優惠折扣碼</label>
                        </div>
                        <div class="col-6 text-center">
                            <input type="text" name="discounts" id="" class="form-control" placeholder="請選擇優惠券" v-model="discount.DiscountValue" readonly>
                        </div>
                        <div class="col-3 text-center">
                            <p @click="openDiscount" style="margin: 0px; text-decoration: underline; cursor: pointer; display: inline-block;">選擇優惠券</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="invoice">
            <div class="ititle">
                <h3>最後一步</h3>
            </div>
            <div class="icontent">
                <div class="needknow">
                    <i style="cursor: pointer;" :class="needknow_check ? 'fa-solid fa-circle-check' : 'fa-regular fa-circle'" @click="needknow_check=!needknow_check"></i>
                    <span style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#exampleModal">我已詳細閱讀並同意「會員權益聲明」</span>
                </div>
                <div class="send text-end">
                    <button type="submit" class="btn send-button">送出訂單</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">會員權益聲明</h5>
            </div>
            <div class="modal-body">
                <section>
                    <p>
                        歡迎您加入「買齊 MARKET」購物平台（以下簡稱本平台）會員。在您註冊成為會員並使用本平台所提供的服務之前，請詳閱以下會員權益聲明與使用規則，當您註冊成功，即表示您已詳閱、理解並同意以下條款：
                    </p>

                    <h3>一、會員基本權益</h3>
                    <ul>
                        <li>免費加入會員：本平台提供免費會員制度，凡填寫真實資料並完成註冊程序者，即可成為正式會員。</li>
                        <li>會員等級制度：
                            <ul>
                                <li>依據消費金額或累計訂單數可自動升等。</li>
                                <li>不同等級享有不同折扣、專屬優惠、生日禮、限量活動等專屬權益。</li>
                            </ul>
                        </li>
                        <li>會員專區功能：可查詢訂單、編輯個人資料、管理收件地址、追蹤喜愛商品、接收促銷訊息等。</li>
                        <li>促銷與活動參與：會員可優先參加限時折扣、抽獎活動、會員日等專屬活動。</li>
                    </ul>

                    <h3>二、個人資料保護與使用</h3>
                    <ul>
                        <li>個資保護承諾：本平台依照《個人資料保護法》妥善保護會員所提供之所有個人資料，絕不會在未經本人同意的情況下洩露予第三方。</li>
                        <li>資料使用範圍：
                            <ul>
                                <li>會員識別與登入認證。</li>
                                <li>訂單處理、客服聯繫與物流配送。</li>
                                <li>行銷資訊提供（可選擇是否接收）。</li>
                            </ul>
                        </li>
                        <li>資料更新與刪除：會員可隨時登入修改個人資料，如欲終止帳號並刪除個人資料，可透過客服申請。</li>
                    </ul>

                    <h3>三、訂單與退換貨規範</h3>
                    <ul>
                        <li>訂單成立與取消：
                            <ul>
                                <li>訂單於完成付款後即視為成立。</li>
                                <li>訂單成立後不得自行取消，若需異動請聯繫客服。</li>
                            </ul>
                        </li>
                        <li>退換貨政策：
                            <ul>
                                <li>依《消費者保護法》，會員享有商品到貨七日內之無條件退貨權益（非試用期）。</li>
                                <li>退換貨商品須為全新未使用、包裝完整。</li>
                                <li>某些商品如內衣褲、襪類、客製化商品恕不適用退貨規則（下單前將特別註明）。</li>
                            </ul>
                        </li>
                        <li>退款流程：經平台確認商品無誤後，款項將於 7–14 個工作天內退還至原支付方式。</li>
                    </ul>

                    <h3>四、會員使用規範</h3>
                    <ul>
                        <li>帳號使用責任：會員應妥善保管帳號與密碼，若有遭他人盜用，須立即通知本平台，平台將協助處理。</li>
                        <li>禁止行為：
                            <ul>
                                <li>假冒他人註冊、惡意下單或散布不實資訊。</li>
                                <li>利用平台從事違法或損害他人權益之行為。</li>
                                <li>干擾或破壞本平台系統之行為。</li>
                            </ul>
                        </li>
                        <li>違反規範處置：本平台有權暫停或終止違規帳號之服務，並保留法律追訴權。</li>
                    </ul>

                    <h3>五、聲明與免責事項</h3>
                    <ul>
                        <li>內容變更權利：本平台保留隨時修改會員權益聲明之權利，修改後不另行個別通知，將公告於平台首頁或會員專區。</li>
                        <li>服務中斷或故障：因系統維護、第三方服務異常、不可抗力因素（如天災、斷電）導致服務暫停或中斷，本平台將儘速修復，但不負任何賠償責任。</li>
                        <li>智慧財產權：平台上所有內容（含圖片、文字、介面設計）皆屬本平台所有或合法授權，未經同意不得任意使用。</li>
                    </ul>

                    <h3>六、客服與聯繫方式</h3>
                    <p>若會員對於本聲明或平台使用上有任何疑問，歡迎聯繫客服：</p>
                    <ul>
                        <li>客服信箱：chap39672@gmail.com</a></li>
                        <li>客服電話：0800-123-456</li>
                        <li>客服時間：週一至週五 09:00–18:00（國定假日除外）</li>
                    </ul>

                    <p><strong>請您定期查閱本會員權益聲明，以保障自身權益。</strong></p>
                </section>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
ob_start();
?>
<script>
    const orderdata = {
        data() {
            return {
                cityData: [],
                url: apiurl + 'get711store',
                store: {
                    storeid: 0,
                    storename: null,
                    storeaddress: null,
                },
                howSend: null,
                SendCh: null,
                discount: [],
                needknow_check: false,
                city: null,
                countyData: [],
                county: null,
                add: "",
                name: '',
                tel: '',
                other: '',
            }
        },
        created() {
            const vm = this;
            axios.get("/js/CityCountyData.json")
                .then(response => {
                    // console.log(response.data); // 拿到回傳資料
                    vm.cityData = response.data;
                })
                .catch(error => {
                    console.error("無法獲取城市資料：", error);
                });
        },
        watch: {
            howSend(newVal) {
                const vm = this;
                // 當 howSend 改變時，檢查是否為 0 或 1
                if (newVal % 2 == 1) {
                    vm.store.storename = null; // 清空門市名稱
                    vm.store.storeaddress = null; // 清空門市地址
                } else {
                    vm.city = null; // 清空縣市選擇
                    vm.country = null; // 清空鄉鎮選擇
                    vm.add = ""; // 清空地址輸入框
                }

                if(newVal == 0){
                    vm.SendCh = "711-貨到付款";
                }else if(newVal == 1){
                    vm.SendCh = "ATM-轉帳宅配到家";
                }else if(newVal == 2){
                    vm.SendCh = "線上刷卡-宅配到家";
                }else if(newVal == 3){
                    vm.SendCh = "線上刷卡-711取貨";
                }
            }
        },
        methods: {
            openMap() {
                // 開啟地圖的 URL
                const vm = this;
                const url = "https://emap.presco.com.tw/c2cemap.ashx?eshopid=870&servicetype=1&url=" + vm.url;
                window.open(url, "_blank");

                // 等待 callback.php 回傳訊息
                window.addEventListener("message", (event) => {
                    // 安全性檢查來源（視你的 domain 調整）
                    if (event.origin !== "http://localhost:83") return;

                    const data = event.data;
                    // console.log("收到門市資料：", data);
                    const name = decodeURIComponent(data.storename);
                    const address = decodeURIComponent(data.storeaddress);
                    vm.store.storeid = data.storeid; // 存到 Vue
                    vm.store.storename = name; // 存到 Vue
                    vm.store.storeaddress = address; // 存到 Vue
                });
            },
            openDiscount() {
                const vm = this;
                let keyA = getCookie("keyA");
                let keyB = getCookie("keyB");
                let url = "my-discount.php?url=" + encodeURIComponent(apiurl + "rollbackdiscount");
                window.open(url, "_blank");
                window.addEventListener("message", (event) => {
                    // 檢查來源
                    if (event.origin !== "http://localhost") return;

                    // 檢查資料是否為有效的優惠券資料
                    if (event.data && event.data.DiscountValue) {
                        // console.log("收到有效的優惠券資料：", event.data);
                        // 更新 Vue 的 discount 資料
                        vm.discount = event.data;
                    }
                });
            },
            handleCityChange(e) {
                const vm = this;
                const selectedCity = e.target.value;
                const foundIndex = vm.cityData.findIndex(item => item.CityName === selectedCity);
                if (foundIndex !== -1) {
                    vm.countyData = vm.cityData[foundIndex].AreaList;
                }
            },
            submitForm() {
                const vm = this;
                if (((vm.city != null && vm.country != null && vm.add != null) || vm.store.storeaddress != null) && vm.needknow_check && vm.howSend !=null) {
                    let howsend = vm.howSend;
                    let add = null;
                    let name = vm.name ?? null;
                    let tel = vm.tel ?? null;
                    let other = vm.other ?? null;
                    let shopcart = JSON.parse(localStorage.getItem("shoppingcart")) ?? null;
                    if (vm.store.storeaddress != null) {
                        add = vm.store.storeaddress;
                    } else if (vm.city != null && vm.country != null && vm.add != null) {
                        add = vm.city + vm.country + vm.add;
                    }

                    let keya = getCookie("keyA") ?? null;
                    let keyb = getCookie("keyB") ?? null;
                    if (keyb != null && keyb != null && add != null && name != null && tel != null && shopcart != null) {

                        axios.post(apiurl + "addorder", {
                                keyA: keya,
                                keyB: keyb,
                                name: name,
                                tel: tel,
                                other: other,
                                add: add,
                                discount: vm.discount.DiscountValue,
                                shopcart: shopcart,
                                howsend: howsend,
                                sendch: vm.SendCh,
                            })
                            .then(response => {
                                console.log(response.data);
                                if (response.data.state == true) {
                                    window.location.href = "/success-order.html";
                                } else {
                                    console.log(response.data.data);
                                }
                            })
                            .catch(error => {
                                console.log(error);
                            })
                    }

                } else {
                    swal.fire({
                        icon: 'warning',
                        text: '請確認資料是否填寫完整或有未勾選項目',
                        showConfirmButton: false,
                    });
                }
            }
        }
    }
    Vue.createApp(orderdata).mount("#orderdata");
</script>

<?php
$script = ob_get_clean();
include("template.php");
?>