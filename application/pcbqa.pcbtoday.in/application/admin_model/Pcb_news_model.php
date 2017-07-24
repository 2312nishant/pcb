<?php
/**
 * Created by PhpStorm.

 * User: Nishant Nair

 * Date: 2/25/15
 * Time: 3:22 PM
 */

class Pcb_news_model extends CI_Model
{

	private $news;
	private $news_collection;
	private $astrology;
	private $video;
	private $breaking_news;
        private $push_notification;
	
	
	public function __construct(){
	parent::__construct();
        $this->load->helper('url','include');
		$this->news 		    = $this->db->dbprefix('news');
		$this->news_collection 	= $this->db->dbprefix('news_collection');
		$this->astrology		= $this->db->dbprefix('astrology');
		$this->breaking_news    = $this->db->dbprefix('breaking_news');
		$this->pcb_poll    		= $this->db->dbprefix('poll');
		$this->video    		= $this->db->dbprefix('video');
		$this->ads 		   		= $this->db->dbprefix('adv_world');
        $this->ward 		   	= $this->db->dbprefix('ward');
		$this->election_reservation = $this->db->dbprefix('election_reservation');
        $this->push_notification = $this->db->dbprefix('push_notification');
        $this->ward 		   	= $this->db->dbprefix('ward');
		$this->election_reservation = $this->db->dbprefix('election_reservation');
        $this->push_notification = $this->db->dbprefix('push_notification');
        $this->candidate_ward = $this->db->dbprefix('candidate_ward');
        $this->election_party = $this->db->dbprefix('election_party');
        $this->candidate = $this->db->dbprefix('candidate');
    }
	
    function getNewsType()
    {
		$this->db->select('id,news,display_name')
				 ->from($this->news);
		$result = $this->db->get();
        $newsType=array();
        if($result->num_rows()>0)
        {
            foreach($result->result_array() as $row)
            {
                $newsType[]= $row;
            }

            return $newsType;
        }
        else
        {
            return $newsType;
        }
    }
    function getBreakingNews()
    {
		$this->db->select('text')
				 ->from($this->breaking_news);
		$result = $this->db->get();
        $newsType=array();
        if($result->num_rows()>0)
        {
            foreach($result->result_array() as $row)
            {
                $newsType[]= $row;
            }

            return $newsType;
        }
        else
        {
            return $newsType;
        }
    }


    function getDeviceNotificationIds()
    {
        $this->db->distinct();
		$this->db->select('push_id')
				 ->from($this->push_notification);
		$result = $this->db->get();
        $pushIds=array();
        if($result->num_rows()>0)
        {
            foreach($result->result_array() as $row)
            {
                $pushIds[]= $row['push_id'];
            }

            return $pushIds;
        }
        else
        {
            return $pushIds;
        }
    }

    function getAllPcbNews($type=NULL,$limit=NULL)
    {

			$this->db->select('coll.id collection_id,news.id newsType_id, news.display_name, coll.title,description, coll.image,created_date');

			if($type!=NULL && $limit!=NULL){

			$this->db->where('pcb_news_id' , $type);

			$this->db->limit($limit);
			}

if($type==NULL && $limit!=NULL){

			$this->db->limit($limit);
			}


			$this->db->from($this->news_collection.' AS coll');
			$this->db->join($this->news.' As news','news.id=coll.pcb_news_id');
			$this->db->order_by("coll.id", "desc");
			$query = $this->db->get();
            $news=array();
			if($query->num_rows()>0){
			foreach($query->result_array() as $row)
            {
                $news[]= $row;
            }
			return $news;
            }
            return $news;
    }
    function getAllPcbTagNews($tag)
    {

			$this->db->select('coll.id collection_id,news.id newsType_id, news.display_name, coll.title,description, coll.image,created_date');

			$this->db->from($this->news_collection.' AS coll');
            $this->db->where("MATCH (`tag`) AGAINST ('{$tag}')");
			$this->db->join($this->news.' As news','news.id=coll.pcb_news_id');
			$this->db->order_by("coll.id", "desc");
			$query = $this->db->get();
            $news=array();
			if($query->num_rows()>0){
			foreach($query->result_array() as $row)
            {
                $news[]= $row;
            }
			return $news;
            }
            return $news;
    }
	
