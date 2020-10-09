<?php 

	include_once 'db.php';

	$result = array('error' => false);
	$action = '';

	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}

	if($action == 'read'){
		$sql = pg_query($conn, "SELECT * FROM vuejs_db ");
		$users = array();
		while($row = pg_fetch_assoc($sql)){
			array_push($users, $row);
		}
		$result['users'] = $users;
	}

	if($action == 'create'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$university = $_POST['university'];
		$examone = $_POST['examone']; 
		$examaverage = $_POST['examaverage'];

		$sql = pg_query($conn, "INSERT INTO vuejs_db (id, name, university, examone, examaverage) VALUES ('$id', '$name', '$university', '$examone', '$examaverage') ");
		if($sql){
			$result['message'] = "User added Successfully.!";
		}else{
			$result['error'] = true;
			$result['success'] = "Something went to wrong.!";
		}
	}

	if($action == 'update'){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$university = $_POST['university'];
		$examone = $_POST['examone'];
		$examaverage = $_POST['examaverage'];

		$sql = pg_query($conn, "UPDATE vuejs_db SET id = '$id', name = '$name', university = '$university', examone = '$examone', examaverage = '$examaverage' WHERE id = '$id' ");
		if($sql){
			$result['message'] = "User Updated Successfully.!";
		}else{
			$result['error'] = true;
			$result['success'] = "Something went to wrong.!";
		}
	}

	if($action == 'delete'){
		$id = $_POST['id'];

		$sql = pg_query($conn, "DELETE FROM vuejs_db WHERE id = '$id' ");
		if($sql){
			$result['message'] = "User Deleted Successfully.!";
		}else{
			$result['error'] = true;
			$result['success'] = "Something went to wrong.!";
		}
	}

	pg_close($conn);
	echo json_encode($result);
 ?>