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
		 else {
			  $this->load->database();
			  $role = $_POST['Role'];
			  
			  switch($role)
			  {
				  
				  case "Voter":
				  $this->load->model('VoterModel');
				  $this->VoterModel->insertOtpValues();
				  break;
				  
				  case "Leader":
				   $this->load->model('LeaderModel');
				  $this->LeaderModel->insertOtpValues();
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
	
	
	
	public function login()
	{
		
		 if (!isset($_POST['MobileNo']) || !isset($_POST['Role']) || !isset($_POST['Otp'])) {
			  $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
		 }
		 else {
			  $this->load->database();
			  $role = $_POST['Role'];
			  
			  switch($role)
			  {
				  
				  case "Voter":
				  $this->load->model('VoterModel');
				  $this->VoterModel->checkLogin();
				  break;
				  
				  case "Leader":
				  $this->load->model('LeaderModel');
				  $this->LeaderModel->checkLogin();
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
	
	
	public function updateProfile()
	{
		 if (!isset($_POST['UserId']) || !isset($_POST['MobileNo'])
			 ||!isset($_POST['Role']) || !isset($_POST['Firstname'])
			 ||!isset($_POST['Lastname']) || !isset($_POST['State'])
			 ||!isset($_POST['District']) || !isset($_POST['Taluka'])
			 ||!isset($_POST['City']) || !isset($_POST['PostalCode'])
			 ||!isset($_POST['Language'])) {
			  $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
		 }
		 else{
			  $this->load->database();
			  $this->load->model('UserModel');
			  $this->UserModel->insertUserData();
		 }
		
	}





    //Push Updates 
	public function uploadLeaderPosts()
	{
		 if (!isset($_POST['UserId']) || !isset($_POST['Title'])
			 ||!isset($_POST['Description']) || !isset($_POST['Attachment'])
			 ||!isset($_POST['Role'])) {
			  $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
		 }
		 else{
			  $this->load->database();
			  $this->load->model('LeaderModel');
			  $this->LeaderModel->insertPushLeaderUpdates();
		 }
		
	}


public function getLeaderPosts()
	{
		 if (!isset($_POST['UserId'])||!isset($_POST['Role'])) {
			  $res = array(
                'success' => 'false',
                'message' => 'Please make sure you are passing credentials in post format'
            );
            echo json_encode($res);
		 }
		 else{
			  $this->load->database();
			  $this->load->model('LeaderModel');
			  $this->LeaderModel->insertPushLeaderUpdates();
		 }
		
	}














    
	
	
    
}


?>