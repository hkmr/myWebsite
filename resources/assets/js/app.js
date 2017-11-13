
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('bookmark', require('./components/Bookmark.vue'));
Vue.component('follow', require('./components/Follow.vue'));
Vue.component('notification', require('./components/Notification.vue'));

const app = new Vue({
    el: '#app',

});
