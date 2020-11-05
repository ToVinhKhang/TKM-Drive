<?php
	
	//About SQLi
	function getDB(){
		$connect = new mysqli(SERVER,USER,PASS,DB);
		if($connect->connect_error){
			die('Can not connect to MySQL: '.$connect->connect_error);
		}
		return $connect;
	}
	function redirect($page){
		header("Location: ".HOST."/".$page);
	}
	function getDrive($db){
		$sql = "select * from drivedata";
		return $db->query($sql);
	}
	function getDriveOfUser($db,$user){
		$sql = "select * from drivedata where user = '".$user."'";
		return $db->query($sql);
	}
	function delete_files($target){
	    if(is_dir($target)){
	        $files = glob($target.'*',GLOB_MARK);
	        foreach($files as $file){
	            delete_files($file );      
	        }
	        rmdir($target);
	    }
	    else if(is_file($target)){
	        unlink($target);  
	    }
	}
	//Show Message
	function setShowMess($mess){
		$_SESSION['mess']=$mess;
	}
	function setShowMessIfFail($mess){
		$_SESSION['messfail']=$mess;
	}
	function getShowMess(){
		if(isset($_SESSION['mess'])){
			$mess = $_SESSION['mess'];
			unset($_SESSION['mess']);
			return $mess;
		}
		else{
			return '';
		}
	}
	function getShowMessIfFail(){
		if(isset($_SESSION['messfail'])){
			$mess = $_SESSION['messfail'];
			unset($_SESSION['messfail']);
			return $mess;
		}
		else{
			return '';
		}
	}
	//About Functions
	function Add($icon,$name,$user,$type,$date,$size){
		$sql = 'insert into drivedata (icon,name,user,type,date,size) values(?,?,?,?,?,?)';
		$db = getDB();
		$format = $db->prepare($sql);
		$format->bind_param('ssssss',$icon,$name,$user,$type,$date,$size);
		$result = $format->execute();

		$format->close();
		return $result;
	}
	function AddNewAccount($email,$pass,$mdfpass){
		$sql = 'insert into account values(?,?,?)';
		$db = getDB();
		$format = $db->prepare($sql);
		$format->bind_param('sss',$email,$pass,$mdfpass);
		$result = $format->execute();

		$format->close();
		return $result;
	}
	function Login($email,$pass){
		$db = getDB();
		$md5pass = md5($pass);
		$sql = "select * from account where md5pass = '" .$md5pass. "' and mail = '" .$email. "'";
		$result = $db->query($sql);
		if($result!=null && $result->num_rows==1){
			return true;
		}
		else
		{
			$result->close();
			return false;
		}
	}
	/*function Delete($name,$user){
		$sql = 'delete from drivedata where name = ? and user = ?';
		$db = getDB();
		$format = $db->prepare($sql);
		$format->bind_param('ss',$name,$user);
		$result = $format->execute();

		$format->close();
		return $result;
	}*/
	function issetAcountFromDatabase($email){
		$db = getDB();
		$sql = "select * from account where mail = '" .$email. "'";
		$result = $db->query($sql);
		if($result!=null && $result->num_rows==1){
			return true;
		}
		else
		{
			$result->close();
			return false;
		}
	}
	function folderSize($dir){
		$count_size = 0;
		$dir_array = scandir($dir);
		foreach($dir_array as $key=>$filename){
		    if($filename!=".." && $filename!="."){
		        if(is_file($dir."/".$filename)){
		        	$count_size = $count_size + filesize($dir."/".$filename);
		        	
		       	}
	   		}
		}
		return $count_size;
	}
	function GetShortURL($url)  {  
		$CurlInit = curl_init();   
		curl_setopt($CurlInit,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
		curl_setopt($CurlInit,CURLOPT_RETURNTRANSFER,1);  
		curl_setopt($CurlInit,CURLOPT_CONNECTTIMEOUT,5);  
		$data = curl_exec($CurlInit);  
		curl_close($CurlInit);  
		return $data;
	}
?>