$(document).ready(function(e) {	 
	var debugget = function(url){
		options = {
			url: '/A/debug/LB/'+url+'.htm',
			dataType: "html",
			async:false,
			cache:true
		};
		return $.ajax(options).responseText;
	}
	$("body").append(debugget('debug'));			//加入html
	//-------------------------------------------------------------
	$('.footerbtn2').hide();
	$('.zj_toggle').addClass('zj_togglebg');
	$('.footerbtn1').click(function() {
		if($('.footerbtn2').attr('states')=='vst'){
			$('.footerbtn2').hide();
			$('.zj_toggle').addClass('zj_togglebg')
			$('.footerbtn2').attr('states','vstt');
		}else{
			$('.footerbtn2').show();
			$('.zj_toggle').removeClass('zj_togglebg');
			$('.footerbtn2').attr('states','vst');
		}
	});
	$('.footerbtn2 a').click(function(){
		var ts = $(this).attr("rel");
		var nr = debugget(ts);
		art.dialog({ 
			id:ts+'0987',
			lock:true,
			title: ts,
			opacity:0.35,
			content: nr,
			ok: function () {			//关闭执行
			}
		});
	});
});
