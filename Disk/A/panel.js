// JavaScript Document
function alertDismiss(clazz,sec){
	setTimeout(function(){
		$('.'+clazz).fadeOut();
	},sec*1000);
}
$(document).ready(function(){  
	var nsshowsitebar = getcookie('leftsidebar');
	if(nsshowsitebar ==2){
		$(".sidebar-nav").hide();
		$('#content').removeClass("content");
		$('#content').addClass("content_change");
	}
	//后台界面 add by sham
	$('.scollleft').click(function(){
		if($(".sidebar-nav").is(":hidden")){
			setcookie('leftsidebar',1);
			$(".sidebar-nav").show();
			$('#content').removeClass("content_change");
			$('#content').addClass("content");
		}else{
			setcookie('leftsidebar',2);
			$(".sidebar-nav").hide();
			$('#content').removeClass("content");
			$('#content').addClass("content_change");
		}
	})
	alertDismiss("alert-success",3);
	alertDismiss("alert-info",10); 
});