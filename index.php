<?php

@include_once 'templates/header_temp.php';
@include_once 'templates/navigation_temp.php'; 

?>

<div class="container">
    <div class="span5">
        <h2>Quick Item Search</h2>
        
            <form class=".form-search" action="php/item/search_item.php" method="post" >
                <input autocomplete="off" class="input-large search-query searchGet" type="text" id="typeahead" data-provide="typeahead" name="search" placeholder="Serial Number or Item Number">
                <button type="submit" class="btn btn-danger" onclick="fillSearchForm('php/reports/quick_item_search.php')">Search</button>
            </form>            
                <div class="row">
                    <div id="searchUpForm">
                    </div>       
                    <div class="message span4"> 
                    </div>                            
                </div>
    </div>
    
    <div class="span5">
     <h1>Temp Menu</h1>
     
     <a href="level.php"><h4>Add/Update/Remove Bag Level</h4></a>
     <a href="itemCategories.php"><h4>Item Categories</h4></a>
     <a href="station.php"><h4>Station</h4></a>
     <a href="bag.php"><h4>Bag</h4></a> 
     <a href="item.php"><h4>Item</h4></a>
    </div>    
</div> <!-- /container -->
    
<?php

@include_once 'templates/footer_temp.php';    

?>

   
