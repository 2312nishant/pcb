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
			$push_id = $this->input->post('pushId');
			$this->data['created_date'] = date('Y-m-d H:i:s', strtotime('-24 hours'));
			//if(!isset($this->data['email']) || empty($this->data['mobile'])){
			if(!isset($push_id)){
					//$array = array('success' => 'False', 'errorMessage' => 'PCB ERROR INVALID MOBILE_NO OR EMAIL');
					$array = array('success' => 'False', 'errorMessage' => 'PCB ERROR INVALID Push Id');
			}
			else{
				$result_id = $this->app_model->checkUser($this->data['email'],$this->data['mobile']);
				if($result_id){
					if($this->app_model->checkPushid($push_id)){
						$data = array(
							'user_id' => $result_id,
							'push_id' => $push_id
					);
					$result = $this->app_model->registerPushId($data);
                    $array = array('success' => 'True');
                    }else{
                        $array = array('success' => 'True','errorMessage'=>'Already Registered');
                    }


				}else{
					$id = $this->app_model->registerAppUser($this->data);
					if(is_numeric($id) && $this->app_model->checkPushid($push_id)){
					$data = array(
							'user_id' =>$id,
							'push_id' => $push_id
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
	

	function unknownMethod() {
			$array = array('success' => 'False', 'errorMsg' => 'Unknown methdod.');    	// Return error messag
			return $this->response($array, 200); // 200 being the HTTP response code
		}
}