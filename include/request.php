<?php 

include "function.php";

if(isset($_FILES['image']) AND isset($_POST['fullname']) AND isset($_POST['number']) AND isset($_POST['email']) AND isset($_POST['password']))
{
	$image=$_FILES['image'];

	$fullname=strtolower($_POST['fullname']);
	$phone_no=$_POST['number'];
	$email=strtolower($_POST['email']);
	$password=$_POST['password'];
	$confirm_pass=$_POST['c_password'];

	$image_types = array('png','jpg','jpeg');
	$profile_file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

	if($password!=$confirm_pass)
	{
		return message('error','Missmatch Password AND Confirm Password...... !','');
	}
	else if(password_method($_POST['password'])===false)
	{
		return message('error','Password Required<br> 1=Minimum 8 characters<br> 2=One uppercase letter<br> 3=One lowercase letter,<br> 4=One number,');
	}
	else if (!in_array($profile_file_ext, $image_types)) 
	{
		return message('error','Image files with the following extensions are allowed: ' . implode(', ', $image_types),'');
	}
	else if(is_array(getUser($_POST['email'])))
	{
		return message('error','Email Address Already Exist. Please Use Anthor Email.....!');
	}
	else
	{
		$profile_name=mt_rand(1111,9999).'_'.preg_replace('/\s+/', '', $_FILES['image']['name']);
		$profile_path="../files/usersProfile/".$profile_name;
		$profile_temp=$_FILES['image']['tmp_name'];

		if (!move_uploaded_file($profile_temp, $profile_path))
		{
			return message('error','Profile Image Not Uploaded.....!','');
		}

		$run=$con->prepare('INSERT INTO `users`(`u_fullName`, `u_email`, `u_password`, `u_phoneNumber`, `u_profileImage`) VALUES (?,?,?,?,?)');
		$run->bindParam(1,$fullname,PDO::PARAM_STR);
		$run->bindParam(2,$email,PDO::PARAM_STR);
		$run->bindParam(3,$password,PDO::PARAM_STR);
		$run->bindParam(4,$phone_no,PDO::PARAM_STR);
		$run->bindParam(5,$profile_name,PDO::PARAM_STR);

		if($run->execute())
		{
			$_SESSION['loginUser']=[
          	  $email,
          	  $con->lastInsertId(),
            ];

			$url=BASEURL."/index2.php";
			return message('success','Account Created Successfully...... !',$url);
		}
	}
}
else if(isset($_POST['login_email']) AND isset($_POST['login_password']))
{

	$login_email=strtolower($_POST['login_email']);
	$login_password=$_POST['login_password'];

	$userData=getUser($login_email);


	if(is_array($userData))
	{
		if($userData['u_password']==$login_password)
		{
			$_SESSION['loginUser']=[
          	  $login_email,
          	  $userData['u_id'],
            ];

			$url=BASEURL."/index2.php";
			return message('success','Login Successfully...... !',$url);
		}
		else
		{
			return message('error','Invalid Password.....!');
		}
	}
	else
	{
		return message('error','Invalid Email Address.....!');
	}
}
else if(isset($_POST['addNewCase']))
{
	$case=strtolower($_POST['addNewCase']);
	if(!empty($_POST['addNewCase']))
	{
		if(is_array(checkCaseType($case)))
		{
			return message('error','Case Type Name Already Available.....!');
		}

		$userID=$_SESSION['loginUser'][1];
		$caseName=strtolower($_POST['addNewCase']);

		$run=$con->prepare("INSERT INTO `cases_type`(`case_type_userId`, `case_type`) VALUES (?,?)");
		$run->bindParam(1,$userID,PDO::PARAM_INT);
		$run->bindParam(2,$case,PDO::PARAM_STR);
		if($run->execute())
		{
			return message('refersh','New Case Type Added Successfully.....!');
		}
	}
	else
	{
		return message('error','Enter Case Type Name.....!');
	}
}
else if(isset($_POST['addNewCout']))
{
	$court=strtolower($_POST['addNewCout']);
	if(!empty($court))
	{
		if(is_array(checkCourtType($court)))
		{
			return message('error','Court Type Name Already Available.....!');
		}

		$userID=$_SESSION['loginUser'][1];

		$run=$con->prepare("INSERT INTO `court_type`(`court_type_userId`, `court_type`) VALUES (?,?)");
		$run->bindParam(1,$userID,PDO::PARAM_INT);
		$run->bindParam(2,$court,PDO::PARAM_STR);
		if($run->execute())
		{
			return message('refersh','New Court Type Added Successfully.....!');
		}
	}
	else
	{
		return message('error','Enter Court Type Name.....!');
	}
}
else if(isset($_POST['updateCourtType']) AND isset($_POST['type']))
{
	//Edit Court Type
	if(!empty($_POST['updateCourtType']) AND is_numeric($_POST['updateCourtType']))
	{
		$userID=$_SESSION['loginUser'][1];
		$court_id=$_POST['updateCourtType'];
		$type_name=strtolower($_POST['type']);

		if(!empty($type_name))
		{
			$run=$con->prepare("SELECT * FROM `court_type` WHERE court_type_id=? AND court_type_userId=?");
			$run->bindParam(1,$court_id,PDO::PARAM_INT);
            $run->bindParam(2,$userID,PDO::PARAM_INT);
			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					if(is_array(checkCourtType($type_name)))
					{
						return message('error','Court Type Name Already Available.....!');
					}
					else
					{
						$run=$con->prepare("UPDATE `court_type` SET `court_type`=? WHERE court_type_id=? AND court_type_userId=?");
					    $run->bindParam(1,$type_name,PDO::PARAM_STR);
			            $run->bindParam(2,$court_id,PDO::PARAM_INT);
                        $run->bindParam(3,$userID,PDO::PARAM_INT);

                        if($run->execute())
                        {
                        	$url=BASEURL."/Court_type.php";
                        	return message('success','Court Type Name Updated Successfully.....!',$url);
                        }
					}
					
				}
				else
				{
					return message('error','Invalid Court Update.....!');
				}
			}
		}
		else
		{
			return message('error','Enter New Court Name.....!');
		}
	}
	else
	{
		return message('error','Invalid Court Update.....!');
	}

	return message('error','Something Was Wrong Please Try Again.....!');
}
else if(isset($_POST['courtTypeDelete']) AND isset($_POST['courtTypeID']))
{
	//Delete Court Type Name
	if(!empty($_POST['courtTypeID']) AND is_numeric($_POST['courtTypeID']))
	{
		$userID=$_SESSION['loginUser'][1];
		$delete_id=$_POST['courtTypeID'];

		$run=$con->prepare("SELECT * FROM `court_type` WHERE  court_type_userId=? AND court_type_id=?");
	 	$run->bindParam(1,$userID,PDO::PARAM_INT);
	 	$run->bindParam(2,$delete_id,PDO::PARAM_INT);

		 if($run->execute())
		 {
		 	 if($run->rowCount()>0)
		 	 {
		 	 	$run=$con->prepare("DELETE FROM `court_type` WHERE court_type_userId=? AND court_type_id=?");
	 	        $run->bindParam(1,$userID,PDO::PARAM_INT);
	 	        $run->bindParam(2,$delete_id,PDO::PARAM_INT);

	 	        if($run->execute())
	 	        {
	 	        	$url=BASEURL."/Court_type.php";
                    return message('success','Court Type Name Deleted Successfully.....!',$url);
	 	        }
		 	 }
		 	 else
		 	 {
		 	 	return message('error','Invalid Court Delet.....!');
		 	 }
		 }

	}
	else
	{
		return message('error','Invalid Court Delete.....!');
	}

	return message('error','Something Was Wrong Please Try Again.....!');
}
else if(isset($_POST['type']) AND isset($_POST['caseTypeUpdateID']))
{
	//Case Type Edit
	if(!empty($_POST['caseTypeUpdateID']) AND is_numeric($_POST['caseTypeUpdateID']))
	{
		$userID=$_SESSION['loginUser'][1];
		$case_id=$_POST['caseTypeUpdateID'];
		$type_name=strtolower($_POST['type']);

		if(!empty($type_name))
		{
			$run=$con->prepare("SELECT * FROM `cases_type` WHERE case_type_id=? AND case_type_userId=?");
			$run->bindParam(1,$case_id,PDO::PARAM_INT);
            $run->bindParam(2,$userID,PDO::PARAM_INT);
			if($run->execute())
			{
				if($run->rowCount()>0)
				{
					if(is_array(checkCaseType($type_name)))
					{
						return message('error','Case Type Name Already Available.....!');
					}
					else
					{
						$run=$con->prepare("UPDATE `cases_type` SET `case_type`=? WHERE case_type_id=? AND case_type_userId=?");
					    $run->bindParam(1,$type_name,PDO::PARAM_STR);
			            $run->bindParam(2,$case_id,PDO::PARAM_INT);
                        $run->bindParam(3,$userID,PDO::PARAM_INT);

                        if($run->execute())
                        {
                        	$url=BASEURL."/case_type.php";
                        	return message('success','Case Type Name Updated Successfully.....!',$url);
                        }
					}
					
				}
				else
				{
					return message('error','Invalid Case Update.....!');
				}
			}
		}
		else
		{
			return message('error','Enter New Case Name.....!');
		}
	}
	else
	{
		return message('error','Invalid Case Update.....!');
	}

	return message('error','Something Was Wrong Please Try Again.....!');
}
else if(isset($_POST['caseTypeDelete']) AND isset($_POST['caseTypeID']))
{
	//Delete Case Type Name
	if(!empty($_POST['caseTypeID']) AND is_numeric($_POST['caseTypeID']))
	{
		$userID=$_SESSION['loginUser'][1];
		$delete_id=$_POST['caseTypeID'];

		$run=$con->prepare("SELECT * FROM `cases_type` WHERE  case_type_userId=? AND case_type_id=?");
	 	$run->bindParam(1,$userID,PDO::PARAM_INT);
	 	$run->bindParam(2,$delete_id,PDO::PARAM_INT);

		 if($run->execute())
		 {
		 	 if($run->rowCount()>0)
		 	 {
		 	 	$run=$con->prepare("DELETE FROM `cases_type` WHERE case_type_userId=? AND case_type_id=?");
	 	        $run->bindParam(1,$userID,PDO::PARAM_INT);
	 	        $run->bindParam(2,$delete_id,PDO::PARAM_INT);

	 	        if($run->execute())
	 	        {
	 	        	$url=BASEURL."/case_type.php";
                    return message('success','Case Type Name Deleted Successfully.....!',$url);
	 	        }
		 	 }
		 	 else
		 	 {
		 	 	return message('error','Invalid Case Delet.....!');
		 	 }
		 }

	}
	else
	{
		return message('error','Invalid Case Delete.....!');
	}

	return message('error','Something Was Wrong Please Try Again.....!');
}
else if (isset($_POST['c_name']) AND isset($_POST['c_father']) AND isset($_POST['c_cnic']) AND isset($_POST['c_number'])  AND isset($_POST['c_address']) ) 
{
	//Add Client Details

	if (!empty($_POST['c_name']) AND !empty($_POST['c_father']) AND !empty($_POST['c_cnic']) AND !empty($_POST['c_number'])  AND !empty($_POST['c_address']) ) 
	{
		if(!preg_match('/^((?:00|\+)92)?(0?3(?:[0-46]\d|55)\d{7})$/', $_POST['c_number'])) 
		{
		  return message('error',' Phone number is invalid....!');
		}
		else if(validatePakistanCNIC($_POST['c_cnic'])==false) 
		{
		   return message('error','Invalid CNIC number....!');
		} 
		else 
		{
		  if(getClientByCnic($_POST['c_cnic']))
		  {
		  	return message('error','Client Already Exist....!');
		  }
		  else
		  {
		  	$userID=$_SESSION['loginUser'][1];
		  	$name=strtolower($_POST['c_name']);
		  	$father=strtolower($_POST['c_father']);
		  	$cnic=$_POST['c_cnic'];
		  	$number=$_POST['c_number'];
		    $address=strtolower($_POST['c_address']);

		  	$run=$con->prepare("INSERT INTO `client`(`user_id`, `fullname`, `father`, `cnic`, `number`, `address`) VALUES (?,?,?,?,?,?)");
		  	$run->bindParam(1,$userID,PDO::PARAM_INT);
		  	$run->bindParam(2,$name,PDO::PARAM_STR);
		  	$run->bindParam(3,$father,PDO::PARAM_STR);
		  	$run->bindParam(4,$cnic,PDO::PARAM_STR);
		  	$run->bindParam(5,$number,PDO::PARAM_STR);
		  	$run->bindParam(6,$address,PDO::PARAM_STR);

		  	if($run->execute())
		  	{
		  		$url=BASEURL."/addClientCase.php?client_id=".$con->lastInsertId();
                return message('success','Client Added Successfully.....!',$url);
		  	}
		  }
		}

	}
}
else if (isset($_POST['client_id']) AND isset($_POST['behalf']) AND isset($_POST['case_no']) AND isset($_POST['case_type']) AND isset($_POST['court_name']) AND isset($_POST['pet_name']) AND isset($_POST['section']) AND isset($_POST['hearing']) AND isset($_POST['judge_name'])) 
{
	// ADD Client Case Details
	$userID=$_SESSION['loginUser'][1];
	$client_id=$_POST['client_id'];
	$behalf=$_POST['behalf'];
	$case_no=$_POST['case_no'];
	$case_type=$_POST['case_type'];
	$court_name=$_POST['court_name'];
	$pet_name=$_POST['pet_name'];
	$section=$_POST['section'];
	$judge_name=$_POST['judge_name'];
	$hearing=$_POST['hearing'];

	$currentDate = date("Y-m-d");

	if (strtotime($hearing) < strtotime($currentDate)) 
	{
	    return message('error','Please Select a Future Date....!');
	}
	else if(is_array(getClient($case_no,$client_id)))
	{
		return message('error','Client Case Already Exist....!');
	}
	else if(getClientByID($client_id)==false)
	{
	   return message('error','Invalid Client....!');
	}
	else
	{
		$run=$con->prepare("INSERT INTO `cases`(`client_id`, `user_id`, `behalf`, `case_no`, `case_type_name`, `court_type_name`, `pet_name`, `section`, `judge_name`) VALUES (?,?,?,?,?,?,?,?,?)");

		$run->bindParam(1,$client_id,PDO::PARAM_INT);
		$run->bindParam(2,$userID,PDO::PARAM_INT);
		$run->bindParam(3,$behalf,PDO::PARAM_STR);
		$run->bindParam(4,$case_no,PDO::PARAM_INT);
		$run->bindParam(5,$case_type,PDO::PARAM_STR);
		$run->bindParam(6,$court_name,PDO::PARAM_STR);
		$run->bindParam(7,$pet_name,PDO::PARAM_STR);
		$run->bindParam(8,$section,PDO::PARAM_STR);
		$run->bindParam(9,$judge_name,PDO::PARAM_STR);

		if($run->execute())
		{
			$case_id=$con->lastInsertId();

			$run=$con->prepare("INSERT INTO `hearing`(`user_id`, `client_id`, `case_id`, `next_hearing`) VALUES (?,?,?,?)");
			$run->bindParam(1,$userID,PDO::PARAM_INT);
			$run->bindParam(2,$client_id,PDO::PARAM_INT);
			$run->bindParam(3,$case_id,PDO::PARAM_INT);
			$run->bindParam(4,$hearing,PDO::PARAM_STR);

			if($run->execute())
			{
				$url=BASEURL."/case.php";
                return message('success','Client Added Successfully.....!',$url);
			}
		}

	}
	

}
else if (isset($_POST['update_fullname']) AND isset($_POST['update_father']) AND isset($_POST['update_cnic']) AND isset($_POST['update_number'])  AND isset($_POST['update_address']) AND isset($_POST['update_client_status']) AND isset($_POST['client_id']) ) 
{
	//Edit Client Details
	if(!preg_match('/^((?:00|\+)92)?(0?3(?:[0-46]\d|55)\d{7})$/', $_POST['update_number'])) 
	{
	  return message('error',' Phone number is invalid....!');
	}
	else if(validatePakistanCNIC($_POST['update_cnic'])==false) 
	{
	   return message('error','Invalid CNIC number....!');
	} 
	else if(!is_numeric($_POST['client_id']))
	{
		$url=BASEURL."/clients.php";
		return message('error','Invalid Client....!',$url);
	}
	else 
	{
		$clientData=getClientByCnic($_POST['update_cnic']);

	   if(is_array($clientData) AND $clientData['id']!=$_POST['client_id'])
	   {
	  	 return message('error','Client CNIC Already Exist....!');
	   }
	 
		$userID=$_SESSION['loginUser'][1];
		$client_id=$_POST['client_id'];

	  	$name=strtolower($_POST['update_fullname']);
	  	$father=strtolower($_POST['update_father']);
	  	$cnic=$_POST['update_cnic'];
	  	$number=$_POST['update_number'];
	    $address=strtolower($_POST['update_address']);
	    $status=strtolower($_POST['update_client_status']);

	    $run=$con->prepare("UPDATE `client` SET `fullname`=?,`father`=?,`cnic`=?,`number`=?,`address`=?,`client_status`=? WHERE user_id=? AND id=?");


	  	$run->bindParam(1,$name,PDO::PARAM_STR);
	  	$run->bindParam(2,$father,PDO::PARAM_STR);
	  	$run->bindParam(3,$cnic,PDO::PARAM_STR);
	  	$run->bindParam(4,$number,PDO::PARAM_STR);
	  	$run->bindParam(5,$address,PDO::PARAM_STR);
	  	$run->bindParam(6,$status,PDO::PARAM_STR);
	  	$run->bindParam(7,$userID,PDO::PARAM_INT);
	  	$run->bindParam(8,$client_id,PDO::PARAM_INT);

	  	if($run->execute())
	  	{
	  		if($_POST['update_client_status']=='inactive')
	  		{
	  			$updateStatus='clientInactive';
	  			$status='open';
	  		}
	  		else
	  		{
	  			$status="clientInactive";
	  			$updateStatus='open';
	  		}
            $run=$con->prepare("UPDATE `cases` SET `case_status`=? WHERE client_id=? AND user_id=? AND case_status=?");
           	$run->bindParam(1,$updateStatus,PDO::PARAM_STR);
	  	    $run->bindParam(2,$client_id,PDO::PARAM_INT);
	  	    $run->bindParam(3,$userID,PDO::PARAM_INT);
	  	    $run->bindParam(4,$status,PDO::PARAM_STR);

	  	    if($run->execute())
	  	    {
	  	    	$url=BASEURL."/clients.php";
                return message('success','Client Updated Successfully.....!',$url);
	  	    }	
	  	}

	}
}
else if (isset($_POST['update_case_id']) AND isset($_POST['update_behalf']) AND isset($_POST['update_case_no']) AND isset($_POST['update_case_type']) AND isset($_POST['update_court_name']) AND isset($_POST['update_pet_name']) AND isset($_POST['update_section']) AND isset($_POST['update_judge_name']) AND isset($_POST['update_client_status'])) 
{
	// Edit Client Case Details

	$case_id=$_POST['update_case_id'];
	$behalf=$_POST['update_behalf'];
	$case_no=$_POST['update_case_no'];
	$case_type=$_POST['update_case_type'];
	$court_name=$_POST['update_court_name'];
	$pet_name=$_POST['update_pet_name'];
	$section=$_POST['update_section'];
	$judge_name=$_POST['update_judge_name'];
	$status=$_POST['update_client_status'];

	$currentDate = date("Y-m-d");
	$checkCase=getCaseByID($case_id);
	$userID=$_SESSION['loginUser'][1];

	if(is_array($checkCase))
	{
		$run=$con->prepare('SELECT * FROM `cases` WHERE case_no=? AND user_id=?');
	 	$run->bindParam(1,$case_no,PDO::PARAM_INT);
	 	$run->bindParam(2,$userID,PDO::PARAM_INT);

	 	 if($run->execute())
	 	 {
	 	 	 if($run->rowCount()>0)
	 	 	 {
	 	 	 	$caseData=$run->fetch(PDO::FETCH_ASSOC);
	 	 	 }
	 	 	 else
	 	 	 {
	 	 	 	$caseData='';
	 	 	 }
	 	 }


		 if (is_array($caseData) && isset($caseData['id']) && $caseData['id'] != $case_id) 
		 {
	       return message('error', 'Client Case Already Exists....!');
		 } 
		else 
		{
			if(is_array($caseData))
			{
				$clientData = getClientByID($caseData['client_id']);
			    if ($clientData && $clientData['client_status'] == 'inactive') 
			    {
			        return message('error', 'The client status is inactive. You should not edit the client case without first changing the client status to active....!');
			    }

			}
		    
			$run=$con->prepare('UPDATE `cases` SET `case_type_name`=?,`court_type_name`=?,`behalf`=?,`case_no`=?,`pet_name`=?,`section`=?,`judge_name`=?,`case_status`=? WHERE id=? AND user_id=?');

			$run->bindParam(1,$case_type,PDO::PARAM_STR);
			$run->bindParam(2,$court_name,PDO::PARAM_STR);
			$run->bindParam(3,$behalf,PDO::PARAM_STR);
			$run->bindParam(4,$case_no,PDO::PARAM_INT);
			$run->bindParam(5,$pet_name,PDO::PARAM_STR);
			$run->bindParam(6,$section,PDO::PARAM_STR);
			$run->bindParam(7,$judge_name,PDO::PARAM_STR);
			$run->bindParam(8,$status,PDO::PARAM_STR);
			$run->bindParam(9,$case_id,PDO::PARAM_INT);
			$run->bindParam(10,$userID,PDO::PARAM_INT);


			if($run->execute())
			{
				$url=BASEURL."/case.php";
	            return message('success','Client Case Edit Successfully.....!',$url);
			}
		}
	}
	else
	{
		return message('error','Invalid Client Case Edit.....!',$url);
	}
	
}
else if (isset($_POST['deleteClientCaseDelete']) AND isset($_POST['case_id'])) 
{
	// Delete Case
	if(is_numeric($_POST['case_id']) AND !empty($_POST['case_id']))
	{
		$case_id=$_POST['case_id'];

		$checkCase=getCaseByID($case_id);

		if(is_array($checkCase))
		{
			$run=$con->prepare("DELETE FROM `cases` WHERE id=?");
			$run->bindParam(1,$case_id,PDO::PARAM_INT);

			if($run->execute())
			{
				$url=BASEURL."/case.php";
	            return message('success','Client Case Delete Successfully.....!',$url);
			}
			else
			{
				return message('error','Invalid Case Delete.....!','');
			}
		}
	}
	else
	{
		return message('error','Invalid Case Delete.....!','');
	}

	return message('error','Something Was Wrong Please Try Again.....!','');
}
else if(isset($_POST['deleteClient']) AND isset($_POST['client_id']))
{
	//Delete Client
	if(is_numeric($_POST['client_id']))
	{
		$userID=$_SESSION['loginUser'][1];
		$client_id=$_POST['client_id'];

		$checkCase=getClientByID($client_id);

		if(is_array($checkCase))
		{
			$run=$con->prepare("DELETE FROM `client` WHERE id=?");
			$run->bindParam(1,$client_id,PDO::PARAM_INT);
			if($run->execute())
			{
				$run=$con->prepare("DELETE FROM `cases` WHERE client_id=? AND user_id=?");
			    $run->bindParam(1,$client_id,PDO::PARAM_INT);
			    $run->bindParam(2,$userID,PDO::PARAM_INT);
			    if($run->execute())
			    {
			    	$url=BASEURL."/clients.php";
	                return message('success','Client All Data Deleted Successfully.....!',$url);
			    }
			}
		}
	}
	else
	{
		return message('error','Invalid Client Delete.....!','');
	}
}
else if(isset($_POST['checkHearing']) AND isset($_POST['case_id']))
{
	//check hearing. add new hearing time
	$case_id=$_POST['case_id'];

	if(is_numeric($case_id))
	{
		$checkCase=getCaseByID($case_id);

		if(is_array($checkCase))
		{
			if($checkCase['case_status']=='close')
			{
				return message('error','The Case status is close. You should not add new hearing the client case without first changing the case status to open.','');
			}
			else if($checkCase['case_status']=='clientInactive')
			{
				return message('error','The client status is inactive. You should not add new hearing the client case without first changing the client status to active.','');
			}
		}
		else
		{
			return message('error','Invalid Case','');
		}


		$run=$con->prepare("SELECT * FROM `hearing` WHERE case_id=? ORDER BY h_id DESC");
		$run->bindParam(1,$case_id,PDO::PARAM_INT);
		if($run->execute())
		{
			if($run->rowCount()>0)
			{
				$data=$run->fetch(PDO::FETCH_ASSOC);
			}
		}

		if(is_array($data))
		{
			if(empty($data['previous_hearing']) OR $data['previous_hearing']==NULL)
			{
				$html='
                <div class="col-md-12">
                    <b>First Hearing</b>
                  <input type="date" required class="form-control" value="'.$data['next_hearing'].'" name="previous_date" disabled>
                </div><br>

                <div class="col-md-12">
                    <b>Next Hearing</b>
                  <input type="date" name="next_date"  class="form-control">
                </div><br>

                <div class="col-md-12">
                  <textarea cols="2" rows="6" class="form-control" name="judgeRemark" placeholder="Judge Remarks"></textarea>
                </div>

                <input type="number" name="caseID" value="'.$case_id.'" hidden>
                ';
			}
			else
			{

				$html='<div class="col-md-12">
                    <b>Previous Hearing</b>
                  <input type="date" value="'.$data['previous_hearing'].'" name="previous_date"  class="form-control" disabled>
                </div><br>
                <div class="col-md-12">
                    <b>Next Hearing</b>
                  <input type="date" required class="form-control" name="next_date">
                </div><br>
                <div class="col-md-12">
                  <textarea cols="2" rows="6" class="form-control" placeholder="Judge Remarks" name="judgeRemark"></textarea>
                </div> <input type="number" name="caseID" value="'.$case_id.'" hidden>';
			}

			$currentDate = date('Y-m-d');


			if($data['next_hearing']<=$currentDate)
			{
				return message('success',$html,'');
			}
			else
			{
				$formattedDate = date('d-m-Y', strtotime($data['next_hearing']));

				return message('error','New Hearing date after this date:- <b>'.$formattedDate.' </b>','');
			}

			
		}
	}
	else
	{
		return message('error','Invalid Case.....!','');
	}
}
else if(isset($_POST['next_date']) AND isset($_POST['judgeRemark']) AND isset($_POST['caseID']))
{
	if(!empty($_POST['next_date']) AND !empty($_POST['judgeRemark']) AND !empty($_POST['caseID']))
	{
		$caseID=$_POST['caseID'];
		$next_date=$_POST['next_date'];
		$judgeRemark=$_POST['judgeRemark'];
		$currentDate = date('Y-m-d');

		if(is_numeric($caseID))
		{
			$checkCase=getCaseByID($caseID);
			if(is_array($checkCase))
			{
				if($checkCase['case_status']=='close')
				{
					return message('error','The Case status is close. You should not add new hearing the client case without first changing the case status to open....!','');
				}
				else if($checkCase['case_status']=='clientInactive')
				{
					return message('error','The client status is inactive. You should not add new hearing the client case without first changing the client status to active....!','');
				}

				$run=$con->prepare("SELECT * FROM `hearing` WHERE case_id=? ORDER BY h_id DESC");
				$run->bindParam(1,$caseID,PDO::PARAM_INT);
				if($run->execute())
				{
					if($run->rowCount()>0)
					{
						$data=$run->fetch(PDO::FETCH_ASSOC);
					}
				}


				if(is_array($data))
				{
					if(empty($data['previous_hearing']) OR $data['previous_hearing']==NULL)
					{
						$previous_hearing=$data['next_hearing'];
					}
					else
					{
						$previous_hearing=$data['previous_hearing'];
					}
					

					if ($next_date <= $currentDate) 
					{
					  return message('error','Please select a future date......!','');
					} 
					else 
					{
						$h_id=$data['h_id'];
						$userID=$_SESSION['loginUser'][1];
						$client_id=$data['client_id'];

						$run=$con->prepare("UPDATE `hearing` SET `judge_remarks`=? WHERE h_id=? AND user_id=?");
						$run->bindParam(1,$judgeRemark,PDO::PARAM_STR);
						$run->bindParam(2,$h_id,PDO::PARAM_INT);
						$run->bindParam(3,$userID,PDO::PARAM_INT);

						if($run->execute())
						{
							$run=$con->prepare("INSERT INTO `hearing`(`user_id`, `client_id`, `case_id`, `previous_hearing`, `next_hearing`) VALUES (?,?,?,?,?)");

							$run->bindParam(1,$userID,PDO::PARAM_INT);
							$run->bindParam(2,$client_id,PDO::PARAM_INT);
							$run->bindParam(3,$caseID,PDO::PARAM_INT);
							$run->bindParam(4,$previous_hearing,PDO::PARAM_STR);
							$run->bindParam(5,$next_date,PDO::PARAM_STR);

							if($run->execute())
							{
								$url=BASEURL."/case.php";
		                        return message('success','New Hearing Date Added Successfully.....!',$url);
							}

						}
					}
				}
			}
		}
	}
}
else if(isset($_POST['forgot_password']))
{
	$email=$_POST['forgot_password'];

	$userData=getUser($email);

	if(is_array($userData))
	{
	    $subject='Forgot Password';
        $message="<p>Hello ".ucwords($userData['u_fullName'])."...!<br>Your Password is :-  ".$userData['u_password']." </p><br><hr>
        <p>If You Think You Did Not Make This Request, Just ignore this email</p>";
        
        @mail($email, $subject, $message,"Content-type: text/html\r\n");
        return message('success','Password Send Your Email Address Please Check Your Email.....!','');
        
	}
	else
	{
		return message('error','Invalid Email Address.....!','');
	}
}
?>