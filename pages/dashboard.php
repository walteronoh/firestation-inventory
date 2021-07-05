<?php 
    include('actions/server.php');
    if(empty($_SESSION['username'])){
        header('location:../index.php');
    }
    $action=new safety();
?>
<!doctype html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Fire,Safety">
    <meta name="description" content="fire and safety services">
    <link rel="stylesheet" href="../bootstrap-3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../bootstrap-3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="../js/actions.js"></script>
</head>
<body>
<div class="container">
    <div class="left-bar">
        <ul class="profile">
            <li><i class="glyphicon glyphicon-user"></i></li>
            <li><a href="dashboard.php?logout='1'">Log Out</a></li>
        </ul>
        <ul class="left-items">
            <li class="show_clients_tab">Clients</li>
            <li class="show_items_tab">Items</li>
            <li class="show_services_tab">Services</li>
        </ul>
    </div>
    <div class="main-bar">
        <div id="clients">
            <h2>Clients</h2>
            <div class="add">
                <button class="btn btn-info"  data-toggle="modal" data-target="#addClient">Add Client</button>
            </div>
            <div class="show-elements">
                <table>
					<th>Name</th> <th>Address</th> <th>Nature</th> <th>Category</th> <th>Subcounty</th> <th>Ward</th><th>Action</th>
					<tr class="added_client"></tr>
					<?php
		                $value=$action->showClients();
                        echo $value;
	                ?>
			    </table>
            </div>
        </div>
        <div id="items">
            <h2>Items</h2>
            <div class="add">
                <button class="btn btn-info" data-toggle="modal" data-target="#addItem">Add Item</button>
            </div>
            <div class="show-elements">
                <table>
					<th>Item Name</th><th>Action</th>
					<tr class="added_item"></tr>
					<?php
		                $value=$action->showItems();
                        echo $value;
	                ?>
			    </table>
            </div>
        </div>
        <div id="services">
            <h2>Service Rendered</h2>
            <div class="add">
                <button class="btn btn-info" data-toggle="modal" data-target="#addService">Add Service</button>
            </div>
            <div class="show-elements">
                <table>
                    <th>Business Name</th><th>Item Name</th><th>Service</th><th>Repair</th><th>Refill</th><th>Supply</th><th>Total</th><th>Action</th>
					<tr class="added_service"></tr>
					<?php
		                $value=$action->showServices();
                        echo $value;
	                ?>
			    </table>
            </div>
        </div>
    </div>
    <!--Client Modal-->
    <div class="modal fade" id="addClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header-->
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal"> 
				        <span aria-hidden="true">&times;</span>
					    <span class="sr-only">Close</span> 
			        </button> 
				    <h2>Add Client</h2>
			    </div>
                <!-- Body --> 
			    <div class="modal-body">
                    <div class="client_msg"></div>
                    <form class="navbar-form" id="addClientForm" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Business Name</label><br>
                            <input class="form-control" type="text" name="business_name" id="business_name" placeholder="Business name"><br>
                            <label>Address</label><br>
                            <input class="form-control" type="text" name="address" id="address" placeholder="Address"><br>
                            <label>Nature Of Business</label><br>
                            <input class="form-control" type="text" name="nature" id="nature" placeholder="Nature Of Business"><br>
                            <label>Business Category</label><br>
                            <select class="form-control" name="category" id="category">
                                <option value="">--Category--</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select><br>
                            <label>Subcounty</label><br>
                            <select class="form-control subcounty" name="subcounty" id="subcounty">
                                <option value="">--Subcounty--</option>
                                <?php
                                    $subcounties=$action->subcounties();
                                    echo $subcounties;
                                ?>
                            </select><br>
                            <label>Ward</label><br>
                            <select class="outputWards form-control" name="ward" id="ward">
                            <option value="">--Ward--</option>
                            </select><br>
                            <input class="form-control" type="submit" name="add_client" value="Submit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
				    <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
			    </div>
            </div>
        </div>    
    </div>
    <!--Item Modal-->
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header-->
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal"> 
				        <span aria-hidden="true">&times;</span>
					    <span class="sr-only">Close</span> 
			        </button> 
				    <h2>Add Item</h2>
			    </div>
                <!-- Body --> 
			    <div class="modal-body">
                    <div class="item_msg"></div>
                    <form class="navbar-form" id="addItemForm" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Item Name</label><br>
                            <input class="form-control" type="text" name="item_name" id="item_name" placeholder="Item name"><br>
                            <input class="form-control" type="submit" name="add_item" value="Submit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
				    <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
			    </div>
            </div>
        </div>    
    </div>
    <!--Service Modal-->
    <div class="modal fade" id="addService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header-->
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal"> 
				        <span aria-hidden="true">&times;</span>
					    <span class="sr-only">Close</span> 
			        </button> 
				    <h2>Add Service</h2>
			    </div>
                <!-- Body --> 
			    <div class="modal-body">
                    <div class="service_msg"></div>
                    <form class="navbar-form" id="addServiceForm" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Item Name</label><br>
                            <select class="form-control" name="item_name" id="item_name">
                                <option value="">--Choose Item--</option>
                                <?php
                                    $items=$action->getItems();
                                    echo $items;
                                ?>
                            </select><br>
                            <label>Type Of Service</label><br>
                            <input class="form-control" type="number" name="service" id="service" placeholder="Service">
                            <input class="form-control" type="number" name="refill" id="refill" placeholder="Refill">
                            <input class="form-control" type="number" name="repair" id="repair" placeholder="Repair">
                            <input class="form-control" type="number" name="supply" id="supply" placeholder="Supply"><br>
                            <label>Subcounty</label><br>
                            <select class="form-control subcounty" name="subcounty"  id="subcounty" >
                                <option value="">--Subcounty--</option>
                                <?php
                                    $subcounties=$action->subcounties();
                                    echo $subcounties;
                                ?>
                            </select><br>
                            <label>Ward</label><br>
                            <select class="outputWards form-control" id="wards">
                            <option value="">--Ward--</option>
                            </select><br>
                            <label>Business Name</label><br>
                            <select class="form-control outputBusiness" name="business_name" id="business_name">
                                <option value="">--Business Name--</option>
                            </select><br>
                            <input class="form-control" type="submit" name="add_service" value="Submit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
				    <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
			    </div>
            </div>
        </div>    
    </div>
    <!--Update Client Modal-->
    <div class="modal fade" id="updateClient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header-->
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal"> 
				        <span aria-hidden="true">&times;</span>
					    <span class="sr-only">Close</span> 
			        </button> 
				    <h2>Update Client</h2>
			    </div>
                <!-- Body --> 
                <div class="modal-body client_content">
                </div>
                <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
				    <!-- <button type='button' class='btn btn-primary'>Save changes</button>-->
			    </div>
            </div>
        </div>    
    </div>
    <!--Update Item Modal-->
    <div class="modal fade" id="updateItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Header-->
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal"> 
				        <span aria-hidden="true">&times;</span>
					    <span class="sr-only">Close</span> 
			        </button> 
				    <h2>Update Item</h2>
			    </div>
                <!-- Body --> 
                <div class="modal-body item_content">
                </div>
                <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
				    <!-- <button type='button' class='btn btn-primary'>Save changes</button>-->
			    </div>
            </div>
        </div>    
    </div>
</div>
</body>
</html>