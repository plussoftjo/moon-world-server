<template>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <span class="nav-link" :class="state == 0 ? 'active_tab':'not_active'" @click="state = 0;">نظرة عامة</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link " :class="state == 1?'active_tab':'not_active'" @click="state = 1;">الفئات</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link " :class="state == 2?'active_tab':'not_active'" @click="state = 2;">المواد</span>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link " :class="state == 3?'active_tab':'not_active'" @click="state = 3;">ألطلبات</span>
                            </li>
                        </ul>
                    </card>
                    <card class="strpied-tabled-with-hover" body-classes="table-full-width table-responsive">
                        <overview v-if="state == 0" />
                        <category v-if="state == 1" />
                        <Items v-if="state == 2" />
                        <Order v-if="state == 3" />
                    </card>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import Card from '../components/Cards/Card.vue';
  import category from './StorePages/catgorey.vue';
  import Items from './StorePages/Items.vue';
  import Overview from './StorePages/Overview.vue';
  import Order from './StorePages/Order.vue';
export default {
    components: {
      Card,
      category,
      Items,
      Overview,
      Order
    },
    data() {
        return {
            state:0
        }
    }
}
</script>
<style>
    .active_tab{color:blue;}
    .nav-link:hover{color:cadetblue;}
    .nav-link{cursor: pointer;font-weight: 800;font-size: 18px;}
</style>