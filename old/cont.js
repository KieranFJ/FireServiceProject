$(document).on("change", "select.getContents", function(){
    var action = $('select.getContents').parent().attr('action');        
    fillContents(action)
    
//        $('select.getContents').ready(function() {
//        var action = $('select.getContents').parent().attr('action');        
//        fillContents(action)
//    });
//    $('select.getContents').change(function() {        
//        var action = $('select.getContents').parent().attr('action');        
//        fillContents(action)
    });
//});

$(document).on("ready", "select.getContents", function(){
    var action = $('select.getContents').parent().attr('action');        
    fillContents(action)
  });

function loadBagContents(){
    var action = $('select.getContents').parent().attr('action');        
    fillContents(action)
}
function fillContents(action)
{        
    $('#upFormContents').load(action, $('select.getContents').parent().serializeArray());
}