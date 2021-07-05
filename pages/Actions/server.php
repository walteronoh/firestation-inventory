<?php
session_start();
class safety{
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "safety";      
    private $adminTable = 'admins';
	private $clientTable = 'clients';
	private $itemTable = 'items';
    private $serviceTable = 'services';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }

    public function login($username,$pass){
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->adminTable." WHERE username='$username'");
        if(mysqli_num_rows($result)==1){
            $row=mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['password'])){
                return "success";
            }else{
                return "error";
            }
        }else{
            return "error";
        }
    }

    public function addClient($business_name,$address,$nature,$category,$subcounty,$ward){
        $output="";
        $chars='0123456789abcdefghijklmnopqrstuvwxyz';
        $business_id=substr(str_shuffle($chars), 0,7);
        $check_id=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->clientTable." WHERE business_id='".$business_id."' LIMIT 1");
        if(mysqli_num_rows($check_id)==1){
            $errors=1;
        }else{
            $result=mysqli_query($this->dbConnect,"INSERT INTO ".$this->clientTable." (business_id,business_name,address,nature,category,subcounty,ward,created_at)
            VALUES('$business_id','$business_name','$address','$nature','$category','$subcounty','$ward',now())");
            if(!$result){
                return ('Error in query: '. mysqli_error());
            }else{
                $output.="<td>".$business_name."</td><td>".$address."</td><td>".$nature."</td><td>".$category."</td><td>".$subcounty."</td><td>".$ward."</td><td><a data-item='".$business_id."' data-toggle='modal' data-target='#updateClient' class='update_client'>Update</a><a class='remove_client' data-item='".$business_id."'>Remove</a></td>";
                $data=array("success"=>"success","values"=>$output);
            }
            return $data;
        }
    }

    public function addItem($item_name){
        $output="";
        $result=mysqli_query($this->dbConnect,"INSERT INTO ".$this->itemTable." (item_name,created_at) 
        VALUES('$item_name',now())");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            $results=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->itemTable." WHERE item_name='$item_name'");
            $row=mysqli_fetch_assoc($results);
            $output.="<td>".$item_name."</td><td><a data-item='".$row['id']."' class='update_item'>Update</a><a class='remove_item' data-item='".$row['id']."'>Remove</a></td>";
            $data=array("success"=>"success","values"=>$output);
        }
        return $data;
    }

    public function addService($item_name,$service,$refill,$repair,$supply,$business_name){
        $output=$total="";
        $result=mysqli_query($this->dbConnect,"INSERT INTO ".$this->serviceTable."(item_name,service,refill,repair,supply,business_name,created_at)
        VALUES('$item_name','$service','$refill','$repair','$supply','$business_name',now())");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            $total=intval($service)+intval($refill)+intval($repair)+intval($supply);
            $results=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->serviceTable." WHERE item_name='$item_name' ORDER BY created_at LIMIT 1");
            $row=mysqli_fetch_assoc($results);
            $output.="<td>".$business_name."</td><td>".$item_name."</td><td>".intval($service)."</td><td>".intval($refill)."</td><td>".intval($repair)."</td><td>".intval($supply)."</td><td>".$total."</td><td><a class='remove_service' data-item='".$row['id']."'>Remove</a></td>";
            $data=array("success"=>"success","values"=>$output);
        }
        return $data;
    }

    public function validate_data($data){
	    $data=trim($data);
	    $data=stripslashes($data);
	    $data=strip_tags($data);
	    $data=htmlspecialchars($data);
		$data=mysqli_real_escape_string($this->dbConnect,$data);
	    return $data;
    }
    
    public function subcounties(){
        $results="";
        $subcounties=["Butere","Ikolomani","Khwisero","Likuyani","Lugari","Lurambi","Malava","Matungu","Mumias East","Mumias West","Navakholo","Shinyalu"];
        foreach($subcounties as $subcounty){
            $results .="<option value='".$subcounty."'>".$subcounty."</option>";
        }
        return $results;
    }

    public function wards($name){
        $result="";
        switch ($name){
            case "Matungu":
            $wards=["Koyonzo","Kholera","Khalaba","Mayoni","Namamali"];
            foreach($wards as $ward){
                $result.="<option class='show_business' data-ward='".$ward."' value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
            
            case "Likuyani":
            $wards=["Sango","Kongoni","Likuyani","Nzoia","Sinoko"];
            foreach($wards as $ward){
                $result.="<option class='show_business' data-ward='".$ward."' value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
            
            case "Shinyalu":
            $wards=["Isukha north","Murhanda","Isukha central","Isukha south","Isukha east","Isukha west"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
            
            case "Navakholo":
            $wards=["Ingotse-matiha","Shinoyi-shikomari-esumeiya","Bunyala west"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Mumias East":
            $wards=["Lusheya-lubinu","Malaha-isongo-makunga","East wanga"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Mumias West":
            $wards=["Mumias central","Mumias north","Etenje","Musanda"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Malava":
            $wards=["West kabaras","Chemuche","East kabaras","Butali/chegulo","Manda-shivanga","South kabaras","Shirugu-mugai"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Lurambi":
            $wards=["Butsotso east","Butsotso south","Butsostso central","Shieywe","Mahiakalo","Shirere"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Lugari":
            $wards=["Mautuma","Lugari","Lumakanda","Chekalini","Chevagwa","Lwandeti"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Khwisero":
            $wards=["Kisa north","Kisa east","Kisa west","Kisa central"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Ikolomani":
            $wards=["Idakho south","Idakho east","Idakho north","Idakho central"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
    
            case "Butere":
            $wards=["Marama west","Marama central","Marenyo-shianda","Marama north","Marama south"];
            foreach($wards as $ward){
                $result.="<option value='".$ward."'>".$ward."</option>";
            }
            return $result;
            break;
        }
    } 
    
    public function showClients(){
        $output="";
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->clientTable." ORDER BY created_at DESC");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            foreach($result as $row){
                $output.="<tr><td>".$row['business_name']."</td><td>".$row['address']."</td><td>".$row['nature']."</td><td>".$row['category']."</td><td>".$row['subcounty']."</td><td>".$row['ward']."</td><td><a data-item='".$row['business_id']."' class='update_client' data-toggle='modal' data-target='#updateClient'>Update</a><a class='remove_client' data-item='".$row['business_id']."'>Remove</a></td></tr>";
            }
            return $output;
        }
    }

    public function showItems(){
        $output="";
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->itemTable." ORDER BY created_at DESC");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            foreach($result as $row){
                $output.="<tr><td>".$row['item_name']."</td><td><a data-item='".$row['id']."' class='update_item' data-toggle='modal' data-target='#updateItem'>Update</a><a class='remove_item' data-item='".$row['id']."'>Remove</a></td></tr>";
            }
            return $output;
        }
    }

    public function showServices(){
        $output=$total="";
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->serviceTable." ORDER BY created_at DESC");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            foreach($result as $row){
                $total=$row['service']+$row['repair']+$row['refill']+$row['supply'];
                $output.="<tr><td>".$row['business_name']."</td><td>".$row['item_name']."</td><td>".$row['service']."</td><td>".$row['refill']."</td><td>".$row['repair']."</td><td>".$row['supply']."</td><td>".$total."</td><td><a class='remove_service' data-item='".$row['id']."'>Remove</a></td></tr>";
            }
            return $output;
        }  
    }

    public function updateClients($id,$business_name,$address,$nature,$category,$subcounty,$ward){
        $result=mysqli_query($this->dbConnect,"UPDATE ".$this->clientTable." SET business_name='$business_name',address='$address',nature='$nature',category='$category',subcounty='$subcounty',ward='$ward',created_at=now() WHERE business_id='$id'");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            return "success";
        }
    }

    public function updateItems($id,$item_name){
        $result=mysqli_query($this->dbConnect,"UPDATE ".$this->itemTable." SET item_name='$item_name',created_at=now() WHERE id='$id'");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            return "success";
        }
    }

    public function removeClient($id){
        $result=mysqli_query($this->dbConnect,"DELETE FROM ".$this->clientTable." WHERE business_id='".$id."'");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            return "success";
        }
    }

    public function removeItem($id){
        $result=mysqli_query($this->dbConnect,"DELETE FROM ".$this->itemTable." WHERE id='".$id."'");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            return "success";
        }
    }

    public function removeService($id){
        $result=mysqli_query($this->dbConnect,"DELETE FROM ".$this->serviceTable." WHERE id='".$id."'");
        if(!$result){
            return ('Error in query: '. mysqli_error());
        }else{
            return "success";
        }
    }

    public function showBusiness($name){
        $output="";
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->clientTable." WHERE ward='".$name."' ORDER BY created_at DESC");
        if(!$result){
            return ('Error in query:'.mysqli_error());
        }else{
            if(mysqli_num_rows($result)>0){
            foreach($result as $row){
                $output.="<option value='".$row['business_name']."'>".$row['business_name']."=".$row['address']."</option>";
                }
            }else{
                $output.="<option value=''>--No Business in this ward--</option>"; 
            }
            return $output;
        }
    }

    public function clientDetails($business_id){
        $output="";
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->clientTable." WHERE business_id='".$business_id."'");
        if(!$result){
            return ('Error in query:'.mysqli_error());
        }else{
            foreach($result as $row){
                $output="<div class='client_msg'></div><form class='navbar-form' id='updateClientForm' role='form' method='post' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <input type='hidden' value='".$row['business_id']."' name='business_id' id='business_id'>
                            <label>Business Name</label><br>
                            <input class='form-control' type='text' name='business_name' id='business_name' value='".$row['business_name']."' placeholder='Business name'><br>
                            <label>Address</label><br>
                            <input class='form-control' type='text' name='address' id='address' value='".$row['address']."' placeholder='Address'><br>
                            <label>Nature Of Business</label><br>
                            <input class='form-control' type='text' name='nature' id='nature' value='".$row['nature']."' placeholder='Nature Of Business'><br>
                            <label>Business Category</label><br>
                            <select class='form-control' name='category' id='category'>
                                <option value='".$row['category']."'>".$row['category']."</option>
                                <option value=''>--Category--</option>
                                <option value='A'>A</option>
                                <option value='B'>B</option>
                                <option value='C'>C</option>
                            </select><br>
                            <label>Subcounty</label><br>
                            <select class='form-control subcounty' name='subcounty' id='subcounty'>
                                <option value='".$row['subcounty']."'>".$row['subcounty']."</option>
                                <option value=''>--Subcounty--</option>
                                    ".$this->subcounties().";
                            </select><br>
                            <label>Ward</label><br>
                            <select class='outputWards form-control' name='ward' id='ward'>
                            <option value='".$row['ward']."'>".$row['ward']."</option>
                            <option value=''>--Ward--</option>
                            </select><br>
                            <input class='form-control' type='submit' name='update_client' value='Update Client'>
                        </div>
                    </form>";
            }
            return $output;
        }
    }

    public function itemDetails($id){
        $output="";
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->itemTable." WHERE id='".$id."'");
        if(!$result){
            return ('Error in query:'.mysqli_error());
        }else{
            foreach($result as $row){
                $output="<div class='item_msg'></div>
                        <form class='navbar-form' id='updateItemForm' role='form' method='post' enctype='multipart/form-data'>
                        <div class='form-group'>
                            <input type='hidden' value='".$row['id']."' name='item_id' id='item_id'>
                            <label>Item Name</label><br>
                            <input class='form-control' type='text' name='item_name' id='item_name' value='".$row['item_name']."' placeholder='Item name'><br>
                            <input class='form-control' type='submit' name='update_item' value='Update Item'>
                        </div>
                    </form>";
            }
            return $output;
        }
    }

    public function getItems(){
        $output="";
        $result=mysqli_query($this->dbConnect,"SELECT * FROM ".$this->itemTable."");
        if(!$result){
            return ('Error in query:'.mysqli_error());
        }else{
            foreach($result as $row){
                $output.="<option value='".$row['item_name']."'>".$row['item_name']."</option>";
            }
            return $output;
        }
    }
}

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header('location:../index.php');
}
?>