<?php

$currentFile = $_SERVER['PHP_SELF'];
$parts = explode('/', $currentFile);
$parts = explode('.', $parts[count($parts) - 1]);
$img = "/helpimg/".$parts[0].".png";
?>




<div id="helpModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Help</h3>
  </div>
  <div class="modal-body">
    <img src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/fire/FireServiceProject/assets'.$img?>"></img>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>