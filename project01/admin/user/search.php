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
				<h2 class="text-center">TÌM KIẾM USER</h2>
			</div>
			<div class="panel-body">
                <form action="#" method="get">
                    <input type="text" name="search" />
                    <input type="submit" name="ok" value="search" />
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50px">STT</th>
                            <th>Tên</th>
                            <th>Địa chỉ</th>
                            <th>Phone</th>
                            <th width="200px">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
 if (isset($_REQUEST['ok'])) 
 {
     // Gán hàm addslashes để chống sql injection
     $search = addslashes($_GET['search']);

     // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
     if (empty($search)) {
         echo "Nhập dữ liệu vào ô trống!";
     } 
     else
     {
        $sql = "select * from users where name like '%$search%'";
        $userList = executeResult($sql);
        
        $id = 1;
        
        if(empty($userList)) 
        {
            echo '
                <tr>
                    <td colspan="4" style="text-align:center">Không có dữ liệu!</td>
                   
                </tr>
            ';
        }else { 

            foreach ($userList as $item) {
                // $a = "khogn co";
                    if(!empty($item)) {
                        echo '
                            <tr>
                                <td>'.($id++).'</td>
                                <td>'.$item['name'].'</td>
                                <td>'.$item['address'].'</td>
                                <td>'.$item['phone'].'</td>
                                <td>'.$item['created_at'].'</td>
                            </tr>
                        ';
                     
                    } 
                    else 
                    {
                        
                    }
                    
        
                    
                ;
            }
        }
         
     }
     
 }
?>
                    </tbody>
                </table>
            </div>
		</div>
	</div>

    <script src="./add.js"></script>
</body>
</html>