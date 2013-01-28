<?php

@include_once 'templates/header_temp.php';
@include_once 'templates/navigation_temp.php'; 

?>

<div class="container">
    <div class="span5">
     <h1>Temp Menu</h1>
     
     <a href="level.php"><h4>Add/Update/Remove Bag Level</h4></a>
     <a href="itemCategories.php"><h4>Item Categories</h4></a>
     <a href="station.php"><h4>Station</h4></a>
     <a href="bag.php"><h4>Bag</h4></a> 
     <a href="item.php"><h4>Item</h4></a>
    </div>
    <div class="span5">
        <h1>Warning</h1>
        <p>This is a testing environment, all information entered into any forms 
        should be considered as test data only and may be deleted at any time.</p>
        <p>Do not worry about breaking anything as development happens in a separated
        development development environment</p>
        <h2>Updates</h2>
        <h3>17/1/13</h3>
        <p>Database - New table added, bagcontents, will solve a data repetition issue when
            adding items to a bag.</p>
        <p>Item - Added query to automatically add all new items to the 'bag' designated as 'store',
        will make it easier/quicker to query the database for all items not in a physical bag</p>            
        <p>Bag - Started on the bag creation interface. </p>
        <p>Bag - When a bag level is selected the database is queried for existing bags of that level, 
            and sees if there is any sequential bags missing. This is to avoid having ever ascending bag
            numbers over time. For example:</p>
            Level One Bags
            <p>1, 2, 3, 4, 5  <-- Next bag created would be 6</p>
            <p>1, 2, 4, 5, 6  <-- Next bag created would be 3</p>
            As opposed to
            <p>1, 2, 4, 5, 6  <-- Next bag created would be 7</p>
            <p>Bag - Basic implementation of a multi-select that allows movement between two select boxes
            allowing you to add items to a 'bag', or remove them back to the 'stores'</p>
           <p>BUG - Moving items between select boxes keeps items move selected, could cause problems when
           moving back and forth between boxes.</p>
        <h3>10/1/13</h3>
        <p>Item - Added CCN input (Add and Update)</p>
        <p>Item - Added Next Test Date input (Add and Update)</p>
        <p>Item - Added First Use Date  input (Add and Update)</p>
        <p>Item - Redesigned Forms</p>
        <p>Item - Updated backend scripts to facilitate new form additions (Add)</p>
        <p>Item - Updated Database to facilitate new form additions (Add and Update)</p>
        <p>Feature - Integrated Typeahead database querying, current used in Item Update 
            form for item searching. Begin typing into the search box and the search will 
            report back best guesses from the database</p>
        <h2>To Do</h2>
        <p><strike>Item - Update of items has yet to be implemented, pressing the Update button 
            will return a generic error, will not effect anything otherwise</strike></p>
        <h2>Next</h2>
        <p>Bag Creation System</p>
    </div>
</div> <!-- /container -->
    
<?php

@include_once 'templates/footer_temp.php';    

?>

   