	  function getNewsList($type=NULL,$id,$limit=NULL,$start=NULL)
    {

			$this->db->select('coll.id collection_id,pcb_news_id newsType_id, coll.title, description,tag,coll.image,created_date');
			$this->db->from($this->news_collection.' AS coll');
			$this->db->where('pcb_news_id',$type);
			$this->db->limit($limit,$start);
			$this->db->where('id <=',$id);
			$this->db->order_by("coll.id", "desc");
			$query = $this->db->get();
            $news=array();
			if($query->num_rows()>0){
			foreach($query->result_array() as $row)
            {
                $news[]= $row;
            }
			return $news;
            }
            return $news;
    }

    function getRelatedNewsList($id)
    {
       
			$this->db->select('coll.id collection_id,pcb_news_id newsType_id, coll.title, description,tag,coll.image,created_date');
			$this->db->from($this->news_collection.' AS coll');
			$this->db->limit(4);
			$this->db->where('id <',$id);
			$this->db->order_by("coll.id", "desc");
			$query = $this->db->get();
            $news=array();
			if($query->num_rows()>0){
			foreach($query->result_array() as $row)
            {
                $news[]= $row;
            }
			return $news;
            }
            return $news;
    }
 
   function savePcbNews($data){
       $this->db->insert('pcb_news_collection', $data);
       return $this->db->affected_rows();
   }
   
    function savePcbRashi($data){
       $this->db->insert('pcb_astrology', $data);
       return $this->db->affected_rows();
   }

    function savePcbPoll($data){
       $this->db->insert('pcb_poll', $data);
       return $this->db->affected_rows();
   }
   
    function saveBreakingNews($data){
		$this->db->empty_table($this->breaking_news);
        $this->db->insert_batch($this->breaking_news, $data);
        return $this->db->affected_rows();
   }

    function deletePcbNewsById($id){

        $this->db->where('id', $id);
        $this->db->delete($this->news_collection);
        return $this->db->affected_rows();
   }
    function getPcbPollbyID($id){

        $this->db->select('question, option_a,option_b, option_c, option_d')
            ->from($this->pcb_poll);
        $this->db->where('id',$id);

        $result = $this->db->get();
        $poll=array();
        if($result->num_rows()>0)
        {
            foreach($result->result_array() as $row)
            {
                $poll[]= $row;
            }

            return $poll;
        }
        else
        {
            return $poll;
        }
   }

    function updatePcbNews($data,$id){

        $this->db->where('id', $id);
        $this->db->update('pcb_news_collection',$data);
        return $this->db->affected_rows();
    }


    function updateCandidateVotes($data,$id){
        $this->db->where('id', $id);
        $this->db->update($this->candidate,$data);
        return $this->db->affected_rows();
    }


    function getPollList()
    {
        $this->db->select('id, question, option_a, option_b, option_c, option_d, cnt_a, cnt_b, cnt_c, cnt_d, SUM(cnt_a+cnt_b+cnt_c+cnt_d) AS total ');
           $this->db->from($this->pcb_poll);
        $this->db->group_by('id');
        $result = $this->db->get();
        $PollList=array();
        if($result->num_rows()>0)
        {
            foreach($result->result_array() as $row)
            {
                $PollList[]= $row;
            }

            return $PollList;
        }
        else
        {
            return $PollList;
        }
    }

    function updatePcbPoll($data,$id){

        $this->db->where('id', $id);
        $this->db->update($this->pcb_poll,$data);
        return $this->db->affected_rows();
    }

