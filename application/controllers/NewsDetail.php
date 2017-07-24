<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsDetail extends CI_Controller {

	
	 public function __construct()
    {
        parent::__construct();
        $this->load->helper('url', 'include');
        $this->load->model("admin_model/pcb_news_model");

    }

	public function index($id)
	{
		$result['data']= $this->pcb_news_model->getNews($id);
	    $result['related_news'] = $this->pcb_news_model->getRelatedNewsList($id);
	    $result['top_news'] = $this->pcb_news_model->getTopReadCollectionNews(4);
	    $result['breaking'] = $this->pcb_news_model->getBreakingNews();
	    $result['ads'] = $this->pcb_news_model->getAdvsertise(2);
	    $result['ads2'] = $this->pcb_news_model->getAdvsertise(4);
	   // echo "<pre>";
	    //print_r($result);
		$this->load->view('newsDetails',$result);
	}
	
	
}
