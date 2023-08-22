<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_test extends CI_Model {
	private $cds = 'exhibitor';

	function __construct() {
		parent::__construct();
		 $this->load->database();
	}

	
	function get_table() {
		$table = "cms_laboratories";
		return $table;
	}
	
/********************************************************** Laboratories List **************************************/
	
	function addTestDetail($data)
	{
		$this->db->insert("user_information",$data);
		//echo $ans=$this->db->last_query(); exit;
	}
   
  	function check_email_availablity($data)
	{ 
		$email = trim($this->input->post('email'));
        $query = $this->db->query('SELECT * FROM user_information where email="'.$email.'"');
		//$query = $this->db->last_query();
		//    echo $query; exit; 
           if($query->num_rows() > 0)
			return false;
			else
			return true;
	}
	
	function addRegisDetail($data)
	{
		$this->db->insert("user_information",$data);
		//echo $ans=$this->db->last_query(); exit;
	}
	
	public function labList()
    {
            $this->db->select('*');
            $this->db->from('cms_laboratories');
            $query = $this->db->get(); 
		//	$query = $this->db->last_query();
		 //   echo $query; exit; 
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
     }
	 
		public function listExhibitor($isActive)
        {
            $this->db->select('*');
            $this->db->from('exhibitor');
			$this->db->where('Exhibitor_IsActive',$isActive); 
            $query = $this->db->get(); 
			//$query = $this->db->last_query();
		   // echo $query; exit; 
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
        }
	 
/***********************************************************************************************************************/
	function getExhibitor($type)
	{
		//$getProduct = $this->db->get_where("exhibitor",array('status' => $type));
			$this->db->select('Exhibitor_ID,Exhibitor_Name,Exhibitor_Contact_Person,Exhibitor_Designation,Exhibitor_IsActive,Exhibitor_Login,Exhibitor_Password');
            $this->db->from('exhibitor');
			$this->db->where('Exhibitor_IsActive','1'); 
            $getExhibitor = $this->db->get();
		//	$getExhibitor = $this->db->last_query();
		 //   echo $getExhibitor; exit; 
        if($getExhibitor->num_rows > 0)
		{
			return $getExhibitor->result();
		} else {
			return array();
		}
	}
	
	 function load_grid() {
			$this->db->select('Exhibitor_ID,Exhibitor_Name,Exhibitor_Contact_Person,Exhibitor_Designation,Exhibitor_IsActive');
            $this->db->from('exhibitor');
			$this->db->where('Exhibitor_IsActive','1'); 
            $query = $this->db->get();
			return $query->result_array();		
    }
	
	var $table = 'exhibitor';
    var $column_order = array(null, 'Exhibitor_ID','Exhibitor_Name','Exhibitor_Contact_Person','Exhibitor_Designation','Exhibitor_IsActive','Exhibitor_Code'); //set column field database for datatable orderable
    var $column_search = array('Exhibitor_ID','Exhibitor_Name','Exhibitor_Contact_Person','Exhibitor_Designation','Exhibitor_IsActive','Exhibitor_Code'); //set column field database for datatable searchable 
    var $order = array('Exhibitor_ID' => 'asc'); // default order 
 
      function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
	//	$query = $this->db->last_query();
		//   echo $query; exit; 
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
		
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
	 
	
}