    function deletePcbPollById($id){

        $this->db->where('id', $id);
        $this->db->delete($this->pcb_poll);
        return $this->db->affected_rows();
    }

    function getPollData(){
        $this->db->select('id, question, option_a, option_b, option_c, option_d, cnt_a, cnt_b, cnt_c, cnt_d, SUM(cnt_a+cnt_b+cnt_c+cnt_d) AS total ');
        $this->db->from($this->pcb_poll);
        $this->db->group_by('id');
        $this->db->order_by("id", "DESC");
        $this->db->limit(1, 0);
        $result = $this->db->get();
        $PollList=array();
        if($result->num_rows()>0)
        {
            foreach($result->result_array() as $row)
            {
                $PollList[]= $row;
            }

            return $PollList;
        }
        else
        {
            return $PollList;
        }
    }

    function savePollVote($id,$option){

        $this->db->select($option)->from($this->pcb_poll);
        $this->db->where('id',$id);
        $option_cnt=0;
        $result = $this->db->get();
        if($result->num_rows()>0)
        {
          $option_cnt= $result->row($option);
        }
        $option_cnt++;

        $data=array($option=>$option_cnt);
        $this->db->where('id', $id);
        $this->db->update($this->pcb_poll,$data);
        //$sql="update ".$this->pcb_poll." set ".$option."=".$option_cnt." where id=".$id;
        if($this->db->affected_rows()>0){
            return $this->getPollData();
        }
    }
	
	
	function savePcbAds($data){
	   $this->db->insert($this->ads,$data);
       return $this->db->affected_rows();
	}
	
	function savePcbVideo($data){
	   $this->db->insert($this->video,$data);
       return $this->db->affected_rows();
	}

