$(document).ready(function(){
   
    //sets up validation for the forms
    $("form").validate();
    
    //actually checks for validity
    $("form").submit(function(e){  
        e.preventDefault();
        var id=$(this).attr('id'),
            action=$(this).attr('action');
        
        if($("#"+id).valid()){
            $('#'+id).find('div.message').load(action, $('#'+id).serializeArray());            
        }    
        //.message needs to be inside the form that is being submitted otherwise it wont find it
    });
});

//$(document).ajaxStart(function(){ 
//  $('#bagAmount').text('busy'); 
//}).ajaxStop(function(){ 
//  $('#bagAmount').text('notbusy');
//});

function fillSearchForm(action)
{          
    $('#searchUpForm').load(action, $('.searchGet').serializeArray());
}

$('select.get').on().change(function() {
        
      var action = $(this).parent().attr('action');  
      var target = $(this).data('target');  
      $('#'+target).load(action, $(this).parent().serializeArray());      

  }).change(); 
        

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

//$('#typeahead').change(function() {    
//    $('#type-submit').click();
//});

$(function() {  

    $('#add').click(function() {  
        
        var bagID = $('select#bag').parent().find('#bagID').val();
        var levelID = $('select#bag').parent().find('#levelID').val();
        var bagNumber = $('select#bag').parent().find('#bagNumber').val();
        var serials = new Array();
        
        $('#store option:selected').each(function(i){
            serials[i] = $(this).val();
        });
                
        $.ajax({
           
           data: {  serialArr : serials,
                    bagID : bagID,
                    levelID : levelID,
                    bagNumber : bagNumber},
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
           data: {  serialArr : serials,
                    bagID : 0},
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

function fillContents(action)
{        
    $('#upFormContents').load(action, $('select.getContents').parent().serializeArray());
}
