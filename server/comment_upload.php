<?php 
	require_once('dbconfig.php');

	class CommentManager{

		private $db;

		function __construct(){
			$database=new Database();
			$this->db=$database->getDbConnection();
		}

		public function insertComment($comment,$pos){
			$sql="INSERT INTO comment_table(comment,at_pos) VALUES('$comment','$pos')";

			$result=mysqli_query($this->db,$sql);

			if($result){
				return array("success"=>true);
			}
			else{
				return array("success"=>false);
			}
		}

		public function fetchComments(){
			$sql="SELECT * FROM comment_table";
			
			$data=mysqli_query($this->db,$sql);

			if(mysqli_num_rows($data)>0){
				$list=array();

				while($row=mysqli_fetch_assoc($data)){
					array_push($list, $row);
				}

				return array("data"=>$list,"success"=>true);
			}
			else{
				return array("error"=>"User Doesn't Exist","success"=>false);
			}
		}

	}

	if(isset($_POST["action"])){

		$comment = new CommentManager();

		if($_POST['action']=='insert'){
			echo json_encode($comment->insertComment($_POST['comment'],$_POST['at_pos']));
		}
		else{
			echo json_encode($comment->fetchComments());
		}
	}



?>