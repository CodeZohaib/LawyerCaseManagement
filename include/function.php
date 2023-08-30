<?php 
  session_start();
  global $con;
  $con = connection();

   define("BASEURL","http://localhost/case_management");

  function connection()
  {
  	try
  	{
	    $db=new PDO("mysql:host=localhost;dbname=case_management_system","root","");
	    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	    return $db;
	  }

	  catch(PDOException $e)
	  {
	    echo "Sorry database connection error:-".$e->getMessage();
	    exit();
	  }

  }


  function check($array)
  {
  	echo "<pre>";
  	print_r($array);
  	exit();
  }

  function formatDate($date)
	{
	      return date('F j, Y, g:i A',strtotime($date));
	}
 

	function message($status,$msg,$url=NULL)
	{
		if ($status==='success' && !empty($url)) 
		{
			echo json_encode([
				'success'=>'success',
				'message'=>$msg,
				'url'=>$url,
				
			]);
		}
		else if ($status==='error' && !empty($url)) 
		{
			echo json_encode([
				'error'=>'error',
				'message'=>$msg,
				'url'=>$url,
				
			]);
		}
		else if ($status==='success' && empty($url)) 
		{
			echo json_encode([
				'success'=>'success',
				'message'=>$msg,
		    ]);
		}
		else if ($status==='error' && empty($url)) 
		{
			echo json_encode([
				'error'=>'error',
				'message'=>$msg,
		    ]);
		}
    else if ($status==='refersh') 
    {
      echo json_encode([
          'success'=>'success',
          'message'=>$msg,
          'signout'=>1,
      ]);
    }
	}

 function password_method($password)
 {
	$uppercase = preg_match('@[A-Z]@',$password);
  $lowercase = preg_match('@[a-z]@',$password);
  $number    = preg_match('@[0-9]@',$password);

    if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) 
    {
      return false;
    }
    else
    {
    	return true;
    }
 }


