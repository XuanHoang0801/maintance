$(document).ready(function(){
    $('.select').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#myModal').data('id', id).modal('show');
    });


        $('.ok').on('click', function(e){
            e.preventDefault();
            var id = $('#myModal').data('id');
            console.log(id);
           
            $.ajax({
                type: "POST",
                url: '/post/buy',
                data: {
                    id:id
                },
                success: function (data) {
                   if(data['message']){
                    $('.modal-body').html(data['message']);
                    $('#myModal').show();
                    $('.ok').hide();
                   }
                }
            })
        });
});