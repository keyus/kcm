(function ($) {
    $("#contact_qq").on("click",function(){
        var qq=$(this).data('qq'),
            url="http://wpa.qq.com/msgrd?v=3&uin="+qq+"&site=qq&menu=yes";
        var post={
            qq:qq,
            host:window.location.origin
        }
        $.post('/api/consult',post).then(function (data) {

        })
        window.open(url);
    })
})(jQuery)