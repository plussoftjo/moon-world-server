<template>
	<div class="main">
		<div class="load" v-if="show_loader">
			<loader/>
		</div>
		<VCreditCard @change="creditInfoChanged"/>
		<div class="pl-4 pr-4">
			
			<center>
				<div v-if="error">
					<span style="color:red;font-weight:700;">Please check your payment info and try again</span>
				</div>
				<button class="btn btn-info btn-block" @click="submit">Pay</button>
			</center>
		</div>
	</div>
</template>
<script>
import VCreditCard from 'v-credit-card';
import 'v-credit-card/dist/VCreditCard.css';
import loader from './loader.vue';
	export default {
		data() {
			return {
		        name: '',
				cardNumber: '',
				expiration: '',
				security: '',
				type:'',
				user_id:'',
				id:'',
				price:1,
				show_loader:false,
				error:false
			}
		},
		components:{
			VCreditCard,
			loader
		},
		methods: {
			creditInfoChanged(values) {
				for (const key in values) {
					this[key] = values[key];
				}
			},
			submit() {
				const vm = this;
				vm.show_loader = true;
				vm.error = false;
				let expiration = vm.expiration.split('/');
				
				let formData = {
					sellerId: "901415241",
					publishableKey: "09139F1C-2B99-4CF9-983F-34EA247B3EDC",
					ccNo:vm.cardNumber,
					cvv:vm.security,
					expMonth:expiration[0],
					expYear:'20' + expiration[1]
				}

				let success = data => {
					let token = data.response.token.token;
					let address = {
						name:'Testing Tester',
						addrLine1:'123 Test St',
						city:'Columbus',
						state:'OH',
						zipCode:'43123',
						country:'USA,',
						email:'testingtester@2co.com',
						phoneNumber:'555-555-5555'
					};
					axios.post('/api/pay/pay',{token:token,address:address,price:vm.price,type:vm.type,user_id:vm.user_id,id:vm.id},{
						headers: {
							'Content-Type': 'application/json',
						}
					}).then(response => {
						vm.show_loader=false;
						console.log(response.data)
						vm.error = false;
						let ticket = JSON.stringify(response.data.msg);
						window.ReactNativeWebView.postMessage(ticket)
					}).catch(err => {
						console.log(err)
						vm.show_loader = false;
						vm.error = true;
					});
				}

				let error = error => {
					console.log(error)
					vm.error = true;
					vm.show_loader = false;
				}

				window.TCO.loadPubKey("sandbox", () => {
					window.TCO.requestToken(success,error,formData);
				});

			}
		},
		created() {
			const vm = this;
			setTimeout(() => {
				vm.user_id = window.user_id;
				vm.id = window.id;
				vm.price = window.price;
				vm.type = window.type;
				// vm.user_id = 5;
				// vm.id = 1;
				// vm.price = 500;
				// vm.type = 'course';
			},1000);
		}
	}
</script>
<style>
	.load{position:absolute; left:0px;top:0px; min-width:'100%';min-height:'100%';z-index:100;background-color: rgba(0,0,0,0.09);width:100%;height: 100%; padding-top:60%;padding-left: 40%;}
</style>