    function getVideo(){
        $sql="SELECT *
FROM    pcb_video a
WHERE
        (
            SELECT  COUNT(*)
            FROM     pcb_video b
            WHERE a.video_type=b.video_type AND
                  a.id >= b.id
        ) <= 3";
        $query = $this->db->query($sql);
        $CandidateInfo=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $CandidateInfo[]= $row;
            }
            return $CandidateInfo;
        }
        return $CandidateInfo;
    }

    function getNews($id){
       $this->updatePcbNewsCount($id);
        $this->db->select('id,pcb_news_id,title,image,description,tag,created_date,modified_date');
        $this->db->where('id', $id);
        $this->db->from($this->news_collection);
        $query = $this->db->get();
        $news=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $news = $row;
            }
        }
        return $news;

    }
	
	function getDashboardDetailsAPI($type,$limit){

		$this->db->select('coll.id collection_id,news.id newsType_id, news.display_name, coll.title, coll.image,created_date');

		if($type!=NULL && $limit!=NULL){

		$this->db->where(array('pcb_news_id' =>$type));

		$this->db->limit($limit);

		}

		$this->db->from($this->news_collection.' AS coll');

		$this->db->join($this->news.' As news','news.id=coll.pcb_news_id');

		$this->db->order_by("coll.id", "desc");

        $query = $this->db->get();
        $news=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $news = $row;
            }
        }
        return $news;

    }

    function getTopCollectionNews($limit = 5)
    {
        $this->db->distinct();
        $this->db->select('coll.id collection_id,coll.pcb_news_id newsType_id, coll.title, description,tag,coll.image,created_date');
        if($limit!=NULL){
            $this->db->limit($limit);
        }
        $this->db->from($this->news_collection.' AS coll');		
	$this->db->group_by("coll.title");
        $this->db->order_by("coll.id", "desc");
        $query = $this->db->get();
        $news=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $news[]= $row;
            }
            return $news;
        }
        return $news;
    }

    function getTopReadCollectionNews($limit = 5)
    {
        $this->db->select('coll.id collection_id, coll.title, description,tag,coll.image,created_date');
        if($limit!=NULL){
            $this->db->limit($limit);
        }
        $this->db->from($this->news_collection.' AS coll');
        $this->db->order_by("coll.news_count", "desc");
        $query = $this->db->get();
        $news=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $news[]= $row;
            }
            return $news;
        }
        return $news;
    }

    public function updatePcbNewsCount($id)
    {
        $this->db->set('news_count', 'news_count+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('pcb_news_collection');
        return $this->db->affected_rows();
    }

    public function getHashTag(){
        $this->db->select('DISTINCT tag',false);
        $this->db->limit(15);
        $this->db->from($this->news_collection);
        $this->db->order_by("id", "desc");
        $where = "tag is  NOT NULL";
        $this->db->where($where);
        $query = $this->db->get();
        $news=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $news[]= $row;
            }
            return $news;
        }
        return $news;
    }

   function saveWardInfo($data){
       $this->db->insert('pcb_ward', $data);
       return $this->db->insert_id();
   }
    function saveSubWardInfo($data){
       $this->db->insert('pcb_sub_ward', $data);
       return $this->db->insert_id();
   }
   
   public function getNewsCount($type,$id){
	   $this->db->select('id');
	   $this->db->from($this->news_collection.' AS coll');
	   $this->db->where('pcb_news_id',$type);
	   $this->db->where('id <= ',$id);
	   $query = $this->db->get();
	   return $query->num_rows();
   }
   
   public function getElectionDashboard()
   {
		$this->db->select('id,prabhag_no,area,population');
        $this->db->from($this->ward);
        $query = $this->db->get();
        $data=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $data[]= $row;
            }
            return $data;
        }
        return $data;   
   }

    function getElectionReservations(){
        $this->db->select('er.id, er.reservation_name');
        $this->db->from($this->election_reservation.' AS er');
        $query = $this->db->get();
        $ward=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $ward[]= $row;
            }
            return $ward;
        }
        return $ward;
    }
    function getWardInfo(){
        $this->db->select('ward.id ward_id, ward.prabhag_no prabhag_name, ward.population');
        $this->db->from($this->ward.' AS ward');
        $this->db->order_by('sort_by');
        $query = $this->db->get();
        $ward=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $ward[]= $row;
            }
            return $ward;
        }
        return $ward;
    }
    function getSubWards(){
        $this->db->select('ward.id ward_id, ward.prabhag_no prabhag_name');
        $this->db->from($this->ward.' AS ward');
        $query = $this->db->get();
        $ward=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $ward[]= $row;
            }
            return $ward;
        }
        return $ward;
    }


    function saveCandidateInfo($data){
        $this->db->insert('pcb_candidate', $data);
        return $this->db->insert_id();
    }

    function saveCandidateWardInfo($data){
        $this->db->insert($this->candidate_ward,$data);
        return $this->db->insert_id();
    }
    function savePartyInfo($data){
        $this->db->insert($this->election_party,$data);
        return $this->db->affected_rows();
    }

    function getElectionParty(){

        $this->db->select('ep.id, ep.party_name, ep.party_full_name, ep.symbol');
        $this->db->from($this->election_party.' AS ep');
        $query = $this->db->get();
        $party=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $party[]= $row;
            }
            return $party;
        }
        return $party;
    }

    function wardCandidateInfo($id){
       $sql="SELECT * FROM `pcb_candidate` cand, `pcb_candidate_ward` cand_ward, pcb_election_reservation per,pcb_election_party ep WHERE (cand.id=cand_ward.candidate_id) AND (per.id=cand_ward.reservation_id) AND (ep.id=cand.party) AND cand_ward.ward_id=".$id;
        $query = $this->db->query($sql);
        $CandidateInfo=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $CandidateInfo[]= $row;
            }
            return $CandidateInfo;
        }
        return $CandidateInfo;

    }

    function getCandidateInfo($id){
        $this->db->select('`candidate_id`,`ward_id`,`reservation_id`,reservation_name,`name`,`qualification`
,`description`,`occupation`,`mobile_no`,`email`,`photo`,`party`,`age`,`created_at`,
`party_name`,`party_full_name`,`symbol`');
        $this->db->from($this->candidate.' AS cand');
        $this->db->join($this->candidate_ward.' As cand_ward','cand.id=cand_ward.candidate_id');
        $this->db->join($this->election_reservation.' As election','election.id=cand_ward.reservation_id');
        $this->db->join($this->election_party.' As ep','ep.id=cand.party');
        $this->db->where('candidate_id',$id,false);
        $query = $this->db->get();
        $CandidateInfo=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $CandidateInfo= $row;
            }
            return $CandidateInfo;
        }
        return $CandidateInfo;

    }
