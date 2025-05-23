<?php
$title = "首頁";
ob_start();
?>
<style>

</style>
<?php
$css_style = ob_get_clean();
ob_start();
?>
<div class="m-3" id="content">
    <div class="row">
        <div class="col-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-center align-items-center bg-success">
                    <div class="text-center w-100 text-white">
                        <div class="h3" v-if="allprices != null">{{ allprices }}</div>
                        <div class="h5">總營業額</div>
                    </div>
                    <div class="fas fa-money-bill-alt fa-4x text-black-50"></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-center align-items-center bg-primary">
                    <div class="text-center w-100 text-white">
                        <div class="h3" v-if="allusers != null">{{ allusers }}</div>
                        <div class="h5">會員人數</div>
                    </div>
                    <i class="fa-solid fa-users fa-5x text-black-50"></i>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-center align-items-center bg-danger">
                    <div class="text-center w-100 text-white">
                        <div class="h3" v-if="This_Month_Orders != null">{{ This_Month_Orders }}</div>
                        <div class="h5">本月訂單數</div>
                    </div>
                    <i class="fa-solid fa-shopping-cart fa-5x text-black-50"></i>
                </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card">
                <div class="card-header" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseCard1" @click="card1 = !card1">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <span class="">營業額統計</span>
                        <i class="fa-solid fa-angle-right" :class="{'fa-rotate-90' : !card1}"></i>
                    </h5>
                </div>
                <div id="collapseCard1" class="collapse show">
                    <div class="card-body row">
                        <div class="col-12">
                            <select name="" id="Months_Price" class="form-select text-center" v-model="Months_Price">
                                <option value="1">本月統計</option>
                                <option value="3">前3個月統計</option>
                                <option value="6">前6個月統計</option>
                                <option value="9">前9個月統計</option>
                                <option value="12">前12個月統計</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <canvas id="mychart_price_bar" style="height: 500px;"></canvas>
                        </div>
                        <div class="col-4">
                            <canvas id="mychart_price_pie" style="height: 500px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-3">
            <div class="card">
                <div class="card-header" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="#collapseCard2" @click="card2 = !card2">
                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                        <span class="">新進會員統計</span>
                        <i class="fa-solid fa-angle-right" :class="{'fa-rotate-90' : !card2}"></i>
                    </h5>
                </div>
                <div id="collapseCard2" class="collapse show">
                    <div class="card-body row">
                        <div class="col-12">
                            <select name="" id="Months_Member" class="form-select text-center" v-model="Months_Member">
                                <option value="1">本月統計</option>
                                <option value="3">前3個月統計</option>
                                <option value="6">前6個月統計</option>
                                <option value="9">前9個月統計</option>
                                <option value="12">前12個月統計</option>
                            </select>
                        </div>
                        <div class="col-8">
                            <canvas id="mychart_member_bar" style="height: 500px;"></canvas>
                        </div>
                        <div class="col-4">
                            <canvas id="mychart_member_pie" style="height: 500px;"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var mychart_price_bar, mychart_price_pie, mychart_member_bar, mychart_member_pie;
    var chartColors = ["", "", "", "", "", "", "", "", "", "", "", "", ""];
    chartColors = chartColors.map(() => getRandomColor());
    const Content = {
        data() {
            return {
                card1: false,
                card2: false,
                allprices: null,
                allusers: null,
                This_Month_Orders: null,
                Six_Months_Price: null,
                Months_Price: 6,
                N_Months_Member: null,
                Months_Member: 6,
            }
        },
        watch: {
            Months_Price(newVal) {
                const vm = this;
                vm.changemonths_price();
            },
            Months_Member(newVal) {
                const vm = this;
                vm.changemonths_member();
            }
        },
        created() {
            const vm = this;
            axios.get(apiurl + "getdata", {}).then((response) => {
                // console.log(response.data);
                if (response.data.state == true) {
                    vm.allprices = response.data.data.ALl_Orders_Price;
                    vm.allusers = response.data.data.All_Users;
                    vm.This_Month_Orders = response.data.data.This_Month_Orders;
                    // 獲取前 n 個月的資料(預設6個月)
                    vm.changemonths_price();
                    vm.changemonths_member();
                } else {
                    console.log("資料取得失敗 " + response.data.msg);
                }
            }).catch((error) => {
                console.error(error);
            });
        },
        methods: {
            changemonths_price() {
                const vm = this;
                axios.get(apiurl + "getmonthdata", {
                    params: {
                        Months: vm.Months_Price,
                    }
                }).then((response) => {
                    // console.log(response.data);
                    if (response.data.state == true) {
                        vm.Six_Months_Price = response.data.data.Six_Month_Price;

                        mychart_price_bar.data.labels = [];
                        mychart_price_bar.data.datasets[0].data = [];
                        mychart_price_pie.data.labels = [];
                        mychart_price_pie.data.datasets[0].data = [];

                        vm.Six_Months_Price.forEach((item) => {
                            mychart_price_bar.data.labels.push(item.Months);
                            mychart_price_bar.data.datasets[0].data.push(item.This_Month_Price);
                            mychart_price_pie.data.labels.push(item.Months);
                            mychart_price_pie.data.datasets[0].data.push(item.This_Month_Price);
                        });
                        mychart_price_bar.update();
                        mychart_price_pie.update();
                    } else {
                        console.log("資料取得失敗 " + response.data.msg);
                    }
                }).catch((error) => {
                    console.error(error);
                });
            },
            changemonths_member() {
                const vm = this;
                axios.get(apiurl + "getmonthdata_member", {
                    params: {
                        Months: vm.Months_Member,
                    }
                }).then((response) => {
                    console.log(response.data);
                    if (response.data.state == true) {
                        vm.N_Months_Member = response.data.data.N_Month_Member;

                        mychart_member_bar.data.labels = [];
                        mychart_member_bar.data.datasets[0].data = [];
                        mychart_member_pie.data.labels = [];
                        mychart_member_pie.data.datasets[0].data = [];

                        vm.N_Months_Member.forEach((item) => {
                            mychart_member_bar.data.labels.push(item.Months);
                            mychart_member_bar.data.datasets[0].data.push(item.This_Month_Member);
                            mychart_member_pie.data.labels.push(item.Months);
                            mychart_member_pie.data.datasets[0].data.push(item.This_Month_Member);
                        });
                        mychart_member_bar.update();
                        mychart_member_pie.update();
                    } else {
                        console.log("資料取得失敗 " + response.data.msg);
                    }
                }).catch((error) => {
                    console.error(error);
                });
            }
        }
    }
    Vue.createApp(Content).mount('#content');
    const ctx_price_bar = document.getElementById('mychart_price_bar');
    mychart_price_bar = new Chart(ctx_price_bar, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: '每月營業額',
                data: [],
                borderWidth: 1,
                backgroundColor: chartColors,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx_price_pie = document.getElementById('mychart_price_pie');
    mychart_price_pie = new Chart(ctx_price_pie, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                label: '每月營業額',
                data: [],
                borderWidth: 1,
                backgroundColor: chartColors,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx_member_bar = document.getElementById('mychart_member_bar');
    mychart_member_bar = new Chart(ctx_member_bar, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: '每月會員數',
                data: [],
                borderWidth: 1,
                backgroundColor: chartColors,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    const ctx_member_pie = document.getElementById('mychart_member_pie');
    mychart_member_pie = new Chart(ctx_member_pie, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                label: '每月會員數',
                data: [],
                borderWidth: 1,
                backgroundColor: chartColors,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function getRandomColor() {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);
        return `rgb(${r}, ${g}, ${b})`;
    }
</script>
<?php
$js_content = ob_get_clean();
include("template.php");
?>