<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 *
 * 
 * 
 * @Class Name: API
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		suresh bhadane
 
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';
class Api extends REST_Controller
{
	private $accept_url;
	private $return_url;
	private $lead_data;
	public function __construct(){ 
		parent::__construct();
		if (!class_exists('app_model')) {
			$this->load->model('app_model', 'app_model');
		}
		$this->load->model('admin_model/pcb_news_model', 'pcb_news_model');
		
	}
	

    function index_get()
    { 
		$aParams 	= $this->uri->segment_array();  				// Getting get parameters
		$this->load->helper("notification");
		$flag 		= $aParams[3];	
		// check the valid method name								
		switch ($flag) {					
			
		}
    }
    function index_post()
    { 
    	$aParams 	= $this->uri->segment_array();// Getting get parameters
    	$flag 		= $aParams[3];
    	// check the valid method name
    	switch ($flag) {
    		case 'registerAppUser':
    			 $this->registerAppUser();
    			 break;
			case 'dashboard':
    			 $this->getDashboardDetails();
    			 break;		
			case 'getNewsDetails':
				 $this->getNewsDetails();
				 break;
			case 'getNewsList':
				 $this->getNewsList();
				 break;
			case 'electionDashboard':
				 $this->getElectionDashboard();
				 break;
            case 'candidateInfo':
                 $this->getCandidateInfo();
                 break;
			case 'getWardDetailByWardId':
			     $this->getWardDetail();
			     break;
            case 'updatePushId':
			     $this->updatePushId();
			     break;
			case 'getAreaList':
			     $this->getAreaList();
			     break;
            case 'selectedArea':
    			 $this->setSelectedAreaNotification();
    			 break;
           case 'getAds':
    			 $this->getAllAdvsertisement();
    			 break; 
           case 'getTrendingNews':
    			 $this->getTrendingNews();
    			 break;
           case 'getVideo' :
                 $this->getVideo();
                 break;
           case 'getVideoList' :
                 $this->getVideoList();
                 break; 
           case 'saveVote' :
                 $this->saveVote();
                 break; 
				
    		default:
    			$this->unknownMethod();
    	}
    }   
	
