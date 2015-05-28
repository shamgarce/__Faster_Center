/*
//功能有限，适用范围是 功能简单，不需要刷新，没有复窗口

$(".dialog222").click(function(){
	$.CK({
		rel:$(this).attr('rel'),
		//width:'96%',
	});
});

//命令关闭窗口

$('#'+bootstrap_dialog.diaid).hide();
$('.modal-backdrop').remove();
==
$.CKend(bootstrap_dialog);


*/
var bootstrap_dialog;
jQuery.extend({
	CKend:function(option) {
		$('#'+option.diaid).hide();
		$('.modal-backdrop').remove();
	},
	CK:function(option) {
		//console.log(option);
		var FI = function(option){
			re = option.rel;
			tag = re.replace('.','');
			//console.log(tag);
			//tag = tag.replaceAll('/','');
			tag = tag.replace(/\//g,'')
			tag = tag.replace('\\','');
			tag = tag.replace('?','');
			tag = tag.replace('&','');
			tag = 'modal_tbtersgdore'+tag;
			//console.log(tag);
			return tag;
		};
		var htmlget = function(option){
			options = {
				url : option.rel,
				dataType: "html",
				async:false,
				cache:true
			};
			return $.ajax(options).responseText;
		};

		//====================================================================
		tag = FI(option);
		option.diaid = tag;
		//====================================================================
		$("#"+tag).remove()			//移除已经存在的
		//====================================================================
		
		if(option.width !==undefined){
			option.width = "style='width:"+option.width+";'";
		}
		htmlmode_b 	= '<div class="modal fade" id="'+tag+'"><div class="modal-dialog" '+option.width+'><div class="modal-content">';
		htmlmode_e 	= '</div></div></div>';
		html 		= htmlmode_b + htmlget(option) + htmlmode_e;
		//====================================================================
		$('body').append(html);
		//====================================================================
		var JS = $("script[type='text/dialog']").html();
		eval(JS);												//sytle
		//option.backdrop = 'fade';								//先加载
		
		bootstrap_dialog = option;
		//console.log(option_ck);
		jQuery("#"+tag).modal('show', {backdrop: 'fade'});
	},
	

});
