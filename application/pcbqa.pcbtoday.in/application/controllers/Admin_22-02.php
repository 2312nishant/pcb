<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

	 
	public function __construct(){
	parent::__construct();
       $this->load->config("pcb_config");
       $this->load->model("admin_model/pcb_news_model");
 $this->load->helper("notification");

	}
    public function index()
    {
        $this->load->view('admin_portal/index');
    }


    public function uploadFile()
    {
     //  $filename = $_FILES['file']['name'];

        $fileData = $_FILES["file"]["name"];

        $filename = uniqid().str_replace(':', '_', date('Y-m-d H:i:s')).'.'.pathinfo($fileData, PATHINFO_EXTENSION);
        //  echo $this->input->post('id');
        if ($_FILES['file']['name']) {
            //  echo $_FILES['file']['tmp_name'];
            if (!file_exists('uploads/' . $this->input->post('id'))) {
                mkdir('uploads/' . $this->input->post('id'), 0777, true);
            }

            move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $this->input->post('id') . "/" . $filename);
            echo $filename;
        }

    }

    public function changeUploadFile()
    {
     //   $filename = $_FILES['file']['name'];
        $fileData = $_FILES["file"]["name"];
        $filename = uniqid().str_replace(':', '_', date('Y-m-d H:i:s')).'.'.pathinfo($fileData, PATHINFO_EXTENSION);

        $id = $this->input->post('id');
        $oldid = $this->input->post('oldType');
        $oldImage = $this->input->post('oldImage');
        //  echo $filename;
        //  echo $this->input->post('id');
        if ($_FILES['file']['name']) {
            //  echo $_FILES['file']['tmp_name'];
            if (!file_exists('uploads/' . $this->input->post('id'))) {
                mkdir('uploads/' . $this->input->post('id'), 0777, true);
            }

            move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $this->input->post('id') . "/" . $filename);


            if (file_exists("uploads/".$oldid.'/'.$oldImage)) {
                unlink("uploads/".$oldid.'/'.$oldImage);
            }


            echo $filename;
        }



    }

    public function changeUploadFilePath()
    {
        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);

        $id = $request->id;
        $oldid = $request->oldType;
        $oldImage = $request->oldImage;

        if (!file_exists('uploads/' . $id)) {
            mkdir('uploads/' . $this->input->post('id'), 0777, true);
        }

        rename("uploads/".$oldid.'/'.$oldImage, "uploads/".$id.'/'.$oldImage);
    }

    function updatePcbNews(){
        $result =false;
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        if(isset($request)){
        $id = $request->collectionID;
        $data = array(

            'pcb_news_id' => $request->type,
            'title' => $request->title,
            'image' => $request->imageFile,
            'description' => $request->description,
            'tag' => $request->tag,
            'modified_date' => date('Y-m-d H:i:s'),
            'posted_by' => 1
        );
        if(!empty($data) && isset($id)){
            $this->load->model("admin_model/pcb_news_model");
            $result = $this->pcb_news_model->updatePcbNews($data,$id);
        }
        }
        echo $result;

    }

    public function savePcbNews()
    {

        $result=0;
        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);
        // echo $request->type;
        // print_r($request->$request);
		if(isset($request)){
        $data = array(
            'pcb_news_id' => $request->type,
            'title' => $request->title,
            'image' => $request->imageFile,
            'description' => $request->description,
            'tag' => $request->tag,
            'created_date' => date('Y-m-d H:i:s', strtotime('-24 hours')),
            'modified_date' => date('Y-m-d H:i:s', strtotime('-24 hours')),
            'posted_by' => 1
        );

        $this->load->model("admin_model/pcb_news_model");
        $result = $this->pcb_news_model->savePcbNews($data);
    
        if($request->type == NOTIFICATION){
		$this->load->library('Asynchronus');
		$url = base_url()."Admin/sendNotification";
	    $this->asynchronus->do_in_background($url, array());
		}
		}
        if ($result != 0) {
            echo "1";
        }else{
		echo "0";
        }


    }

   public function sendNotification()
   {
     $pushIds = $this->pcb_news_model->getDeviceNotificationIds();
	 $newDetails = $this->pcb_news_model->getAllPcbNews(NOTIFICATION,1);
	 $newsId = $newDetails[0]['collection_id'];
	 $title = $newDetails[0]['title'];
	 $description = $newDetails[0]['description'];
	 $created_date = $newDetails[0]['created_date'];	 
	 $image = $newDetails[0]['image'];      
     $data = array('post_id'=>$newsId,'post_title'=>$title,'post_description'=>$description,'post_image'=>utf8_encode($this->config->item('appPath').'uploads/'.NOTIFICATION.'/'.$image));     
     $file = './image.txt';
     file_put_contents($file, $data , FILE_APPEND);
	 if(!empty($pushIds)){
	 foreach($pushIds as $id){
         $arr[] = $this->sendOnesignalNotification($id,$newsId,$title,$description,$image,$created_date);        
         sendMessage($data,$id);
        
     }
	 }
	
   }

        function sendOnesignalNotification($playerId,$newsId,$title,$description,$image,$created_date){
        $content = array(
          "en" => $description,
          );

        $fields = array(
          'app_id' => "e5233033-a72f-4e29-8070-c030133884b5",
          'device_type' => 1,
          'include_player_ids' => array($playerId),
          'data' => array("newsId" => $newsId),
          'headings' => array("en" => $title),
          'contents' => $content,
          'url' => $this->config->item('pcbPath').'uploads/'.NOTIFICATION.'/'.$image,
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                               'Authorization: Basic MTg5MjgzNTYtNTNhOS00Y2NlLThlYzctNTYwZmIwOThjYjlj'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);

        curl_close($ch);
        return $response;
        }
    public function savePcbPoll()
    {

        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);
        $data = array(
            'question' => $request->que,
            'option_a' => $request->optionA,
            'option_b' => $request->optionB,
            'option_c' => $request->optionC,
            'option_d' => $request->optionD,
            'created_date' => date('Y-m-d H:i:s', strtotime('-24 hours')),
            'modified_date' => date('Y-m-d H:i:s', strtotime('-24 hours')),
            'posted_by' => 1
        );        
        $result = $this->pcb_news_model->savePcbPoll($data);
        if ($result != 0) {
            echo "1";
        }
    }

    public function savePcbRashi()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $data = array(
            'aries' => $request->aries,
            'taurus' => $request->taurus,
            'gemini' => $request->gemini,
            'cancer' => $request->cancer,
            'lion' => $request->lion,
            'kanya' => $request->kanya,
            'libra' => $request->libra,
            'scorpio' => $request->scorpio,
            'sagittarius' => $request->sagittarius,
            'capricorn' => $request->capricorn,
            'aquarius' => $request->aquarius,
            'pisces' => $request->pisces,
            'created_date' => date('Y-m-d H:i:s', strtotime('-24 hours'))
        );        
        $result = $this->pcb_news_model->savePcbRashi($data);
        if ($result != 0) {
            echo "1";
        }
    }

    public function getPcbNewsType()
    {

        $newsType = $this->pcb_news_model->getNewsType();
        echo json_encode($newsType);

    }

    public function getBreakingNews()
    {
        $newsType = $this->pcb_news_model->getBreakingNews();
        echo json_encode($newsType);

    }

    public function saveBreakingNews()
    {

        $postdata = file_get_contents("php://input");

        $request = json_decode($postdata);
        // echo $request->type;
        $news = array();
        // print_r($request);

        $news[0] = $request->news1;
        $news[1] = $request->news2;
        $news[2] = $request->news3;
        $news[3] = $request->news4;
        $news[4] = $request->news5;
        $news[5] = $request->news6;
        $news[6] = $request->news7;
        $news[7] = $request->news8;
        $news[8] = $request->news9;
        $news[9] = $request->news10;


        for ($i = 0; $i < count($news); $i++) {

            $data[$i] = array(
                'text' => $news[$i],
             //   'created_at' => date('Y-m-d H:i:s', strtotime('-24 hours')),
                'posted_by' => 1
            );

        }
        $result = $this->pcb_news_model->saveBreakingNews($data);
        if ($result != 0) {
            echo "1";
        }

    }

    public function getAllPcbNews()
    {
        $news = $this->pcb_news_model->getAllPcbNews(NULL,70);
        echo json_encode($news);

    }
    public function getPcbNewsByType()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $news_type = $request->news_type;
        $limit =  $request->limit;
        if(isset($news_type) && isset($limit)){
		$news = $this->pcb_news_model->getAllPcbNews($news_type,$limit);
        echo json_encode($news);
        }else
        echo "0";

    }
    public function getPcbNewsByHashTag()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $news_tag = $request->tag;
        if(isset($news_tag)){
		$news = $this->pcb_news_model->getAllPcbTagNews($news_tag);
        echo json_encode($news);
        }else
        echo "0";

    }

    public function getPcbNewsById()
    {
        $postdata = file_get_contents("php://input");
        $newsId = $postdata;
        $news = $this->pcb_news_model->getNews($newsId);
        echo json_encode($news);

    }

    public function deletePcbNewsById()
    {
        $postdata = file_get_contents("php://input");
		$newsId = $postdata;
        $news = $this->pcb_news_model->deletePcbNewsById($newsId);
        echo($news);

    }

    public function getPollList()
    {
        $PollList = $this->pcb_news_model->getPollList();
        echo json_encode($PollList);

    }

    public function getPcbPollbyID()
    {
        $postdata = file_get_contents("php://input");
        $pollId = $postdata;
        $poll = $this->pcb_news_model->getPcbPollbyID($pollId);
        echo json_encode($poll);

    }

    function updatePcbPoll(){
        $result =false;
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        if(isset($request)){
            $id = $request->id;
            $data = array(

                'question' => $request->que,
                'option_a' => $request->A,
                'option_b' => $request->B,
                'option_c' => $request->C,
                'option_d' => $request->D,
                'modified_date' => date('Y-m-d H:i:s', strtotime('-24 hours')),
                'posted_by' => 1
            );
            if(!empty($data) && isset($id)){
                $this->load->model("admin_model/pcb_news_model");
                $result = $this->pcb_news_model->updatePcbPoll($data,$id);
            }
        }
        echo $result;

    }

    public function deletePcbPollById()
    {
        $postdata = file_get_contents("php://input");
        $pollId = $postdata;
        $result = $this->pcb_news_model->deletePcbPollById($pollId);
        echo($result);
    }
	
	public function getAdsType()
	{
		$adsType= $this->config->item("ads_config");
		echo(json_encode($adsType));
	}
	
	public function getVideoType()
	{
		$videoType= $this->config->item("video_config");
		echo(json_encode($videoType));
	}

	public function savePcbAds()
	{
		$postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
         $data = array(
            'adv_type' => $request->type,
            'image' => $request->imageFile,
			'web_or_app' =>$request->adType,
            'created_date' => date('Y-m-d H:i:s', strtotime('-24 hours')),
            'posted_by' => 1
        );
        $result = $this->pcb_news_model->savePcbAds($data);
        if ($result != 0) {
            echo "1";
        }
	}

	public function savePcbVideo()
	{
		$postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
         $data = array(
            'video_type' => $request->type,
            'url_code' => $request->code,
            'title' => $request->title,
            'created_date' => date('Y-m-d H:i:s', strtotime('-24 hours')),
            'posted_by' => 1
        );
        $result = $this->pcb_news_model->savePcbVideo($data);
        if ($result != 0) {
            echo "1";
        }
	}

    public function getTopCollectionNews()
    {
        $result = $this->pcb_news_model->getTopCollectionNews(6);
        echo(json_encode($result));
    }


    public function getTopReadCollectionNews()
    {
        $result = $this->pcb_news_model->getTopReadCollectionNews(6);
        echo(json_encode($result));
    }

    public function getHashTag()
    {
        $result = $this->pcb_news_model->getHashTag();
        echo(json_encode($result));
    }



    public function saveNewsCount()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id;
        if(isset($id)){
        $result = $this->pcb_news_model->updatePcbNewsCount($id);
        if ($result != 0) {
            echo "1";
        }
        }
        else{
            echo "0";
        }
    }

    function saveWardInfo(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $data = array(
            'prabhag_no' => $request->prabhag_no,
            'area' => $request->prabhag_area,
            'population' => $request->population,
            'created_at' => date('Y-m-d H:i:s', strtotime('-24 hours'))
        );

        $id = $this->pcb_news_model->saveWardInfo($data);
        if (is_numeric($id) && $id > 0) {
            $data2 = array(
                'ward_id' => $id,
                'sector_a' => $request->prabhag_A,
                'sector_b' => $request->prabhag_B,
                'sector_c' => $request->prabhag_C,
                'sector_d' => $request->prabhag_D,
                'created_at' => date('Y-m-d H:i:s', strtotime('-24 hours'))
            );

            $this->pcb_news_model->saveSubWardInfo($data2);
        }

    }

    function getWardInfo(){
        $result = $this->pcb_news_model->getWardInfo();
        echo(json_encode($result));
    }
    function getElectionReservations(){
        $result = $this->pcb_news_model->getElectionReservations();
        echo(json_encode($result));
    }

    function getSubWards(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $result = $this->pcb_news_model->getSubWards($request->ward);
        echo(json_encode($result));
    }

    function saveCandidateInfo(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $data = array(
            'name' => $request->cname,
            'qualification' => $request->qualification,
            'description' => $request->description,
            'occupation' => $request->occupation,
            'mobile_no' => $request->Contact,
            'email' => $request->email,
            'photo' => $request->photo,
            'party' => $request->party,
            'age' => $request->age,
            'created_at' => date('Y-m-d H:i:s', strtotime('-24 hours'))
        );
        $candidate_id = $this->pcb_news_model->saveCandidateInfo($data);
        if(isset($candidate_id)){
        $candInfo = array(
            'candidate_id' =>$candidate_id,
            'ward_id' => $request->ward,
            'reservation_id' => $request->reservation,
            'sector' => $request->sub_ward,

        );
            $result = $this->pcb_news_model->saveCandidateWardInfo($candInfo);
            if ($result != 0) {
                echo "1";
            }
        }
    }
    function savePartyInfo(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $data = array(
            'party_name' => $request->name,
            'party_full_name' => $request->fullname,
            'symbol' => $request->imageFile
        );
        $result = $this->pcb_news_model->savePartyInfo($data);
        if ($result != 0) {
            echo "1";
        }
    }

    function getElectionParty(){
        $result = $this->pcb_news_model->getElectionParty();
        echo(json_encode($result));
    }

    function wardCandidateInfo()
    {
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        $result = $this->pcb_news_model->wardCandidateInfo($request->id);
        echo(json_encode($result));
    }

    function getRelatedNewsList(){
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);

        if(isset( $request ) && !empty($request)){
        $result = $this->pcb_news_model->getRelatedNewsList($request->id);
        echo(json_encode($result));
        }
        else{
            echo false;
        }
    }

   public  function updateCandidateVotes(){
        $result =false;
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        if(isset($request)){
            $id = $request->candidateId;
            $data = array(
                'no_votes' => $request->no_of_votes,
            );
            if(!empty($data) && isset($id)){
                $this->load->model("admin_model/pcb_news_model");
                $result = $this->pcb_news_model->updateCandidateVotes($data,$id);
            }
        }
        echo $result;

    }



}

