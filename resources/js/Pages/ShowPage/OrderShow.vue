<template>
    <div class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="orderShow" v-if="show">
                    <Card class="strpied-tabled-with-hover"
                    body-classes="table-full-width table-responsive">
                        <template slot="header">
                            <h4 class="card-title">Order Show</h4>
                            <p class="card-category">You can see the order info & order Items here</p>
                        </template>
                        <!-- Show The Order Info and Order Items  -->
                    <div>
                        <h3>#Order Info</h3>
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Net Price</th>
                                    <th>State</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#{{item.id}}</td>
                                    <td>{{item.shop_order_address.name}}</td>
                                    <td>{{item.net}}KWD</td>
                                    <td>
                                    <div v-if="item.state == 0" style="color:blue;font-weight:700;">في الانتظار</div>
                                    <div v-if="item.state == 1" style="font-weight:700;color:green;">تم التسليم</div>

                                    </td>
                                    <td>{{item.created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Show The Order Info and Order Items  -->
                    <div>
                        <h3>#Delvery Info</h3>
                        <table class="table" >
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td>{{item.shop_order_address.name}}</td>
                                <td>{{item.shop_order_address.phone}}</td>
                                <td>{{item.shop_order_address.email}}</td>
                                <td>{{item.shop_order_address.address}}</td>
                                <td>{{item.shop_order_address.created_at}}</td>
                        </tr>
                        </tbody>
                        </table>
                    </div>


                    <!-- Show The Order Info and Order Items  -->
                    <div>
                        <h3>#Items Info</h3>
                        <table class="table" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(oitem,index) in item.shop_order_item" :key="index">
                                <td>{{oitem.items.id}}</td>
                                <td>{{oitem.items.name_ar}}</td>
                                <td style="cursor:pointer;" @click="openImage(oitem.items.image)"><img :src="oitem.items.image" width="75" height="100" /></td>
                                <td>{{oitem.qty}}</td>
                                <td>{{oitem.items.price}}</td>
                        </tr>
                        </tbody>
                        </table>
                    </div>

                    <div class="row" v-if="item.state == 0" >
                    <div class="col-md-6">
                    <button class="btn btn-success btn-block" @click="_vertify(item.id)">اتمام العملية</button>
                    </div>
                    <div class="col-md-6">
                    <button class="btn btn-danger btn-block">Cancle</button>
                    </div>
                </div>
                    </Card>
                </div>
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
            item:{},
            show:false
        }
    },
    methods:{
        install (){
            const vm = this;
            axios.get('admin/store/order/show/' + vm.$route.params.id).then(response => {
                vm.item = response.data;
                vm.show = true;
            }).catch(err => {
                console.log(err)
            });
        },
        _vertify(id) {
            const vm = this;
            axios.get('admin/store/order/vertify/' + id).then(response => {
                confirm('تمت العملية بنجاح') &&
                location.reload();
            }).catch(err => {
                console.log(err)
            });
        },
        openImage(image) {
            const vm = this;
            window.open(image);
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