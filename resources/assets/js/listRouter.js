import ExampleComponent from './components/ExampleComponent.vue';
import itemComponent from './components/Item/itemComponent.vue';
import ItemEditComponent from './components/Item/ItemEditComponent';
import test from './components/test.vue';
import userProgram from './components/programManager/UserComponent';
import userClinic from './components/clinic/UserComponent';
import serviceClinic from './components/clinic/ServiceComponent';
import patientClinic from './components/clinic/PatientComponent';
import patientDetailClinic from './components/clinic/PatientDetailComponent';
import patientChartDetail from './components/clinic/PatientChartDetailComponent';

import ChatComponent from "./components/Item/ChatComponent.vue";
import LoginChatComponent from "./components/LoginChatComponent.vue";
import JitsiLoginComponent from './components/JitsiLoginComponent.vue';
// import jitsiComponent from './components/JitsiComponent.vue';

export default [
	{
		path: '/',
		component: ChatComponent,
		name: 'example'
	},
	// {
	// 	path: '/jitsiComponent',
	// 	component: jitsiComponent,
	// 	name: 'jitsiComponent'
	// },
	// {
	// 	path: '/jitsiComponent?nameRoom=:nameRoom',
	// 	component: jitsiComponent,
	// 	name: 'jitsiComponent'
	// },
	{
		path: '/jitsiLogin',
		component: JitsiLoginComponent,
		name: 'JitsiLoginComponent'
	},
	{
		path: '/chat',
		component: ChatComponent,
		name: 'chat'
	},
	{
		path: '/item',
		component: itemComponent,
		name: 'item'
	},
	{
		path: '/itemEdit/:id',
		component: ItemEditComponent,
		name: 'itemEdit'
	},
	{
		path: '/userProgram',
		component: userProgram,
		name: 'userProgram'
	},
	{
		path: '/userClinic',
		component: userClinic,
		name: 'userClinic'
	},
	{
		path: '/serviceClinic',
		component: serviceClinic,
		name: 'serviceClinic'
	},
	{
		path: '/patientClinic',
		component: patientClinic,
		name: 'patientClinic'
	},
	{
		path: '/patientDetailClinic',
		component: patientDetailClinic,
		name: 'patientDetailClinic'
	},
	{
		path: '/patientChartDetail',
		component: patientChartDetail,
		name: 'patientChartDetail'
	},
	{
		path: '/test',
		component: test,
		name: 'test'
	},

]