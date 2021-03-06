<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');


$query = "SELECT StationName FROM station;";

$result = sqlHandler::getDB()->select($query);

?>
<div class="container">
    <h1>Stations</h1>
    
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#update" data-toggle="tab">Update</a></li>
        <li class><a href="#addNew" data-toggle="tab">Add New</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active" id="update">
            <form action="php/station/get_station.php" method="post">
                <h2>Update Stations</h2>
                <label>Select Station</label>
                <select id="target" data-target="upForm" class="get" name="contactSelect">
                    <?php
                        foreach($result as $row)
                        {?>
                            <option><?php echo $row['StationName'] ?></option>
                        <?php
                        }
                        ?>
                </select>
            </form>
            <form class="validate" action="php/station/update_station.php" method="post" id="form1">                
            <div class="row">
                <div id="upForm">
                </div>  
                <div class="span2">
                    <div class="message">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary btn-large">Update Entry</button>
            </div>
            </form> 
        </div>
        <div class="tab-pane" id="addNew">            
            <form class="validate" action="php/station/add_station.php" method="post" id="form2">                              
            <h2>Add Station</h2>
            <div class="row">
                <div class="span3">
                    <label>Station Number</label>
                    <input class="required" name="stationNumber" type="text" placeholder="Station Number">   
                    <label>Station Name</label>
                    <input class="required" name="stationName" type="text" placeholder="Station Name"> 
                    <label>Station Level</label>
                    <input class="required" name="stationLevel" type="text" placeholder="Station Level">                     
                    <label>Address</label>                
                    <textarea class="required" rows="3" name="address" placeholder="Address"></textarea>
                </div>
                <div class="span3">
                    <label>Contact Name</label>                
                    <input class="required" name="contactName" type="text" placeholder="Contact Name">   
                    <label>Station Contact Number</label>
                    <input class="required" name="stationNo" type="text" placeholder="Station Contact Number"></input>
                    <label>Mobile Contact Number</label>
                    <input class="required" name="mobileNo" type="text" placeholder="Mobile Contact Number"></input>                    
                </div>
                <div class="span2">
                    <div class="message">
                    </div>                     
                </div>
            </div>
            <div class="form-actions">
                <button class="btn btn-primary btn-large" type="submit">Add Station</button>
            </div>
            </form>
        </div>
    </div>
</div>