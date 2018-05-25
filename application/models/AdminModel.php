<?php
class AdminModel extends CI_Model
{
    /*function list_product(){
    $product = $this->db->query('select * from m_item');
    return $product;
    }*/

    
    
    //insert data in table
    public function insertClassValues($classname, $class_abbrevation)
    {
        $this->ClassName        = $classname; // please read the below note
        $this->ClassAbbrevation = $class_abbrevation;
        if ($classname == "" && $class_abbrevation == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Classname and abbrevation is compulsory'
            );
            echo json_encode($res);
        } else if ($classname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Classname is empty'
            );
            echo json_encode($res);
        } else if ($class_abbrevation == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Class abbrevation is empty'
            );
            echo json_encode($res);
        }
        
        else {
            if ($this->db->insert('addclass', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Class successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
        }
    }
    
    
    public function fetchAllClasses()
    {
        
        $allClassesData = $this->db->get('addclass')->result_array();
        $size           = sizeof($allClassesData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'classes' => json_encode($allClassesData)
            );
            echo json_encode($res);
        }
        
    }
	
	 public function fetchClassDetails()
    {
        
        $allClassesData = $this->db->where('ClassAbbrevation', $_GET['classname'])->get('addclass')->result_array();
        $size           = sizeof($allClassesData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'classes' => json_encode($allClassesData)
            );
            echo json_encode($res);
        }
        
    }
	
	
	
    
    public function deleteClassRecord($classname, $classcode)
    {
        $this->load->database();
        $data = array(
            'ClassName' => $classname,
            'ClassAbbrevation' => $classcode
        );
        
        if ($this->db->where('ClassAbbrevation', $classcode)->delete('addclass')) {
            $res = array(
                'success' => 'true',
                'message' => 'Record Deleted Successfully'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
        
    }
    
    
    public function editClassRecord($classname, $classcode, $previousabbrevation)
    {
        $this->load->database();
        $this->ClassName        = $classname;
        $this->ClassAbbrevation = $classcode;
        
        if ($classname == "" && $class_abbrevation == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Classname and abbrevation is compulsory'
            );
            echo json_encode($res);
        } else if ($classname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Classname is empty'
            );
            echo json_encode($res);
        } else if ($class_abbrevation == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Class abbrevation is empty'
            );
            echo json_encode($res);
        } else {
            if ($this->db->set($this)->where('ClassAbbrevation', $previousabbrevation)->update('addclass')) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record Updated Successfully'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'No Record Found'
                );
                echo json_encode($res);
            }
        }
        $this->db->close();
        
    }
    
    
    
    //insert data in table
    public function insertSubjectValues($classname,$subjectname, $subject_abbrevation)
    {
		$this->Classname = $classname;
        $this->SubjectName        = $subjectname; // please read the below note
        $this->SubjectAbbrevation = $subject_abbrevation;
		 
        
        if ($classname=="" && $subjectname == "" && $subject_abbrevation == "") {
            $res = array(
                'success' => 'false',
                'message' => 'subjectname and abbrevation is compulsory'
            );
            echo json_encode($res);
        } 
		else if ($classname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'classname is empty'
            );
            echo json_encode($res);
        }
		else if ($subjectname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'subjectname is empty'
            );
            echo json_encode($res);
        } else if ($subject_abbrevation == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Subject abbrevation is empty'
            );
            echo json_encode($res);
        }
        
        else {
            
            if ($this->db->insert('addsubject', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Subject successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
        }
    }
    
    public function fetchAllSubjects()
    {
        
        $allSubjectData = $this->db->get('addsubject')->result_array();
        $size           = sizeof($allSubjectData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'subjects' => json_encode($allSubjectData)
            );
            echo json_encode($res);
        }
        
    }
    
	
	 public function fetchAllSubjectsByClassname()
    {
        
        $allSubjectData = $this->db->where('Classname',$_GET['Classname'])->get('addsubject')->result_array();
        $size           = sizeof($allSubjectData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'subjects' => json_encode($allSubjectData)
            );
            echo json_encode($res);
        }
        
    }
	
    public function deleteSubjectRecord($subjectname, $subjectcode)
    {
        $this->load->database();
        $data = array(
            'SubjectName' => $subjectname,
            'SubjectAbbrevation' => $subjectcode
        );
        
        if ($this->db->where('SubjectAbbrevation', $subjectcode)->delete('addsubject')) {
            $res = array(
                'success' => 'true',
                'message' => 'Record Deleted Successfully'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
        
    }
    
    
    public function editSubjectRecord($subjectname, $subjectcode, $previousabbrevation)
    {
        $this->load->database();
        $this->SubjectName        = $subjectname;
        $this->SubjectAbbrevation = $subjectcode;
        
        if ($subjectname == "" && $subjectcode == "") {
            $res = array(
                'success' => 'false',
                'message' => 'subjectname and abbrevation is compulsory'
            );
            echo json_encode($res);
        } else if ($subjectname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'subjectname is empty'
            );
            echo json_encode($res);
        } else if ($subjectcode == "") {
            $res = array(
                'success' => 'false',
                'message' => 'subject abbrevation is empty'
            );
            echo json_encode($res);
        } else {
            if ($this->db->set($this)->where('SubjectAbbrevation', $previousabbrevation)->update('addsubject')) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record Updated Successfully'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'No Record Found'
                );
                echo json_encode($res);
            }
        }
        $this->db->close();
        
    }
    
    
    //insert data in table
    public function insertTeacherValues($fullname, $emailid, $mobileno,$classname, $username, $password)
    {
        $this->Fullname = $fullname; // please read the below note
        $this->EmailId  = $emailid;
        $this->MobileNo = $mobileno;
		$this->Classname=$classname;
        $this->Username = $username;
        $this->Password = $password;
		
        
        if ($fullname == "" && $emailid == "" && $mobileno == ""&&$classname=="" && $username == "" && $password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Please fill in the details'
            );
            echo json_encode($res);
        } else if ($fullname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Fullname is empty'
            );
            echo json_encode($res);
        }
         else  if(!preg_match("/^[a-zA-Z ]*$/",$fullname))
        {
        $res = array(
        'success' => 'false',
        'message' => 'Only letters and white space allowed in fullname'
        );
        echo json_encode($res);
        }
        else if ($emailid == "") {
            $res = array(
                'success' => 'false',
                'message' => 'EmailId is empty'
            );
            echo json_encode($res);
        }
         else if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
        
        $res = array(
        'success' => 'false',
        'message' => 'Invalid email format'
        );
        echo json_encode($res);
        }
        else if ($mobileno == "") {
            $res = array(
                'success' => 'false',
                'message' => 'MobileNo is empty'
            );
            echo json_encode($res);
        } 
		else if (strlen($mobileno) < 10) {
            $res = array(
                'success' => 'false',
                'message' => 'Please check you mobile number,only 10 digits allowed'
            );
            echo json_encode($res);
        }
		else if (!is_numeric($mobileno)) {
            $res = array(
                'success' => 'false',
                'message' => 'No characters allowed in mobile number'
            );
            echo json_encode($res);
        }
		
		else if ($username == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Username is empty'
            );
            echo json_encode($res);
        } else if ($password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'password is empty'
            );
            echo json_encode($res);
        }
		else if ($classname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'classname is empty'
            );
            echo json_encode($res);
        }
        
        else {
            
            if ($this->db->insert('addteacher', $this)) {
		
			
			
                $res = array(
                    'success' => 'true',
                    'message' => 'Teacher successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
        }
    }
    
    public function fetchAllTeachers()
    {
        
        $allTeacherData = $this->db->get('addteacher')->result_array();
        $size           = sizeof($allTeacherData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'teachers' => json_encode($allTeacherData)
            );
            echo json_encode($res);
        }
        
    }
    
    public function deleteTeacherRecord($userid)
    {
        $this->load->database();
        
        
        if ($this->db->where('UserId', $userid)->delete('addteacher')) {
            $res = array(
                'success' => 'true',
                'message' => 'Record Deleted Successfully'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
        
    }
    
    
    public function editTeacherRecord($userid, $fullname, $emailid, $mobileno,$classname, $username, $password)
    {
        $this->load->database();
        $this->Fullname = $fullname; // please read the below note
        $this->EmailId  = $emailid;
        $this->MobileNo = $mobileno;
		$this->Classname = $classname;
        $this->Username = $username;
        $this->Password = $password;
        
        if ($fullname == "" && $emailid == "" && $mobileno == "" && $classname=="" && $username == "" && $password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Please fill in the details'
            );
            echo json_encode($res);
        } else if ($fullname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Fullname is empty'
            );
            echo json_encode($res);
        }
         else  if(!preg_match("/^[a-zA-Z ]*$/",$fullname))
        {
        $res = array(
        'success' => 'false',
        'message' => 'Only letters and white space allowed in fullname'
        );
        echo json_encode($res);
        }
        else if ($emailid == "") {
            $res = array(
                'success' => 'false',
                'message' => 'EmailId is empty'
            );
            echo json_encode($res);
        }
        else if (!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
        
        $res = array(
        'success' => 'false',
        'message' => 'Invalid email format'
        );
        echo json_encode($res);
        }
        else if ($mobileno == "") {
            $res = array(
                'success' => 'false',
                'message' => 'MobileNo is empty'
            );
            echo json_encode($res);
        }
else if (strlen($mobileno) < 10) {
            $res = array(
                'success' => 'false',
                'message' => 'Please check you mobile number,only 10 digits allowed'
            );
            echo json_encode($res);
        }
		else if (!is_numeric($mobileno)) {
            $res = array(
                'success' => 'false',
                'message' => 'No characters allowed in mobile number'
            );
            echo json_encode($res);
        }
		else if ($username == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Username is empty'
            );
            echo json_encode($res);
        } else if ($password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'password is empty'
            );
            echo json_encode($res);
        }
        
        else {
            if ($this->db->set($this)->where('UserId', $userid)->update('addteacher')) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record Updated Successfully'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'No Record Found'
                );
                echo json_encode($res);
            }
        }
        $this->db->close();
        
    }
    
    
    
    //insert data in table
    public function insertStudentValues($AdmissionNo, $Classname, $Gender, $DateOfReg, $FeeEffectiveFrom, $StudentFullname, $FatherFullname, $MotherFullname, $EmailId, $MobileNo, $Username, $Password)
    {
        
        $this->AdmissionNo      = $AdmissionNo; // please read the below note
        $this->Classname        = $Classname;
        $this->Gender           = $Gender;
        $this->DateOfReg        = $DateOfReg;
        $this->FeeEffectiveFrom = $FeeEffectiveFrom;
        $this->StudentFullname  = $StudentFullname;
        $this->FatherFullname   = $FatherFullname;
        $this->MotherFullname   = $MotherFullname;
        $this->EmailId          = $EmailId;
        $this->MobileNo         = $MobileNo;
        $this->Username         = $Username;
        $this->Password         = $Password;
        
        
        
        if ($AdmissionNo == "" && $Classname == "" && $Gender == "" && $DateOfReg == "" && $FeeEffectiveFrom == "" && $StudentFullname == "" && $FatherFullname == "" && $MotherFullname == "" && $EmailId == "" && $MobileNo == "" && $Username == "" && $Password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Please fill in the details'
            );
            echo json_encode($res);
        } else if ($AdmissionNo == "") {
            $res = array(
                'success' => 'false',
                'message' => 'AdmissionNo is empty'
            );
            echo json_encode($res);
        } else if ($Classname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Classname is empty'
            );
            echo json_encode($res);
        } else if ($Gender == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Gender is empty'
            );
            echo json_encode($res);
        } else if ($DateOfReg == "") {
            $res = array(
                'success' => 'false',
                'message' => 'DateOfReg is empty'
            );
            echo json_encode($res);
        }  else if ($StudentFullname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'StudentFullname is empty'
            );
            echo json_encode($res);
        } 
        
        else if ($EmailId == "") {
            $res = array(
                'success' => 'false',
                'message' => 'EmailId is empty'
            );
            echo json_encode($res);
        } else if ($MobileNo == "") {
            $res = array(
                'success' => 'false',
                'message' => 'MobileNo is empty'
            );
            echo json_encode($res);
        } else if ($Username == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Username is empty'
            );
            echo json_encode($res);
        } else if ($Password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Password is empty'
            );
            echo json_encode($res);
        } 
		else if(!is_numeric($MobileNo))
		{
			$res = array(
                'success' => 'false',
                'message' => 'Only numbers allowed'
            );
            echo json_encode($res);
		}
		
		
		else {
            
            if ($this->db->insert('addstudent', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
        }
    }
    
    
    
      public function editStudentValues($UserId,$AdmissionNo, $Classname, $Gender, $DateOfReg, $FeeEffectiveFrom, $StudentFullname, $FatherFullname, $MotherFullname, $EmailId, $MobileNo, $Username, $Password)
    {
        $this->UserId           = $UserId;
        $this->AdmissionNo      = $AdmissionNo; // please read the below note
        $this->Classname        = $Classname;
        $this->Gender           = $Gender;
        $this->DateOfReg        = $DateOfReg;
        $this->FeeEffectiveFrom = $FeeEffectiveFrom;
        $this->StudentFullname  = $StudentFullname;
        $this->FatherFullname   = $FatherFullname;
        $this->MotherFullname   = $MotherFullname;
        $this->EmailId          = $EmailId;
        $this->MobileNo         = $MobileNo;
        $this->Username         = $Username;
        $this->Password         = $Password;
        
        
        
        if ($AdmissionNo == "" && $Classname == "" && $Gender == "" && $DateOfReg == "" && $FeeEffectiveFrom == "" && $StudentFullname == "" && $FatherFullname == "" && $MotherFullname == "" && $EmailId == "" && $MobileNo == "" && $Username == "" && $Password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Please fill in the details'
            );
            echo json_encode($res);
        } else if ($AdmissionNo == "") {
            $res = array(
                'success' => 'false',
                'message' => 'AdmissionNo is empty'
            );
            echo json_encode($res);
        } else if ($Classname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Classname is empty'
            );
            echo json_encode($res);
        } else if ($Gender == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Gender is empty'
            );
            echo json_encode($res);
        } else if ($DateOfReg == "") {
            $res = array(
                'success' => 'false',
                'message' => 'DateOfReg is empty'
            );
            echo json_encode($res);
        } else if ($StudentFullname == "") {
            $res = array(
                'success' => 'false',
                'message' => 'StudentFullname is empty'
            );
            echo json_encode($res);
        } 
        
        else if ($EmailId == "") {
            $res = array(
                'success' => 'false',
                'message' => 'EmailId is empty'
            );
            echo json_encode($res);
        } else if ($MobileNo == "") {
            $res = array(
                'success' => 'false',
                'message' => 'MobileNo is empty'
            );
            echo json_encode($res);
        } else if ($Username == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Username is empty'
            );
            echo json_encode($res);
        } else if ($Password == "") {
            $res = array(
                'success' => 'false',
                'message' => 'Password is empty'
            );
            echo json_encode($res);
        } else {
            
            if ($this->db->set($this)->where('UserId', $UserId)->update('addstudent')) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record Updated Successfully'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'No Record Found'
                );
                echo json_encode($res);
            }
        }
    }
    
        public function deleteStudentRecord($userid)
    {
        $this->load->database();
        
        
        if ($this->db->where('UserId', $userid)->delete('addstudent')) {
            $res = array(
                'success' => 'true',
                'message' => 'Record Deleted Successfully'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
        
    }
   
   public function fetchAllStudents()
    {
        
        $allStudentData = $this->db->get('addstudent')->result_array();
        $size           = sizeof($allStudentData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'students' => json_encode($allStudentData)
            );
            echo json_encode($res);
        }
        
    }
	
	public function fetchStudentByClassname($classname)
	{
		$this->db->where('Classname', $classname);
			$allStudentData = $this->db->get('addstudent')->result_array();
		
        $size           = sizeof($allStudentData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'students' => json_encode($allStudentData)
            );
            echo json_encode($res);
        }
		
	}
	
	public function fetchStudentDetailsByClassname()
	{
		$this->db->where('Classname', $_GET['classname']);
			$allStudentData = $this->db->get('addstudent')->result_array();
		
        $size           = sizeof($allStudentData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'students' => json_encode($allStudentData)
            );
            echo json_encode($res);
        }
		
	}
	
	
	
	
	
	public function updateAllStudentsByClassname($currentdate,$classname,$studentlist)
	{
		if($classname=="")
		{
			  $res = array(
                'success' => 'false',
                'students' => 'Class name is empty'
            );
            echo json_encode($res);
		}
		else if($currentdate=="")
		{
			  $res = array(
                'success' => 'false',
                'students' => 'date is empty'
            );
            echo json_encode($res);
		}
		else if($studentlist=="")
		{
			  $res = array(
                'success' => 'false',
                'students' => 'No students found for update'
            );
            echo json_encode($res);
		}
		else if($currentdate=="" && $classname=="" && $studentlist=="")
		{
			  $res = array(
                'success' => 'false',
                'students' => 'No proper values found for update'
            );
            echo json_encode($res);
		}
		else{
			
			$var_jsonarray=json_decode($studentlist, TRUE);
			$flag=0;
			
			 $this->load->database();
        
        
        if ($this->db->where('CurrentDate', $currentdate)->delete('studentattendanceentry')) {
           
		   	for($i=0;$i<sizeof($var_jsonarray);$i++)
			{
				//$var_jsonobj=$var_jsonarray[$i];
				$this->CurrentDate=$currentdate;
				$this->UserId=$var_jsonarray[$i]["UserId"];
				$this->Classname=$classname;
				$this->Present=$var_jsonarray[$i]["Present"];
				$this->Absent=$var_jsonarray[$i]["Absent"];
								
				 if ($this->db->insert('studentattendanceentry', $this)) {
					 $flag=1;
				 }
				 else{
					 $flag=0;
				 }
				
								
			}
			
			
			
			 if ($flag==1) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
		   
		   
		   
		   
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'Something went wrong'
            );
            echo json_encode($res);
        }
        $this->db->close();
			
			
			
			
			
		
			
			
		}
		
	}
	
	
	
	
	public function fetchAllAttendanceEntryByClassname()//$classname,$currentdate)
	{
		$array = array( 'CurrentDate' => $_GET['CurrentDate'],'Classname' => $_GET['Classname']);
		//$this->db->where($array);
			$allStudentData = $this->db->where($array)->get('studentattendanceentry')->result_array();
		
        $size           = sizeof($allStudentData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'students' => json_encode($allStudentData)
            );
            echo json_encode($res);
        }
		
	}
	
	
	public function fetchAllAttendanceEntryOfMonth()
	{
		$array = array('Classname' => $_GET['Classname'],'UserId'=>$_GET['UserId']);
	
			$allStudentData = $this->db->where($array)->get('studentattendanceentry')->result_array();
			
		/*	$currentDate=$_GET['CurrentDate'];
			$str=explode("-",$currentDate);
			$month=$str[1];
			$result=array();
			$j=0;
			for($x=0;$x<sizeof($allStudentData);$x++)
			{
				$str1=explode("-",$allStudentData[$x]['CurrentDate']);
			$month_of_cy=$str1[1];
			
				if($month_of_cy==$month)
				{
					$result[$j]=$allStudentData[$x];
				}
				
			}*/
			
			
			
		
        $size           = sizeof($allStudentData);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'students' => json_encode($allStudentData)
            );
            echo json_encode($res);
        }
	}
	
	public function fetchExamRecord()
	{
		  
	
			$allExam = $this->db->get('addexam')->result_array();
		  $size           = sizeof($allExam);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'exams' => json_encode($allExam)
            );
            echo json_encode($res);
        }
	}
	
	public function insertExamValues()
	{
		$this->Classname=$_POST['Classname'];
		$this->Subject=$_POST['Subject'];
		$this->ExamType=$_POST['ExamType'];
		$this->ExamDate=$_POST['ExamDate'];
		$this->MaxMarks=$_POST['MaxMarks'];
		$this->MinMarks=$_POST['MinMarks'];
		
		 if ($this->db->insert('addexam', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
	}
	
	public function deleteExamRecord()
	{
		 $this->load->database();
        $array=array(
		'Classname'=>$_POST['Classname'],
		'Subject'=>$_POST['Subject'],
		'ExamDate'=>$_POST['ExamDate'],
		'ExamType'=>$_POST['ExamType'],
		'MaxMarks'=>$_POST['MaxMarks'],
		'MinMarks'=>$_POST['MinMarks']);
        
        if ($this->db->where($array)->delete('addexam')) {
            $res = array(
                'success' => 'true',
                'message' => 'Record Deleted Successfully'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
	}
	
	
	
	public function insertStudentsMarks()
	{
		$this->TeacherUserId=$_POST['TeacherUserId'];
		$this->StudentUserId=$_POST['StudentUserId'];
		$this->StudentName=$_POST['StudentName'];
		$this->Classname=$_POST['Classname'];
		$this->SubjectName=$_POST['SubjectName'];
		$this->ExamType=$_POST['ExamType'];
		$this->ExamDate=$_POST['ExamDate'];
		$this->MaxMarks=$_POST['MaxMarks'];
		$this->MinMarks=$_POST['MinMarks'];
		$this->MarksObtained=$_POST['MarksObtained'];
		
		 if ($this->db->insert('addMarks', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
		
	}
	
	
	public function fetchStudentsMarks()
	{
		$array=array('Classname'=>$_GET['Classname'],'StudentUserId'=>$_GET['StudentUserId']);
			$allExam = $this->db->where($array)->get('addmarks')->result_array();
		  $size           = sizeof($allExam);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'result' => json_encode($allExam)
            );
            echo json_encode($res);
        }
	}
	
	
	public function insertHomework()
	{
		$this->TeacherUserId=$_POST['TeacherUserId'];
		$this->Classname=$_POST['Classname'];
		$this->SubjectName=$_POST['SubjectName'];
		$this->Description=$_POST['Description'];
		
		
		 if ($this->db->insert('addhomework', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Record successfully added'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Error inserting the record'
                );
                echo json_encode($res);
            }
	}
	
	
	public function deleteHomeworkRecord()
	{
		 $this->load->database();
        $array=array(
		'TeacherUserId'=>$_POST['TeacherUserId'],
		'Classname'=>$_POST['Classname'],
		'SubjectName'=>$_POST['SubjectName'],
		'Description'=>$_POST['Description']
		);
        
        if ($this->db->where($array)->delete('addhomework')) {
            $res = array(
                'success' => 'true',
                'message' => 'Record Deleted Successfully'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
	}
	
	public function updateHomeworkRecord()
	{
		 $this->load->database();
        $array=array(
		'TeacherUserId'=>$_POST['TeacherUserId'],
		'Classname'=>$_POST['Classname'],
		'SubjectName'=>$_POST['SubjectName'],
		'Description'=>$_POST['Description']
		);
        
        if ($this->db->where($array)->update('addhomework')) {
            $res = array(
                'success' => 'true',
                'message' => 'Record Updated Successfully'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'false',
                'message' => 'No Record Found'
            );
            echo json_encode($res);
        }
        $this->db->close();
	}
	
	public function fetchHomework()
	{
		
			$allExam = $this->db->get('addhomework')->result_array();
		  $size           = sizeof($allExam);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'result' => json_encode($allExam)
            );
            echo json_encode($res);
        }
	}
	
	public function fetchHomeworkByClassName()
	{
		
			$allExam = $this->db->where('Classname',$_GET['Classname'])->get('addhomework')->result_array();
		  $size           = sizeof($allExam);
        if ($size == 0) {
            $res = array(
                'success' => 'false',
                'message' => 'No Records Found'
            );
            echo json_encode($res);
        } else {
            $res = array(
                'success' => 'true',
                'result' => json_encode($allExam)
            );
            echo json_encode($res);
        }
	}
    
}
?>