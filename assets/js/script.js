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
     
  return !$('#select1 option:selected').remove().appendTo('#select2');  
 });  
 $('#remove').click(function() {  
     
  return !$('#select2 option:selected').remove().appendTo('#select1');  
 });  
});