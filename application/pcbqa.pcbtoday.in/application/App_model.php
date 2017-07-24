<?php
/**
 * Created by PhpStorm.
 * User: kranti
 * Date: 2/25/15
 * Time: 3:22 PM
 */

class App_model extends CI_Model
{

	private $news;
	private $news_collection;
	private $astrology;
	private $video;
	private $breaking_news;
	private $appusers;
	private $push_notification;
	
	
	public function __construct(){
	parent::__construct();
        $this->load->helper('url','include');
		$this->news 		    = $this->db->dbprefix('news');
		$this->push_notification 		    = $this->db->dbprefix('push_notification');
		$this->news_collection 	= $this->db->dbprefix('news_collection');
		$this->astrology		= $this->db->dbprefix('astrology');
		$this->breaking_news    = $this->db->dbprefix('breaking_news');
		$this->pcb_poll    		= $this->db->dbprefix('poll');
		$this->video    		= $this->db->dbprefix('video');
		$this->ads 		   		= $this->db->dbprefix('adv_world');
		$this->appusers 	    = $this->db->dbprefix('appusers');
	}
	
   

   function registerAppUser($data){
       $this->db->insert($this->appusers, $data);
       return $this->db->insert_id();
   }
   
   function registerPushId($data){
       $this->db->insert($this->push_notification, $data);
       return  $this->db->affected_rows();
   }
  
   /*
	 * @author Nishant
	 * @desc function name checkUser, checks whether a campaign name already exists
	 * @param campName
	 */

	public function checkUser($email,$mobile)
	{
		$where_clause='';
		if(isset($email) && isset($mobile)){
			$where_clause = "email='".$email."' or mobile=".$mobile;   // Check If Email Exist		
		}else{
			if(isset($email)){
			$where_clause = "email='".$email;		
			}
			if(isset($mobile)){
			$where_clause = "mobile='".$mobile;
			}
		}
		if($where_clause!=''){
		$this->db->where($where_clause);
		$query = $this->db->get($this->appusers);
		if($query->num_rows() > 0)
		{
			return $query->row('id');
		}else{
			return false;
		}
                }else{
			return false;
		}

    }
	
	public function checkPushid($push_id)
	{
		if(isset($push_id)) {
			$this->db->where('push_id',$push_id);
			$query = $this->db->get($this->push_notification);
			if($query->num_rows() > 0)
			{
				return false;
			}else{
				return true;
			}
		}
		return false;
    }
	
	public function getBannerDetails()
	{
		
	}
}