///------------------------------------------------前置运算
iobasew	= "/panel/CK.php";		//接口地址
jsbasew	= "/M/";				//js基础地址

debug = false;
if(!debug)$.ajaxSetup({cache: true});	//加上getajax缓存
//=======================================================	//独立函数 io / dorefresh
var Wr = {
	iobasew	:iobasew,
	jsbasew	:jsbasew,
	jsdo : function(option){
		if(option.js == true)	$.getScript(jsbasew+option.style+'/'+option.rel+'.js',{},false);
	},
	
	htmlget : function(option){
		if(typeof(option.data)!='object')	option.data = {};		
		if(option.url == true || option.url == undefined || option.url == ''){
			option.url = iobasew+'?c='+option.style+'.'+option.rel;
		}
		options = {
			url : option.url,
			data: option.data,
			dataType: "html",
			async:false,
			cache:true
		};
		return $.ajax(options).responseText;
	},

	dorefresh : function(option){
		var nr = Wr.htmlget(option);
		art.dialog.list[option.id].content(nr);
		Wr.jsdo(option);
	},
	
	dofill : function(option){
		var nrs = Wr.htmlget(option);
		$(option.fill).html(nrs);
		Wr.jsdo(option);
	},
	
	dopopup : function(option){
		var okb = (option.buttonok == false || option.buttonok == null)?'':function () {			//关闭执行
			if(typeof(this.opt) == 'object'){
				var fun = this.opt.ok;
				if(typeof(fun) == 'function'){
					var result = this.opt.ok();
					if(typeof(result) == 'boolean'){
						if(!result)	return false;
					}
					if(typeof(result) == 'object'){
						if(result.code <0){
							if(result.msg)art.dialog(result.msg).time(0.5);
							return false;
						}else{
							if(result.msg) art.dialog(result.msg).time(0.5);
						}
					}
				}
			}
			if(typeof(option.callback) == 'function')option.callback();
		};;
		var vdia = art.dialog({
			id: option.id,
			lock:true,
			title: option.title,

width 	: option.width,
height 	: option.height,
left 	: option.left,
top 	: option.top,

fixed 	: option.fixed,
resize 	: option.resize,
drag 	: option.drag,
lock 	: option.lock,

background :option.background,
opacity : option.opacity,
icon 	: option.icon,

			//content: nrs,
			ok: okb,
			cancel:option.buttoncancel
		});
		
		var nrs = Wr.htmlget(option);
		vdia.content(nrs);
		Wr.jsdo(option);
	},

	//--------------------------------------------------------------
	F : function(option){			//去除 空值 url  fill  js
		if(option.style == 'popup'){
			Wr.dopopup(option);
		}else{
			Wr.dofill(option);
		}
	}
	
};

jQuery.extend({
/*
width: '100%',      
height: '100%',      
left: '0%',     
top: '0%',    
  
fixed: true,      
resize: false,      
drag: false,
lock: true,

background: '#600', // 背景色
opacity: 0.87,	// 透明度
icon: 'error',
*/		
	
	CK:function(option) {
		if(!option.rel)	{console.log('miss rel');return false;}
		var now = new Date();
		var rndid = now.getTime() + 1000000000000 + Math.round(Math.random() * (9999999999999 - 1000000000000));   
		option.id = rndid;
		option.title 	= (option.title == null)? option.rel:option.title;
		option.lock 	= (option.lock == false || option.lock == '')	? false:true;
		option.style	= (option.fill == null)	? 'popup':'fill';
		option.js		= (option.js == null || option.js == false)	? false:true;
		
		_option = option;
		Wr.F(option);
	},
	

});