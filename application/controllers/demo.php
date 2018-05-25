<?php

Class Api extends CI_Controller
{
    
    
    public function index()
    {
		
        echo "People app index successfully configured";
    }
    
	
	//This function helps to generate otp based on the mobile number of the user
	public function generate_otp()
	{
		
		 if (!isset($_POST['MobileNo']) || !isset($_POST['Role'])) {
			  $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
		 }
		 else if{
			  $this->load->database();
			  $role = $_POST['Role'];
			  
			  switch($role)
			  {
				  
				  case "Voter":
				  $this->load->model('VoterModel');
				  $this->VoterModel->insertOtpValues();
				  break;
				  
				  case "Leader":
				  break;
				  
				   default:
                    $res = array(
                        'success' => 'false',
                        'message' => 'Role not exists'
                    );
                    echo json_encode($res);
                    break;
			  }
			
		 }
		
	}
	
	
    
    
    //*******************************************************
    //Login Function with parameters Username,UserPassword and Role
    //********************************************************
    public function login()
    {
		
        if (!isset($_POST['Username']) || !isset($_POST['UserPassword'])|| !isset($_POST['Role'])) {
            $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
        } else {
            
            $this->load->database();
            $role = $_POST['Role'];
            switch ($role) {
                case "admin":
                    $admindetails = $this->db->get('adminlogindetails')->result_array();
                    
                    //default admin username and password in database
                    $Username     = $admindetails[0]['Username'];
                    $UserPassword = $admindetails[0]['UserPassword'];
                    
                    //input from user     
                    $userip_username = $_POST['Username'];
                    $userip_password = $_POST['UserPassword'];
                    
                    $UserID = $admindetails[0]['UserID'];
                    if ($Username == $userip_username && $UserPassword == $userip_password && $role == "admin") {
                        
                        $data = array(
                            'IsLoggedIn' => '1'
                        );
                        
                        $this->db->set($data);
                        $this->db->where('UserID', $UserID);
                        $this->db->update('adminlogindetails', $data);
                        $this->db->close();
                        
                        $res = array(
                            'success' => 'true',
                            'message' => 'Login Successfull',
                            'user_id' => $UserID
                        );
                        echo json_encode($res);
                    } else {
                        
                        $data = array(
                            'IsLoggedIn' => '0'
                        );
                        
                        $this->db->set($data);
                        $this->db->where('UserID', $UserID);
                        $this->db->update('adminlogindetails', $data);
                        $this->db->close();
                        $res = array(
                            'success' => 'false',
                            'message' => 'Login Unsuccessfull'
                        );
                        echo json_encode($res);
                    }
                    break;
                
                case "teacher":
				 $teacherdetails = $this->db->get('addteacher')->result_array();
                    $Username="";
					$UserPassword="";
					$UserID="";
					$classname="";
					
                    //input from user     
                    $userip_username = $_POST['Username'];
                    $userip_password = $_POST['UserPassword'];
				
					for($i=0;$i<sizeof($teacherdetails);$i++)
					{
						
						if(strcmp($teacherdetails[$i]['Username'],$userip_username)==0)
						{
							 //default admin username and password in database
                    $Username     = $teacherdetails[$i]['Username'];
                    $UserPassword = $teacherdetails[$i]['Password'];
					   $UserID = $teacherdetails[$i]['UserId'];
					   $classname=$teacherdetails[$i]['Classname'];
					  
					break;
						}
						
					}
                    
                   if ($Username == $userip_username && $UserPassword == $userip_password && $role == "teacher") {
                        
                        $res = array(
                            'success' => 'true',
                            'message' => 'Login Successfull',
                            'user_id' => $UserID,
							'classname'=>$classname,
							'username'=>$Username
                        );
                        echo json_encode($res);
                    } else {
                      
                        $res = array(
                            'success' => 'false',
                            'message' => 'Login Unsuccessfull'
                        );
                        echo json_encode($res);
                    }
					   
					   
					 
                   
				
                    break;
                
                case "student":
				 $studentdetails = $this->db->get('addstudent')->result_array();
                     $Username="";
					$UserPassword="";
					$classname="";
					$UserID="";
                    //input from user     
                    $userip_username = $_POST['Username'];
                    $userip_password = $_POST['UserPassword'];
					
					for($i=0;$i<sizeof($studentdetails);$i++)
					{
				
						if(strcmp($studentdetails[$i]['Username'],$userip_username)==0)
						{
							
                    $Username     = $studentdetails[$i]['Username'];
                    $UserPassword = $studentdetails[$i]['Password'];
					   $UserID = $studentdetails[$i]['UserId'];
					     $classname=$studentdetails[$i]['Classname'];
					break;
						}
						
						
					}
                    
                 
                    if ($Username == $userip_username && $UserPassword == $userip_password && $role == "student") {
                        
                        $res = array(
                            'success' => 'true',
                            'message' => 'Login Successfull',
                            'user_id' => $UserID,
							'classname'=>$classname,
							'username'=>$Username
                        );
                        echo json_encode($res);
                    } else {
                      
                        $res = array(
                            'success' => 'false',
                            'message' => 'Login Unsuccessfull'
                        );
                        echo json_encode($res);
                    }
				
                    break;
                
                default:
                    $res = array(
                        'success' => 'false',
                        'message' => 'Role not exists'
                    );
                    echo json_encode($res);
                    break;
            }
            
        }
        
    }
    
    
    
    
    
    //*******************************************************
    //Logout Function with parameters Username and UserID
    //******************************************************
    public function logout()
    {
        if (!isset($_GET['UserId']) || !isset($_GET['Role'])) {
            $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
        } else {
            
            $this->load->database();
            $role = $_GET['Role'];
            switch ($role) {
                case "admin":
                    $admindetails = $this->db->get('adminlogindetails')->result_array();
                    
                    //default admin username and password in database
                  
                    $UserID   = $admindetails[0]['UserID'];
                    
                    //input from user     
                    $userip_username = $_GET['Role'];
                    $userip_userid   = $_GET['UserId'];
                    
                    $UserID = $admindetails[0]['UserID'];
                    if ($userip_username == $role && $UserID == $userip_userid && $role == "admin") {
                        
                        $data = array(
                            'IsLoggedIn' => '0'
                        );
                        
                        $this->db->set($data);
                        $this->db->where('UserID', $UserID);
                        $this->db->update('adminlogindetails', $data);
                        $this->db->close();
                        
                        $res = array(
                            'success' => 'true',
                            'message' => 'Logout Successfull'
                        );
                        echo json_encode($res);
                    } else {
                        
                        $data = array(
                            'IsLoggedIn' => '1'
                        );
                        
                        $this->db->set($data);
                        $this->db->where('UserID', $UserID);
                        $this->db->update('adminlogindetails', $data);
                        $this->db->close();
                        $res = array(
                            'success' => 'false',
                            'message' => 'Something went wrong'
                        );
                        echo json_encode($res);
                    }
                    break;
                case "teacher":
                    $teacherdetails = $this->db->get('addteacher')->result_array();
                   
                   
                    $userid = $_GET['UserId'];
                 
				$flag=0;
					for($i=0;$i<sizeof($teacherdetails);$i++)
					{
						
						if(strcmp($teacherdetails[$i]['UserId'],$userid)==0)
						{
							
                   $flag=1;
					  
					break;
						}
						
					}
                    
                   if ($flag==1 && $role == "teacher") {
                        $flag=0;
                        $res = array(
                            'success' => 'true',
                            'message' => 'Logout Successfull',
                            'user_id' => $userid
                        );
                        echo json_encode($res);
                    } else {
                      
                        $res = array(
                            'success' => 'false',
                            'message' => 'Logout Unsuccessfull'
                        );
                        echo json_encode($res);
                    }
					   
					   
					 
                   
				
                    break;
               case "student":
                    $studentdetails = $this->db->get('addstudent')->result_array();
                   
                   
                    $userid = $_GET['UserId'];
                 
				$flag=0;
					for($i=0;$i<sizeof($studentdetails);$i++)
					{
						
						if(strcmp($studentdetails[$i]['UserId'],$userid)==0)
						{
							
                   $flag=1;
					  
					break;
						}
						
					}
                    
                   if ($flag==1 && $role == "student") {
                        $flag=0;
                        $res = array(
                            'success' => 'true',
                            'message' => 'Logout Successfull',
                            'user_id' => $userid
                        );
                        echo json_encode($res);
                    } else {
                      
                        $res = array(
                            'success' => 'false',
                            'message' => 'Logout Unsuccessfull'
                        );
                        echo json_encode($res);
                    }
                default:
                    $res = array(
                        'success' => 'false',
                        'message' => 'Role not exists'
                    );
                    echo json_encode($res);
                    break;
                    
            }
            
            
        }
        
    }
    
    
    //*******************************************************
    //addClass function will add the class details
    //******************************************************
    public function addClass()
    {
        if (!isset($_POST['ClassName']) || !isset($_POST['ClassAbbrevation'])) {
            $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
        } else {
            
            $this->load->model('AdminModel');
            $this->AdminModel->insertClassValues($_POST['ClassName'], $_POST['ClassAbbrevation']);
            
        }
        
    }
    
    
    public function getAllClasses()
    {
        
        $this->load->model('AdminModel');
        $this->AdminModel->fetchAllClasses();
        
    }
	
	
	public function getClassDetails()
	{
		$this->load->model('AdminModel');
        $this->AdminModel->fetchClassDetails();
	}
	
    
    public function deleteClass()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->deleteClassRecord($_POST['ClassName'], $_POST['ClassAbbrevation']);
    }
    
    public function editClass()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->editClassRecord($_POST['ClassName'], $_POST['ClassAbbrevation'], $_POST['PreviousAbbrevation']);
    }
    
    
    //*******************************************************
    //addSubject function will add the subject details
    //******************************************************
    public function addSubject()
    {
        if (!isset($_POST['Classname']) || !isset($_POST['SubjectName']) || !isset($_POST['SubjectAbbrevation'])) {
            $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
        } else {
            
            $this->load->model('AdminModel');
            $this->AdminModel->insertSubjectValues($_POST['Classname'],$_POST['SubjectName'], $_POST['SubjectAbbrevation']);
            
        }
        
    }
    
    
    public function getAllSubjects()
    {
        
        $this->load->model('AdminModel');
        $this->AdminModel->fetchAllSubjects();
        
    }
	
	
	public function getAllSubjectsByClassname()
	{
		  $this->load->model('AdminModel');
        $this->AdminModel->fetchAllSubjectsByClassname();
	}
	
    
    public function deleteSubject()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->deleteSubjectRecord($_POST['SubjectName'], $_POST['SubjectAbbrevation']);
    }
    
    public function editSubject()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->editSubjectRecord($_POST['SubjectName'], $_POST['SubjectAbbrevation'], $_POST['PreviousAbbrevation']);
    }
    
    
    
    //*******************************************************
    //addSubject function will add the subject details
    //******************************************************
    public function addTeacher()
    {
        if (!isset($_POST['Fullname']) || !isset($_POST['EmailId']) || !isset($_POST['MobileNo']) ||!isset($_POST['Classname']) || !isset($_POST['Username']) || !isset($_POST['Password'])) {
            $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
        } else {
            
            $this->load->model('AdminModel');
            $this->AdminModel->insertTeacherValues($_POST['Fullname'], $_POST['EmailId'], $_POST['MobileNo'],$_POST['Classname'], $_POST['Username'], $_POST['Password']);
            
        }
        
    }
    
    public function getAllTeachers()
    {
        
        $this->load->model('AdminModel');
        $this->AdminModel->fetchAllTeachers();
        
    }
    
    public function deleteTeacher()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->deleteTeacherRecord($_POST['UserId']);
    }
    
    public function editTeacher()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->editTeacherRecord($_POST['UserId'], $_POST['Fullname'], $_POST['EmailId'], $_POST['MobileNo'],$_POST['Classname'], $_POST['Username'], $_POST['Password']);
    }
    
    
    
    
    
    
    //*******************************************************
    //addStudent function will add the student details
    //******************************************************
    public function addStudent()
    {
        if (!isset($_POST['AdmissionNo']) || !isset($_POST['Classname']) || !isset($_POST['Gender']) || !isset($_POST['DateOfReg']) || !isset($_POST['StudentFullname']) || !isset($_POST['EmailId']) || !isset($_POST['MobileNo']) || !isset($_POST['Username']) || !isset($_POST['Password'])) {
            $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
        } else {
            
            $this->load->model('AdminModel');
            
            $this->AdminModel->insertStudentValues($_POST['AdmissionNo'], $_POST['Classname'], $_POST['Gender'], $_POST['DateOfReg'], $_POST['FeeEffectiveFrom'], $_POST['StudentFullname'], $_POST['FatherFullname'], $_POST['MotherFullname'], $_POST['EmailId'], $_POST['MobileNo'], $_POST['Username'], $_POST['Password']);
            
        }
        
    }
    
    
    public function getAllStudents()
    {
        
        $this->load->model('AdminModel');
        $this->AdminModel->fetchAllStudents();
        
    }
	
	   public function getStudentByClassname()
    {
        
        $this->load->model('AdminModel');
        $this->AdminModel->fetchStudentDetailsByClassname();
        
    }
    
    public function deleteStudent()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->deleteStudentRecord($_POST['UserId']);
    }
    
    public function editStudent()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->editStudentValues($_POST['UserId'], $_POST['AdmissionNo'], $_POST['Classname'], $_POST['Gender'], $_POST['DateOfReg'], $_POST['FeeEffectiveFrom'], $_POST['StudentFullname'], $_POST['FatherFullname'], $_POST['MotherFullname'], $_POST['EmailId'], $_POST['MobileNo'], $_POST['Username'], $_POST['Password']);
    }
	
	public function getAllStudentsByClassname()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->fetchStudentByClassname($_POST['Classname']);
	}
	
	public function updateStudentsByClassname()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->updateAllStudentsByClassname($_POST['CurrentDate'],$_POST['Classname'],$_POST['StudentList']);
	}
	
	public function getAllAttendanceEntry()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->fetchAllAttendanceEntryByClassname();
	}
	
	public function getAllAttendanceEntryOfMonth()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->fetchAllAttendanceEntryOfMonth();
	}
	
	public function addExam()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->insertExamValues();
	}
	
	public function deleteExam()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->deleteExamRecord();
    }
	
	public function getExam()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->fetchExamRecord();
    }
    
    
    public function DeleteItem()
    {
        $this->load->database();
        $data = array(
            'id' => $_POST["id"]
        );
        
        $this->db->set($data);
        $this->db->where('id', $_POST["id"]);
        $this->db->delete('qspldemo', $data);
        $this->db->close();
        
    }
	
	
	public function addStudentsMarks()
	{
		  $this->load->model('AdminModel');
        $this->AdminModel->insertStudentsMarks();
	}
	
	public function getStudentsMarks()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->fetchStudentsMarks();
	}
	
	
	public function addHomework()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->insertHomework();
	}
	
	public function getHomework()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->fetchHomework();
	}
	
	public function getHomeworkByClassname()
	{
		 $this->load->model('AdminModel');
        $this->AdminModel->fetchHomeworkByClassName();
	}
	
	public function deleteHomework()
    {
        $this->load->model('AdminModel');
        $this->AdminModel->deleteHomeworkRecord();
    }
	
	public function uploadFile()
	{
		  $file_path = "./uploads/";
     
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
	
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
		
		$this->ImageName=basename( $_FILES['uploaded_file']['name']);
		
		 if ($this->db->insert('addImage', $this)) {
                $res = array(
                'success' => 'true',
                'message' => 'File Uploaded Successfully'
            );
            echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
		
      
    } else{
        $res = array(
                'success' => 'false',
                'message' => 'Error in uploading file'
            );
            echo json_encode($res);
    }
	
	
	
	
	}
	
	
	
	public function getAllFiles()
	{
		  
			$allfiles = $this->db->get('addImage')->result_array();
		  $size           = sizeof($allfiles);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
				'files'=>$size,
                'result' => json_encode($allfiles)
            );
            echo json_encode($res);
        }
		
	}
	
	
	public function deleteFile()
	{
		 $this->load->database();
       
        if ($this->db->where('ImageName',$_POST['ImageName'])->delete('addImage')) {
			$file_path = "./uploads/";
			  if(unlink($file_path.$_POST['ImageName']))
    {
        $res = array(
                'success' => 'true',
                'message' => 'File Deleted Successfully'
            );
            echo json_encode($res);
    }
    else
    {
		 $res = array(
                'success' => 'true',
                'message' => 'file is not deleted'
            );
            echo json_encode($res);
     
    }

           
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
	}
	
	
	public function viewFile()
	{
		   
			$allfiles = $this->db->where('ImageName',$_POST['ImageName'])->get('addImage')->result_array();
		  $size           = sizeof($allfiles);
        if ($size == 0) {
			
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
			
			 $file_path = "http://192.168.1.8:80/studentattendance/uploads/";
            $res = array(
                'success' => 'true',
				'image'=>$file_path.$_POST['ImageName'],
				'imagename'=>$_POST['ImageName'],
               
            );
            echo json_encode($res);
        }
	}
	
	
	
	
	
	
    
}


?>