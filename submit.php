<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARKET-買齊</title>

    <!-- basic.css -->
    <link rel="stylesheet" href="/css/basic.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- 引入 Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- google font -->
    <link rel="stylesheet" href="/css/css2.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<style>
    body {
        background: var(--colorececec);
        width: 100vw;
        height: 100vh;
    }

    .wrapper {
        width: 100vw;
        height: 100vh;
    }

    .wrapper .back-img {
        background-image: url('/images/SubmitBackground.jpg');
        background-position: center center;
        background-size: contain;
        background-repeat: no-repeat;
        z-index: 10;
        width: 60%;
        height: auto;
        animation: move_large 3s 1 forwards;
    }

    .wrapper .back-img .tel-size {
        display: none;
    }

    .wrapper .submit-form {
        opacity: 0;
        z-index: 100;
        width: 40%;
        height: 100vh;
        top: -90%;
        left: 60%;
        font-size: 1.5rem;
        overflow: auto;
    }

    .wrapper .submit-form .title {
        margin-bottom: 25px;
    }

    .wrapper .submit-form .account {
        margin-bottom: 50px;
    }

    .wrapper .submit-form .userdata {
        margin-bottom: 50px;
    }

    .wrapper .submit-form .input-name {
        width: 95%;
    }

    .wrapper .submit-form .password-title {
        margin-bottom: 25px;
    }

    .wrapper .back-text {
        width: 410px;
        height: 350px;
        z-index: 100;
        position: absolute;
        top: 50%;
        left: 35%;
        color: var(--color333333);
        opacity: 0;
    }

    .wrapper .back-img .back-text .back-title {
        font-size: 80px;
    }

    .wrapper .back-img .back-text .back-content {
        font-size: 40px;
    }

    .wrapper .back-img .back-text .back-icon {
        font-size: 40px;
    }

    .wrapper .back-img .back-text .back-icon a {
        text-decoration: none;
        color: inherit;
    }

    .wrapper .back-img .back-text .back-icon a:hover i {
        margin-right: 1rem;
    }

    .form-control {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid var(--color333333);
        border-radius: 0px;
        color: var(--color666666);
        font-size: 15px;
    }

    .form-select {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid var(--color333333);
        border-radius: 0px;
        color: var(--color666666);
        font-size: 15px;
    }

    .form-control:focus {
        background-color: transparent;
        box-shadow: none;
        border-color: var(--color333333);
    }

    .form-select:focus {
        background-color: transparent;
        box-shadow: none;
        border-color: var(--color333333);
    }

    .fadeIn {
        animation: fadeIn 2S 1 forwards;
    }

    .fs-20 {
        font-size: 1rem;
    }

    .fs-15 {
        font-size: 15px;
    }

    .c-333333 {
        color: var(--color333333);
    }

    .c-666666 {
        color: var(--color666666);
    }

    .c-999999 {
        color: var(--color999999);
    }

    .btn-outline-secondary {
        border: 0px;
    }

    .btn-outline-secondary:hover {
        background-color: transparent;
        color: var(--color666666);
    }

    .btn-outline-secondary:focus {
        box-shadow: none;
    }

    .btn-outline-secondary:active:focus {
        box-shadow: none;
    }

    .row {
        --bs-gutter-x: 0px;
    }

    .row>* {
        padding: 0px;
    }

    .modal-backdrop {
        z-index: 50;
    }

    @keyframes move_large {
        0% {
            width: 50vh;
            height: 50%;
            top: 50%;
            left: 50%;
        }

        60% {
            width: 90vh;
            height: 90%;
            top: 50%;
            left: 50%;
        }

        100% {
            width: 90vh;
            height: 90%;
            top: 50%;
            left: 10%;
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @media screen and (max-width: 1024px) {
        .wrapper .back-img {
            width: 50vh;
            height: 50%;
            animation: move_large 3s 1 forwards;
        }

        .wrapper .back-text {
            height: 300px;
            top: 50%;
            left: 45%;
        }

        .wrapper .submit-form {
            width: 50%;
            left: 50%;
            padding-right: 25px;
        }

        .wrapper .back-img .back-text .back-title {
            font-size: 60px;
        }

        .wrapper .back-img .back-text .back-content {
            font-size: 30px;
        }

        .wrapper .back-img .back-text .back-icon {
            font-size: 30px;
        }

        @keyframes move_large {
            0% {
                width: 50vh;
                height: 50%;
                top: 50%;
                left: 50%;
            }

            60% {
                width: 90vh;
                height: 90%;
                top: 50%;
                left: 50%;
            }

            100% {
                width: 90vh;
                height: 90%;
                top: 50%;
                left: -5%;
            }
        }
    }

    @media screen and (max-width: 768px) {
        body {
            overflow: auto !important;
        }

        .wrapper {
            background-color: var(--colorececec);
            position: relative;
        }

        .wrapper .back-img {
            transform: none !important;
            background-image: none;
            background: linear-gradient(0deg, #FFAB0F 0%, #FEBE21 40%, #FED033 100%);
            width: 100%;
            height: 85px;
            animation: none;
            top: 0%;
            left: 0%;
            border-radius: 0px 0px 25px 25px;
        }

        .wrapper .back-img .back-text {
            display: none !important;
        }

        .wrapper .submit-form {
            width: 100%;
            left: 0%;
            height: auto;
            opacity: 1;
            top: 0px;
            padding: 50px 25px;
        }

        .wrapper .back-img .tel-size {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.5rem;
        }

        .wrapper .back-img .tel-size a {
            text-decoration: none;
            color: var(--color333333);
        }
    }
</style>

<body style="overflow: hidden;">
    <div id="submit" class="wrapper position-absolute">
        <!-- 電腦版 -->
        <div class="back-img position-relative translate-middle" @animationend="showtext">
            <div class="back-text d-flex flex-column justify-content-between align-items-center translate-middle-y" :class="{ 'fadeIn' : anime_flag == true }">
                <div class="back-title fw-700">MARKET</div>
                <div class="back-content">會員註冊</div>
                <div class="back-icon"><a href="/index.php"><i class="fa-solid fa-angle-left"></i>上一步</a></div>
            </div>

            <div class="tel-size">
                <div class="back-icon ms-3"><a href="/index.php"><i class="fa-solid fa-angle-left"></i></a></div>
                <div class="back-title fw-700">MARKET</div>
                <div class="back-content me-3">會員註冊</div>
            </div>
        </div>
        <div class="submit-form position-relative" :class="{ 'fadeIn' : anime_flag == true }">
            <form action="" method="post" @submit="check_data">
                <div class="title c-333333 fw-600">帳號資料</div>
                <div class="account fs-15 c-666666"><span class="fs-30 c-333333">電話（帳號）</span><br>+886 {{ phone }}</div>
                <div class="userdata c-333333 fw-600">個人資料</div>
                <div class="name fs-20">姓名（僅中文且限三字）<span class="text-danger">*</span></div>
                <div class="input-name mt-2 mb-3">
                    <input type="text" name="" id="" class="form-control" placeholder="中英文不能共存，不能使用數字(Ex:陳大文)" maxlength="3" pattern="^[\u4e00-\u9fa5]{3}$" v-model="username">
                </div>
                <div class="date fs-20">生日<span class="text-danger"> *</span></div>
                <div class="input-date mt-2 mb-3">
                    <input type="date" name="" id="" class="form-control" v-model="userdate">
                </div>
                <div class="email fs-20">信箱<span class="text-danger">*</span></div>
                <div class="input-email row mt-2 mb-3">
                    <div class="col-9">
                        <input type="text" name="" id="" class="form-control" placeholder="請填寫 Email" pattern="^[a-zA-Z0-9]+$" v-model="useremail">
                    </div>
                    <div class="col-3 fs-15">@gmail.com</div>
                </div>
                <div class="address fs-20">地址<span class="text-danger"> *</span></div>
                <div class="input-address mt-2 mb-3 row d-flex justify-content-between">
                    <div class="col-5">
                        <select name="" id="" class="form-select" v-model="city">
                            <option value="" class="text-center" disabled selected>-請選擇縣市-</option>
                            <option class="text-center" :value="item.CityName" v-for="(item, key) in add_city" :key="key">{{ item.CityName }}</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <select name="" id="" class="form-select" v-model="usercountry">
                            <option value="" class="text-center" disabled selected>-請選擇鄉鎮-</option>
                            <option class="text-center" :value="item.AreaName" v-for="(item, key) in country" :key="key">{{ item.AreaName }}</option>
                        </select>
                    </div>
                    <div class="col-12 mt-2" style="margin-bottom: 50px;">
                        <input type="text" name="" id="" class="form-control" placeholder="請填寫地址 Ex:彩虹街10樓" v-model="useradd">
                    </div>
                </div>
                <div class="password-title fw-600">設定登陸密碼</div>
                <div class="password fs-20">登入密碼<span class="text-danger">*</span></div>
                <div class="input-password">
                    <div class="input-group">
                        <input :type="pw_type" name="" id="" class="form-control" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,10}$" placeholder="6-10個英文加數字，大小寫會不同" v-model="userpwd">
                        <button class="btn btn-outline-secondary" type="button" id="" @click="show_close">
                            <i class="bi" :class="{ 'bi-eye' : pw_show_close , 'bi-eye-slash' : pw_show_close == false}"></i>
                        </button>
                    </div>
                </div>
                <div class="ck_password fs-20 mt-2">再次輸入登陸密碼<span class="text-danger">*</span></div>
                <div class="check-input-password">
                    <div class="input-group">
                        <input :type="ck_pw_type" class="form-control" placeholder="6-10個英文加數字，大小寫會不同" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,10}$" v-model="userckpwd">
                        <button class="btn btn-outline-secondary" type="button" id="" @click="ck_show_close">
                            <i class="bi" :class="{ 'bi-eye' : ck_pw_show_close , 'bi-eye-slash' : ck_pw_show_close == false}"></i>
                        </button>
                    </div>
                </div>
                <div class="member-need-know mt-3 fs-15 p-2">
                    <button type="button" @click="check_member_know" class="btn btn-outline-secondary"><i class="" style="font-size: 0.75rem;" :class="{ 'fa-regular fa-circle' : click_flag == false , 'fa-solid fa-circle-check' : click_flag}"></i></button>
                    <button type="button" class="btn btn-outline-secondary" style="padding: 0px; font-size: 0.75rem;" data-bs-toggle="modal" data-bs-target="#member_know" @click="">我已詳細閱讀並同意「會員權益聲明」</button>
                </div>

                <!-- 會員權益 modal -->
                <div class="modal" tabindex="-1" id="member_know">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title mx-auto" style="font-size: 2rem;">會員權益須知</h5>
                            </div>
                            <div class="modal-body" style="font-size: 0.75rem;">
                                <h3>1. 會員資格與註冊</h3>
                                所有使用本網站服務的用戶，都需註冊成為會員才能享受專屬優惠與服務。註冊過程中，您需要提供有效的聯繫方式及其他必要信息，例如電話號碼、電子郵件地址、住址等，這些資料將用於帳戶管理、訂單配送及客戶服務等。如果您提供虛假或不正確的資料，本網站有權暫停或終止您的會員資格。註冊後，會員應妥善保管自己的帳號密碼，避免帳號被未經授權的人士使用。若發現帳號異常活動，請立即聯繫客服部門。我們承諾會根據法律規範來處理所有用戶的資料，並保護用戶隱私。

                                <h3>2. 訂單與付款流程</h3>
                                作為註冊會員，您可以輕鬆地在我們的網站上瀏覽商品並進行購買。當您選擇商品並完成付款後，訂單將會進入處理狀態。我們會透過電子郵件向您確認訂單詳情，並提供訂單追蹤資訊。付款方式包括信用卡、銀行轉帳及第三方支付平台（如PayPal等）。在付款完成後，您可以隨時在會員中心查詢訂單狀態。我們保證您的支付過程是安全且加密的。若訂單無法處理或商品缺貨，我們會盡早通知您並進行退款處理。請確保填寫的配送資訊準確無誤，以免影響配送過程。

                                <h3>3. 會員福利與優惠</h3>
                                註冊成為我們的會員，您將能夠獲得一系列專屬福利。這些福利包括，但不限於，生日禮物、專屬折扣、限時促銷活動和積分回饋等。會員也可享受優先購買新品的機會，還有在特殊節慶期間的獨家優惠。積分系統也讓您在每次購物時獲得回饋，積分可以用來折抵未來的消費。除此之外，成為高級會員還能享受更為豐富的福利，例如免費的送貨服務、更長的退換貨期限等。每位會員都應該定期查看網站公告，以免錯過任何優惠活動。

                                <h3>4. 隱私保護與資料安全</h3>
                                我們致力於保護您的隱私與個人資料，並會根據《個人資料保護法》來處理所有收集的資訊。您在註冊過程中提供的個人資料僅會用於本網站的服務，例如訂單配送、客戶支援、促銷活動通知等。我們不會將您的資料販賣或提供給第三方。所有的支付信息都會使用加密技術處理，確保您的交易過程安全無慮。若您有任何關於個人資料處理的疑問，可以隨時聯繫我們的客服中心，我們將提供詳細的解答並協助處理您的需求。

                                <h3>5. 退換貨政策與客戶服務</h3>
                                我們的退換貨政策旨在保障您的消費權益，讓您購物無憂。若您收到的商品存在質量問題，您可以在收到商品後的30天內提出退換貨申請。我們將為您提供退貨郵寄標籤並安排退款或換貨。在退換貨過程中，商品必須保持未使用、未拆封的狀態，並附帶所有原始包裝及標籤。若商品在使用過程中出現故障或損壞，您可根據售後服務規定進行處理。我們的客服團隊會為您提供全程的支援，解決任何您在購物過程中遇到的問題，並確保您的權益得到保障。若有其他特殊情況，請聯繫我們的客服部門，我們將根據具體情況進行處理。
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-around">
                    <button type="submit" class="btn btn-dark">送出</button>
                </div>
            </form>
        </div>
    </div>
</body>
<!-- bootstrap -->
<script src="/js/bootstrap.bundle.min.js"></script>
<!-- jquery -->
<script src="/js/jquery-3.7.1.min.js"></script>
<!-- vue -->
<script src="/js/vue.global.js"></script>
<!-- sweetalert2 -->
<script src="/js/sweetalert2@11.js"></script>
<!-- axios -->
<script src="/js/axios.min.js"></script>
<!-- basic.js -->
<script src="/js/basic.js"></script>
<script>
    const App = {
        data() {
            return {
                anime_flag: false,
                phone: '',
                add_city: [],
                city: '',
                country: [],
                pw_show_close: false,
                pw_type: 'password',
                ck_pw_show_close: false,
                ck_pw_type: 'password',
                click_flag: false,

                // user data
                username: '',
                userdate: '',
                useremail: '',
                usercountry: '',
                useradd: '',
                userpwd: '',
                userckpwd: '',
            }
        },
        created() {
            const vm = this;
            const urlparams = new URLSearchParams(window.location.search);
            vm.phone = urlparams.get('phone') ?? null;
            axios.get('/js/CityCountyData.json')
                .then(response => {
                    // console.log('成功:', response.data);
                    vm.add_city = response.data;
                })
                .catch(error => {
                    console.log('錯誤:', error);
                });
        },
        watch: {
            city(item) {
                const vm = this;
                vm.add_city.forEach(function(item) {
                    if (item.CityName == vm.city) {
                        vm.country = item.AreaList;
                    }
                });
            }
        },
        methods: {
            showtext() {
                const vm = this;
                vm.anime_flag = true;
            },
            show_close() {
                const vm = this;
                if (vm.pw_show_close) {
                    vm.pw_show_close = false;
                    vm.pw_type = 'password';
                } else {
                    vm.pw_show_close = true;
                    vm.pw_type = 'text';
                }
            },
            ck_show_close() {
                const vm = this;
                if (vm.ck_pw_show_close) {
                    vm.ck_pw_show_close = false;
                    vm.ck_pw_type = 'password';
                } else {
                    vm.ck_pw_show_close = true;
                    vm.ck_pw_type = 'text';
                }
            },
            check_member_know() {
                const vm = this;
                if (vm.click_flag) {
                    vm.click_flag = false;
                } else {
                    vm.click_flag = true;
                }
            },
            check_data(event) {
                const vm = this;
                event.preventDefault();
                let name_flag = false,
                    date_flag = false,
                    email_flag = false,
                    city_flag = false,
                    country_flag = false,
                    add_flag = false,
                    pwd_flag = false;

                // 姓名檢查
                const username_limit = /^[\u4e00-\u9fa5]{3}$/;
                name_flag = username_limit.test(vm.username) ?? false;
                console.log("name " + name_flag);
                // 生日檢查
                date_flag = vm.userdate != '' ?? false;
                console.log("date " + date_flag);
                // 信箱檢查
                const useremail_limit = /^[a-zA-Z0-9]+$/;
                email_flag = useremail_limit.test(vm.useremail) ?? false;
                console.log("email " + email_flag);
                // 縣市檢查
                city_flag = vm.city != '' ?? false;
                console.log("city " + city_flag);
                // 鄉鎮檢查
                country_flag = vm.usercountry != '' ?? false;
                console.log("country " + country_flag);
                // 路段檢查
                add_flag = vm.useradd != '' ?? false;
                console.log('add ' + add_flag);
                // 密碼檢查
                const pwd_limit = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,10}$/;
                if (pwd_limit.test(vm.userpwd) && pwd_limit.test(vm.userckpwd) && vm.userpwd === vm.userckpwd) {
                    pwd_flag = true;
                } else {
                    pwd_flag = false;
                }
                console.log("pwd " + pwd_flag);

                if (name_flag && date_flag && email_flag && city_flag && country_flag && add_flag && pwd_flag && vm.click_flag) {
                    axios.post(apiurl + 'adduser', {
                            name: vm.username,
                            date: vm.userdate,
                            email: vm.useremail + "@gmail.com",
                            add: vm.city + vm.usercountry + vm.useradd,
                            pwd: vm.userpwd,
                            phone: "09" + vm.phone,
                        })
                        .then(response => {
                            console.log(response.data);
                            if (response.data.state === true) {
                                setCookie("keyA", response.data.data.keyA, 0.3);
                                setCookie("keyB", response.data.data.keyB, 0.3);
                                swal2("新增成功", "", "success", "確定", true, vm.review, false);
                            } else {
                                if (response.data.msg == "帳號已存在") {
                                    swal2("帳號已存在", "", "error", "", false, () => {}, true);
                                } else {
                                    swal2("帳號新增失敗", "", "error", "", false, () => {}, true);
                                }
                            }
                        })
                        .catch(error => {
                            console.log("錯誤：" + error);
                        })
                } else {
                    swal2("請檢查資料是否有誤", "", "warning", "", false, () => {}, true);
                }
            },
            review() {
                window.location.href = "/home.php";
            }
        }
    }
    Vue.createApp(App).mount("#submit");
</script>

</html>