<?php
class LeaderModel extends CI_Model
{
    
	 public function insertOtpValues()
    {
		$this->load->database();
        $this->MobileNo = $_POST['MobileNo']; 
        $this->Role = $_POST['Role'];
		$this->Otp = mt_rand(100000, 999999);
		$this->isloggedIn=false;
		$this->OtpStartTime = date('Y-m-d H:i:s');
		try {
			 if ($this->db->insert('otp_generation', $this)) {
                $res = array(
                    'success' => 'true',
                    'message' => 'Otp for your mobile number is '.$this->Otp
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
			if (mysql_errno() == 1062) {
			 $res = array(
                    'success' => 'false',
                    'message' => $this->MobileNo.' mobile number is already used.'
                );
            echo json_encode($res);
			}
			else{
			$res = array(
                    'success' => 'false',
                    'message' => 'Caught exception: ',  $e->getMessage(), "\n"
                );
            echo json_encode($res);
			
			}
			 
		}

           
    }
	
	
	 public function checkLogin()
    {
		$this->load->database();
        $MobileNo = $_POST['MobileNo']; 
        $Role = $_POST['Role'];
		$Otp = $_POST['Otp'];
		$OtpEndTime = date('Y-m-d H:i:s');
		try {
			
			$this->db->where('MobileNo', $MobileNo);
			$userdetails = $this->db->get('otp_generation')->result_array();
			$db_otp=$userdetails[0]['Otp'];
			
			 if ($Otp==$db_otp) {
				$data = array(
                            'OtpEndTime' => $OtpEndTime,
							'isloggedIn' => true
                        );
                        
				$this->db->set($data);
				$this->db->where('MobileNo', $MobileNo);
				$this->db->update('otp_generation', $data);
				$this->db->close();
                $res = array(
                    'success' => 'true',
                    'message' => 'Successfully Logged In',
					'UserId'  =>  $userdetails[0]['UserId']
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