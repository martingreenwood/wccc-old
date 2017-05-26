!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}(function($){"use strict";function t(t){if(t instanceof Date)return t;if(String(t).match(o))return String(t).match(/^[0-9]*$/)&&(t=Number(t)),String(t).match(/\-/)&&(t=String(t).replace(/\-/g,"/")),new Date(t);throw new Error("Couldn't cast `"+t+"` to a date object.")}function e(t){var e=t.toString().replace(/([.?*+^$[\]\\(){}|-])/g,"\\$1");return new RegExp(e)}function s(t){return function(s){var n=s.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);if(n)for(var o=0,a=n.length;o<a;++o){var h=n[o].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),l=e(h[0]),c=h[1]||"",f=h[3]||"",u=null;h=h[2],r.hasOwnProperty(h)&&(u=r[h],u=Number(t[u])),null!==u&&("!"===c&&(u=i(f,u)),""===c&&u<10&&(u="0"+u.toString()),s=s.replace(l,u.toString()))}return s=s.replace(/%%/,"%")}}function i(t,e){var s="s",i="";return t&&(t=t.replace(/(:|;|\s)/gi,"").split(/\,/),1===t.length?s=t[0]:(i=t[0],s=t[1])),Math.abs(e)>1?s:i}var n=[],o=[],a={precision:100,elapse:!1,defer:!1};o.push(/^[0-9]*$/.source),o.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),o.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),o=new RegExp(o.join("|"));var r={Y:"years",m:"months",n:"daysToMonth",d:"daysToWeek",w:"weeks",W:"weeksToMonth",H:"hours",M:"minutes",S:"seconds",D:"totalDays",I:"totalHours",N:"totalMinutes",T:"totalSeconds"},h=function(t,e,s){this.el=t,this.$el=$(t),this.interval=null,this.offset={},this.options=$.extend({},a),this.firstTick=!0,this.instanceNumber=n.length,n.push(this),this.$el.data("countdown-instance",this.instanceNumber),s&&("function"==typeof s?(this.$el.on("update.countdown",s),this.$el.on("stoped.countdown",s),this.$el.on("finish.countdown",s)):this.options=$.extend({},a,s)),this.setFinalDate(e),!1===this.options.defer&&this.start()};$.extend(h.prototype,{start:function(){null!==this.interval&&clearInterval(this.interval);var t=this;this.update(),this.interval=setInterval(function(){t.update.call(t)},this.options.precision)},stop:function(){clearInterval(this.interval),this.interval=null,this.dispatchEvent("stoped")},toggle:function(){this.interval?this.stop():this.start()},pause:function(){this.stop()},resume:function(){this.start()},remove:function(){this.stop.call(this),n[this.instanceNumber]=null,delete this.$el.data().countdownInstance},setFinalDate:function(e){this.finalDate=t(e)},update:function(){if(0===this.$el.closest("html").length)return void this.remove();var t=new Date,e;if(e=this.finalDate.getTime()-t.getTime(),e=Math.ceil(e/1e3),e=!this.options.elapse&&e<0?0:Math.abs(e),this.totalSecsLeft===e||this.firstTick)return void(this.firstTick=!1);this.totalSecsLeft=e,this.elapsed=t>=this.finalDate,this.offset={seconds:this.totalSecsLeft%60,minutes:Math.floor(this.totalSecsLeft/60)%60,hours:Math.floor(this.totalSecsLeft/60/60)%24,days:Math.floor(this.totalSecsLeft/60/60/24)%7,daysToWeek:Math.floor(this.totalSecsLeft/60/60/24)%7,daysToMonth:Math.floor(this.totalSecsLeft/60/60/24%30.4368),weeks:Math.floor(this.totalSecsLeft/60/60/24/7),weeksToMonth:Math.floor(this.totalSecsLeft/60/60/24/7)%4,months:Math.floor(this.totalSecsLeft/60/60/24/30.4368),years:Math.abs(this.finalDate.getFullYear()-t.getFullYear()),totalDays:Math.floor(this.totalSecsLeft/60/60/24),totalHours:Math.floor(this.totalSecsLeft/60/60),totalMinutes:Math.floor(this.totalSecsLeft/60),totalSeconds:this.totalSecsLeft},this.options.elapse||0!==this.totalSecsLeft?this.dispatchEvent("update"):(this.stop(),this.dispatchEvent("finish"))},dispatchEvent:function(t){var e=$.Event(t+".countdown");e.finalDate=this.finalDate,e.elapsed=this.elapsed,e.offset=$.extend({},this.offset),e.strftime=s(this.offset),this.$el.trigger(e)}}),$.fn.countdown=function(){var t=Array.prototype.slice.call(arguments,0);return this.each(function(){var e=$(this).data("countdown-instance");if(void 0!==e){var s=n[e],i=t[0];h.prototype.hasOwnProperty(i)?s[i].apply(s,t.slice(1)):null===String(i).match(/^[$A-Z_][0-9A-Z_$]*$/i)?(s.setFinalDate.call(s,i),s.start()):$.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi,i))}else new h(this,t[0],t[1])})}});