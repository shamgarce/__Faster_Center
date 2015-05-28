///------------------------------------------------前置运算

/*	
使用 
//console.log();
$(document).ready(function(){
	$.CK({
		ok:true,
		rel:'dialog/p2.shtml'
	});
})

<script type="text/dialog">
ob = this;
	$(".dialog_refresh").click(function(){
		$.CKrefresh(_option);
	});
	//关闭
	$(".dialog_close").click(function(){
		ob.close();
	});
	//ok按钮动作
	this.opt = {				//确定按钮的点击
		ok:function(){
			var res = {
					code: 200,
					msg : 'hello'
				}
			return res;
		},
		cancel:function(){},						//点击cancel按钮
		close:function(){},							//关闭对话框 不是回调
	}
	
</script>


对话框中
	ob = this;
	//ok按钮动作
	this.opt = {				//确定按钮的点击
		ok:function(){
			var res = {
					code: 200,
					msg : 'hello'
				}
			return res;
		},
		cancel:function(){},						//点击cancel按钮
		close:function(){},							//关闭对话框 不是回调
	}

	//刷新
	$(".dialog_refresh").click(function(){
		$.CKrefresh(_option);
	});
	
	//关闭
	$(".dialog_close").click(function(){
		ob.close();
	});
		
*/

var _option;
//=======================================================	//独立函数 io / dorefresh
jQuery.extend({
	CK:function(option){

		option = $.CK2.ini(option);
		_option = option;					//得到准备好的option
		
		//console.log(option);
		$.CK2.dopopup(option);
	},
	CKend:function(option){
		//关闭option对话框
	},
	CKrefresh:function(option){
		//刷新对话框
		var nrs = $.CK2.htmlget(option);
		art.dialog.list[option.id].content(nrs);
	}
});




jQuery.extend({
	CK2:{
		states:function(){
			//console.log(this);
		},
		ini:function(option){
			return $.extend({},  {
				width 	: '',
				height 	: '',
				left 	: '',
				top 	: '250px',
				
				fixed 	: '',
				resize 	: '',
				drag 	: '',
				
				background :'',
				opacity : '',
				icon 	: '',
				//content: nrs,
				rndid	: '',
				url		: '',
				//==============================================
				ok		: false,
				cancel	: false,
				buttonok: false,

				callback:false,
				//==============================================
				rel		: '',
				confirm_d	: 'vdtr',
				id		: 'v1212',
				title	: '',
				lock	: true,
				style	: 'popup'
			}, option)
		},
		htmlget:function(option) {
			
			option.url = option.rel;
			options = {
				url : option.url,
				dataType: "html",
				async:false,
				cache:true
			};
			return $.ajax(options).responseText;
			
		},
		dofresh:function(option) {
		},
		
		okb : function(option){
			
			var opts = (option.ok == false || option.ok == null)?false:function () {
				if(typeof(this.opt) == 'object'){
					//------------------------------------------------
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
					//------------------------------------------------
				}else{
					if(option.ok == true){
						return true;
					}else{
						option.ok();
					}
				}
				if(typeof(option.callback) == 'function')option.callback();
			};
			//console.log(opts);
			
			return opts;		
		},
		dopopup:function(option) {
			var vs = this.okb(option);
//			console.log(vs);
			var vdia = art.dialog({
				id: option.id,
				title	: option.title,
	
//				width 	: option.width,
//				height 	: option.height,
//				left 	: option.left,
				top 	: option.top,
				
//				fixed 	: option.fixed,
//				resize 	: option.resize,
//				drag 	: true,
				lock 	: true,
				
//				background :option.background,
				opacity : 0.3,
				icon 	: option.icon,
				//content: nrs,
				ok: this.okb(option),
				cancel:option.cancel,
				
			});
			
			var nrs = this.htmlget(option);
			vdia.content(nrs);				
		}
	}
	
});


