<?php
require_once('../../db/dbhelper.php');


$id = $name = '';
if(!empty($_POST)) {
    
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $avatar = $_POST['avatar'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    //upload avatar
    $path = "upload/";
    $tmp_name = $_FILES['avatar']['tmp_name'];
    $avatar = $_FILES['avatar']['name'];

    if(!empty($name)) {
        $created_at = date('Y-m-d H:s:i'); 
        $updated_at = date('Y-m-d H:s:i');
        if($id == '') {
            $sql = 'insert into users(name, avatar, address, email,phone, created_at, updated_at) values ("'.$name.'", "'.$avatar.'", "'.$address.'", "'.$email.'", "'.$phone.'",  "'.$created_at.'", "'.$updated_at.'")';
        }else {
            $sql = 'update users set name = "'.$name.'", avatar= "'.$avatar.'", address= "'.$address.'",  email = "'.$email.'", phone = "'.$phone.'", updated_at= "'.$updated_at.'" where id= '.$id;
        }
        
        
        execute($sql);

        header('Location: index.php');
        die();
    }
}

//edit


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'select * from users where id = '.$id;
    $user = executeSingleResult($sql);
    if($user != null) {
        $name = $user['name'];
        $avatar = $user['avatar'];
        $address = $user['address'];
        $email = $user['email'];
        $phone = $user['phone'];
        
    }

}

// upload image
if(isset($_POST['upload'])) {
    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $sql = 'insert into users(name, avatar, address, email,phone, created_at, updated_at) values ("'.$name.'", "'.$avatar.'", "'.$address.'", "'.$email.'", "'.$phone.'",  "'.$created_at.'", "'.$updated_at.'")';
    execute($sql);  
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Danh Sach User</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- icon -->
    <!-- <script src="https://kit.fontawesome.com/yourcode.js"></script> -->
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">THÊM/SỬA USER</h2>
			</div>
			<div class="panel-body">
                <form method="POST" enctype="multipart/form-data" onsubmit="return(validate());">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" name="id" value="<?=$id?>" >
                        <input  type="text" class="form-control" id="name" name="name" value="<?=$name?>">
                        <span id="namenotif" style="color:red"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Avatar:</label>
                        <!-- <input type="text" name="id"  > -->
                        <input  type="file" class="form-control" id="avatar" name="avatar" value="<?=$avatar?>">
                        <!-- <span id="avatarnotif" style="color:red"></span> -->
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input  type="text" class="form-control" id="address" name="address" value="<?=$address?>">
                        <span id="addrnotif" style="color:red"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input  type="text" class="form-control" id="email" name="email" value="<?=$email?>" onblur="checkEmail(this.value)">
                        <span id="emailnotif" style="color:red"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">SĐT:</label>
                        <input  type="number" class="form-control" id="phone" name="phone" value="<?=$phone?>">
                        <span id="phonenotif" style="color:red"></span>
                    </div> 
                    
                    <button  class="btn btn-success" name="upload" id="regis">Submit</button>
                </form>
            </div>
		</div>
	</div>

    <script src="./add.js"></script>
    <!-- <script src="cleave.min.js"></script>
    <script src="cleave-phone.i18n.js"></script> -->
    

    <!-- <script>
        var cleave = new Cleave('#phone', {
            phone: true,
            phoneRegionCode: 'VI'
        });
    </script> -->
    <script>
        function checkEmail(email) {
            $.post('checkEmail.php', {'email':email}, function(data) {
                if(data == "true") {
                    $("#emailnotif").text("Email đã tồn tại");
                    $("#regis").attr({
                        "disabled": ''
                    });
                }else {
                    $("#emailnotif").text("");
                }
            });
        }
    </script>
</body>
</html>