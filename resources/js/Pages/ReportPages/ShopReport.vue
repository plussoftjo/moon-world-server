<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
          <template slot="header">
              <div class="row" style="text-align:center!important;">
                  <div class="col-md-3">
                      <card>
                          <template slot="header">
                            <h4 class="card-title">عدد الطلبات</h4>
                            <p class="card-category">{{data.length}}</p>
                          </template>
                      </card>
                  </div>
                  <div class="col-md-3">
                      <card>
                          <template slot="header">
                            <h4 class="card-title">المبلغ المحصل</h4>
                            <p class="card-category">{{net}}</p>
                          </template>
                      </card>
                  </div>
                  <div class="col-md-3">
                      <card>
                          <template slot="header">
                            <h4 class="card-title">طلبات هذا الشهر</h4>
                            <p class="card-category">{{this_month.length}}</p>
                          </template>
                      </card>
                  </div>
                  <div class="col-md-3">
                      <card>
                          <template slot="header">
                            <h4 class="card-title">المبلغ المحصل هذا الشهر</h4>
                            <p class="card-category">{{month_net}}</p>
                          </template>
                      </card>
                  </div>
              </div>
          </template>
            <template slot="header">
              <h4 class="card-title">قائمة الطلبات</h4>
              <p class="card-category">يمكنك متابعة الطلبات من هنا</p>
            </template>
            <table class="table">
              <thead>
                <slot name="columns">
                  <tr>
                    <th>ID</th>
                    <th>الحالة</th>
                    <th>السعر</th>
                    <th>التاريخ</th>
                  </tr>
                </slot>
              </thead>
              <tbody>
              <tr v-for="(item, index) in data" :key="index">
                <slot :row="item">
                  <td>{{item.id}}</td>
                  <td>
                      <span style="color:blue;font-weight:700;" v-if="item.state == 0">في الانتظار</span>
                      <span style="color:green;font-weight:700;" v-if="item.state == 1">تم الارسال</span>
                  </td>
                  <td>{{item.net}}</td>
                  <td>{{item.created_at}}</td>
                </slot>
              </tr>
              </tbody>
            </table>
          </card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import Card from '../../components/Cards/Card.vue';
  export default {
    components: {
      Card
    },
    data () {
      return {
          data: [],
          this_month:[]
      }
    },
    methods: {
      install() {
        const vm = this;
        axios.get('admin/report/shop').then(response => {
          console.log(response.data)
          vm.data = response.data.shop_order;
          vm.this_month = response.data.this_month;
        }).catch(err => {
          console.log(err.response)
        });
      },
    },
    created() {
      const vm = this;
      vm.install();
    },
    computed:{
        net() {
            let price = 0;
            this.data.forEach(trg => {
                trg.net = trg.net * 1;
                price = price + trg.net;
            });
            return price;
        },
        month_net() {
            let price = 0;
            this.this_month.forEach(trg => {
                trg.net = trg.net * 1;
                price = price + trg.net;
            });
            return price;
        }
    }
  }
</script>
<style>
</style>
