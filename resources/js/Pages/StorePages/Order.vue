<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
            <template slot="header">
              <h4 class="card-title">قائمة الطلبات</h4>
              <p class="card-category">يمكنك متابعة الطلبات من هنا</p>
            </template>
            <table class="table">
              <thead>
                <slot name="columns">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Order Net</th>
                    <th>State</th>
                    <th>Show</th>
                  </tr>
                </slot>
              </thead>
              <tbody>
              <tr v-for="(item, index) in data" :key="index">
                <slot :row="item">
                  <td>{{item.id}}</td>
                  <td>{{item.shop_order_address.name}}</td>
                  <td>{{item.net}} <span style="font-weight:700;">KWD</span> </td>
                  <td>
                      <span style="color:blue;font-weight:700;" v-if="item.state == 0">في الانتظار</span>
                      <span style="color:green;font-weight:700;" v-if="item.state == 1">تم الارسال</span>
                  </td>
                  <td>
                    <span style="color:green;font-weight:700; cursor:pointer;" @click="$router.push({name:'OrderShow',params:{id:item.id}})">Show</span>
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
          data: []
      }
    },
    methods: {
      hasValue (item, column) {
        return item[column.toLowerCase()] !== 'undefined'
      },
      itemValue (item, column) {
        return item[column.toLowerCase()]
      },
      install() {
        const vm = this;
        axios.get('admin/store/index_order').then(response => {
          console.log(response.data)
          vm.data = response.data;
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
