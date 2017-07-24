<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'include');
        $this->load->model("admin_model/pcb_news_model");

    }

    public function index()
    {
      
        $this->load->view('index');
    }

    public function getWebsiteData()
    {
        $new_type = array(BANNER => 10, PIMPRI => 3, CHINCHWAD => 3, BHOSARI => 3, PUNE => 3, MAHARASHTRA => 3, PUNEGRAMIN => 3, DESH => 3, VIDESH => 3, KRIDA => 3, NOTIFICATION => 10 , VISHESH => 3, LIFE_STYLE => 3);
        foreach ($new_type as $key => $value) {
            $news[$key] = $this->pcb_news_model->getAllPcbNews($key, $value);
        }
        $news['breaking'] = $this->pcb_news_model->getBreakingNews();

        $tw_username = 'pcbtodaynews'; 
        $data = file_get_contents('https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names='.$tw_username); 
        $parsed =  json_decode($data,true);
        $news['tw_followers'] =  $parsed[0]['followers_count'];
        echo json_encode($news);
    }

    public function getPollData()
    {

        $poll = $this->pcb_news_model->getPollData();
        echo json_encode($poll);
    }

    public function savePollVote()
    {

        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        if (isset($request)) {
            $option = $request->option;
            $id = $request->id;

            if (isset($option)) {
                $this->load->model("admin_model/pcb_news_model");
                $result = $this->pcb_news_model->savePollVote($id, $option);


                echo json_encode($result);

            }
        }
    }

    public function getNews()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->pcb_news_model->getNews($request->id);
        echo json_encode($result);

    }



    public function getVideo()
{
    $result = $this->pcb_news_model->getVideo();
    echo json_encode($result);

}

    public function getAdvertise()
{
   
	$this->load->config("pcb_config");
	$addType= $this->config->item("ads_config");
	foreach($addType as $key =>$value){
			$result[$value] = $this->pcb_news_model->getAdvsertise($key);
	}
	
    echo json_encode($result);

}

    public function getCandidateWardInfo()
{
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    //echo $request->id;die;
    if (isset($request->id)) {
        $data['wardInfo'] = $this->pcb_news_model->getWardInfoAPI($request->id);
        if (isset($data['wardInfo'])) {
            foreach ($data['wardInfo'] as $row => $value) {
                $partyInfo = array('party_name' => $value['party_name'], 'party_symbol' => $value['symbol'], 'party_full_name' => $value['party_full_name']);
                $candidateInfo['candidate_info'] = $this->pcb_news_model->getCandidatePartyInfo($value['candidates'], $request->id);

                $data['partyInfo'][] = array_merge($candidateInfo, $partyInfo);
            }
        }
        echo json_encode($data);
    } else {
        echo "0";
    }
}
    public function getAllCandidateInfo()
{
    $result = $this->pcb_news_model->getAllCandidateInfo();
    echo json_encode($result);

}

public function getElectionResultByWardId()
{
	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
	if(isset($request->id)){
	$result = $this->pcb_news_model->getAllCandidateInfo($request->id);
	}else{
		$result = $this->pcb_news_model->getAllCandidateInfo();
	}
	 echo json_encode($result);
}
}
