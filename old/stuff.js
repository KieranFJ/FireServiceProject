//
//
//function fillSearchForm(action)
//{          
//    $('#searchUpForm').load(action, $('.searchGet').serializeArray());
//}
//
//$(function() {
//            $("#typeahead").typeahead({
//                source: function(query, process) {
//                    $.ajax({
//                        url: 'php/item/search_item.php',
//                        type: 'POST',
//                        data: 'query=' + query,
//                        dataType: 'JSON',
//                        async: true,
//                        success: function(data){
//                            process(data);
//                        }
//                    });
//                }
//            });
//        });
//
//$(function() {  
//
// $('#add').click(function() {  
//     
//  return !$('#select1 option:selected').remove().appendTo('#select2');  
// });  
// $('#remove').click(function() {  
//     
//  return !$('#select2 option:selected').remove().appendTo('#select1');  
// });  
//});