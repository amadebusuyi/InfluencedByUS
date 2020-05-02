<?php 
if(isset($_SESSION['user'])){
	$uid = $_SESSION['user'];
	$token = $_SESSION['token'];
	require_once "inc/conn.php";

	$conn = $pdo->open();
	$query = $conn->prepare("SELECT count(*) as count from users where id = :uid and session_token = :token");
	$query->execute(["uid"=>$uid, "token"=>$token]);
	if($query->fetch()['count'] != 0){
		try{
			$query = $conn->prepare("UPDATE users set session_token = null where id = :uid");
			$query->execute(["uid"=>$uid]);
		}
		catch(PDOException $e){
			echo "Couldn't log user out <br>".$e;
		}
	}
	else{}
	$pdo->close();
}
session_destroy();
header('Location: ./');

 ?>