//调用
/*
$(".__container").CkFill({
	url 	: "/A/DE/index.html",
	js 		: ""
});
*/
(function($) {
	$.fn.CkFill = function(options) {
		var _this = this;
        var opts = $.extend({}, $.fn.CkFill.defaults, options);
		opts.error  =  function() {
		//		loading('请求失败!');
			}
		opts.success  = function(result) {
				_this.html(result);
			}
		$.ajax(opts);
		if(opts.js !== ''){$.getScript(opts.js,{},false);}
    };

    $.fn.CkFill.defaults = {
		url 	: "/A/DE/index.html",
		//==================================================
		type	: "GET",
		js 		: "",				//执行的js
		data 	: "",				//post数据
		dataType: "html",
		async	: false,
		cache	: true
    };
})(jQuery);
