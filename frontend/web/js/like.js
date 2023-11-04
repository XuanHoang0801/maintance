$(document).ready(function(){
    $(document).on("click","#like",function() {

        var id = $("#id").val();
        $.post(
            '/maintain/post/like',
            {
                id:id,
            },
            function(data){
            var item = '<i class="fas fa-thumbs-down "></i>  Bỏ thích'
            $('#like').html(item);
            $('#like').attr('id','unlike');
            $('.count-like').html(data['count']);
            }
        )
    });

    $(document).on("click","#unlike",function() {
        var id = $("#id").val();

        $.post(
            '/maintain/post/un-like',
            {
                id:id,
            },
            function(data){
                var item = '<i class="fas fa-thumbs-up "></i>  Thích'
            $('#unlike').html(item);
            $('#unlike').attr('id','like');
            $('.count-like').html(data['count']);
            }
        )
    });

    $(document).on("click","#comment",function() {
        var content = $('#content').val();
        var id = $('#id').val();
        $.post(
            '/maintain/post/comment',
            {
                content: content,
                post_id: id 
            },
            function(data){
                var item = '<div class="comment-item d-flex">' +
                                '<div class="comment-avatar">' +
                                '<img class="avatar" src="'+data['avt']+'" alt="">'+
                                '</div>'+
                                '<div class="comment-content ">'+
                                '<div class="comment-top d-flex">'+
                                    '<div class="comment-author"><strong>'+data['user']+'</strong></div>'+
                                    '<div class="comment-time fw-light ml-3">'+data['time']+'</div>'+
                                '</div>'+
                                '<div class="comment-text">'+data['content']+'</div>'+
                                '</div>'+
                            '</div>';
                $('.list-comment').append(item);
            }
        )
    });

});