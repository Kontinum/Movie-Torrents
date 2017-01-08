$('document').ready(function(){
   $('.genre-edit').hide();

    var brojZanrova = $('.genre-list').length;
    var nizZanrova = [];
    for (brojZanrova;brojZanrova>0;brojZanrova--){
        nizZanrova.push(brojZanrova);
    }

    $.each(nizZanrova,function(index , value){
    $('.genre-list:nth-child('+ value +') .fa-pencil-square-o').click(function(){
            $('.genre-list:nth-child('+ value +') .genre-edit').slideToggle()
        });
    })

    //Delay for session messages
    $('.info-box.success').delay(4000).slideUp(1000);
    $('.info-box.fail').delay(4000).slideUp(1000);

    //Drop down for add-movie-form
    $('.add-movie-form').hide();
    $('.dropdown-movie').click(function () {
        $('.add-movie-form').slideToggle();
        if($('.dropdown-movie-icon').hasClass('fa-chevron-down')){
            $('.dropdown-movie-icon').removeClass('fa-chevron-down');
            $('.dropdown-movie-icon').addClass('fa-chevron-up');
        } else{
            $('.dropdown-movie-icon').removeClass('fa-chevron-up');
            $('.dropdown-movie-icon').addClass('fa-chevron-down');
        }
    });

});