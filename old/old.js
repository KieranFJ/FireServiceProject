$(document).ready(function(){
    
    
    $('#target').change( function () {
        $('#upForm').load('php/get_level.php', $('#target').serialize());
    });
    
//    $("#inForm").validate({
//        submitHandler: function() {
//            $('#inForm').find('.addContentMess').load('php/add_level.php', $('#inForm').serializeArray());
//        }
//    });  
//
//

//fires off every time a form is clicked upon, working for now - better solution?
    $("#removeEntry").click(function() {
       $("#modalMessage").load('php/remove_level.php', $(this).serialize());
    });

//    $(".validate").click( function() {
//        //debugger;
//        //e.preventDefault();
//        var id=$(this).attr('id');
//        var action=$(this).attr('action');
//
//        console.log(action + ' ' + id); //works
//        $(this).validate({
//            submitHandler: function(){
//
//                console.log(action + ' ' + id); //doesnt work
//                $('#'+id).find('div.message').load(action, $('#'+id).serializeArray());            
//            }        
//        });
//    });
    
    $("form").validate();
    
    $("form").submit(function(e){        
        e.preventDefault();
        if($("form").valid()){
            var id=$(this).attr('id'),
                action=$(this).attr('action');
            console.log(action + ' ' + id);
            $('#'+id).find('div.message').load(action, $('#'+id).serializeArray());

        }        
    });
//        $("form").valid( function(e){        
//            console.log(action + ' ' + id);
//            $('#'+id).find('div.message').load(action, $('#'+id).serializeArray());
//            
//            
//        });
        
    
    
//old code, doesnt work

//$("form").submit(function(e){
//    
//    
//    e.preventDefault();
//    var id=$(this).attr('id');
//    var action=$(this).attr('action');
//    
//    console.log(action + ' ' + id); //works
//    
//    $('#'+id).validate({
//        submitHandler: function() {
//            
//            console.log(action + ' ' + id); //doesnt work
//            $('#'+id).find('div.message').load(action, $('#'+id).serializeArray());            
//        }
//    });    
//});
//    
//    $(form).validate({
//        submitHandler: function(form) {
//            
//            var action = $(form).attr('action');
//            var id = $(form).attr('id');
//            
//            console.log(action + ' ' + id);
//            $('#'+id).find('div.message').load(action, $('#'+id).serializeArray());            
//        }
//    });    
//    
//    $('#form2').validate({
//        
//        submitHandler: function() {
//            var action = $('#form2').attr('action');
//            
//            console.log(action + ' validate2');
//            $('#form2').find('div.message').load(action, $('#form2').serializeArray());            
//        }
//    });    
});