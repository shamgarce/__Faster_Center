var confirms = function(vars,fn){
	art.dialog({
		lock: true,
		background: '#000', // 背景色
		opacity: 0.57,	// 透明度
		content: vars,
		ok: function () {//console.log('OK 执行操作');
		fn();},
		cancelVal: '关闭',
		cancel: true //为true等价于function(){}
	});
//	$('.icon-remove').click(function(){
//		var vs = function(){alert(1)}
//		confirms('确定要删除吗?',vs);
//	})
}

function getQueryString(name) {
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if (r != null) return unescape(r[2]); return null;
}

var isArray = function(obj) {
return Object.prototype.toString.call(obj) === '[object Array]';
} 

function inArray(needle,array,bool){
	if(typeof needle=="string"||typeof needle=="number"){
		for(var i in array){
			if(needle===array[i]){
				if(bool){
					return i;
				}
				return true;
			}
		}
		return false;
	}
}


function setcookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	document.cookie = name + "=" + value + expires + "; path=/";
}

function getcookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function setc(name){
	var is = getcookie(name);
	if(is == 1){
		var ns = 0;
	}else{
		var ns = 1;
	}
	setcookie(name,ns,1);
}


function HTMLDecode(str)
{  
	var s = "";
	if(str.length == 0)   return "";
	s    =    str.replace(/&amp;/g,"&");
	s    =    s.replace(/&lt;/g,"<");
	s    =    s.replace(/&gt;/g,">");
	s    =    s.replace(/&nbsp;/g," ");
	s    =    s.replace(/&#39;/g,"\'");
	s    =    s.replace(/&quot;/g,"\"");
	return   s;  
}
