(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{"4iGB":function(t,e,s){"use strict";var n={props:{type:{type:String,default:"submit"}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this.$createElement;return(this._self._c||t)("button",{staticClass:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150",attrs:{type:this.type}},[this._t("default")],2)}),[],!1,null,null,null);e.a=o.exports},"7f1e":function(t,e,s){"use strict";var n={props:{show:{default:!1},maxWidth:{default:"2xl"},closeable:{default:!0}},methods:{close:function(){this.closeable&&this.$emit("close")}},watch:{show:{immediate:!0,handler:function(t){document.body.style.overflow=t?"hidden":null}}},created:function(){var t=this,e=function(e){"Escape"===e.key&&t.show&&t.close()};document.addEventListener("keydown",e),this.$once("hook:destroyed",(function(){document.removeEventListener("keydown",e)}))},computed:{maxWidthClass:function(){return{sm:"sm:max-w-sm",md:"sm:max-w-md",lg:"sm:max-w-lg",xl:"sm:max-w-xl","2xl":"sm:max-w-2xl"}[this.maxWidth]}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("portal",{attrs:{to:"modal"}},[e("transition",{attrs:{leaveActiveClass:"duration-200"}},[e("div",{directives:[{name:"show",rawName:"v-show",value:this.show,expression:"show"}],staticClass:"fixed inset-x-0 top-0 px-4 pt-6 sm:px-0 sm:flex sm:items-top sm:justify-center"},[e("transition",{attrs:{enterActiveClass:"ease-out duration-300",enterClass:"opacity-0",enterToClass:"opacity-100",leaveActiveClass:"ease-in duration-200",leaveClass:"opacity-100",leaveToClass:"opacity-0"}},[e("div",{directives:[{name:"show",rawName:"v-show",value:this.show,expression:"show"}],staticClass:"fixed inset-0 transition-all transform",on:{click:this.close}},[e("div",{staticClass:"absolute inset-0 bg-gray-500 opacity-75"})])]),this._v(" "),e("transition",{attrs:{enterActiveClass:"ease-out duration-300",enterClass:"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95",enterToClass:"opacity-100 translate-y-0 sm:scale-100",leaveActiveClass:"ease-in duration-200",leaveClass:"opacity-100 translate-y-0 sm:scale-100",leaveToClass:"opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"}},[e("div",{directives:[{name:"show",rawName:"v-show",value:this.show,expression:"show"}],staticClass:"overflow-hidden transition-all transform bg-white rounded-lg shadow-xl sm:w-full",class:this.maxWidthClass},[this._t("default")],2)])],1)])],1)}),[],!1,null,null,null);e.a=o.exports},CxDH:function(t,e,s){"use strict";var n=s("KHd+"),i=Object(n.a)({},(function(){var t=this.$createElement;this._self._c;return this._m(0)}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"hidden sm:block"},[e("div",{staticClass:"py-8"},[e("div",{staticClass:"border-t border-gray-200"})])])}],!1,null,null,null);e.a=i.exports},F9sF:function(t,e,s){"use strict";var n={props:{message:{type:String,default:""}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{directives:[{name:"show",rawName:"v-show",value:this.message,expression:"message"}]},[e("p",{staticClass:"text-sm font-bold text-red-600 md:text-4xl"},[this._v("\n    "+this._s(this.message)+"\n  ")])])}),[],!1,null,null,null);e.a=o.exports},HEq2:function(t,e,s){"use strict";var n={props:["value"],methods:{focus:function(){this.$refs.input.focus()}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("input",{ref:"input",staticClass:"form-input rounded-md shadow-sm",domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})}),[],!1,null,null,null);e.a=o.exports},"KHd+":function(t,e,s){"use strict";function n(t,e,s,n,i,o,a,r){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=s,c._compiled=!0),n&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),a?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},c._ssrRegister=l):i&&(l=r?function(){i.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:i),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}s.d(e,"a",(function(){return n}))},KLIG:function(t,e,s){"use strict";var n={props:{type:{type:String,default:"button"}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this.$createElement;return(this._self._c||t)("button",{staticClass:"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150",attrs:{type:this.type}},[this._t("default")],2)}),[],!1,null,null,null);e.a=o.exports},V2YS:function(t,e,s){"use strict";var n={components:{Modal:s("7f1e").a},props:{show:{default:!1},maxWidth:{default:"2xl"},closeable:{default:!0}},methods:{close:function(){this.$emit("close")}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("modal",{attrs:{show:t.show,"max-width":t.maxWidth,closeable:t.closeable},on:{close:t.close}},[s("div",{staticClass:"px-6 py-4"},[s("div",{staticClass:"text-lg"},[t._t("title")],2),t._v(" "),s("div",{staticClass:"mt-4"},[t._t("content")],2)]),t._v(" "),s("div",{staticClass:"px-6 py-4 bg-gray-100 text-right"},[t._t("footer")],2)])}),[],!1,null,null,null);e.a=o.exports},mG0w:function(t,e,s){"use strict";var n={props:{type:{type:String,default:"button"}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this.$createElement;return(this._self._c||t)("button",{staticClass:"inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150",attrs:{type:this.type}},[this._t("default")],2)}),[],!1,null,null,null);e.a=o.exports},oPAw:function(t,e,s){"use strict";var n={components:{JetSectionTitle:s("xfBN").a}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"md:grid md:grid-cols-3 md:gap-6"},[s("jet-section-title",{scopedSlots:t._u([{key:"title",fn:function(){return[t._t("title")]},proxy:!0},{key:"description",fn:function(){return[t._t("description")]},proxy:!0}],null,!0)}),t._v(" "),s("div",{staticClass:"mt-5 md:mt-0 md:col-span-2"},[s("div",{staticClass:"px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg"},[t._t("content")],2)])],1)}),[],!1,null,null,null);e.a=o.exports},p9ws:function(t,e,s){"use strict";var n={components:{JetSectionTitle:s("xfBN").a},computed:{hasActions:function(){return!!this.$slots.actions}}},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"md:grid md:grid-cols-3 md:gap-6"},[s("jet-section-title",{scopedSlots:t._u([{key:"title",fn:function(){return[t._t("title")]},proxy:!0},{key:"description",fn:function(){return[t._t("description")]},proxy:!0}],null,!0)}),t._v(" "),s("div",{staticClass:"mt-5 md:mt-0 md:col-span-2"},[s("form",{on:{submit:function(e){return e.preventDefault(),t.$emit("submitted")}}},[s("div",{staticClass:"shadow overflow-hidden sm:rounded-md"},[s("div",{staticClass:"px-4 py-5 bg-white sm:p-6"},[s("div",{staticClass:"grid grid-cols-6 gap-6"},[t._t("form")],2)]),t._v(" "),t.hasActions?s("div",{staticClass:"flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6"},[t._t("actions")],2):t._e()])])])],1)}),[],!1,null,null,null);e.a=o.exports},tAcx:function(t,e,s){"use strict";var n={props:["value"]},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("label",{staticClass:"block font-medium text-sm text-gray-700"},[this.value?e("span",[this._v(this._s(this.value))]):e("span",[this._t("default")],2)])}),[],!1,null,null,null);e.a=o.exports},x7Mh:function(t,e,s){"use strict";s.r(e);var n=s("zZX0"),i=s("oPAw"),o=s("4iGB"),a={components:{Modal:s("7f1e").a},props:{show:{default:!1},maxWidth:{default:"2xl"},closeable:{default:!0}},methods:{close:function(){this.$emit("close")}}},r=s("KHd+"),l=Object(r.a)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("modal",{attrs:{show:t.show,"max-width":t.maxWidth,closeable:t.closeable},on:{close:t.close}},[s("div",{staticClass:"bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"},[s("div",{staticClass:"sm:flex sm:items-start"},[s("div",{staticClass:"mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"},[s("svg",{staticClass:"h-6 w-6 text-red-600",attrs:{stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"}},[s("path",{attrs:{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"}})])]),t._v(" "),s("div",{staticClass:"mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left"},[s("h3",{staticClass:"text-lg"},[t._t("title")],2),t._v(" "),s("div",{staticClass:"mt-2"},[t._t("content")],2)])])]),t._v(" "),s("div",{staticClass:"px-6 py-4 bg-gray-100 text-right"},[t._t("footer")],2)])}),[],!1,null,null,null).exports,c=s("mG0w"),u=s("V2YS"),d=s("p9ws"),p=s("HEq2"),m=s("F9sF"),f=s("tAcx"),v=s("KLIG"),h=s("CxDH"),x={components:{JetActionMessage:n.a,JetActionSection:i.a,JetButton:o.a,JetConfirmationModal:l,JetDangerButton:c.a,JetDialogModal:u.a,JetFormSection:d.a,JetInput:p.a,JetInputError:m.a,JetLabel:f.a,JetSecondaryButton:v.a,JetSectionBorder:h.a},props:["tokens","availablePermissions","defaultPermissions"],data:function(){return{createApiTokenForm:this.$inertia.form({name:"",permissions:this.defaultPermissions},{bag:"createApiToken",resetOnSuccess:!0}),updateApiTokenForm:this.$inertia.form({permissions:[]},{resetOnSuccess:!1,bag:"updateApiToken"}),deleteApiTokenForm:this.$inertia.form(),displayingToken:!1,managingPermissionsFor:null,apiTokenBeingDeleted:null}},methods:{createApiToken:function(){var t=this;this.createApiTokenForm.post("/user/api-tokens",{preserveScroll:!0}).then((function(e){t.createApiTokenForm.hasErrors()||(t.displayingToken=!0)}))},manageApiTokenPermissions:function(t){this.updateApiTokenForm.permissions=t.abilities,this.managingPermissionsFor=t},updateApiToken:function(){var t=this;this.updateApiTokenForm.put("/user/api-tokens/"+this.managingPermissionsFor.id,{preserveScroll:!0,preserveState:!0}).then((function(e){t.managingPermissionsFor=null}))},confirmApiTokenDeletion:function(t){this.apiTokenBeingDeleted=t},deleteApiToken:function(){var t=this;this.deleteApiTokenForm.delete("/user/api-tokens/"+this.apiTokenBeingDeleted.id,{preserveScroll:!0,preserveState:!0}).then((function(){t.apiTokenBeingDeleted=null}))},fromNow:function(t){return moment(t).local().fromNow()}}},y=Object(r.a)(x,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("jet-form-section",{on:{submitted:t.createApiToken},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n      Create API Token\n    ")]},proxy:!0},{key:"description",fn:function(){return[t._v("\n      API tokens allow third-party services to authenticate with our application on your behalf.\n    ")]},proxy:!0},{key:"form",fn:function(){return[s("div",{staticClass:"col-span-6 sm:col-span-4"},[s("jet-label",{attrs:{for:"name",value:"Name"}}),t._v(" "),s("jet-input",{staticClass:"mt-1 block w-full",attrs:{id:"name",type:"text",autofocus:""},model:{value:t.createApiTokenForm.name,callback:function(e){t.$set(t.createApiTokenForm,"name",e)},expression:"createApiTokenForm.name"}}),t._v(" "),s("jet-input-error",{staticClass:"mt-2",attrs:{message:t.createApiTokenForm.error("name")}})],1),t._v(" "),t.availablePermissions.length>0?s("div",{staticClass:"col-span-6"},[s("jet-label",{attrs:{for:"permissions",value:"Permissions"}}),t._v(" "),s("div",{staticClass:"mt-2 grid grid-cols-1 md:grid-cols-2 gap-4"},t._l(t.availablePermissions,(function(e){return s("div",[s("label",{staticClass:"flex items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:t.createApiTokenForm.permissions,expression:"createApiTokenForm.permissions"}],staticClass:"form-checkbox",attrs:{type:"checkbox"},domProps:{value:e,checked:Array.isArray(t.createApiTokenForm.permissions)?t._i(t.createApiTokenForm.permissions,e)>-1:t.createApiTokenForm.permissions},on:{change:function(s){var n=t.createApiTokenForm.permissions,i=s.target,o=!!i.checked;if(Array.isArray(n)){var a=e,r=t._i(n,a);i.checked?r<0&&t.$set(t.createApiTokenForm,"permissions",n.concat([a])):r>-1&&t.$set(t.createApiTokenForm,"permissions",n.slice(0,r).concat(n.slice(r+1)))}else t.$set(t.createApiTokenForm,"permissions",o)}}}),t._v(" "),s("span",{staticClass:"ml-2 text-sm text-gray-600"},[t._v(t._s(e))])])])})),0)],1):t._e()]},proxy:!0},{key:"actions",fn:function(){return[s("jet-action-message",{staticClass:"mr-3",attrs:{on:t.createApiTokenForm.recentlySuccessful}},[t._v("\n        Created.\n      ")]),t._v(" "),s("jet-button",{class:{"opacity-25":t.createApiTokenForm.processing},attrs:{disabled:t.createApiTokenForm.processing}},[t._v("\n        Create\n      ")])]},proxy:!0}])}),t._v(" "),t.tokens.length>0?s("div",[s("jet-section-border"),t._v(" "),s("div",{staticClass:"mt-10 sm:mt-0"},[s("jet-action-section",{scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n          Manage API Tokens\n        ")]},proxy:!0},{key:"description",fn:function(){return[t._v("\n          You may delete any of your existing tokens if they are no longer needed.\n        ")]},proxy:!0},{key:"content",fn:function(){return[s("div",{staticClass:"space-y-6"},t._l(t.tokens,(function(e){return s("div",{staticClass:"flex items-center justify-between"},[s("div",[t._v("\n                "+t._s(e.name)+"\n              ")]),t._v(" "),s("div",{staticClass:"flex items-center"},[e.last_used_at?s("div",{staticClass:"text-sm text-gray-400"},[t._v("\n                  Last used "+t._s(t.fromNow(e.last_used_at))+"\n                ")]):t._e(),t._v(" "),t.availablePermissions.length>0?s("button",{staticClass:"cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none",on:{click:function(s){return t.manageApiTokenPermissions(e)}}},[t._v("\n                  Permissions\n                ")]):t._e(),t._v(" "),s("button",{staticClass:"cursor-pointer ml-6 text-sm text-red-500 focus:outline-none",on:{click:function(s){return t.confirmApiTokenDeletion(e)}}},[t._v("\n                  Delete\n                ")])])])})),0)]},proxy:!0}],null,!1,1144617728)})],1)],1):t._e(),t._v(" "),s("jet-dialog-modal",{attrs:{show:t.displayingToken},on:{close:function(e){t.displayingToken=!1}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n      API Token\n    ")]},proxy:!0},{key:"content",fn:function(){return[s("div",[t._v("\n        Please copy your new API token. For your security, it won't be shown again.\n      ")]),t._v(" "),t.$page.props.jetstream.flash.token?s("div",{staticClass:"mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500"},[t._v("\n        "+t._s(t.$page.props.jetstream.flash.token)+"\n      ")]):t._e()]},proxy:!0},{key:"footer",fn:function(){return[s("jet-secondary-button",{nativeOn:{click:function(e){t.displayingToken=!1}}},[t._v("\n        Close\n      ")])]},proxy:!0}])}),t._v(" "),s("jet-dialog-modal",{attrs:{show:t.managingPermissionsFor},on:{close:function(e){t.managingPermissionsFor=null}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n      API Token Permissions\n    ")]},proxy:!0},{key:"content",fn:function(){return[s("div",{staticClass:"grid grid-cols-1 md:grid-cols-2 gap-4"},t._l(t.availablePermissions,(function(e){return s("div",[s("label",{staticClass:"flex items-center"},[s("input",{directives:[{name:"model",rawName:"v-model",value:t.updateApiTokenForm.permissions,expression:"updateApiTokenForm.permissions"}],staticClass:"form-checkbox",attrs:{type:"checkbox"},domProps:{value:e,checked:Array.isArray(t.updateApiTokenForm.permissions)?t._i(t.updateApiTokenForm.permissions,e)>-1:t.updateApiTokenForm.permissions},on:{change:function(s){var n=t.updateApiTokenForm.permissions,i=s.target,o=!!i.checked;if(Array.isArray(n)){var a=e,r=t._i(n,a);i.checked?r<0&&t.$set(t.updateApiTokenForm,"permissions",n.concat([a])):r>-1&&t.$set(t.updateApiTokenForm,"permissions",n.slice(0,r).concat(n.slice(r+1)))}else t.$set(t.updateApiTokenForm,"permissions",o)}}}),t._v(" "),s("span",{staticClass:"ml-2 text-sm text-gray-600"},[t._v(t._s(e))])])])})),0)]},proxy:!0},{key:"footer",fn:function(){return[s("jet-secondary-button",{nativeOn:{click:function(e){t.managingPermissionsFor=null}}},[t._v("\n        Nevermind\n      ")]),t._v(" "),s("jet-button",{staticClass:"ml-2",class:{"opacity-25":t.updateApiTokenForm.processing},attrs:{disabled:t.updateApiTokenForm.processing},nativeOn:{click:function(e){return t.updateApiToken(e)}}},[t._v("\n        Save\n      ")])]},proxy:!0}])}),t._v(" "),s("jet-confirmation-modal",{attrs:{show:t.apiTokenBeingDeleted},on:{close:function(e){t.apiTokenBeingDeleted=null}},scopedSlots:t._u([{key:"title",fn:function(){return[t._v("\n      Delete API Token\n    ")]},proxy:!0},{key:"content",fn:function(){return[t._v("\n      Are you sure you would like to delete this API token?\n    ")]},proxy:!0},{key:"footer",fn:function(){return[s("jet-secondary-button",{nativeOn:{click:function(e){t.apiTokenBeingDeleted=null}}},[t._v("\n        Nevermind\n      ")]),t._v(" "),s("jet-danger-button",{staticClass:"ml-2",class:{"opacity-25":t.deleteApiTokenForm.processing},attrs:{disabled:t.deleteApiTokenForm.processing},nativeOn:{click:function(e){return t.deleteApiToken(e)}}},[t._v("\n        Delete\n      ")])]},proxy:!0}])})],1)}),[],!1,null,null,null);e.default=y.exports},xfBN:function(t,e,s){"use strict";var n=s("KHd+"),i=Object(n.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"md:col-span-1"},[e("div",{staticClass:"px-4 sm:px-0"},[e("h3",{staticClass:"text-lg font-medium text-gray-900"},[this._t("title")],2),this._v(" "),e("p",{staticClass:"mt-1 text-sm text-gray-600"},[this._t("description")],2)])])}),[],!1,null,null,null);e.a=i.exports},zZX0:function(t,e,s){"use strict";var n={props:["on"]},i=s("KHd+"),o=Object(i.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("transition",{attrs:{"leave-active-class":"transition ease-in duration-1000","leave-class":"opacity-100","leave-to-class":"opacity-0"}},[e("div",{directives:[{name:"show",rawName:"v-show",value:this.on,expression:"on"}],staticClass:"text-sm text-gray-600"},[this._t("default")],2)])],1)}),[],!1,null,null,null);e.a=o.exports}}]);
//# sourceMappingURL=5.js.map?id=24c7e25b267669976b5c