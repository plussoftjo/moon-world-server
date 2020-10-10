import index from './components/index/index.vue';
import sections from './components/sections/index.vue';
import stars from './components/stars/index.vue';
import star from './components/star/index.vue';
import catgoray from './components/catgoray/index.vue';
import markets from './components/markets/index.vue';
import country from './components/country/index.vue';
import city from './components/city/index.vue';
import market from './components/market/index.vue'
import entry from './components/entry/index.vue'

export const routes = 
[
	{
		path:'/',
		name:'لوجة التحكم',
		component:index
	},
	{
		path:'/sections',
		name:'الاقسام',
		component:sections
	},
	{
		path:'/stars',
		name:'نجوم',
		component:stars
	},
	{
		path:'/star/:id',
		name:'نجم',
		component:star
	},
	{
		path:'/catgoray',
		name:'اصناف',
		component:catgoray
	},
	{
		path:'/markets',
		name:'محلات',
		component:markets
	},
	{
		path:'/country',
		name:'الدول',
		component:country
	},
	{
		path:'/city',
		name:'المدن',
		component:city
	},
	{
		path:'/market/:id',
		name:'market',
		component:market
	},
	{
		path:'/entry',
		name:'طلبات التوثيق',
		component:entry
	}
]