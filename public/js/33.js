(window.webpackJsonp=window.webpackJsonp||[]).push([[33],{DotY:function(t,e,s){"use strict";s.r(e);var a=s("hAWA"),r=s("MY0P"),n=s("DORU"),i=s("6NUw"),l=s("noZS"),c=s.n(l),o=s("d8FT"),v=s.n(o),f=s("DzJC"),u=s.n(f),d={props:{services:{type:Object,default:function(){}},filters:{type:[Object,Array],default:function(){}}},components:{AppLayout:a.a,Icon:r.a,Pagination:n.a,SearchFilter:i.a},data:function(){return{filterForm:{text:this.filters.search,trashed:this.filters.trashed}}},watch:{filterForm:{handler:u()((function(){var t=v()(this.filterForm);this.$inertia.replace(this.route("services.index",Object.keys(t).length?t:{remember:"forget"}))}),150),deep:!0}},methods:{reset:function(){this.filterForm=c()(this.filterForm,(function(){return null}))}}},h=s("KHd+"),p=Object(h.a)(d,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("app-layout",{scopedSlots:t._u([{key:"header",fn:function(){return[t._v("\n    Services\n  ")]},proxy:!0}])},[t._v(" "),s("div",{staticClass:"flex justify-between"},[s("search-filter",{staticClass:"w-full max-w-md mr-4",on:{reset:t.reset},model:{value:t.filterForm.search,callback:function(e){t.$set(t.filterForm,"search",e)},expression:"filterForm.search"}},[s("label",{staticClass:"block text-gray-700"},[t._v("Trashed:")]),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.filterForm.trashed,expression:"filterForm.trashed"}],staticClass:"w-full mt-1 form-select",on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filterForm,"trashed",e.target.multiple?s:s[0])}}},[s("option",{domProps:{value:null}}),t._v(" "),s("option",{attrs:{value:"with"}},[t._v("\n          With Trashed\n        ")]),t._v(" "),s("option",{attrs:{value:"only"}},[t._v("\n          Only Trashed\n        ")])])]),t._v(" "),s("inertia-link",{staticClass:"btn-indigo",attrs:{href:t.route("services.create")}},[s("span",[t._v("Create")]),t._v(" "),s("span",{staticClass:"hidden md:inline"},[t._v("Service")])])],1),t._v(" "),s("table",{staticClass:"w-full my-4 whitespace-no-wrap bg-white"},[s("tr",{staticClass:"font-bold text-left"},[s("th",{staticClass:"p-4 text-center"},[t._v("\n        #\n      ")]),t._v(" "),s("th",{staticClass:"p-4 text-center"},[t._v("\n        Name\n      ")]),t._v(" "),s("th",{staticClass:"p-4 text-center"},[t._v("\n        Office\n      ")]),t._v(" "),s("th",{staticClass:"p-4 text-center"},[t._v("\n        Action\n      ")])]),t._v(" "),t._l(t.services.data,(function(e,a){return s("tr",{key:e.id,staticClass:"border-t hover:bg-gray-100 focus-within:bg-gray-100"},[s("td",{staticClass:"p-3"},[t._v("\n        "+t._s(t.services.from+a)+"\n      ")]),t._v(" "),s("td",{staticClass:"p-3"},[t._v("\n        "+t._s(e.name)+"\n        "),e.deleted_at?s("icon",{staticClass:"inline w-3 h-3 ml-2 fill-red-400",attrs:{name:"trash"}}):t._e()],1),t._v(" "),s("td",{staticClass:"p-3"},[t._v("\n        "+t._s(e.office)+"\n      ")]),t._v(" "),s("td",{staticClass:"p-3"},[s("inertia-link",{staticClass:"focus:text-indigo-500",attrs:{href:t.route("services.edit",e.id),tabindex:"-1"}},[s("icon",{staticClass:"w-6 h-6 m-auto fill-gray-400",attrs:{name:"cheveron-right"}})],1)],1)])})),t._v(" "),0===t.services.data.length?s("tr",[s("td",{staticClass:"px-6 py-4 border-t",attrs:{colspan:"4"}},[t._v("\n        No Services found.\n      ")])]):t._e()],2),t._v(" "),s("pagination",{attrs:{links:t.services.links}})],1)}),[],!1,null,null,null);e.default=p.exports}}]);
//# sourceMappingURL=33.js.map?id=f065bc7d18a8ecfbb046