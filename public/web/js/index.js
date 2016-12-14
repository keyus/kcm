/**
 * 首页导航点切换
 */
$(function(){
  	//首页咨询栏切换
	$(".navi").click(function(){
		var liIndex=$(this).index();
		$(".main").eq(liIndex).css("display","block").siblings(".main").hide();
		$(".more").eq(liIndex).css("display","block").siblings(".more").hide();
		$(this).addClass("on");
                $(this).siblings().removeClass("on");
		});
	//首页导航点切换
	$(".main_box3 .box_three li").click(function(){
		var liIndex=$(this).index();
		$(".zs_img img").eq(liIndex).css("display","block").siblings().hide();
		$(this).addClass("on").siblings().removeClass("on");
		});
});

















