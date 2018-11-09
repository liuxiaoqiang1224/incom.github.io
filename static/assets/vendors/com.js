// // 个人中心下拉菜单
// $('.myself').mouseover(function(){
// 	$('.grzx').stop().slideDown();
// })
// $('.myself').mouseout(function(){
// 	$('.grzx').stop().slideUp();
// })
// 搜索框
// $('#search_img').click(function(){
// 	var val = document.getElementById('search_input');
// 	if (val.value == "" || val.value == "去发现吧！想要的所有！") {
// 		alert('请输入搜索内容');
// 	}else{
// 		alert(val.value);
// 	}
// })
var txt = document.getElementById('search_input');
txt.onfocus = function () {
	txt.placeholder = '';
	txt.value = '';
}
txt.onblur = function () {
	txt.placeholder = '请输入...';
}
var arr = ['去', '探', '索', '吧', '！','去' ,'找', '你', '想', '要', '的', '！'];
function inner (arr) {
	var timer = null;
	var count = 0;
	timer = setInterval(function () {
		if(count === arr.length - 1) {
			clearInterval(timer);
		}
		txt.value += arr[count];
		count++;
	}, 100)
}
inner(arr);
// 回到顶部
$('.right_top_img').click(function(){
	$('html, body').stop().animate({'scrollTop':0},600);
})
// qq群
// $('.qq').mouseover(function(){
// 	$('.qq_p').stop().slideDown();
// }).mouseout(function(){
// 	$('.qq_p').stop().slideUp();
// })
// $('.right_top_img').mousedown(function(){
// 	return false;
// }).mouseup(function(){
// 	return false;
// });

//广告去除
$('.close').click(function(){
	$('.banner').remove();
});

$('.list_01').parent().nextAll().css({
	width: '98%',
	height: 40,
	backgroundColor: '#e8e8e8',
	borderRadius: 5
})

// 评论区
var btnPL = document.getElementById('btnPL');
var searchtxt = document.getElementById('text');
var ul = document.getElementById('ul');
btnPL.onclick = function(){
  if (searchtxt.value === '') {
    alert('内容为空，重新输入');
    return;
  }
  var text = searchtxt.value;
  var li = document.createElement('li');
  li.innerText = text;
  if (ul.children.length === 0) {
    ul.appendChild(li);
  }else{
    ul.insertBefore(li,ul.children[0]);
  }
  li.innerHTML += '<input type="button" value="删除">'
  li.children[li.children.length-1].onclick = function(){
    ul.removeChild(li);
  }
  searchtxt.value = '';
}
