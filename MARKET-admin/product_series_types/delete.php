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
</style>
<?php
$css_style = ob_get_clean();
$title = "刪除系列";
ob_start();
?>

<div class="row w-100" id="delete">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <div class="h2 text-center fw-700">刪除商品系列</div>
            </div>
        </div>
        <div class="card-body mt-3 mx-auto col-12 col-md-10 row">
            <div class="col-12 text-start">
                <button type="button" class="btn btn-danger" @click="deletes()">刪除</button>
            </div>
            <table class="table table-border mt-3">
                <tr class="border border-dark table-secondary">
                    <td class="col-2 text-center border-end border-dark">
                        <input type="checkbox" name="" id="" class="form-check-input" v-model="chooseAll">
                    </td>
                    <td class="col-10 text-center">
                        商品系列
                    </td>
                </tr>
                <tr class="text-center" v-for="(item) in seriesdata">
                    <td class="col-2">
                        <input type="checkbox" name="" id="" class="form-check-input" :value="item.Id" v-model="chooseId">
                    </td>
                    <td class="col-10">
                        {{ item.Name }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>

<script>
    const Delete = {
        data() {
            return {
                seriesdata: [],
                chooseId: [],
                chooseAll: false,
            }
        },
        created() {
            eventBus.on('sendSeries', (data) => {
                this.seriesdata = data;
            });
        },
        watch: {
            chooseId(item) {
                this.chooseAll = item.length === this.seriesdata.length && this.seriesdata.length > 0;
            },
            chooseAll(item) {
                const vm = this;
                if (item) {
                    vm.chooseId = vm.seriesdata.map(item => item.Id);
                } else if (vm.chooseId.length == vm.seriesdata.length) {
                    // 取消全選：清空 selectedItems 陣列
                    vm.chooseId = [];
                }
            }
        },
        methods: {
            deletes() {
                const vm = this;
                if (vm.chooseId.length == 0) {
                    swal2("請選擇至少一個選項", "", "error", "", false, () => {}, true);
                } else {
                    swal2("確認是否刪除", `這將會刪除<br><h5 class="fw-700 text-danger">系列及系列內的所有種類和種類內的商品！</h5>`, "warning", "確定", true, vm.successDelete, true);
                }
            },
            successDelete() {
                const vm = this;
                axios.post(apiurl + "deleteseries_producttype_product", {
                        seriesId: vm.chooseId,
                    }, {
                        'Content-Type': 'application/json'
                    })
                    .then(response => {
                        console.log(response);
                        if (response.data.state == true) {
                            console.log(response.data);
                            swal2(response.data.msg, "", "success", "確定", true, vm.review);
                        } else {
                            swal2("新增失敗", "", "error", "", false, ()=>{}, true);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            review(){
                window.location.href="/home.php";
            }
        }
    };

    Vue.createApp(Delete).mount('#delete');
</script>

<?php
$js_content = ob_get_clean();
include("../template.php");
?>