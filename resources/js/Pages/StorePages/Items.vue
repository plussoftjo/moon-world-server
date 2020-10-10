<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <card class="strpied-tabled-with-hover"
                body-classes="table-full-width table-responsive"
          >
            <template slot="header">
              <h4 class="card-title">قائمة المواد</h4>
              <p class="card-category">يمكنك اضافة وتعديل المواد واسعارها من خلال القائمة هنا </p>
              <a class="btn btn-info" href="#/admin/NewItems">اضافة مادة جديدة</a>
            </template>
            <table class="table">
              <thead>
                <slot name="columns">
                  <tr>
                    <th v-for="column in columns" :key="column">{{column}}</th>
                    <th>Edit & Delete</th>
                  </tr>
                </slot>
              </thead>
              <tbody>
              <tr v-for="(item, index) in data" :key="index">
                <slot :row="item">
                  <td v-for="column in columns" :key="column" v-if="hasValue(item, column)">
                    <div v-if="column == 'image'">
                      <img :src="'/' + itemValue(item, column)" width="50" height="50"/>
                    </div>
                    <div v-else>
                      {{itemValue(item, column)}}
                    </div>
                  </td>
                  <td>
                    <span style="color:green;font-weight:700; cursor:pointer;" @click="$router.push({name:'ItemsEdit',params:{id:item.id}})">Edit</span>
                      <span style="width:5px;" ></span>
                      <span style="color:red;font-weight:700;cursor:pointer;" @click="remove(item.id)">Delete</span>
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
  const tableColumns = ['id', 'name_ar', 'name_en', 'description_ar','description_en','image','price','shop_category_id']
  export default {
    components: {
      Card
    },
    data () {
      return {
          columns: [...tableColumns],
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
        axios.get('admin/shop_items/index').then(response => {
          vm.data= response.data;
        }).catch(err => {
          console.log(err.response)
        });
      },
      remove(id) {
        const vm = this;
        confirm('هل تريد الحذف ؟') &&
        axios.get('admin/shop_items/delete/' + id).then(response => {
          location.reload();
        }).catch(err => {
          console.log(err)
        });
      }
    },
    created() {
      const vm = this;
      vm.install();
    }
  }
</script>
<style>
</style>
