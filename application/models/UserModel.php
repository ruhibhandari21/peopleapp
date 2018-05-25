<?php
class UserModel extends CI_Model
{
    
	 public function insertUserData()
    { 
		$this->load->database();
        $this->UserId = $_POST['UserId'];
		$this->MobileNo = $_POST['MobileNo'];
		$this->Role = $_POST['Role'];
		$this->Firstname = $_POST['Firstname'];
		$this->Lastname = $_POST['Lastname'];
		$this->State = $_POST['State'];
		$this->Taluka=$_POST['Taluka'];
		$this->District = $_POST['District'];
		$this->City = $_POST['City'];
		$this->PostalCode = $_POST['PostalCode'];
		$this->Language = $_POST['Language'];
	
		try {
			 if ($this->db->insert('userdetails', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Profile Updated Successfully'
                );
                echo json_encode($res);
            } else {
                $res = array(
                    'success' => 'false',
                    'message' => 'Oopps..Some Error Occurred'
                );
                echo json_encode($res);
            }
		} catch (Exception $e) {
			
			$res = array(
                    'success' => 'false',
                    'message' => 'Caught exception: ',  $e->getMessage(), "\n"
                );
            echo json_encode($res);
			
		}

    }
	
}
?>