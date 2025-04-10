<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MARKET-買齊</title>
</head>

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
<style>
    body {
        width: 100%;
        height: 100vh;
    }

    .wrapper {
        width: 100%;
        height: 100%;
        top: 0%;
        left: 0%;
        position: absolute;
        display: flex;
        align-items: center;
    }

    .wrapper img {
        position: absolute;
        animation: move_large 3s 1 forwards;
        transform: translate(-50%, -50%);
        z-index: 10;
    }

    .wrapper .text {
        position: relative;
        width: 33.3%;
        height: 100%;
        z-index: 100;
        opacity: 0;
    }

    .wrapper .text .pc {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        font-size: 3rem;
    }

    .wrapper .text .tel {
        display: none;
    }

    .wrapper .text * .back-icon a {
        text-decoration: none;
        color: var(--color333333);
    }

    .wrapper .text * .back-icon a:hover i {
        margin-right: 1rem;
    }

    .wrapper .input {
        position: absolute;
        width: 50%;
        height: 100%;
        top: 0px;
        right: 0px;
        padding-right: 25px;
        display: flex;
        justify-content: end;
        align-items: center;
        opacity: 0;
    }

    .wrapper .input .input-box {
        position: absolute;
        width: 75%;
        height: 50%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: start;
        z-index: 100;
    }

    .form-control {
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

    .fadeIn{
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

    @keyframes move_large {
        0% {
            height: 30%;
            width: 30vh;
            left: 50%;
            top: 50%;
        }

        60% {
            height: 90%;
            width: 90%;
            left: 50%;
            top: 50%;
        }

        100% {
            height: 200%;
            width: 90%;
            left: 10%;
            top: 50%;
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


    @media screen and (max-width: 768px) {
        .wrapper .text .pc {
            display: none;
        }

        .wrapper {
            position: relative;
            width: 100vw;
            height: 100%;
        }

        .wrapper img {
            display: none;
        }

        .wrapper .text {
            position: absolute;
            top: 0px;
            height: 85px;
            width: 100%;
            opacity: 1;
            background: linear-gradient(0deg, #FFAB0F 0%, #FEBE21 40%, #FED033 100%);
            border-radius: 0px 0px 25px 25px;
        }

        .wrapper .input {
            position: absolute;
            top: 85px;
            width: 100%;
            height: calc(100% - 85px);
            opacity: 1;
            padding-right: 0px;
            display: flex;
            justify-content: center;

        }

        .wrapper .input .input-box{
            height: auto;
            width: 90%;
        }

        .wrapper .text .tel {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100%;
            width: 100%;
            opacity: 1;
        }

        
    }
</style>

<body style="overflow: hidden;" id="check">
    <div class="wrapper" style="font-size: 30px;">
        <img src="/images/SubmitBackground.jpg" alt="" class="img-fluid" @animationend="showtext">
        <div class="text" :class="{ 'fadeIn' : show }">
            <div class="pc">
                <div class="back-title fw-700 c-333333">MARKET</div>
                <div class="back-content c-333333">會員登入</div>
                <div class="back-icon"><a href="/index.php"><i class="fa-solid fa-angle-left"></i>上一步</a></div>
            </div>
            <div class="tel">
                <div class="back-icon ms-3"><a href="/index.php"><i class="fa-solid fa-angle-left"></i></a></div>
                <div class="back-title fw-700 c-333333">MARKET</div>
                <div class="back-content me-3 c-333333">會員登入</div>
            </div>
        </div>
        <div class="input" :class="{ 'fadeIn' : show }">
            <div class="input-box">
                <div class="pwd-text">登入密碼<span class="text-danger">*</span></div>
                <form action="" method="post" style="width: 100%;" class="text-center" @submit="chk_data">
                    <div class="input-group">
                        <input :type="pwd_type" class="form-control" placeholder="6-10個英文加數字，大小寫會不同" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,10}$" v-model="pwd">
                        <button class="btn btn-outline-secondary" type="button" id="" @click="ck_show_close">
                            <i class="bi" :class="{ 'bi-eye' : click_pwd_text , 'bi-eye-slash' : click_pwd_text == false}"></i>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-dark mt-3">送出</button>
                </form>
            </div>
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
                pwd: '',
                pwd_type: 'password',
                click_pwd_text: false,
                show: false,
            }
        },
        methods: {
            showtext(){
                const vm = this;
                vm.show = true;
            },
            ck_show_close() {
                const vm = this;
                if (vm.click_pwd_text) {
                    vm.click_pwd_text = false;
                    vm.pwd_type = 'password';
                } else {
                    vm.click_pwd_text = true;
                    vm.pwd_type = 'text';
                }
            },
            chk_data(event) {
                event.preventDefault();
                const vm = this;
                // 密碼檢查
                let pwd_flag = false;
                const pwd_limit = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,10}$/;
                if (pwd_limit.test(vm.pwd)) {
                    pwd_flag = true;
                } else {
                    pwd_flag = false;
                }
                console.log("pwd " + pwd_flag);

                const urlparams = new URLSearchParams(window.location.search);
                let phone = urlparams.get('tel') ?? null;
                if (pwd_flag) {
                    axios.post(apiurl + 'userlogin', {
                            tel: phone,
                            pwd: vm.pwd,
                        })
                        .then(response => {
                            // console.log(response.data);
                            if (response.data.state === true) {
                                setCookie("keyA", response.data.data.keyA, 0.3);
                                setCookie("keyB", response.data.data.keyB, 0.3);
                                swal2("登入成功", "", "success", "確定", true, vm.review, false);
                            } else {
                                swal2("登入失敗", "", "error", "", false, () => {}, true);
                            }
                        })
                        .catch(error => {
                            console.log("錯誤：" + error);
                        })
                } else {
                    swal2("請檢查資料是否有誤", "", "warning", "", false, () => {}, true);
                }
            },
            review(){
                window.location.href="/home.php";
            }
        }
    }
    Vue.createApp(App).mount("#check");
</script>

</html>