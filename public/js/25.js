(window.webpackJsonp=window.webpackJsonp||[]).push([[25],{QvW6:function(e,t,s){"use strict";s.r(t);var i=s("hAWA"),r=s("Z84v"),n=s("Ujtf"),o=s("pF+r"),a=s("GO1j"),c={components:{AppLayout:i.a,LoadingButton:r.a,SelectInput:n.a,TextInput:o.a,TrashedMessage:a.a},props:{errors:{type:Object,default:function(){}},service:{type:Object,default:function(){}},offices:{type:Array,default:function(){return[]}}},remember:"form",data:function(){return{sending:!1,form:{name:this.service.name,office_id:this.service.office_id}}},methods:{submit:function(){var e=this;this.sending=!0,this.$inertia.patch(this.route("services.update",this.service.id),this.form).then((function(){return e.sending=!1}))},destroy:function(){confirm("Are you sure you want to delete this service?")&&this.$inertia.delete(this.route("services.destroy",this.service.id))}}},l=s("KHd+"),d=Object(l.a)(c,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("app-layout",{scopedSlots:e._u([{key:"header",fn:function(){return[s("inertia-link",{staticClass:"text-indigo-400 hover:text-indigo-600",attrs:{href:e.route("services.index")}},[e._v("\n      Services\n    ")]),e._v(" "),s("span",{staticClass:"font-medium"},[e._v("/")]),e._v("\n    "+e._s(e.form.name)+"\n  ")]},proxy:!0}])},[e._v(" "),e.service.deleted_at?s("trashed-message",{staticClass:"mb-6",on:{restore:e.restore}},[e._v("\n    This service has been deleted.\n  ")]):e._e(),e._v(" "),s("div",{staticClass:"self-center m-auto overflow-hidden bg-white rounded shadow-xl"},[s("form",{on:{submit:function(t){return t.preventDefault(),e.submit(t)}}},[s("div",{staticClass:"flex flex-wrap p-8 -mb-8 -mr-6"},[s("text-input",{staticClass:"w-full pb-8 pr-6 lg:w-1/2",attrs:{error:e.errors.name,label:"Name"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),s("select-input",{staticClass:"w-full pb-8 pr-6 lg:w-1/2",attrs:{error:e.errors.office_id,label:"Office"},model:{value:e.form.office_id,callback:function(t){e.$set(e.form,"office_id",t)},expression:"form.office_id"}},[s("option",{domProps:{value:null}}),e._v(" "),e._l(e.offices,(function(t){return s("option",{key:t.id,domProps:{value:t.id}},[e._v("\n            "+e._s(t.abbr)+"\n          ")])}))],2)],1),e._v(" "),s("div",{staticClass:"flex items-center justify-between px-8 py-4 bg-gray-100 border-t border-gray-200"},[e.service.deleted_at?e._e():s("button",{staticClass:"btn-red",attrs:{tabindex:"-1",type:"button"},on:{click:e.destroy}},[e._v("\n          Delete Service\n        ")]),e._v(" "),s("loading-button",{staticClass:"btn-indigo",attrs:{loading:e.sending,type:"submit"}},[e._v("\n          Update Service\n        ")])],1)])])],1)}),[],!1,null,null,null);t.default=d.exports}}]);
//# sourceMappingURL=25.js.map?id=fb28996e8585af3d0d41