 <?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');


$query = "SELECT Level FROM level;";

$result = sqlHandler::getDB()->select($query);

?>

<div class="container"> 
    <h1>Bag Level</h1>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#update" data-toggle="tab">Update</a></li>
        <li class><a href="#addNew" data-toggle="tab">Add New</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active" id="update">                
            <form action="php/level/get_level.php" method="post">
                <h2>Update Level</h2>
                <label>Select Bag Level</label>
                <select id="target" data-target="upForm" class="get" name="levelSelect">
                    <?php
                    foreach($result as $row)
                    {?>
                        <option><?php echo $row['Level'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </form>
            <form class="validate" action="php/level/update_level.php" method="post" id="form1">
            <div class="row">                    
                <div id="upForm" class="span4">
                </div>
                <div class="span2 message">
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary btn-large">Update Entry</button>
            </div>
            </form>                
        </div>
        <div class="tab-pane" id="addNew">                
            <form class="validate" action="php/level/add_level.php" id="form2">
            <h2>New Level</h2> 
            <div class="row">                         
                <div class="span4">                          
                <label>Level</label>
                <input class="required" maxlength="10" minlength="1" type="text" name="level" placeholder="Level">
                <label>Number of Items</label>
                <input class="required" maxlength="5" minlength="1" type="text" name="noItems" placeholder="Number of items to contained">
                <label>Description</label>
                <textarea class="required" name="description"  rows="3" placeholder="Description of level type"></textarea>  
                </div>
                <div class="span2">
                    <div class="message">
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <button id="inFormSub" type="submit" class="btn btn-large btn-primary">Submit</button>
            </div>
            </form>                   
        </div>
    </div>
</div>
