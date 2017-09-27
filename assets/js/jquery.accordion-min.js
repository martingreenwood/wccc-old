!function($,t,n,e){function i(t,n){this.element=t,this.options=$.extend({},o,n),this._defaults=o,this._name=a,this.init()}var a="accordion",o={transitionSpeed:300,transitionEasing:"ease",controlElement:"[data-control]",contentElement:"[data-content]",groupElement:"[data-accordion-group]",singleOpen:!0};i.prototype.init=function(){function e(t,n,e){var i;return function a(){function o(){e||t.apply(s,r),i=null}var s=this,r=arguments;i?clearTimeout(i):e&&t.apply(s,r),i=setTimeout(o,n||100)}}function i(){var t=n.body||n.documentElement,e=t.style,i="transition";if("string"==typeof e[i])return!0;var a=["Moz","webkit","Webkit","Khtml","O","ms"];i="Transition";for(var o=0;o<a.length;o++)if("string"==typeof e[a[o]+i])return!0;return!1}function a(n){return t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame?requestAnimationFrame(n)||webkitRequestAnimationFrame(n)||mozRequestAnimationFrame(n):setTimeout(n,1e3/60)}function o(t,n){n?H.css({"-webkit-transition":"",transition:""}):H.css({"-webkit-transition":"max-height "+p.transitionSpeed+"ms "+p.transitionEasing,transition:"max-height "+p.transitionSpeed+"ms "+p.transitionEasing})}function s(t){var n=0;t.children().each(function(){n+=$(this).outerHeight(!0)}),t.data("oHeight",n)}function r(t,n,e,i){var a=t.filter(".open").find("> [data-content]"),o=a.find("[data-accordion].open > [data-content]"),s;p.singleOpen||(o=o.not(n.siblings("[data-accordion].open").find("> [data-content]"))),s=a.add(o),t.hasClass("open")&&s.each(function(){var t=$(this).data("oHeight");switch(i){case"+":$(this).data("oHeight",t+e);break;case"-":$(this).data("oHeight",t-e);break;default:throw"updateParentHeight method needs an operation"}$(this).css("max-height",$(this).data("oHeight"))})}function c(t){if(t.hasClass("open")){var n=t.find("> [data-content]"),e=n.find("[data-accordion].open > [data-content]"),i=n.add(e);s(i),i.css("max-height",i.data("oHeight"))}}function d(t,n){if(t.trigger("accordion.close"),k){if(w){r(t.parents("[data-accordion]"),t,n.data("oHeight"),"-")}n.css(b),t.removeClass("open")}else n.css("max-height",n.data("oHeight")),n.animate(b,p.transitionSpeed),t.removeClass("open")}function h(t,n){if(t.trigger("accordion.open"),k){if(o(n),w){r(t.parents("[data-accordion]"),t,n.data("oHeight"),"+")}a(function(){n.css("max-height",n.data("oHeight"))}),t.addClass("open")}else n.animate({"max-height":n.data("oHeight")},p.transitionSpeed,function(){n.css({"max-height":"none"})}),t.addClass("open")}function l(t){var n=t.closest(p.groupElement),e=t.siblings("[data-accordion]").filter(".open"),i=e.find("[data-accordion]").filter(".open"),a=e.add(i);a.each(function(){var t=$(this);d(t,t.find(p.contentElement))}),a.removeClass("open")}function f(){var t=!!p.singleOpen&&v.parents(p.groupElement).length>0;s(H),t&&l(v),v.hasClass("open")?d(v,H):h(v,H)}function u(){E.on("click",f),E.on("accordion.toggle",function(){if(p.singleOpen&&E.length>1)return!1;f()}),E.on("accordion.refresh",function(){c(v)}),$(t).on("resize",e(function(){c(v)}))}function m(){H.each(function(){var t=$(this);0!=t.css("max-height")&&(t.closest("[data-accordion]").hasClass("open")?(o(t),s(t),t.css("max-height",t.data("oHeight"))):t.css({"max-height":0,overflow:"hidden"}))}),v.attr("data-accordion")||(v.attr("data-accordion",""),v.find(p.controlElement).attr("data-control",""),v.find(p.contentElement).attr("data-content",""))}var g=this,p=g.options,v=$(g.element),E=v.find("> "+p.controlElement),H=v.find("> "+p.contentElement),x=v.parents("[data-accordion]").length,w=x>0,b={"max-height":0,overflow:"hidden"},k=i();m(),u()},$.fn[a]=function(t){return this.each(function(){$.data(this,"plugin_"+a)||$.data(this,"plugin_"+a,new i(this,t))})}}(jQuery,window,document);