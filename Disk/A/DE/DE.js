//追加左侧内容
$(document).ready(function(e) {	 
	$("body").append($.ajax({
		url 	: "/A/DE/Frame.html",
		//==================================================
		type	: "GET",
		data 	: "",				//post数据
		dataType: "html",
		async	: false,
		cache	: true
    }).responseText);			//加入html
	
});