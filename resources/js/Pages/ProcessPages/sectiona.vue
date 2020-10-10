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
                  <div class="col-md-2"></div>
                  <div class="col-md-4">
                      <card>
                              <button class="btn btn-info btn-block" @click="data = all_data;state = 0;">جميع الطلبات</button>
                      </card>
                  </div>
                  <div class="col-md-4">
                      <card>
                            <button class="btn btn-info btn-block" @click="data = new_data; state = 1;">الطلبات الجديدة</button>
                      </card>
                  </div>
                  <div class="col-md-2"></div>

              </div>
          </template>
            <template slot="header">
              <h4 class="card-title" v-if="state == 0">جميع الطلبات</h4>
              <h4 class="card-title" v-if="state == 1">الطلبات الجديدة</h4>
              <p class="card-category">يمكنك متابعة الطلبات من هنا</p>
            </template>
            <table class="table">
              <thead>
                <slot name="columns">
                  <tr>
                    <th>ID</th>
                    <th>اسم الاستشارة</th>
                    <th>السعر</th>
                    <th>التاريخ</th>
                    <th>متابعه</th>
                  </tr>
                </slot>
              </thead>
              <tbody>
              <tr v-for="(item, index) in data" :key="index">
                <slot :row="item">
                  <td>{{item.id}}</td>
                  <td>{{item.psychologicalcounseling.name_ar}}</td>
                  <td>{{item.price}}</td>
                  <td>{{item.created_at}}</td>
                  <td>
                      <span style="color:green;font-weight:700;cursor:pointer;" @click="$router.push({name:'SectionaShow',params:{id:item.id}})">متابعة العملية</span>
                  </td>
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
          new_data:[],
          all_data:[],
          state:0
      }
    },
    methods: {
      install() {
        const vm = this;
        axios.get('admin/process/sectiona').then(response => {
          console.log(response.data)
          vm.data = response.data.all_data;
          vm.new_data = response.data.new_data;
          vm.all_data = response.data.all_data;
        }).catch(err => {
          console.log(err.response)
        });
      },
    },
    created() {
      const vm = this;
      vm.install();
    }
  }
</script>
<style>
</style>
