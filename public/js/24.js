(window.webpackJsonp=window.webpackJsonp||[]).push([[24],{"+TQ2":function(e,t,s){"use strict";s.r(t);var n={components:{AppLayout:s("hAWA").a}},r=s("KHd+"),a=Object(r.a)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("app-layout",{scopedSlots:e._u([{key:"header",fn:function(){return[e._v("\n    Dashboard\n  ")]},proxy:!0}])},[e._v(" "),s("div",{staticClass:"flex justify-between"},[e._v("\n    - statistics / charts\n    - feedback submissions\n    - \n  ")])])}),[],!1,null,null,null);t.default=a.exports},"KHd+":function(e,t,s){"use strict";function n(e,t,s,n,r,a,i,o){var l,d="function"==typeof e?e.options:e;if(t&&(d.render=t,d.staticRenderFns=s,d._compiled=!0),n&&(d.functional=!0),a&&(d._scopeId="data-v-"+a),i?(l=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(i)},d._ssrRegister=l):r&&(l=o?function(){r.call(this,(d.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(d.functional){d._injectStyles=l;var c=d.render;d.render=function(e,t){return l.call(t),c(e,t)}}else{var u=d.beforeCreate;d.beforeCreate=u?[].concat(u,l):[l]}return{exports:e,options:d}}s.d(t,"a",(function(){return n}))},hAWA:function(e,t,s){"use strict";var n=s("Z0Oe"),r=s("cC/8"),a=s("iblZ"),i={props:["href","active"],computed:{classes:function(){return this.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"}}},o=s("KHd+"),l=Object(o.a)(i,(function(){var e=this.$createElement;return(this._self._c||e)("inertia-link",{class:this.classes,attrs:{href:this.href}},[this._t("default")],2)}),[],!1,null,null,null).exports,d={props:["active","href","as"],computed:{classes:function(){return this.active?"block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"}}},c=Object(o.a)(d,(function(){var e=this.$createElement,t=this._self._c||e;return t("div",["button"==this.as?t("button",{staticClass:"w-full text-left",class:this.classes},[this._t("default")],2):t("inertia-link",{class:this.classes,attrs:{href:this.href}},[this._t("default")],2)],1)}),[],!1,null,null,null).exports,u=s("mydA"),p={components:{Logo:n.a,JetDropdown:r.a,JetDropdownLink:a.a,JetNavLink:l,FlashMessages:u.a,JetResponsiveNavLink:c},data:function(){return{showingNavigationDropdown:!1}},methods:{switchToTeam:function(e){this.$inertia.put("/current-team",{team_id:e.id},{preserveState:!1})},logout:function(){this.$inertia.post(this.route("logout"))}},computed:{path:function(){return window.location.pathname}}},v=Object(o.a)(p,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"min-h-screen bg-gray-100"},[s("nav",{staticClass:"bg-white border-b border-gray-100 shadow-md"},[s("div",{staticClass:"px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"},[s("div",{staticClass:"flex justify-between h-16"},[s("div",{staticClass:"flex"},[s("div",{staticClass:"flex items-center flex-shrink-0"},[s("inertia-link",{attrs:{href:e.route("dashboard")}},[s("logo",{staticClass:"block w-auto h-10"})],1)],1),e._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:e.route("dashboard"),active:"dashboard"==e.$page.props.currentRouteName}},[e._v("\n              Dashboard\n            ")])],1),e._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:e.route("feedback.index"),active:"feedback.index"==e.$page.props.currentRouteName}},[e._v("\n              Feedback\n            ")])],1),e._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:e.route("offices.index"),active:"offices.index"==e.$page.props.currentRouteName}},[e._v("\n              Offices\n            ")])],1),e._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:e.route("services.index"),active:"services.index"==e.$page.props.currentRouteName}},[e._v("\n              Services\n            ")])],1),e._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:e.route("questions.index"),active:"questions.index"==e.$page.props.currentRouteName}},[e._v("\n              Questions\n            ")])],1),e._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:e.route("reports.index"),active:"reports.index"==e.$page.props.currentRouteName}},[e._v("\n              Reports\n            ")])],1),e._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:e.route("signatories.index"),active:"signatories.index"==e.$page.props.currentRouteName}},[e._v("\n              Signatories\n            ")])],1)]),e._v(" "),s("div",{staticClass:"hidden sm:flex sm:items-center sm:ml-6"},[s("div",{staticClass:"relative ml-3"},[s("jet-dropdown",{attrs:{align:"right",width:"48"},scopedSlots:e._u([{key:"trigger",fn:function(){return[s("button",{staticClass:"flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"},[s("img",{staticClass:"object-cover w-8 h-8 rounded-full",attrs:{src:e.$page.props.user.profile_photo_url,alt:e.$page.props.user.name}})])]},proxy:!0},{key:"content",fn:function(){return[s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[e._v("\n                  Manage Account\n                ")]),e._v(" "),s("jet-dropdown-link",{attrs:{href:"/user/profile"}},[e._v("\n                  Profile\n                ")]),e._v(" "),e.$page.props.jetstream.hasApiFeatures?s("jet-dropdown-link",{attrs:{href:"/user/api-tokens"}},[e._v("\n                  API Tokens\n                ")]):e._e(),e._v(" "),s("div",{staticClass:"border-t border-gray-100"}),e._v(" "),s("form",{on:{submit:function(t){return t.preventDefault(),e.logout(t)}}},[s("jet-dropdown-link",{attrs:{as:"button"}},[e._v("\n                    Logout\n                  ")])],1)]},proxy:!0}])})],1)]),e._v(" "),s("div",{staticClass:"flex items-center -mr-2 sm:hidden"},[s("button",{staticClass:"inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500",on:{click:function(t){e.showingNavigationDropdown=!e.showingNavigationDropdown}}},[s("svg",{staticClass:"w-6 h-6",attrs:{stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"}},[s("path",{class:{hidden:e.showingNavigationDropdown,"inline-flex":!e.showingNavigationDropdown},attrs:{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"}}),e._v(" "),s("path",{class:{hidden:!e.showingNavigationDropdown,"inline-flex":e.showingNavigationDropdown},attrs:{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"}})])])])])]),e._v(" "),s("div",{staticClass:"sm:hidden",class:{block:e.showingNavigationDropdown,hidden:!e.showingNavigationDropdown}},[s("div",{staticClass:"pt-2 pb-3 space-y-1"},[s("jet-responsive-nav-link",{attrs:{href:e.route("dashboard"),active:"dashboard"==e.$page.props.currentRouteName}},[e._v("\n          Dashboard\n        ")])],1),e._v(" "),s("div",{staticClass:"pt-4 pb-1 border-t border-gray-200"},[s("div",{staticClass:"flex items-center px-4"},[s("div",{staticClass:"flex-shrink-0"},[s("img",{staticClass:"w-10 h-10 rounded-full",attrs:{src:e.$page.props.user.profile_photo_url,alt:e.$page.props.user.name}})]),e._v(" "),s("div",{staticClass:"ml-3"},[s("div",{staticClass:"text-base font-medium text-gray-800"},[e._v("\n              "+e._s(e.$page.props.user.name)+"\n            ")]),e._v(" "),s("div",{staticClass:"text-sm font-medium text-gray-500"},[e._v("\n              "+e._s(e.$page.props.user.email)+"\n            ")])])]),e._v(" "),s("div",{staticClass:"mt-3 space-y-1"},[s("jet-responsive-nav-link",{attrs:{href:"/user/profile",active:"profile.show"==e.$page.props.currentRouteName}},[e._v("\n            Profile\n          ")]),e._v(" "),e.$page.props.jetstream.hasApiFeatures?s("jet-responsive-nav-link",{attrs:{href:"/user/api-tokens",active:"api-tokens.index"==e.$page.props.currentRouteName}},[e._v("\n            API Tokens\n          ")]):e._e(),e._v(" "),s("form",{attrs:{method:"POST"},on:{submit:function(t){return t.preventDefault(),e.logout(t)}}},[s("jet-responsive-nav-link",{attrs:{as:"button"}},[e._v("\n              Logout\n            ")])],1),e._v(" "),e.$page.props.jetstream.hasTeamFeatures?[s("div",{staticClass:"border-t border-gray-200"}),e._v(" "),s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[e._v("\n              Manage Team\n            ")]),e._v(" "),s("jet-responsive-nav-link",{attrs:{href:"/teams/"+e.$page.props.user.current_team.id,active:"teams.show"==e.$page.props.currentRouteName}},[e._v("\n              Team Settings\n            ")]),e._v(" "),s("jet-responsive-nav-link",{attrs:{href:"/teams/create",active:"teams.create"==e.$page.props.currentRouteName}},[e._v("\n              Create New Team\n            ")]),e._v(" "),s("div",{staticClass:"border-t border-gray-200"}),e._v(" "),s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[e._v("\n              Switch Teams\n            ")]),e._v(" "),e._l(e.$page.props.user.all_teams,(function(t){return[s("form",{key:t.id,on:{submit:function(s){return s.preventDefault(),e.switchToTeam(t)}}},[s("jet-responsive-nav-link",{attrs:{as:"button"}},[s("div",{staticClass:"flex items-center"},[t.id==e.$page.props.user.current_team_id?s("svg",{staticClass:"w-5 h-5 mr-2 text-green-400",attrs:{fill:"none","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",stroke:"currentColor",viewBox:"0 0 24 24"}},[s("path",{attrs:{d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"}})]):e._e(),e._v(" "),s("div",[e._v(e._s(t.name))])])])],1)]}))]:e._e()],2)])])]),e._v(" "),s("main",[s("div",{staticClass:"flex-1 max-w-6xl px-4 py-4 m-auto overflow-y-auto",attrs:{"scroll-region":""}},[s("header",[s("h1",{staticClass:"page-header"},[e._t("header")],2)]),e._v(" "),s("flash-messages"),e._v(" "),e._t("default")],2)]),e._v(" "),s("portal-target",{attrs:{name:"modal",multiple:""}}),e._v(" "),s("portal-target",{attrs:{name:"dropdown",slim:""}})],1)}),[],!1,null,null,null);t.a=v.exports}}]);
//# sourceMappingURL=24.js.map?id=f077d7e4e742762db5b6