    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="front.php">Inventory System</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="front.php">Main Page</a></li>
              <li class="dropdown">
                  <a id="drop2" role="button "class="dropdown-toggle" data-toggle="dropdown" href="#">Reports</a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                      <li><a href="bag_contents_report.php">Bag Contents</a></li>                      
                  </ul>                  
              <li><a href="bag.php">Bag Management</a></li>
              <li><a href="bag_station_allocation.php">Allocate Bag</a></li>
              <li class="dropdown">
                  <a id="drop2" role="button "class="dropdown-toggle" data-toggle="dropdown" href="#">Add/Update</a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
                      <li><a href="item.php">Item</a></li>
                      <li><a href="itemCategories.php">Item Categories</a></li>
                      <li><a href="level.php">Bag Level</a></li>
                      <li><a href="station.php">Station</a></li>
                  </ul>                  
              </li>
              <li><a href="test.php">Item Testing</a></li>
              <li><a href="php/logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<!-- 
@TODO Navigation - Overhaul navigation, needs clear back buttons or similar
-->