	public function registerAppUser()
    {
	$auth_key = $this->config->item('api_auth_key');
	$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
			$this->data['email']  = $this->input->post('email');
			$this->data['mobile'] = $this->input->post('mobile');
			$device_type = $this->input->post('device_type');
			$push_id = $this->input->post('pushId');
			file_put_contents('28.txt', print_r($push_id,1).PHP_EOL, FILE_APPEND);
			$this->data['created_date'] = date('Y-m-d H:i:s', strtotime('-24 hours'));
			//if(!isset($this->data['email']) || empty($this->data['mobile'])){
			if(!isset($push_id)){
					//$array = array('success' => 'False', 'errorMessage' => 'PCB ERROR INVALID MOBILE_NO OR EMAIL');
					$array = array('success' => 'False', 'errorMessage' => 'PCB ERROR INVALID Push Id');
			}
			else{
				$result_id = $this->app_model->checkUser($this->data['email'],$this->data['mobile']);
				if($result_id && !empty($this->data['email']) && !empty($this->data['mobile'])){
					if($this->app_model->checkPushid($push_id)){
						$data = array(
							'user_id' => $result_id,
							'push_id' => $push_id,
							'device_type' => isset($device_type) ? $device_type :'Android',
					);
					$result = $this->app_model->registerPushId($data);
                    $array = array('success' => 'True');
                    }else{
                        $array = array('success' => 'True','errorMessage'=>'Already Registered');
                    }


				}else{
				    $id = 1;
				    if(!empty($this->data['email']) && !empty($this->data['mobile'])){
					$id = $this->app_model->registerAppUser($this->data);
				    }
					if($this->app_model->checkPushid($push_id)){
					$data = array(
							'user_id' =>$id,
							'push_id' => $push_id,
							'device_type' => isset($device_type) ? $device_type :'Android',
					);
					$result = $this->app_model->registerPushId($data);
						if($result === FALSE)
						{
							$array = array('success' => 'False', 'errorMessage' => 'Ops something went wrong.Please try again later');
						}
						else
						{
							$array = array('success' => 'True');
						}
					}else{
					$array = array('success' => 'True','errorMessage'=>'Push Id  already registred');
					}
				}
			}
			return $this->response($array, 200); // 200 being the HTTP response code		
		}
		else{
				$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
			}
	return $this->response($array, 200); // 200 being the HTTP response code
	}
	
	function getDashboardDetails() {		
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
			$collection = $this->config->item('news_collection');
			$this->data[$collection[BANNER]]=$this->pcb_news_model->getAllPcbNews(BANNER,3);				
			$new_type = array(PIMPRI =>1,CHINCHWAD=>1,BHOSARI=>1,PUNE=>1,MAHARASHTRA=>1,PUNEGRAMIN=>1,DESH=>1,VIDESH=>1,KRIDA=>1,NOTIFICATION=>1,BANNER=>3,LIFE_STYLE=>3);
			foreach($new_type as $key => $value){
			$news[]=$this->pcb_news_model->getDashboardDetailsAPI($key,$value);
			}
			$this->data['Regions'] = $news;
			$this->data['version'] = 4;
            $this->data['election'] = 0;
			$this->data['breaking'] = $this->pcb_news_model->getBreakingNews();
                        $array = array('success' => 'True', 'data' => $this->data);			
		
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}
	
	function getNewsDetails() {		
		$id = $this->input->post('newsId');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key && isset($id)){
			$data['newsDetail']=$this->pcb_news_model->getNews($id);	
			
            $array = array('success' => 'True', 'data' => $data);			
		
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

	function getNewsList() {		
		$newsTypeId = $this->input->post('newsTypeId');
		$id = $this->input->post('id');
		$limit = $this->input->post('limit');
		$start = $this->input->post('start');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key && isset($newsTypeId) && isset($id)){
			$data['newsList']=$this->pcb_news_model->getNewsList($newsTypeId,$id,$limit,$start);
			$data['totalCnt']=$this->pcb_news_model->getNewsCount($newsTypeId,$id);
            $array = array('success' => 'True', 'data' => $data);				
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}
	
	private function getElectionDashboard()
	{
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
			$data['wardList']=$this->pcb_news_model->getElectionDashboard();			
            $array = array('success' => 'True', 'data' => $data);				
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

	 private function getWardDetail()
	{
        $id = $this->input->post('id');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
			$data['wardInfo']=$this->pcb_news_model->getWardInfoAPI($id);
			if(isset($data['wardInfo'])){				
				foreach($data['wardInfo'] as $row => $value){
				$partyInfo = array('party_name'=>$value['party_name'],'party_symbol'=>$value['symbol'],'party_full_name'=>$value['party_full_name']);
				$candidateInfo['candidate_info'] = $this->pcb_news_model->getCandidatePartyInfo($value['candidates'],$id);
				$data['partyInfo'][] = array_merge($candidateInfo,$partyInfo);		
				}					
			}
            $array = array('success' => 'True', 'data' => $data);
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}
	

    private function getCandidateInfo()
	{
        $id = $this->input->post('id');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
			$data['candidateInfo']=$this->pcb_news_model->getCandidateInfo($id);
            $array = array('success' => 'True', 'data' => $data);
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

    private function updatePushId()
	{
        $old_id= $this->input->post('old_id');
        $new_id= $this->input->post('new_id');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
			$updatedId=$this->pcb_news_model->updatePushId($old_id,$new_id);
                        if($updatedId){
                        $array = array('success' => 'True', 'message' => 'Push Id updated');
                        }else{
                        $array = array('success' => 'True', 'data' => 'Nothing to update');
                        }
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}
	
	 private function getAreaList()
	{
	
                $push_id = $this->input->post('push_id');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
		$area_list = $this->config->item('news_collection_marathi');	
                $selected_area = $this->pcb_news_model->getSelectedArea($push_id);

                $array = array('success'=>'False','errorMessage'=>'Invalid Push Id');
	               if($selected_area==0 || (isset($selected_area) && !empty($selected_area))){ 
	                foreach($area_list as &$row){
		                 if( $selected_area == 0 ){
		                 $row['selected'] = 1;
		                 }else{
		                 $row['selected'] = (in_array($row['id'],explode(',',$selected_area))) ? 1 :0;
		                 }
	                }	
	                $data = $area_list;		
	                $array = array('success' => 'True', 'data' => $data);
	                }
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}


     function setSelectedAreaNotification() {		
		$push_id = $this->input->post('push_id');
		$areaList = $this->input->post('area_list');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if(($partnerSecretKey == $auth_key) && isset($push_id) && isset($areaList)){
		if(is_array($areaList)){
		$update_data = array('notification_alert'=>implode(',',$areaList));
		}else{
		$update_data= array('notification_alert' =>$areaList);
		}
		
			$updatedId=$this->pcb_news_model->updateNotificationSettings($push_id,$update_data);
                        if($updatedId){
                        $array = array('success' => 'True', 'message' => 'Settings updated');
                        }else{
                        $array = array('success' => 'True', 'data' => 'Nothing to update'); 
                        }				
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

       private function getAllAdvsertisement()
	{
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
                $device="APP";
	        $data =$this->pcb_news_model->getAllAdvsertisement($device);
                $array = array('success' => 'True', 'data' => $data);
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

        private function getTrendingNews()
	{
        $id = $this->input->post('id');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
                $limit =15;
		if($partnerSecretKey == $auth_key){
		$data = $this->pcb_news_model->getTopReadCollectionNews($limit);
                $array = array('success' => 'True', 'data' => $data);
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

       private function getVideo()
	{
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key){
                $this->config->load('pcb_config');
                $video_type = $this->config->item('video_config');
			if(isset($video_type)){				
				foreach($video_type as $key => $value){
				$videoType = array('video_type' => $value);
				$videoInfo['video_list'] = $this->pcb_news_model->getVideoInfo($key);
				$data['videoInfo'][] = array_merge($videoInfo,$videoType);		
				}					
			}
            $array = array('success' => 'True', 'data' => $data);
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

      function getVideoList() {		
		$typeId = $this->input->post('typeId');
		$id = $this->input->post('id');
		$limit = $this->input->post('limit');
		$start = $this->input->post('start');
		$auth_key = $this->config->item('api_auth_key');
		$partnerSecretKey = $this->input->post('partnerSecretKey');
		if($partnerSecretKey == $auth_key && isset($typeId) && isset($id)){
			$data['videoList']=$this->pcb_news_model->getVideoList($typeId,$id,$limit,$start);
			$data['totalCnt']=$this->pcb_news_model->getVideoCount($typeId,$id);
                        $array = array('success' => 'True', 'data' => $data);				
		} else {
			$array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
		}
		return $this->response($array, 200); // 200 being the HTTP response code
	}

     function saveVote()
     {
            $id = $this->input->post('id');
            $option = $this->input->post('option');
            $push_id = $this->input->post('push_id');
            $auth_key = $this->config->item('api_auth_key');
            $partnerSecretKey = $this->input->post('partnerSecretKey');
	    if($partnerSecretKey == $auth_key && isset($id) && isset($option)){
                $this->load->model("admin_model/pcb_news_model");
                $result = $this->pcb_news_model->savePollVote($id, $option,$push_id);
                if($result>0){
                $data = $this->pcb_news_model->getPcbPollbyID($id);
                $array = array('success' => 'True','data'=>$data);		
                }else{
                $array = array('success' => 'False', 'errorMessage' => 'Please try again later'); 
                }
        }else{
                $array = array('success' => 'False', 'errorMessage' => 'MJ_INVALID_PARTNER_KEY');
	}
		return $this->response($array, 200); // 200 being the HTTP response code}
     }

	function unknownMethod() {
			$array = array('success' => 'False', 'errorMsg' => 'Unknown methdod.');    	// Return error messag
			return $this->response($array, 200); // 200 being the HTTP response code
		}
}