/*SELECT ward_id,area,group_concat(candidate_id),cand.party,reservation_name 
FROM `pcb_candidate` cand, `pcb_candidate_ward` cand_ward,pcb_ward ward, pcb_election_reservation per,pcb_election_party ep 
WHERE (cand.id=cand_ward.candidate_id) AND (per.id=cand_ward.reservation_id) AND (ep.id=cand.party) 
AND ward.id=cand_ward.ward_id and cand_ward.ward_id=127 group by cand.party*/

		function getWardInfoAPI($id){
        $this->db->select('ward_id,prabhag_no,area,group_concat(candidate_id) as candidates,cand.party,party_name,party_full_name,symbol,reservation_name');
        $this->db->from($this->candidate.' AS cand');
        $this->db->join($this->candidate_ward.' As cand_ward','cand.id=cand_ward.candidate_id');
		$this->db->join($this->ward.' As ward','ward.id=cand_ward.ward_id');
        $this->db->join($this->election_reservation.' As election','election.id=cand_ward.reservation_id');
        $this->db->join($this->election_party.' As ep','ep.id=cand.party');
        $this->db->where('ward.id',$id,false);
		$this->db->group_by('cand.party');
        $query = $this->db->get();
        $CandidateInfo=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $CandidateInfo[]= $row;
            }
            return $CandidateInfo;
        }
        return $CandidateInfo;

    }	
	function getCandidatePartyInfo($candidateIds,$wardId){
        $this->db->select('candidate_id,ward_id,reservation_id,name,party_name,party_full_name,photo,qualification
,description,occupation,mobile_no,email,photo,party,age,reservation_name');
        $this->db->from($this->candidate.' AS cand');
        $this->db->join($this->candidate_ward.' As cand_ward','cand.id=cand_ward.candidate_id');
        $this->db->join($this->election_reservation.' As election','election.id=cand_ward.reservation_id');
        $this->db->join($this->election_party.' As ep','ep.id=cand.party');
        $this->db->where_in('candidate_id',$candidateIds,false);
		$this->db->where('ward_id',$wardId);
        $query = $this->db->get();
        $CandidateInfo=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $CandidateInfo[] = $row;
            }
            return $CandidateInfo;
        }
        return $CandidateInfo;

    }

    function getAllCandidateInfo(){
        $this->db->select('candidate_id,ward_id,reservation_id,name,party_name,party_full_name,photo,party,age,prabhag_no,sector, no_votes');
        $this->db->from($this->candidate.' AS cand');
        $this->db->join($this->candidate_ward.' As cand_ward','cand.id=cand_ward.candidate_id');
        $this->db->join($this->ward.' As ward','ward.id=cand_ward.ward_id');
        $this->db->join($this->election_reservation.' As election','election.id=cand_ward.reservation_id');
        $this->db->join($this->election_party.' As ep','ep.id=cand.party');
        $query = $this->db->get();
        $CandidateInfo=array();
        if($query->num_rows()>0){
            foreach($query->result_array() as $row)
            {
                $CandidateInfo[] = $row;
            }
            return $CandidateInfo;
        }
        return $CandidateInfo;
    }


}