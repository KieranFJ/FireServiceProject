$(document).ready(function(){

    $('select.get').ready(function() {
        var action = $('select.get').parent().attr('action');        
        fillForm(action)
    });
    
    $('select.get').change(function() {
        var action = $('select.get').parent().attr('action');        
        fillForm(action)
    });
    
//    $('.searchGet').submit(function() {
//       var action = $('.searchGet').parent().attr('action');
//       $('#searchUpForm').load(action, $('searchGet').parent().serializeArray());
//    });

    function fillSearchForm(action)
    {          
            $('#searchUpForm').load(action, $('.searchGet').serializeArray());
    }
    
    function fillForm(action)
    {          
            $('#upForm').load(action, $('select.get').parent().serializeArray());
    }
    
    //sets up validation for the forms
    $("#form").validate();
    
    //actually checks for validity
    $("form").submit(function(e){        
        e.preventDefault();
        var id=$(this).attr('id'),
            action=$(this).attr('action');
        
        if($("#"+id).valid()){
            $('#'+id).find('div.message').load(action, $('#'+id).serializeArray());
        }        
    });
});