function validatePakistanCNIC($cnic) {
  // Check if the CNIC number matches the expected pattern
  if (preg_match('/^\d{5}-\d{7}-\d$/', $cnic)) {
    return true; // Valid CNIC number
  } else {
    return false; // Invalid CNIC number
  }
}



 function getUser($value)
 {
 	 global $con;
 	 if(is_numeric($value))
 	 {
 	 	 $run=$con->prepare("SELECT * FROM `users` WHERE u_id=?");
 	 	 $run->bindParam(1,$value,PDO::PARAM_INT);
 	 }
 	 else
 	 {
 	 	$run=$con->prepare("SELECT * FROM `users` WHERE u_email=?");
 	 	 $run->bindParam(1,$value,PDO::PARAM_STR);
 	 }

 	 if($run->execute())
 	 {
 	 	 if($run->rowCount()>0)
 	 	 {
 	 	 	 return $run->fetch(PDO::FETCH_ASSOC);
 	 	 }
 	 }

 	 return false;
 }

 function checkCaseType($value)
 {
 	 global $con;
 	 if(!empty($value))
 	 {
 	 	 $userID=$_SESSION['loginUser'][1];
 	 	 $run=$con->prepare("SELECT * FROM `cases_type` WHERE case_type=? AND case_type_userId=?");
 	 	 $run->bindParam(1,$value,PDO::PARAM_STR);
 	 	 $run->bindParam(2,$userID,PDO::PARAM_INT);
 	
	 	 if($run->execute())
	 	 {
	 	 	 if($run->rowCount()>0)
	 	 	 {
	 	 	 	 return $run->fetch(PDO::FETCH_ASSOC);
	 	 	 }
	 	 }
 	}

 	 return false;
 }

 function checkCourtType($value)
 {
 	 global $con;
 	 if(!empty($value))
 	 {
 	 	 $userID=$_SESSION['loginUser'][1];
 	 	 $run=$con->prepare("SELECT * FROM `court_type` WHERE court_type=? AND court_type_userId=?");
 	 	 $run->bindParam(1,$value,PDO::PARAM_STR);
 	 	 $run->bindParam(2,$userID,PDO::PARAM_INT);
 	
	 	 if($run->execute())
	 	 {
	 	 	 if($run->rowCount()>0)
	 	 	 {
	 	 	 	 return $run->fetch(PDO::FETCH_ASSOC);
	 	 	 }
	 	 }
 	}

 	 return false;
 }

 function getCaseType($id=null)
 {
 	 global $con;

 	 if(empty($id) OR $id==NULL)
 	 {
 	 	$userID=$_SESSION['loginUser'][1];
 	 }
 	 else
 	 {
 	 	$userID=$id;
 	 }
 	 
 	 $run=$con->prepare("SELECT * FROM `cases_type` WHERE  case_type_userId=?");
 	 $run->bindParam(1,$userID,PDO::PARAM_INT);

	 if($run->execute())
	 {
	 	 if($run->rowCount()>0)
	 	 {
	 	 	 return $run->fetchAll(PDO::FETCH_ASSOC);
	 	 }
	 }

 	 return false;
 }


 function getCourtType($id=null)
 {
 	 global $con;

 	 if(empty($id) OR $id==NULL)
 	 {
 	 	$userID=$_SESSION['loginUser'][1];
 	 }
 	 else
 	 {
 	 	$userID=$id;
 	 }
 	 $run=$con->prepare("SELECT * FROM `court_type` WHERE court_type_userId=?");
 	 $run->bindParam(1,$userID,PDO::PARAM_INT);

	 if($run->execute())
	 {
	 	 if($run->rowCount()>0)
	 	 {
	 	 	 return $run->fetchAll(PDO::FETCH_ASSOC);
	 	 }
	 }

 	 return false;
 }

 function getClientByCnic($cnic)
 {
 	 global $con;

 	 if(!empty($cnic))
 	 {
 	 	$userID=$_SESSION['loginUser'][1];

 	 	 $run=$con->prepare('SELECT * FROM `client` WHERE cnic=? AND user_id=?');
 	 	 $run->bindParam(1,$cnic,PDO::PARAM_STR);
 	 	 $run->bindParam(2,$userID,PDO::PARAM_INT);

 	 	 if($run->execute())
 	 	 {
 	 	 	 if($run->rowCount()>0)
 	 	 	 {
 	 	 	 	 return $run->fetch(PDO::FETCH_ASSOC);
 	 	 	 }
 	 	 }
 	 }

 	 return false;
 }

 function getClientByID($id)
 {
 	 global $con;

 	 if(!empty($id))
 	 {
 	 	$userID=$_SESSION['loginUser'][1];

 	 	 $run=$con->prepare('SELECT * FROM `client` WHERE id=? AND user_id=?');
 	 	 $run->bindParam(1,$id,PDO::PARAM_INT);
 	 	 $run->bindParam(2,$userID,PDO::PARAM_INT);

 	 	 if($run->execute())
 	 	 {
 	 	 	 if($run->rowCount()>0)
 	 	 	 {
 	 	 	 	 return $run->fetch(PDO::FETCH_ASSOC);
 	 	 	 }
 	 	 }
 	 }

 	 return false;
 }

 function getClient($case_no,$client_id)
 {
 	 global $con;

 	 if(!empty($case_no))
 	 {
 	 	$userID=$_SESSION['loginUser'][1];

 	 	 $run=$con->prepare('SELECT * FROM `cases` WHERE case_no=? AND client_id=? AND user_id=?');
 	 	 $run->bindParam(1,$case_no,PDO::PARAM_INT);
 	 	 $run->bindParam(2,$client_id,PDO::PARAM_INT);
 	 	 $run->bindParam(3,$userID,PDO::PARAM_INT);

 	 	 if($run->execute())
 	 	 {
 	 	 	 if($run->rowCount()>0)
 	 	 	 {
 	 	 	 	 return $run->fetch(PDO::FETCH_ASSOC);
 	 	 	 }
 	 	 }
 	 }

 	 return false;
 }

 function getCaseByID($case_id)
 {
 	 global $con;

 	 if(!empty($case_id))
 	 {
 	 	$userID=$_SESSION['loginUser'][1];

 	 	 $run=$con->prepare('SELECT * FROM `cases` WHERE id=? AND user_id=?');
 	 	 $run->bindParam(1,$case_id,PDO::PARAM_INT);
 	 	 $run->bindParam(2,$userID,PDO::PARAM_INT);

 	 	 if($run->execute())
 	 	 {
 	 	 	 if($run->rowCount()>0)
 	 	 	 {
 	 	 	 	 return $run->fetch(PDO::FETCH_ASSOC);
 	 	 	 }
 	 	 }
 	 }

 	 return false;
 }


 function getHearingByID($hearing_id)
 {
 	 global $con;

 	 if(!empty($hearing_id))
 	 {
 	 	$userID=$_SESSION['loginUser'][1];

 	 	$run=$con->prepare("SELECT * FROM `hearing` JOIN `client` ON `hearing`.`client_id`=`client`.`id` WHERE `hearing`.`user_id`=? AND h_id=?");

 	 	$run->bindParam(1,$userID,PDO::PARAM_INT);
 	 	$run->bindParam(2,$hearing_id,PDO::PARAM_INT);

 	 	if($run->execute())
 	 	{
 	 		if($run->rowCount()>0)
 	 		{
 	 			return $run->fetch(PDO::FETCH_ASSOC);
 	 		}
 	 	}
 	 }

 	 return false;

 }
?>