/**
 *  like
 */



$(document).on('click', '.like-btn', function (event) {


    $(this).addClass("rubberBand animated").one('animationend webkitAnimationEnd oAnimationEnd', function() {
        $(this).removeClass('rubberBand');
    });

    var url = $(this).data('request-url');
    var id = $(this).data('request-id');


    $.ajax({
        type:"post",
        url:url,
        data:{id: id},
        datatype: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend:function(){},
        success:function(data){
            var avatar

        },

        complete: function(XMLHttpRequest, textStatus){

        },
        error: function(){

        }
    });


    event.stopPropagation();
});


$(".like .animated").mousemove(function () {
    $(this).addClass("swing animated").one('animationend webkitAnimationEnd oAnimationEnd', function() {
        $(this).removeClass('swing');
    });
});
