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

    $('.actor-edit').hide();

    var brojGlumaca = $('.actor-list').length;
    var nizGlumaca = [];
    for (brojGlumaca;brojGlumaca>0;brojGlumaca--){
        nizGlumaca.push(brojGlumaca);
    }

    $.each(nizGlumaca,function(index , value){
        $('.actor-list:nth-child('+ value +') .fa-pencil-square-o').click(function(){
            $('.actor-list:nth-child('+ value +') .actor-edit').slideToggle()
        });
    })
});