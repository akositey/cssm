(window.webpackJsonp=window.webpackJsonp||[]).push([[30],{gxWK:function(t,e,s){"use strict";s.r(e);var n=s("hAWA"),i=s("Z84v"),o=s("Ujtf"),r=s("pF+r"),a=s("GO1j"),u={components:{AppLayout:n.a,LoadingButton:i.a,SelectInput:o.a,TextInput:r.a,TrashedMessage:a.a},props:{errors:{type:Object,default:function(){}},question:{type:Object,default:function(){}},questions:{type:Array,default:function(){return[]}}},remember:"form",data:function(){return{sending:!1,form:{question:this.question.question,is_required:this.question.is_required,type:this.question.type}}},methods:{submit:function(){var t=this;this.sending=!0,this.$inertia.patch(this.route("questions.update",this.question.id),this.form).then((function(){return t.sending=!1}))},destroy:function(){confirm("Are you sure you want to delete this question?")&&this.$inertia.delete(this.route("questions.destroy",this.question.id))}}},l=s("KHd+"),d=Object(l.a)(u,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("app-layout",{scopedSlots:t._u([{key:"header",fn:function(){return[s("inertia-link",{staticClass:"text-indigo-400 hover:text-indigo-600",attrs:{href:t.route("questions.index")}},[t._v("\n      Questions\n    ")]),t._v(" "),s("span",{staticClass:"font-medium"},[t._v("/")]),t._v("\n    "+t._s(t.form.question)+"\n  ")]},proxy:!0}])},[t._v(" "),t.question.deleted_at?s("trashed-message",{staticClass:"mb-6",on:{restore:t.restore}},[t._v("\n    This question has been deleted.\n  ")]):t._e(),t._v(" "),s("div",{staticClass:"self-center m-auto overflow-hidden bg-white rounded shadow-xl"},[s("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[s("div",{staticClass:"flex flex-wrap p-8 -mb-8 -mr-6"},[s("text-input",{staticClass:"w-full pb-8 pr-6",attrs:{error:t.errors.question,label:"Question"},model:{value:t.form.question,callback:function(e){t.$set(t.form,"question",e)},expression:"form.question"}}),t._v(" "),s("select-input",{staticClass:"w-full pb-8 pr-6 lg:w-1/2",attrs:{error:t.errors.is_required,label:"Required"},model:{value:t.form.is_required,callback:function(e){t.$set(t.form,"is_required",e)},expression:"form.is_required"}},[s("option",{domProps:{value:null}}),t._v(" "),s("option",{key:"0",attrs:{value:"0"}},[t._v("\n            Optional\n          ")]),t._v(" "),s("option",{key:"1",attrs:{value:"1"}},[t._v("\n            Mandatory\n          ")])]),t._v(" "),s("select-input",{staticClass:"w-full pb-8 pr-6 lg:w-1/2",attrs:{error:t.errors.type,label:"(If Optional) Type"},model:{value:t.form.type,callback:function(e){t.$set(t.form,"type",e)},expression:"form.type"}},[s("option",{domProps:{value:null}}),t._v(" "),s("option",{key:"1",attrs:{value:"1"}},[t._v("\n            Positive\n          ")]),t._v(" "),s("option",{key:"2",attrs:{value:"2"}},[t._v("\n            Negative\n          ")]),t._v(" "),s("option",{key:"3",attrs:{value:"3"}},[t._v("\n            Etc\n          ")])])],1),t._v(" "),s("div",{staticClass:"flex items-center justify-between px-8 py-4 bg-gray-100 border-t border-gray-200"},[t.question.deleted_at?t._e():s("button",{staticClass:"btn-red",attrs:{tabindex:"-1",type:"button"},on:{click:t.destroy}},[t._v("\n          Delete Question\n        ")]),t._v(" "),s("loading-button",{staticClass:"btn-indigo",attrs:{loading:t.sending,type:"submit"}},[t._v("\n          Update Question\n        ")])],1)])])],1)}),[],!1,null,null,null);e.default=d.exports}}]);
//# sourceMappingURL=30.js.map?id=de00b3c56fb4faac1c6f