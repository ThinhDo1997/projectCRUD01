<?php
require_once('../../db/dbhelper.php');
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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">DANH SÁCH USER</h2>
			</div>
			<div class="panel-body">
                <a href="search.php">
                    <button class="btn btn-warning" >SEARCH</button>
                </a>
                <a href="add.php">
                    <button class="btn btn-success" >ADD</button>
                </a>
                <a href="sort.php">
                    <button class="btn btn-secondary" >ID MỚI NHẤT</button>
                </a>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            
                            <th width="50px">ID</th>
                            <th width="50px">STT</th>
                            <th>Tên</th>
                            <th>Avatar</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Phone</th> 
                            <th width="200px">Ngày tạo</th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
//lay so trang
    $limit = 10;
    $page = 1;
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    if($page <= 0){
        $page = 1;
    }
    $firstIndex = ($page -1)*$limit;

    $sql = 'select * from users where 1 limit '.$firstIndex.','.$limit;
    $userList = executeResult($sql);

    $sql = 'select count(id) as total from users ';
    $countResult = executeSingleResult($sql);
    $count = $countResult['total'];
    $number = ceil($count/$limit);

    // $i = 1; 
    foreach ($userList as $item) {
        echo '
            <tr class="col-sm-8"> 
                
                <td>'.$item['id'].'</td>
                <td>'.(++$firstIndex).'</td>
                <td>'.$item['name'].'</td>
                <td><img src="upload/'.$item['avatar'].'" style="max-width: 100px;"></td>
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

<!-- delete -->
<!-- Button trigger modal -->
<!-- <button type="button" id="deletemodal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->
<!-- php echo'<img src="data:avatar; base64,'.base64_encode($item['avatar']).'" alt=""avatar >';   -->
<!-- Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">XÓA USER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="deletecode.php" method="POST">
            <div class="modal-body">
                    <input  name="delete_id" id="delete_id" hidden="true" >
                    <h4>Bạn có chắc chắn xóa không?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                <button type="submit" name="deletedata" class="btn btn-primary">Đồng ý</button>
            </div>

      </form>
      
    </div>
  </div>
</div>

                    </tbody>

                </table>
<!-- pagination -->
                <ul class="pagination">
<?php
    if($page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page='.($page-1).'">Previous</a></li> ';
    }
?>
                
                      
<?php
    for ($i=0; $i < $number ; $i++) { 
        if($page ==($i+1)){
            echo'<li class="page-item active"><a class="page-link" href="#">'.($i+1).'</a></li>';
        } else {
            echo'<li class="page-item" ><a class="page-link" href="?page='.($i+1).'">'.($i+1).'</a></li>';
        }
        
    }
?>        

<?php
    if($page < $number) {
        echo '<li class="page-item"><a class="page-link" href="?page='.($page+1).'">Next</a></li> ';
    }
?>
                    
                    
                </ul>
			</div>
		</div>
	</div>

    <!-- <script>
        function deleteUser(id) {
            // var option = confirm('Bạn chắc chắn muốn xóa không?')
            if(!option) {
                return;
            }
            console.log(id)
            //ajax-lenh post
            $.post('ajax.php', {
                'id':id,
                'action': 'delete'
            }, function(data) {
                location.reload()
            })
        }
    </script> -->

<!-- delete user use Modal Bootstrap     -->
        <script>
            $(document).ready(function(){
                $('.deletebtn').on('click', function(){
                    $('#deletemodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#delete_id').val(data[0]);   
                });
            });
        </script>
</body>
</html>