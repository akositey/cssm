(window.webpackJsonp=window.webpackJsonp||[]).push([[20],{hAWA:function(t,e,s){"use strict";var a=s("Z0Oe"),n={props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:Array,default:function(){return["py-1","bg-white"]}}},data:function(){return{open:!1}},created:function(){var t=this,e=function(e){t.open&&27===e.keyCode&&(t.open=!1)};this.$once("hook:destroyed",(function(){document.removeEventListener("keydown",e)})),document.addEventListener("keydown",e)},watch:{open:function(t){console.log("is "+(t?"":"not ")+"open")}},computed:{widthClass:function(){return{48:"w-48"}[this.width.toString()]},alignmentClasses:function(){return"left"==this.align?"origin-top-left left-0":"right"==this.align?"origin-top-right right-0":"origin-top"}}},i=s("KHd+"),r=Object(i.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"relative"},[s("div",{on:{click:function(e){t.open=!t.open}}},[t._t("trigger")],2),t._v(" "),s("div",{directives:[{name:"show",rawName:"v-show",value:t.open,expression:"open"}],staticClass:"fixed inset-0 z-40",on:{click:function(e){t.open=!1}}}),t._v(" "),s("transition",{attrs:{"enter-active-class":"transition duration-200 ease-out","enter-class":"transform scale-95 opacity-0","enter-to-class":"transform scale-100 opacity-100","leave-active-class":"transition duration-75 ease-in","leave-class":"transform scale-100 opacity-100","leave-to-class":"transform scale-95 opacity-0"}},[s("div",{directives:[{name:"show",rawName:"v-show",value:t.open,expression:"open"}],staticClass:"absolute z-50 mt-2 rounded-md shadow-lg",class:[t.widthClass,t.alignmentClasses],staticStyle:{display:"none"},on:{click:function(e){t.open=!1}}},[s("div",{staticClass:"rounded-md shadow-xs",class:t.contentClasses},[t._t("content")],2)])])],1)}),[],!1,null,null,null).exports,o={props:["href","as"]},l=Object(i.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",["button"==this.as?e("button",{staticClass:"block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out",attrs:{type:"submit"}},[this._t("default")],2):e("inertia-link",{staticClass:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out",attrs:{href:this.href}},[this._t("default")],2)],1)}),[],!1,null,null,null).exports,c={props:["href","active"],computed:{classes:function(){return this.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"}}},u=Object(i.a)(c,(function(){var t=this.$createElement;return(this._self._c||t)("inertia-link",{class:this.classes,attrs:{href:this.href}},[this._t("default")],2)}),[],!1,null,null,null).exports,d={props:["active","href","as"],computed:{classes:function(){return this.active?"block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"}}},p=Object(i.a)(d,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",["button"==this.as?e("button",{staticClass:"w-full text-left",class:this.classes},[this._t("default")],2):e("inertia-link",{class:this.classes,attrs:{href:this.href}},[this._t("default")],2)],1)}),[],!1,null,null,null).exports,v=s("mydA"),f={components:{Logo:a.a,JetDropdown:r,JetDropdownLink:l,JetNavLink:u,FlashMessages:v.a,JetResponsiveNavLink:p},data:function(){return{showingNavigationDropdown:!1}},methods:{switchToTeam:function(t){this.$inertia.put("/current-team",{team_id:t.id},{preserveState:!1})},logout:function(){this.$inertia.post(this.route("logout"))}},computed:{path:function(){return window.location.pathname}}},m=Object(i.a)(f,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"min-h-screen bg-gray-100"},[s("nav",{staticClass:"bg-white border-b border-gray-100"},[s("div",{staticClass:"px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"},[s("div",{staticClass:"flex justify-between h-16"},[s("div",{staticClass:"flex"},[s("div",{staticClass:"flex items-center flex-shrink-0"},[s("inertia-link",{attrs:{href:t.route("dashboard")}},[s("logo",{staticClass:"block w-auto h-10"})],1)],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("dashboard"),active:"dashboard"==t.$page.currentRouteName}},[t._v("\n              Dashboard\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("feedback.index"),active:"feedback.index"==t.$page.currentRouteName}},[t._v("\n              Feedback\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("offices.index"),active:"offices.index"==t.$page.currentRouteName}},[t._v("\n              Offices\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("services.index"),active:"services.index"==t.$page.currentRouteName}},[t._v("\n              Services\n            ")])],1),t._v(" "),s("div",{staticClass:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},[s("jet-nav-link",{attrs:{href:t.route("questions.index"),active:"questions.index"==t.$page.currentRouteName}},[t._v("\n              Questions\n            ")])],1)]),t._v(" "),s("div",{staticClass:"hidden sm:flex sm:items-center sm:ml-6"},[s("div",{staticClass:"relative ml-3"},[s("jet-dropdown",{attrs:{align:"right",width:"48"},scopedSlots:t._u([{key:"trigger",fn:function(){return[s("button",{staticClass:"flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"},[s("img",{staticClass:"object-cover w-8 h-8 rounded-full",attrs:{src:t.$page.user.profile_photo_url,alt:t.$page.user.name}})])]},proxy:!0},{key:"content",fn:function(){return[s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[t._v("\n                  Manage Account\n                ")]),t._v(" "),s("jet-dropdown-link",{attrs:{href:"/user/profile"}},[t._v("\n                  Profile\n                ")]),t._v(" "),t.$page.jetstream.hasApiFeatures?s("jet-dropdown-link",{attrs:{href:"/user/api-tokens"}},[t._v("\n                  API Tokens\n                ")]):t._e(),t._v(" "),s("div",{staticClass:"border-t border-gray-100"}),t._v(" "),s("form",{on:{submit:function(e){return e.preventDefault(),t.logout(e)}}},[s("jet-dropdown-link",{attrs:{as:"button"}},[t._v("\n                    Logout\n                  ")])],1)]},proxy:!0}])})],1)]),t._v(" "),s("div",{staticClass:"flex items-center -mr-2 sm:hidden"},[s("button",{staticClass:"inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500",on:{click:function(e){t.showingNavigationDropdown=!t.showingNavigationDropdown}}},[s("svg",{staticClass:"w-6 h-6",attrs:{stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"}},[s("path",{class:{hidden:t.showingNavigationDropdown,"inline-flex":!t.showingNavigationDropdown},attrs:{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"}}),t._v(" "),s("path",{class:{hidden:!t.showingNavigationDropdown,"inline-flex":t.showingNavigationDropdown},attrs:{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"}})])])])])]),t._v(" "),s("div",{staticClass:"sm:hidden",class:{block:t.showingNavigationDropdown,hidden:!t.showingNavigationDropdown}},[s("div",{staticClass:"pt-2 pb-3 space-y-1"},[s("jet-responsive-nav-link",{attrs:{href:t.route("dashboard"),active:"dashboard"==t.$page.currentRouteName}},[t._v("\n          Dashboard\n        ")])],1),t._v(" "),s("div",{staticClass:"pt-4 pb-1 border-t border-gray-200"},[s("div",{staticClass:"flex items-center px-4"},[s("div",{staticClass:"flex-shrink-0"},[s("img",{staticClass:"w-10 h-10 rounded-full",attrs:{src:t.$page.user.profile_photo_url,alt:t.$page.user.name}})]),t._v(" "),s("div",{staticClass:"ml-3"},[s("div",{staticClass:"text-base font-medium text-gray-800"},[t._v("\n              "+t._s(t.$page.user.name)+"\n            ")]),t._v(" "),s("div",{staticClass:"text-sm font-medium text-gray-500"},[t._v("\n              "+t._s(t.$page.user.email)+"\n            ")])])]),t._v(" "),s("div",{staticClass:"mt-3 space-y-1"},[s("jet-responsive-nav-link",{attrs:{href:"/user/profile",active:"profile.show"==t.$page.currentRouteName}},[t._v("\n            Profile\n          ")]),t._v(" "),t.$page.jetstream.hasApiFeatures?s("jet-responsive-nav-link",{attrs:{href:"/user/api-tokens",active:"api-tokens.index"==t.$page.currentRouteName}},[t._v("\n            API Tokens\n          ")]):t._e(),t._v(" "),s("form",{attrs:{method:"POST"},on:{submit:function(e){return e.preventDefault(),t.logout(e)}}},[s("jet-responsive-nav-link",{attrs:{as:"button"}},[t._v("\n              Logout\n            ")])],1),t._v(" "),t.$page.jetstream.hasTeamFeatures?[s("div",{staticClass:"border-t border-gray-200"}),t._v(" "),s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[t._v("\n              Manage Team\n            ")]),t._v(" "),s("jet-responsive-nav-link",{attrs:{href:"/teams/"+t.$page.user.current_team.id,active:"teams.show"==t.$page.currentRouteName}},[t._v("\n              Team Settings\n            ")]),t._v(" "),s("jet-responsive-nav-link",{attrs:{href:"/teams/create",active:"teams.create"==t.$page.currentRouteName}},[t._v("\n              Create New Team\n            ")]),t._v(" "),s("div",{staticClass:"border-t border-gray-200"}),t._v(" "),s("div",{staticClass:"block px-4 py-2 text-xs text-gray-400"},[t._v("\n              Switch Teams\n            ")]),t._v(" "),t._l(t.$page.user.all_teams,(function(e){return[s("form",{key:e.id,on:{submit:function(s){return s.preventDefault(),t.switchToTeam(e)}}},[s("jet-responsive-nav-link",{attrs:{as:"button"}},[s("div",{staticClass:"flex items-center"},[e.id==t.$page.user.current_team_id?s("svg",{staticClass:"w-5 h-5 mr-2 text-green-400",attrs:{fill:"none","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",stroke:"currentColor",viewBox:"0 0 24 24"}},[s("path",{attrs:{d:"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"}})]):t._e(),t._v(" "),s("div",[t._v(t._s(e.name))])])])],1)]}))]:t._e()],2)])])]),t._v(" "),s("main",[s("div",{staticClass:"flex-1 max-w-6xl px-4 py-4 m-auto overflow-y-auto",attrs:{"scroll-region":""}},[s("header",[s("h1",{staticClass:"mb-4 text-3xl font-bold"},[t._t("header")],2)]),t._v(" "),s("flash-messages"),t._v(" "),t._t("default")],2)]),t._v(" "),s("portal-target",{attrs:{name:"modal",multiple:""}}),t._v(" "),s("portal-target",{attrs:{name:"dropdown",slim:""}})],1)}),[],!1,null,null,null);e.a=m.exports},pUxE:function(t,e,s){"use strict";s.r(e);var a=s("x7Mh"),n=s("hAWA"),i=s("CxDH"),r={props:["tokens","availablePermissions","defaultPermissions"],components:{ApiTokenManager:a.default,AppLayout:n.a,JetSectionBorder:i.a}},o=s("KHd+"),l=Object(o.a)(r,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("app-layout",{scopedSlots:t._u([{key:"header",fn:function(){return[s("h2",{staticClass:"font-semibold text-xl text-gray-800 leading-tight"},[t._v("\n            API Tokens\n        ")])]},proxy:!0}])},[t._v(" "),s("div",[s("div",{staticClass:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},[s("api-token-manager",{attrs:{tokens:t.tokens,"available-permissions":t.availablePermissions,"default-permissions":t.defaultPermissions}})],1)])])}),[],!1,null,null,null);e.default=l.exports}}]);
//# sourceMappingURL=20.js.map?id=29cb295dac627768b902