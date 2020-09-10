/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

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
Vue.component('card-form-component', require('./components/CardFormComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: "#app",
//  data() {
//    return {
//      currentCardBackground: Math.floor(Math.random()* 25 + 1), // just for fun :D
//      cardName: "",
//      cardNumber: "",
//      cardMonth: "",
//      cardYear: "",
//      cardCvv: "",
//      minCardYear: new Date().getFullYear(),
//      amexCardMask: "#### ###### #####",
//      otherCardMask: "#### #### #### ####",
//      cardNumberTemp: "",
//      isCardFlipped: false,
//      focusElementStyle: null,
//      isInputFocused: false
//    };
//  },
//  mounted() {
//    this.cardNumberTemp = this.otherCardMask;
//    document.getElementById("cardNumber").focus();
//  },
//  computed: {
//    getCardType () {
//      let number = this.cardNumber;
//      let re = new RegExp("^4");
//      if (number.match(re) != null) return "visa";
//
//      re = new RegExp("^(34|37)");
//      if (number.match(re) != null) return "amex";
//
//      re = new RegExp("^5[1-5]");
//      if (number.match(re) != null) return "mastercard";
//
//      re = new RegExp("^6011");
//      if (number.match(re) != null) return "discover";
//      
//      re = new RegExp('^9792')
//      if (number.match(re) != null) return 'troy'
//
//      return "visa"; // default type
//    },
//        generateCardNumberMask () {
//            return this.getCardType === "amex" ? this.amexCardMask : this.otherCardMask;
//    },
//    minCardMonth () {
//      if (this.cardYear === this.minCardYear) return new Date().getMonth() + 1;
//      return 1;
//    }
//  },
//  watch: {
//    cardYear () {
//      if (this.cardMonth < this.minCardMonth) {
//        this.cardMonth = "";
//      }
//    }
//  },
//  methods: {
//    flipCard (status) {
//      this.isCardFlipped = status;
//    },
//    focusInput (e) {
//      this.isInputFocused = true;
//      let targetRef = e.target.dataset.ref;
//      let target = this.$refs[targetRef];
//      this.focusElementStyle = {
//        width: `${target.offsetWidth}px`,
//        height: `${target.offsetHeight}px`,
//        transform: `translateX(${target.offsetLeft}px) translateY(${target.offsetTop}px)`
//      }
//    },
//    blurInput() {
//      let vm = this;
//      setTimeout(() => {
//        if (!vm.isInputFocused) {
//          vm.focusElementStyle = null;
//        }
//      }, 300);
//      vm.isInputFocused = false;
//    }
//  }
});
