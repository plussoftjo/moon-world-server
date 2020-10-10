<template>
    <div class="overview">
        <div class="row" style="text-align:center!important;">
            <div class="col-md-4">
                <card>
                    <template slot="header">
                        <h4 class="card-title">عدد الفئات</h4>
                        <p>{{data.shop_category}}</p>
                    </template>
                </card>
            </div>
            <div class="col-md-4">
                <card>
                    <template slot="header">
                        <h4 class="card-title">عدد المواد</h4>
                        <p>{{data.items_count}}</p>
                    </template>
                </card>
            </div>
            <div class="col-md-4">
                <card>
                    <template slot="header">
                        <h4 class="card-title">عدد الطلبات</h4>
                        <p>{{data.shop_order}}</p>
                    </template>
                </card>
            </div>
        </div>
    </div>
</template>
<script>
import Card from '../../components/Cards/Card.vue';
export default {
    components:{
        Card
    },
    data() {
        return {
            data:{}
        }
    },
    methods:{
        install() {
            const vm = this;
            axios.get('admin/store/overview').then(response => {
                vm.data = response.data;
            }).catch(err => {
                console.log(err)
            });
        }
    },
    created () {
        const vm = this;
        vm.install();
    }
}
</script>
<style>

</style>