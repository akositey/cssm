(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{"KHd+":function(t,e,n){"use strict";function s(t,e,n,s,o,a,i,r){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),s&&(c.functional=!0),a&&(c._scopeId="data-v-"+a),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=l):o&&(l=r?function(){o.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}n.d(e,"a",(function(){return s}))},"V/BI":function(t,e,n){"use strict";var s=n("Z0Oe"),o=n("mydA"),a=n("cC/8"),i=n("iblZ"),r={components:{Logo:s.a,FlashMessages:o.a,JetDropdown:a.a,JetDropdownLink:i.a},props:{office:{type:String,default:""}},data:function(){return{showingNavigationDropdown:!1}},methods:{},computed:{path:function(){return window.location.pathname}}},l=n("KHd+"),c=Object(l.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"min-h-screen bg-gray-200"},[n("nav",{staticClass:"bg-white shadow-md"},[n("div",{staticClass:"px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"},[n("div",{staticClass:"relative flex items-center justify-between h-16"},[n("div",{staticClass:"flex items-center justify-center flex-1 md:items-stretch md:justify-start"},[n("div",{staticClass:"flex-shrink-0"},[n("inertia-link",{attrs:{href:t.route("home")}},[n("logo",{staticClass:"block w-auto h-8 md:h-10"})],1)],1),t._v(" "),t._m(0)]),t._v(" "),n("div",{staticClass:"hidden sm:flex sm:items-center sm:ml-6"},[n("div",{staticClass:"relative ml-3"},[n("jet-dropdown",{attrs:{align:"right",width:"48"},scopedSlots:t._u([{key:"trigger",fn:function(){return[n("button",{staticClass:"flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"},[n("h2",{staticClass:"items-center px-3 py-2 text-xl font-semibold leading-tight text-gray-800 "},[t._v("\n                    "+t._s(t.$page.props.user.name)+"\n                  ")])])]},proxy:!0},{key:"content",fn:function(){return[n("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[t._v("\n                  Tools\n                ")]),t._v(" "),n("jet-dropdown-link",{attrs:{href:t.route("export.create")}},[t._v("\n                  Export\n                ")])]},proxy:!0}])})],1)])])])]),t._v(" "),n("main",[n("div",{staticClass:"flex-1 px-4 py-4 m-auto overflow-y-auto max-w-7xl ",attrs:{"scroll-region":""}},[n("flash-messages"),t._v(" "),t._t("default")],2)]),t._v(" "),n("portal-target",{attrs:{name:"dropdown",slim:""}})],1)}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"hidden sm:block sm:ml-6"},[e("div",{staticClass:"flex"},[e("h2",{staticClass:"items-center px-3 py-2 text-xl font-semibold leading-tight text-gray-800 "},[this._v("\n                Customer Satisfaction Survey\n              ")])])])}],!1,null,null,null);e.a=c.exports},mSFh:function(t,e,n){"use strict";n.r(e);var s={components:{FeedbackLayout:n("V/BI").a},props:{file:{type:String,default:""}},mounted:function(){},methods:{goFullScreen:function(){document.documentElement.requestFullscreen({navigationUI:"show"}).then((function(){console.log("entered full screen")})).catch((function(t){console.log(t)}))}}},o=n("KHd+"),a=Object(o.a)(s,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("feedback-layout",[n("div",{staticClass:"h-full"},[n("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[n("div",{staticClass:"p-8 text-xl font-bold text-left md:text-5xl sm:text-3xl"},[n("p",[t._v("\n          Ano po ang masasabi nyo sa serbisyong naibigay sa inyo?\n        ")]),t._v(" "),n("div",{staticClass:"flex flex-no-wrap justify-center p-12"},[n("inertia-link",{attrs:{href:t.route("survey.index")}},[n("button",{staticClass:"text-xl sm:text-3xl btn-green md:btn-6xl md:text-5xl",on:{click:t.goFullScreen}},[t._v("\n              Simulan ang Survey ✍🏻\n            ")])])],1)])])])])}),[],!1,null,null,null);e.default=a.exports}}]);
//# sourceMappingURL=25.js.map?id=6dcc3bd9579f66c82ac6