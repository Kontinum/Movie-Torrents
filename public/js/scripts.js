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

    $('.info-box.success').delay(4000).slideUp(1000);
    $('.info-box.fail').delay(4000).slideUp(1000);

});