<?php
include ('server.php');
$action=new safety();

$error=$success="";
if(isset($_POST['login'])){
    $username=$action->validate_data($_POST['username']);
    $pass=$action->validate_data($_POST['pass']);
    if(empty($username) || empty($pass)){
        $error="<p class='alert alert-danger'>Fill All The Fields!</p>";
        $data=array("error"=>$error);
    }else{
        $result=$action->login($username,$pass);
        if($result=="success"){
            $_SESSION['username']=$username;
            $data=array("success"=>$result);
        }elseif($result=="error"){
            $error="<p class='alert alert-danger'>Invalid Login</p>";
            $data=array("error"=>$error);
        }else{}
    }
    echo json_encode($data);
}

if(isset($_POST['add_item'])){
    $item_name=$action->validate_data($_POST['item_name']);
    if(empty($item_name)){
        $error="<p class='alert alert-danger'>Item Field Is Required!</p>";
        $data=array("error"=>$error);
    }else{
        $result=$action->addItem($item_name);
        foreach($result as $key=>$val){
            if($key=="error"){
                $error="<p class='alert alert-danger'>Item Has Not Been Added!</p>";
                $data=array("error"=>$error);
            }else{
                $success="<p class='alert alert-success'>Item Has been Successfully Added</p>";
                $data=array("success"=>$success,"output"=>$val);
            }
        }
    }
    echo json_encode($data);
}

if(isset($_POST['add_client'])){
    $business_name=$action->validate_data($_POST['business_name']);
    $address=$action->validate_data($_POST['address']);
    $nature=$action->validate_data($_POST['nature']);
    $category=$action->validate_data($_POST['category']);
    $subcounty=$action->validate_data($_POST['subcounty']);
    $ward=$action->validate_data($_POST['ward']);
    if(empty($business_name) || empty($address) || empty($nature) || empty($category) || empty($subcounty) || empty($ward)){
        $error="<p class='alert alert-danger'>All Fields Are required!</p>";
        $data=array("error"=>$error);
    }else{
        $result=$action->addClient($business_name,$address,$nature,$category,$subcounty,$ward);
        foreach($result as $key=>$val){
            if($key=="error"){

            }else{
                $success="<p class='alert alert-success'>Client Has been Successfully Added</p>";
                $data=array("success"=>$success,"output"=>$val);
            }
        }
    }
    echo json_encode($data);
}

if(isset($_POST['add_service'])){
    $item_name=$action->validate_data($_POST['item_name']);
    $service=$action->validate_data($_POST['service']);
    $refill=$action->validate_data($_POST['refill']);
    $repair=$action->validate_data($_POST['repair']);
    $supply=$action->validate_data($_POST['supply']);
    $business_name=$action->validate_data($_POST['business_name']);
    if(empty($item_name) || empty($business_name)){
        $error="<p class='alert alert-danger'>All Fields Are Required!</p>";
        $data=array("error"=>$error);
    }else{
        $result=$action->addService($item_name,$service,$refill,$repair,$supply,$business_name);
        foreach($result as $key=>$val){
            if($key=="error"){
                $error="<p class='alert alert-danger'>Service Has Not Been Added!</p>";
                $data=array("error"=>$error);
            }else{
                $success="<p class='alert alert-success'>Service has been Successfully Added</p>";
                $data=array("success"=>$success,"output"=>$val);
            }
        }
    }
    echo json_encode($data);
}

if(isset($_POST['check_ward'])){
    $subcounty=$_POST['subcounty'];
    $results=$action->wards($subcounty);
    $data=array("success"=>$results);
    echo json_encode($data);
}

if(isset($_POST['show_business'])){
    $ward=$_POST['ward'];
    $results=$action->showBusiness($ward);
    $data=array("success"=>$results);
    echo json_encode($data);
}

if(isset($_POST['update_client'])){
    $id=$_POST['id'];
    $result=$action->clientDetails($id);
    $data=array("success"=>$result);
    echo json_encode($data);
}
if(isset($_POST['update_item'])){
    $id=$_POST['id'];
    $result=$action->itemDetails($id);
    $data=array("success"=>$result);
    echo json_encode($data);
}

if(isset($_POST['update_client_form'])){
    $business_id=$action->validate_data($_POST['business_id']);
    $business_name=$action->validate_data($_POST['business_name']);
    $address=$action->validate_data($_POST['address']);
    $nature=$action->validate_data($_POST['nature']);
    $category=$action->validate_data($_POST['category']);
    $subcounty=$action->validate_data($_POST['subcounty']);
    $ward=$action->validate_data($_POST['ward']);
    if(empty($business_name) || empty($address) || empty($nature) || empty($category) || empty($subcounty) || empty($ward)){
        $error="<p class='alert alert-danger'>All Fields Are required!</p>";
        $data=array("error"=>$error);
    }else{
        $result=$action->updateClients($business_id,$business_name,$address,$nature,$category,$subcounty,$ward);
        if($result=="success"){
                $success="<p class='alert alert-success'>Client Has been Successfully Updated</p>";
                $data=array("success"=>$success);
        }
    }
    echo json_encode($data);
}

if(isset($_POST['update_item_form'])){
    $item_id=$action->validate_data($_POST['item_id']);
    $item_name=$action->validate_data($_POST['item_name']);
    if(empty($item_name)){
        $error="<p class='alert alert-danger'>Item Field Is Required!</p>";
        $data=array("error"=>$error);
    }else{
        $result=$action->updateItems($item_id,$item_name);
        if($result=="success"){
                $success="<p class='alert alert-success'>Item Has been Successfully Updated</p>";
                $data=array("success"=>$success);
        }
    }
    echo json_encode($data);
}

if(isset($_POST['remove_client'])){
    $id=$_POST['id'];
    $result=$action->removeClient($id);
    $data=array("success"=>$result);
    echo json_encode($data);
}

if(isset($_POST['remove_item'])){
    $id=$_POST['id'];
    $result=$action->removeItem($id);
    $data=array("success"=>$result);
    echo json_encode($data);
}

if(isset($_POST['remove_service'])){
    $id=$_POST['id'];
    $result=$action->removeService($id);
    $data=array("success"=>$result);
    echo json_encode($data);
}
?>