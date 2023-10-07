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
});