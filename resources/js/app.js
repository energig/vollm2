/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueSignaturePad from 'vue-signature-pad';
Vue.use(VueSignaturePad);

//import VueSignature from "signature_pad";
//Vue.use(VueSignature);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('signature-component', require('./components/SignatureComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.app = new Vue({
    el: '#app',
	components: { },
	methods: { clearPad: function() {
		//this.$refs.signaturePad.clear();
		
		let signsave = this.$refs.signaturePad.save();
		if (signsave.isEmpty) { 
			alert ('Bitte unterschreiben');
			return false;
		} else {
			var uschrift = document.getElementById('unterschrift_base64');
			//console.log(signsave.isEmpty);
			//console.log(signsave.data);
			
			uschrift.value = signsave.data;
			return true;
		}
	}}
});
