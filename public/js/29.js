(window.webpackJsonp=window.webpackJsonp||[]).push([[29],{"4uSf":function(e,t,n){"use strict";n.r(t);var r=n("hAWA"),i=n("Z84v"),s=n("Ujtf"),o=n("pF+r"),a=n("GO1j"),f={components:{AppLayout:r.a,LoadingButton:i.a,SelectInput:s.a,TextInput:o.a,TrashedMessage:a.a},props:{errors:{type:Object,default:function(){}},office:{type:Object,default:function(){}},offices:{type:Array,default:function(){return[]}}},remember:"form",data:function(){return{sending:!1,form:{name:this.office.name,abbr:this.office.abbr,parent_id:this.office.parent_id}}},methods:{submit:function(){var e=this;this.sending=!0,this.$inertia.patch(this.route("offices.update",this.office.id),this.form).then((function(){return e.sending=!1}))},destroy:function(){confirm("Are you sure you want to delete this office?")&&this.$inertia.delete(this.route("offices.destroy",this.office.id))}}},l=n("KHd+"),c=Object(l.a)(f,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("app-layout",{scopedSlots:e._u([{key:"header",fn:function(){return[n("inertia-link",{staticClass:"text-indigo-400 hover:text-indigo-600",attrs:{href:e.route("offices.index")}},[e._v("\n      Offices\n    ")]),e._v(" "),n("span",{staticClass:"font-medium"},[e._v("/")]),e._v("\n    "+e._s(e.form.name)+"\n  ")]},proxy:!0}])},[e._v(" "),e.office.deleted_at?n("trashed-message",{staticClass:"mb-6",on:{restore:e.restore}},[e._v("\n    This office has been deleted.\n  ")]):e._e(),e._v(" "),n("div",{staticClass:"self-center m-auto overflow-hidden bg-white rounded shadow-xl"},[n("form",{on:{submit:function(t){return t.preventDefault(),e.submit(t)}}},[n("div",{staticClass:"flex flex-wrap p-8 -mb-8 -mr-6"},[n("text-input",{staticClass:"w-full pb-8 pr-6 lg:w-1/2",attrs:{error:e.errors.name,label:"Name"},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),n("text-input",{staticClass:"w-full pb-8 pr-6 lg:w-1/2",attrs:{error:e.errors.abbr,label:"Abbreviation"},model:{value:e.form.abbr,callback:function(t){e.$set(e.form,"abbr",t)},expression:"form.abbr"}}),e._v(" "),n("select-input",{staticClass:"w-full pb-8 pr-6 lg:w-1/2",attrs:{error:e.errors.parent_id,label:"Parent Office"},model:{value:e.form.parent_id,callback:function(t){e.$set(e.form,"parent_id",t)},expression:"form.parent_id"}},[n("option",{domProps:{value:null}}),e._v(" "),e._l(e.offices,(function(t){return n("option",{key:t.id,domProps:{value:t.id}},[e._v("\n            "+e._s(t.abbr)+"\n          ")])}))],2)],1),e._v(" "),n("div",{staticClass:"flex items-center justify-between px-8 py-4 bg-gray-100 border-t border-gray-200"},[e.office.deleted_at?e._e():n("button",{staticClass:"btn-red",attrs:{tabindex:"-1",type:"button"},on:{click:e.destroy}},[e._v("\n          Delete Office\n        ")]),e._v(" "),n("loading-button",{staticClass:"btn-indigo",attrs:{loading:e.sending,type:"submit"}},[e._v("\n          Update Office\n        ")])],1)])])],1)}),[],!1,null,null,null);t.default=c.exports}}]);
//# sourceMappingURL=29.js.map?id=f3c18de3bf563288add7