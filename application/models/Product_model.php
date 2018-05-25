<?php 
class Product_model extends CI_Model {
	/*function list_product(){
		$product = $this->db->query('select * from m_item');
		return $product;
	}*/
	
	
	
     //insert data in table
	 public function insert($data){
       $this->id_item    = $data['id_item']; // please read the below note
       $this->item_name  = $data['item_name'];
       $this->note = $data['note'];
	   $this->stock = $data['stock'];
	   $this->price = $data['price'];
	   $this->unit = $data['unit'];
	   
       if($this->db->insert('m_item',$this))
       {    
     echo json_encode($this);
           return 'Data is inserted successfully';
       }
         else
       {
           return "Error has occured";
       }
   }
   
   
   //update single record in table
    public function update($data){
       $id    = $data['id_item']; 
       $this->item_name  = $data['item_name'];
	   $this->price = $data['price'];
	 
	   
	   if( $this->db->set($this)
         ->where('id_item',$id)
        ->update('m_item'))
       {    
			echo json_encode($this);
			return 'Record Updated successfully';
       }
       else
       {
			return "Error has occured";
       }
   }
   public function deletefun($data){
   
	   if($this->db->where('id_item', $data)->delete('m_item'))
       {    
  
			return 'Deleted successfully';
       }
       else
       {
			return "Error has occured";
       }
   }
   
   public function truncateTable()
   {
	   if($this->db->empty_table('m_item'))
	   {
		   return 'All records deleted successfully from the table';
	   }
	   else{
		   	return "Error has occured";
	   }
   }
   
   
}
?>