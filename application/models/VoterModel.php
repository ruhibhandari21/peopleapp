    <?php
    class VoterModel extends CI_Model
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
         $otpdetails = $this->db->get('otp_generation')->result_array();
         $db_otp=$otpdetails[0]['Otp'];
         
         if ($Otp==$db_otp) {
            $data = array(
                'OtpEndTime' => $OtpEndTime,
                'isloggedIn' => true
            );
            
            $this->db->set($data);
            $this->db->where('MobileNo', $MobileNo);
            $this->db->update('otp_generation', $data);

                    //Updating userdetails table
            $this->db->where('MobileNo', $MobileNo);
            $userdetails = $this->db->get('userdetails')->result_array();
            if(sizeof($userdetails) == 0){
               
                $this->UserId = $otpdetails[0]['UserId'];
                $this->MobileNo = $MobileNo;
                $this->Role = $Role ;
                $this->Firstname = "";
                $this->Lastname = "";
                $this->State = "";
                $this->Taluka="";
                $this->District = "";
                $this->City = "";
                $this->PostalCode = "";
                $this->Language = "";
                
                
                if ($this->db->insert('userdetails', $this)) {
                 
                    echo "Added profile row";
                } 

                $this->db->close();
                $res = array(
                    'success' => 'true',
                    'message' => 'Successfully Logged In',
                    'UserId'  =>  $otpdetails[0]['UserId']
                    
                    
                );
                echo json_encode($res);


            }else{
                        //fetch old record
                $this->db->where('MobileNo', $MobileNo);
                $userdetailsarr = $this->db->get('userdetails')->result_array();
                $this->db->close();
                $res = array(
                    'success' => 'true',
                    'message' => 'Successfully Logged In',
                    'UserId'  =>  $otpdetails[0]['UserId'],
                    'userdetailsarr'=>json_encode($userdetailsarr)
                    
                );
                echo json_encode($res);
            }




            
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