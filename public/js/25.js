(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{"KHd+":function(t,e,s){"use strict";function r(t,e,s,r,n,i,a,o){var l,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=s,u._compiled=!0),r&&(u.functional=!0),i&&(u._scopeId="data-v-"+i),a?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),n&&n.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=l):n&&(l=o?function(){n.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:n),l)if(u.functional){u._injectStyles=l;var c=u.render;u.render=function(t,e){return l.call(e),c(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:u}}s.d(e,"a",(function(){return r}))},KJek:function(t,e,s){"use strict";s.r(e);var r=s("hAWA"),n=s("pF+r"),i=s("Z84v"),a={props:{settings:{type:[Object,Array],default:function(){}},errors:{type:[Object,Array],default:function(){}}},components:{AppLayout:r.a,TextInput:n.a,LoadingButton:i.a},data:function(){return{form:{reviewerName:this.settings.reviewerName,reviewerPosition:this.settings.reviewerPosition,noterName:this.settings.noterName,noterPosition:this.settings.noterPosition},sending:!1}},computed:{},watch:{},methods:{saveSettings:function(){var t=this;this.sending=!0,this.$inertia.patch(this.route("signatories.update"),this.form,{onFinish:function(){t.sending=!1,console.log("done")}})}}},o=s("KHd+"),l=Object(o.a)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("app-layout",{scopedSlots:t._u([{key:"header",fn:function(){return[s("div",{staticClass:"flex justify-between"},[t._v("\n      Signatory Settings\n    ")])]},proxy:!0}])},[t._v(" "),s("div",{staticClass:"w-full"},[s("form",{on:{submit:function(e){return e.preventDefault(),t.saveSettings(e)}}},[s("div",{staticClass:"grid md:grid-cols-2"},[s("text-input",{staticClass:"w-full px-4 pb-8",attrs:{error:t.errors.reviewerName,label:"Reviewer Name"},model:{value:t.form.reviewerName,callback:function(e){t.$set(t.form,"reviewerName",e)},expression:"form.reviewerName"}}),t._v(" "),s("text-input",{staticClass:"w-full px-4 pb-8",attrs:{error:t.errors.reviewerPosition,label:"Reviewer Position"},model:{value:t.form.reviewerPosition,callback:function(e){t.$set(t.form,"reviewerPosition",e)},expression:"form.reviewerPosition"}}),t._v(" "),s("text-input",{staticClass:"w-full px-4 pb-8",attrs:{error:t.errors.noterName,label:"Office Head Name"},model:{value:t.form.noterName,callback:function(e){t.$set(t.form,"noterName",e)},expression:"form.noterName"}}),t._v(" "),s("text-input",{staticClass:"w-full px-4 pb-8",attrs:{error:t.errors.noterPosition,label:"Office Head Position"},model:{value:t.form.noterPosition,callback:function(e){t.$set(t.form,"noterPosition",e)},expression:"form.noterPosition"}})],1),t._v(" "),s("div",{staticClass:"flex justify-end"},[s("loading-button",{staticClass:"btn-indigo",attrs:{loading:t.sending,type:"submit"}},[t._v("\n          Save\n        ")])],1)])])])}),[],!1,null,null,null);e.default=l.exports},Z84v:function(t,e,s){"use strict";var r={props:{loading:Boolean}},n=s("KHd+"),i=Object(n.a)(r,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("button",{staticClass:"flex items-center",attrs:{disabled:t.loading},on:{click:function(e){return t.$emit("click")}}},[t.loading?s("div",{staticClass:"mr-2 btn-spinner"}):t._e(),t._v(" "),t._t("default")],2)}),[],!1,null,null,null);e.a=i.exports},hAWA:function(t,e,s){"use strict";var r=s("Z0Oe"),n=s("cC/8"),i=s("iblZ"),a={props:["href","active"],computed:{classes:function(){return this.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"}}},o=s("KHd+"),l=Object(o.a)(a,(function(){var t=this.$createElement;return(this._self._c||t)("inertia-link",{class:this.classes,attrs:{href:this.href}},[this._t("default")],2)}),[],!1,null,null,null).exports,u={props:["active","href","as"],computed:{classes:function(){return this.active?"block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"}}},c=Object(o.a)(u,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",["button"==this.as?e("button",{staticClass:"w-full text-left",class:this.classes},[this._t("default")],2):e("inertia-link",{class:this.classes,attrs:{href:this.href}},[this._t("default")],2)],1)}),[],!1,null,null,null).exports,d=s("mydA"),p={name:"ErrorBoundary",data:function(){return{error:null}},errorCaptured:function(t,e,s){return this.error="".concat(t.stack,"\n\nfound in ").concat(s," of component"),!1},render:function(t){return this.error?t("pre",{style:{color:"red"}},this.error):this.$slots.default[0]}},v=Object(o.a)(p,void 0,void 0,!1,null,null,null).exports,f={components:{Logo:r.a,JetDropdown:n.a,JetDropdownLink:i.a,JetNavLink:l,FlashMessages:d.a,JetResponsiveNavLink:c,ErrorBoundary:v},data:function(){return{showingNavigationDropdown:!1}},methods:{switchToTeam:function(t){this.$inertia.put("/current-team",{team_id:t.id},{preserveState:!1})},logout:function(){this.$inertia.post(this.route("logout"))}},computed:{path:function(){return window.location.pathname}}},m=Object(o.a)(f,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"min-h-screen bg-gray-100"},[s("nav",{staticClass:"bg-white border-b border-gray-100 shadow-md"},[s("div",{staticClass:"px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"},[s("div",{staticClass:"flex justify-between h-16"},[s("div",{staticClass:"flex"},[s("div",{staticClass:"flex items-center flex-shrink-0"},[s("inertia-link",{attrs:{href:t.route("dashboard")}},[s("logo",{staticClass:"block w-auto h-10"})],1)],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("dashboard"),active:"dashboard"==t.$page.props.currentRouteName}},[t._v("\n              Dashboard\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("feedback.index"),active:"feedback.index"==t.$page.props.currentRouteName}},[t._v("\n              Feedback\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("offices.index"),active:"offices.index"==t.$page.props.currentRouteName}},[t._v("\n              Offices\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("services.index"),active:"services.index"==t.$page.props.currentRouteName}},[t._v("\n              Services\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("questions.index"),active:"questions.index"==t.$page.props.currentRouteName}},[t._v("\n              Questions\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("reports.index"),active:"reports.index"==t.$page.props.currentRouteName}},[t._v("\n              Reports\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("signatories.index"),active:"signatories.index"==t.$page.props.currentRouteName}},[t._v("\n              Signatories\n            ")])],1)]),t._v(" "),s("div",{staticClass:"hidden sm:flex sm:items-center sm:ml-6"},[s("div",{staticClass:"relative ml-3"},[s("jet-dropdown",{attrs:{align:"right",width:"48"},scopedSlots:t._u([{key:"trigger",fn:function(){return[s("button",{staticClass:"flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"},[s("img",{staticClass:"object-cover w-8 h-8 rounded-full",attrs:{src:t.$page.props.user.profile_photo_url,alt:t.$page.props.user.name}})])]},proxy:!0},{key:"content",fn:function(){return[s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[t._v("\n                  Manage Account\n                ")]),t._v(" "),s("jet-dropdown-link",{attrs:{href:"/user/profile"}},[t._v("\n                  Profile\n                ")]),t._v(" "),t.$page.props.jetstream.hasApiFeatures?s("jet-dropdown-link",{attrs:{href:"/user/api-tokens"}},[t._v("\n                  API Tokens\n                ")]):t._e(),t._v(" "),s("div",{staticClass:"border-t border-gray-100"}),t._v(" "),s("form",{on:{submit:function(e){return e.preventDefault(),t.logout(e)}}},[s("jet-dropdown-link",{attrs:{as:"button"}},[t._v("\n                    Logout\n                  ")])],1)]},proxy:!0}])})],1)]),t._v(" "),s("div",{staticClass:"flex items-center -mr-2 sm:hidden"},[s("button",{staticClass:"inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500",on:{click:function(e){t.showingNavigationDropdown=!t.showingNavigationDropdown}}},[s("svg",{staticClass:"w-6 h-6",attrs:{stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"}},[s("path",{class:{hidden:t.showingNavigationDropdown,"inline-flex":!t.showingNavigationDropdown},attrs:{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"}}),t._v(" "),s("path",{class:{hidden:!t.showingNavigationDropdown,"inline-flex":t.showingNavigationDropdown},attrs:{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"}})])])])])]),t._v(" "),s("div",{staticClass:"sm:hidden",class:{block:t.showingNavigationDropdown,hidden:!t.showingNavigationDropdown}},[s("div",{staticClass:"pt-2 pb-3 space-y-1"},[s("jet-responsive-nav-link",{attrs:{href:t.route("dashboard"),active:"dashboard"==t.$page.props.currentRouteName}},[t._v("\n          Dashboard\n        ")])],1),t._v(" "),s("div",{staticClass:"pt-4 pb-1 border-t border-gray-200"},[s("div",{staticClass:"flex items-center px-4"},[s("div",{staticClass:"flex-shrink-0"},[s("img",{staticClass:"w-10 h-10 rounded-full",attrs:{src:t.$page.props.user.profile_photo_url,alt:t.$page.props.user.name}})]),t._v(" "),s("div",{staticClass:"ml-3"},[s("div",{staticClass:"text-base font-medium text-gray-800"},[t._v("\n              "+t._s(t.$page.props.user.name)+"\n            ")]),t._v(" "),s("div",{staticClass:"text-sm font-medium text-gray-500"},[t._v("\n              "+t._s(t.$page.props.user.email)+"\n            ")])])]),t._v(" "),s("div",{staticClass:"mt-3 space-y-1"},[s("jet-responsive-nav-link",{attrs:{href:"/user/profile",active:"profile.show"==t.$page.props.currentRouteName}},[t._v("\n            Profile\n          ")]),t._v(" "),t.$page.props.jetstream.hasApiFeatures?s("jet-responsive-nav-link",{attrs:{href:"/user/api-tokens",active:"api-tokens.index"==t.$page.props.currentRouteName}},[t._v("\n            API Tokens\n          ")]):t._e(),t._v(" "),s("form",{attrs:{method:"POST"},on:{submit:function(e){return e.preventDefault(),t.logout(e)}}},[s("jet-responsive-nav-link",{attrs:{as:"button"}},[t._v("\n              Logout\n            ")])],1),t._v(" "),t.$page.props.jetstream.hasTeamFeatures?[s("div",{staticClass:"border-t border-gray-200"}),t._v(" "),s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[t._v("\n              Manage Team\n            ")]),t._v(" "),s("jet-responsive-nav-link",{attrs:{href:"/teams/"+t.$page.props.user.current_team.id,active:"teams.show"==t.$page.props.currentRouteName}},[t._v("\n              Team Settings\n            ")]),t._v(" "),s("jet-responsive-nav-link",{attrs:{href:"/teams/create",active:"teams.create"==t.$page.props.currentRouteName}},[t._v("\n              Create New Team\n            ")]),t._v(" "),s("div",{staticClass:"border-t border-gray-200"}),t._v(" "),s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[t._v("\n              Switch Teams\n            ")]),t._v(" "),t._l(t.$page.props.user.all_teams,(function(e){return[s("form",{key:e.id,on:{submit:function(s){return s.preventDefault(),t.switchToTeam(e)}}},[s("jet-responsive-nav-link",{attrs:{as:"button"}},[s("div",{staticClass:"flex items-center"},[e.id==t.$page.props.user.current_team_id?s("svg",{staticClass:"w-5 h-5 mr-2 text-green-400",attrs:{fill:"none","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",stroke:"currentColor",viewBox:"0 0 24 24"}},[s("path",{attrs:{d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"}})]):t._e(),t._v(" "),s("div",[t._v(t._s(e.name))])])])],1)]}))]:t._e()],2)])])]),t._v(" "),s("main",[s("div",{staticClass:"flex-1 max-w-6xl px-4 py-4 m-auto overflow-y-auto",attrs:{"scroll-region":""}},[s("header",[s("h1",{staticClass:"page-header"},[t._t("header")],2)]),t._v(" "),s("flash-messages"),t._v(" "),s("error-boundary",[s("div",[t._t("default")],2)])],1)]),t._v(" "),s("portal-target",{attrs:{name:"modal",multiple:""}}),t._v(" "),s("portal-target",{attrs:{name:"dropdown",slim:""}})],1)}),[],!1,null,null,null);e.a=m.exports},"pF+r":function(t,e,s){"use strict";var r={inheritAttrs:!1,props:{id:{type:String,default:function(){return"text-input-".concat(this._uid)}},type:{type:String,default:"text"},value:{type:String,default:function(){}},label:{type:String,default:function(){}},error:{type:String,default:function(){}}},methods:{focus:function(){this.$refs.input.focus()},select:function(){this.$refs.input.select()},setSelectionRange:function(t,e){this.$refs.input.setSelectionRange(t,e)}}},n=s("KHd+"),i=Object(n.a)(r,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[t.label?s("label",{staticClass:"form-label",attrs:{for:t.id}},[t._v(t._s(t.label)+":")]):t._e(),t._v(" "),s("input",t._b({ref:"input",staticClass:"form-input",class:{error:t.error},attrs:{id:t.id,type:t.type},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},"input",t.$attrs,!1)),t._v(" "),t.error?s("div",{staticClass:"form-error"},[t._v("\n    "+t._s(t.error)+"\n  ")]):t._e()])}),[],!1,null,null,null);e.a=i.exports}}]);
//# sourceMappingURL=25.js.map?id=8f5000fb8be38b8ed121