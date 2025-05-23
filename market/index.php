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

        .wrapper img {
            position: absolute;
            z-index: 10;
            width: 700px;
            height: 700px;
            top: 50%;
            left: 50%;
        }

        .wrapper .form {
            z-index: 100;
            font-size: 2rem;
            width: 50%;
            height: auto;
        }

        .wrapper .form .form-tel .tel-2 {
            padding: 0px;
        }

        .wrapper .form .form-tel .tel-8 {
            padding: 0px;
            padding-left: 1.5rem;
        }

        .wrapper .form .form-tel .tel-8 input {
            background: rgba(255, 255, 255, 0);
            border: 0px;
            border-bottom: 1px solid #000000;
            padding: 0px;
            border-radius: 0px;
            color: var(--color333333);
            font-size: 2rem;
        }

        .wrapper .form button {
            width: 150px;
            height: 50px;
            font-size: 1.75rem;
            color: var(--colorececec);
            background-color: var(--color333333);
            border-color: var(--color333333);
            padding: 0px;
            border-radius: 0.75rem;
        }

        @media screen and (max-width: 767px) {
            body {
                background: linear-gradient(45deg, #FFA90D, #FED235);
            }

            .wrapper .form {
                width: 100%;
                height: 425px;
            }

            .wrapper .form .text-remind {
                width: 100%;

            }

            .wrapper .form .text-tel {
                width: 300px;
                height: 50px;
                font-size: 1.5rem;
            }

            .wrapper .form .form-tel .tel-8 input {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div id="submit" class="wrapper position-relative">
        <!-- 電腦版 -->
        <img src="/images/SubmitBackground.jpg" alt="" class="d-none d-md-block translate-middle">
        <div class="form text-center position-absolute top-50 start-50 translate-middle d-flex flex-column justify-content-center align-items-center">
            <form action="" @submit.prevent="checkform()">
                <div class="text-remind fw-600 text-center">會員註冊/登入</div>
                <div class="text-tel form-tel fw-500 row mt-5">
                    <div class="tel-2 col-2">09</div>
                    <div class="tel-8 col-10 d-flex">
                        <input type="tel" name="" id="" class="form-control text-center" pattern="\d{8}" placeholder="請輸入電話號碼" v-model="tel" required>
                    </div>
                </div>
                <button type="submit" class="btn mt-5 ">確定</button>
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
    const APP = {
        data() {
            return {
                tel: '',
            }
        },
        created() {
            axios.post(apiurl + 'checkkey', {
                    keyA: getCookie('keyA'),
                    keyB: getCookie('keyB'),
                }, {
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => {
                    console.log(response);
                    if(response.data.state == true) {
                        window.location.href = "/home.php";
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        methods: {
            checkform() {
                const phonepattern = /^\d{8}$/;
                const vm = this;
                if (phonepattern.test(vm.tel)) {
                    axios.post(apiurl + 'checkphone', {
                            phone: '09' + vm.tel,
                        }, {
                            headers: {
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => {
                            console.log(response);
                            if (response.data.data != null) {
                                window.location.href = "/login.php?tel=09" + vm.tel;
                            } else {
                                window.location.href = "/submit.php?phone=" + vm.tel;
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        })
                } else {
                    swal2("送出失敗", "", "error", "", false, () => {}, true);
                }
            }
        }
    }
    Vue.createApp(APP).mount("#submit");
</script>

</html>