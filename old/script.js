$(document).ready(function(){

    $('select.get').ready(function() {
        var action = $('select.get').parent().attr('action');        
        fillForm(action)
    });
    
    $('select.get').change(function() {
        var action = $('select.get').parent().attr('action');        
        fillForm(action)
    });
        
    function fillForm(action)
    {          
            $('#upForm').load(action, $('select.get').parent().serializeArray());
    }
    
    $('select.getType').ready(function() {
        var action = $('select.getType').parent().attr('action');        
        fillType(action)
    });
    
    $('select.getType').change(function() {
        
        var action = $('select.getType').parent().attr('action');        
        fillType(action)
    });
    
    function fillType(action)
    {
        
        $('#upFormType').load(action, $('select.getType').parent().serializeArray());
    }
    
//    $('select.getContents').ready(function() {
//        var action = $('select.getContents').parent().attr('action');        
//        fillContents(action)
//    });
//
//    $('select.getContents').change(function() {        
//        var action = $('select.getContents').parent().attr('action');        
//        fillContents(action)
//    });
//    function fillContents(action)
//    {        
//        $('#upFormContents').load(action, $('select.getContents').parent().serializeArray());
//    }
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

function fillSearchForm(action)
{          
    $('#searchUpForm').load(action, $('.searchGet').serializeArray());
}

$(function() {
            $("#typeahead").typeahead({
                source: function(query, process) {
                    $.ajax({
                        url: 'php/item/search_item.php',
                        type: 'POST',
                        data: 'query=' + query,
                        dataType: 'JSON',
                        async: true,
                        success: function(data){
                            process(data);
                        }
                    });
                }
            });
        });

$(function() {  

    $('#add').click(function() {  

        var serials = new Array();
        
        $('#store option:selected').each(function(i){
            serials[i] = $(this).val();
        });
                
        $.ajax({
           data: { serialArr : serials},
           type: $('select#bag').parent().attr('method'),
           url: $('select#bag').parent().attr('action'),
           success: function(returnData) {
               $('.message').html(returnData);
           }
        });
        return !$('#store option:selected').remove().appendTo('#bag');       
    });  
    $('#remove').click(function() { 
        
        var serials = new Array();
        
        $('#bag option:selected').each(function(i){
            serials[i] = $(this).val();
        });

        $.ajax({
           data: { serialArr : serials},
           type: $('select#store').parent().attr('method'),
           url: $('select#store').parent().attr('action'),
           success: function(returnData) {
               $('.message').html(returnData);
           }           
        });
        return !$('#bag option:selected').remove().appendTo('#store');       
    });  
});


$(document).on("change", "select.getContents", function(){
    var action = $('select.getContents').parent().attr('action');        
    fillContents(action);
    
});

//$(document).on("ready", "select.getContents", function(){
//    var action = $('select.getContents').parent().attr('action');        
//    fillContents(action);
//});

//        $('select.getContents').ready(function() {
//        var action = $('select.getContents').parent().attr('action');        
//        fillContents(action)
//    });
//    $('select.getContents').change(function() {        
//        var action = $('select.getContents').parent().attr('action');        
//        fillContents(action)
    
//});



//function loadBagContents(){
//    var action = $('select.getContents').parent().attr('action');        
//    fillContents(action)
//}
function fillContents(action)
{        
    $('#upFormContents').load(action, $('select.getContents').parent().serializeArray());
}