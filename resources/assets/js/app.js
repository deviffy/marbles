
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('colorsetup', require('./components/ColorSetup.vue'));
Vue.component('marblesetup', require('./components/MarbleSetup.vue'));
Vue.component('results', require('./components/Results.vue'));

const app = new Vue({
    el: '#app',
    data: {
        step: 'colorsetup',
        colorSet: []
    },
    ready: function () {
    },
    methods: {
        setMarbles: function (colorSet) {
            this.colorSet = colorSet;
            this.step = 'marblesetup';
        },
        showBuckets: function (buckets) {
            this.buckets = buckets;
            this.step = 'results';
        }
    }
});
