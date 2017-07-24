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
        $result['data'] = '<h3>मेष</h3>
                            <div>
                                <p>संपत्ती संबंधी विषयांमध्ये अनुकूल स्थिती उत्पन्न होण्याची संभावना. कौटुंबिक वातावरण देखील आपल्या जीवनात आनंद आणेल. आपल्या जोडीदाराशी संवाद मधुर ठेवा.</p>
                            </div>

                            <h3>वृषभ</h3>
                            <div>
                                <p>प्रेम-प्रसंगांमध्ये सावधगिरी बाळगा. आर्थिक खर्च अधिक होईल. कर्ज देणे टाळा. निष्कारण चिंता त्रास देतील. व्यापारात वेळ मध्यम राहील.</p>
                            </div>

                            <h3>मिथुन</h3>
                            <div>
                                <p>कामात काही विघ्न येऊ शकतात. अधिक जोखिमीचे कार्ये टाळा. आरोग्य नरम-गरम राहील.</p>
                            </div>

                            <h3>कर्क</h3>
                            <div>
                                <p>व्यवसाय सुरळीत चालत राहील. आपल्या कौटुंबिक सभासदांचा आधार मिळेल. आनंददायी कार्यांसाठी व मनोरंजनासाठी देखील वेळ मिळेल.</p>
                            </div>

                             <h3>सिंह</h3>
                            <div>
                                <p>आरोग्याची काळजी घ्या. अत्यंत परिश्रम केल्यानंतर थोडे यश मिळेल. व्यापार-व्यवसायात सावधगिरी बाळगा. अधिकार्‍यांपासून दूर राहा.</p>
                            </div>

                            <h3>कन्या</h3>
                            <div>
                                <p>धार्मिक कार्यांमध्ये खर्च होण्याची शक्यता आहे. मित्रांचे सहकार्य मिळाल्याने महत्वाची कार्य पूर्ण होतील. आरोग्य उत्तम राहील. मान- सन्मानात वाढ होईल.</p>
                            </div>

                            <h3>तूळ</h3>
                            <div>
                                <p>भावनांच्या भरात वाहून नुकसान होण्याची शक्यता आहे. शेअरमध्ये गुंतवणुक करु नका. कौटुंबिक आनंदाचे वातावरण राहील. आरोग्य उत्तम राहील.</p>
                            </div>

                            <h3>वृश्चिक</h3>
                            <div>
                                <p>विशिष्ट व्यक्तिंचा सहयोग मिळेल. नोकरीपेशा व्यक्तिंना अनुकूल वातावरण मिळेल. राजकारणी व्यक्तिंना आपल्या उद्देश्यात यश मिळेल.</p>
                            </div>

                             <h3>धनु</h3>
                            <div>
                                <p>महत्त्वाचे कार्य यशस्वीरीत्या पूर्ण होतील. शत्रू पराभूत होतील व राजकीय विषयांमध्ये आपल्यासाठी काळ अनुकूल ठरेल व कौटुंबिक सुख वाढेल.</p>
                            </div>

                            >';
        $this->load->view('index', $result);
    }

    public function getWebsiteData()
    {
        $new_type = array(BANNER => 10, PIMPRI => 3, CHINCHWAD => 3, BHOSARI => 3, PUNE => 3, MAHARASHTRA => 3, PUNEGRAMIN => 3, DESH => 3, VIDESH => 3, KRIDA => 3, NOTIFICATION => 6, ELECTION => 10, VISHESH => 3, LIFE_STYLE => 3);
        foreach ($new_type as $key => $value) {
            $news[$key] = $this->pcb_news_model->getAllPcbNews($key, $value);
        }
        $news['breaking'] = $this->pcb_news_model->getBreakingNews();
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
    $result = $this->pcb_news_model->getAdvsertise();
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
}
