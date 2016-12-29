$('document').ready(function(){
   $('.genre-edit').hide();

    var brojZanrova = $('.list-group-item').length;
    var nizZanrova = [];
    for (brojZanrova;brojZanrova>0;brojZanrova--){
        nizZanrova.push(brojZanrova);
    }

    $.each(nizZanrova,function(index , value){
    $('.list-group-item:nth-child('+ value +') .fa-pencil-square-o').click(function(){
            $('.list-group-item:nth-child('+ value +') .genre-edit').slideToggle()
        });
    })
});