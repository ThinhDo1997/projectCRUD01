<?php
require_once('../../db/dbhelper.php');

// if(!empty($_POST)) {
//     $name = ''; 
//     if (isset($_POST['name'])) {
//         $name = $_POST['name'];
//         $address = $_POST['address'];
//     }

//     if(!empty($name)) {
//         $created_at = $updated_at = date('Y-m-d H:s:i');
//         $sql = 'insert into users(name, address, created_at, updated_at) values ("'.$name.'", "'.$address.'", "'.$created_at.'", "'.$updated_at.'")';
        
//         execute($sql);

//         header('Location: index.php');
//     }
// }
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
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">SẮP XẾP USER</h2>
			</div>
            
			<div class="panel-body">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50px">ID</th>
                            <th width="50px">STT</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th width="200px">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
    $sql = 'select * from users ORDER BY id ASC';
    $userList = executeResult($sql);

    $i = 1; 
    foreach ($userList as $item) {
        echo '
            <tr class="col-sm-8"> 
                
                <td>'.$item['id'].'</td>
                <td>'.($i++).'</td>
                <td>'.$item['name'].'</td>
                <td>'.$item['address'].'</td>
                <td>'.$item['email'].'</td>
                <td>'.$item['phone'].'</td>
                <td>'.$item['created_at'].'</td>
                <td>
                    <a href="add.php?id='.$item['id'].'">
                        <button class="btn btn-warning">EDIT</button>
                    </a>
                </td>
                <td>
                                   
                        <button type="button" class="btn btn-danger deletebtn"  >DELETE</button>
                    
                </td>
                
            </tr>

            
        ';
    }
?>
                    </tbody>
                </table>
            </div>
            <a href="index.php">
                    <button class="btn btn-secondary" >QUAY LẠI</button>
            </a>
		</div>
	</div>

    <script src="./add.js"></script>
</body>
</html>