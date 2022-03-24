<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Persons_controller extends CI_Controller
{
    public $databaseName = '';

    public function __construct()
    {
        parent::__construct();
        force_ssl();
        $this->session_data = $this->session->userdata($this->getSessionName());
        if ($this->session->userdata($this->getSessionName())) {
            $explodedData = explode('-', strrev($this->session_data['esnecil']));
            $this->databaseName = $explodedData[1];
        } else {
            redirect('Login');
        }
        $this->load->model('Persons_model');
    }

    public function Get_Persons_With_Category_SelectBox_C($Category)
    {
        echo(json_encode($this->Persons_model->Get_Persons_With_Category_SelectBox($Category)));
    }

    public function Get_Persons_With_Category_SelectBoxNew_C($Category)
    {
        echo(json_encode($this->Persons_model->Get_Persons_With_Category_SelectBoxNew($Category)));
    }

    public function Get_Person_With_id_SelectBox_C($id)
    {
        echo json_encode($this->Persons_model->Get_Person_With_id($id));
    }

    public function Get_All_Persons_C()
    {
        echo json_encode($this->Persons_model->Get_All_Persons_new());
    }

    public function Get_All_Persons_Barcode_C()
    {
        echo json_encode($this->Persons_model->Get_All_Persons_Barcode($this->input->post('ids')));
    }

    public function Get_All_Persons_Selectbox_C()
    {
        echo json_encode($this->Persons_model->Get_All_Persons_Selectbox());
    }

    public function UnDel_Person_Batch_C()
    {
        $data = $this->input->post('BatchWork');
        echo $this->Persons_model->UnDel_Person_Batch($data);
    }

    public function Del_Person_Batch_C()
    {
        $data = $this->input->post('BatchWork');
        echo json_encode($this->Persons_model->Del_Person_Batch($data));
    }

    public function Move_To_Category_Batch_C()
    {
        $data = $this->input->post('BatchWork');
        $Category = $this->input->post('CategoryId');
        echo $this->Persons_model->Move_To_Category_Batch($data, $Category);
    }

    public function Move_To_City_Batch_C()
    {
        $data = $this->input->post('BatchWork');
        $City = $this->input->post('CityId');
        echo $this->Persons_model->Move_To_City_Batch($data, $City);
    }

    public function Get_All_Person_Category_C()
    {
        echo json_encode($this->Persons_model->Get_All_Persons_Category());
    }

    public function Get_All_Person_Category_Limited_C()
    {
        echo json_encode($this->Persons_model->Get_All_Persons_Category_Limited());
    }

    public function Get_All_Person_CategoryOld_C()
    {
        echo json_encode($this->Persons_model->Get_All_Person_CategoryOld());
    }

    public function Get_All_Person_City_C()
    {
        echo json_encode($this->Persons_model->Get_All_Persons_City());
    }

    public function Get_All_Category_C()
    {
        echo json_encode($this->Persons_model->Get_All_Person_CategoryOld());
    }

    public function Get_All_Category_Parent_C()
    {
        echo json_encode($this->Persons_model->Get_All_Persons_Category_Parent());
    }

    public function Get_All_Citys_C()
    {
        echo json_encode($this->Persons_model->Get_All_Citys());
    }

    public function Persons_Manager()
    {
        if (isset($this->session_data['FA']) || isset($this->session_data['Persons'])) {
            $data = $this->getLang($this->Menu_Navbar, ['Category_lang', 'Cities_lang']);
            $data['Name'] = $this->session_data['PersonFullName'];
            $data['Level'] = 1;
            $data['Sahab_Page_title'] = 'مدیریت اشخاص';
            $data['Sahab_Page_heading'] = 'مدیریت اشخاص';
            $this->load->view('Persons_view', $data);
        } else {
            redirect('Login');
        }
    }

    public function Persons_Category_Manager()
    {
        if (isset($this->session_data['FA']) || isset($this->session_data['Persons'])) {
            $data = $this->getLang($this->Menu_Navbar);
            $data['Name'] = $this->session_data['PersonFullName'];
            $data['Level'] = 1;
            $data['Sahab_Page_title'] = 'مدیریت دسته بندی اشخاص';
            $data['Sahab_Page_heading'] = 'مدیریت دسته بندی اشخاص';
            $this->load->view('Person_Category_view', $data);
        } else {
            redirect('Login');
        }
    }

    public function Persons_City_Manager()
    {
        if (isset($this->session_data['FA']) || isset($this->session_data['Persons'])) {
            $data = $this->getLang($this->Menu_Navbar);
            $data['Name'] = $this->session_data['PersonFullName'];
            $data['Level'] = 1;
            $data['Sahab_Page_title'] = 'مدیریت استان های اشخاص';
            $data['Sahab_Page_heading'] = 'مدیریت استان های اشخاص';
            $this->load->view('Person_City_view', $data);
        } else {
            redirect('Login');
        }
    }

    public function Get_Persons_With_Category_C($Category)
    {
        echo(json_encode($this->Persons_model->Get_Persons_With_Category($Category)));
    }

    public function Get_Persons_Categorys_With_Category_C($Category)
    {
        echo(json_encode($this->Persons_model->Get_Persons_Categorys_With_Category($Category)));
    }

    public function Get_Persons_With_Category_And_City_C()
    {
        echo(json_encode($this->Persons_model->Get_Persons_With_Category_And_City($this->input->post('Category'), $this->input->post('City'))));
    }

    public function Get_Persons_With_Category_And_City_And_Status_C()
    {
        echo(json_encode($this->Persons_model->Get_Persons_With_Category_And_City_And_Status($this->input->post('Category'), $this->input->post('City'), $this->input->post('Statusid'))));
    }

    public function Get_Searched_Persons_C()
    {
        echo(json_encode($this->Persons_model->Get_Searched_Persons($this->input->post('id'), $this->input->post('Name'), $this->input->post('LName'), $this->input->post('Company'), $this->input->post('Email'), $this->input->post('Mobile'), $this->input->post('Category'), $this->input->post('City'), $this->input->post('StartDate'), $this->input->post('EndDate'), $this->input->post('ScoreFrom'), $this->input->post('ScoreTo'))));
    }

    public function Get_Searched_Persons_Category_C()
    {
        $data['PrC'] = $this->Persons_model->Get_Searched_Category_Persons($this->input->post('id'), $this->input->post('Name'), $this->input->post('Category'), $this->input->post('StartDate'), $this->input->post('EndDate'));
        $data['PrCAllL1'] = $this->Persons_model->Get_Persons_With_Level_Category_Limited(1);
        $data['PrCAllL2'] = $this->Persons_model->Get_Persons_With_Level_Category_Limited(2);
        $data['PrCAllL3'] = $this->Persons_model->Get_Persons_With_Level_Category_Limited(3);
        echo json_encode($data);
    }

    public function Get_Searched_Persons_Citys_C()
    {
        echo(json_encode($this->Persons_model->Get_Searched_City_Persons($this->input->post('id'), $this->input->post('Name'))));
    }

    public function Set_Person_C()
    {
        $data = array(
            'Name' => $this->input->post('Name'),
            'LName' => $this->input->post('LName'),
            'Company' => $this->input->post('Company'),
            'Category' => $this->input->post('Category'),
            'Address' => $this->input->post('Address'),
            'City' => $this->input->post('City'),
            'Phone' => $this->input->post('Phone'),
            'LastAction' => '',
            'LastPayment' => '',
            'About' => $this->input->post('About'),
            'Mobile' => $this->input->post('Mobile'),
            'Email' => $this->input->post('Email'),
            'PostalCode' => $this->input->post('PostalCode'),
            'BusinesCode' => $this->input->post('BusinesCode'),
            'Credit_limit' => $this->input->post('credit_limit'),
            'RegisterDate' => date('Y-m-d'),
            'Status' => '1'
        );
        echo $this->Persons_model->Set_Person_Persons($data);
    }

    public function Set_Person_Quick_C()
    {
        $data = array(
            'Name' => $this->input->post('Name'),
            'LName' => $this->input->post('LName'),
            'Company' => '',
            'Category' => $this->input->post('Category'),
            'Address' => $this->input->post('Address'),
            'City' => '',
            'Phone' => '',
            'LastAction' => '',
            'LastPayment' => '',
            'About' => '',
            'Mobile' => $this->input->post('Mobile'),
            'Email' => '',
            'PostalCode' => '',
            'BusinesCode' => '',
            'RegisterDate' => date('Y-m-d'),
            'Status' => '1'
        );
        echo $this->Persons_model->Set_Person_Persons($data);
    }

    public function Set_Persons_Category_C()
    {
        if ($this->input->post('Parent') == 'WithoutParent') {
            $data = array(
                'Name' => $this->input->post('Name'),
                'Extend' => '',
                'About' => $this->input->post('About'),
                'Level' => '1',
                'RegisterDate' => date('Y-m-d'),
                'Status' => '1'

            );
        } else {
            $data = array(
                'Name' => $this->input->post('Name'),
                'Extend' => $this->input->post('Parent'),
                'About' => $this->input->post('About'),
                'Level' => $this->input->post('Level'),
                'RegisterDate' => date('Y-m-d'),
                'Status' => '1'

            );
        }
        echo $this->Persons_model->Add_Person_Category($data);
    }

    public function Set_Persons_City_C()
    {
        $data = array(
            'Name' => $this->input->post('Name'),
            'Status' => '1'
        );
        echo $this->Persons_model->Add_Person_City($data);
    }

    public function Set_Person_Edit_C()
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Edit']) || $this->session_data['Edit'] == '1') {
            $id = $this->input->post('id');
            $data = array(
                'Name' => $this->input->post('Name'),
                'LName' => $this->input->post('LName'),
                'Company' => $this->input->post('Company'),
                'Category' => $this->input->post('Category'),
                'Address' => $this->input->post('Address'),
                'City' => $this->input->post('City'),
                'Phone' => $this->input->post('Phone'),
                'LastAction' => '',
                'LastPayment' => '',
                'About' => $this->input->post('About'),
                'Mobile' => $this->input->post('Mobile'),
                'Email' => $this->input->post('Email'),
                'PostalCode' => $this->input->post('PostalCode'),
                'BusinesCode' => $this->input->post('BusinesCode')
            );
            echo $this->Persons_model->Update_Person_Persons($data, $id);
        } else {
            echo 'AccessDenied';
        }
    }

    public function Set_Person_Category_Edit_C()
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Edit']) || $this->session_data['Edit'] == '1') {
            $id = $this->input->post('id');
            if ($this->input->post('Parent') == 'WithoutParent') {
                $data = array(
                    'Name' => $this->input->post('Name'),
                    'Extend' => '',
                    'About' => $this->input->post('About'),
                    'Level' => '1',
                    'RegisterDate' => date('Y-m-d')
                );
            } else {
                $data = array(
                    'Name' => $this->input->post('Name'),
                    'Extend' => $this->input->post('Parent'),
                    'About' => $this->input->post('About'),
                    'Level' => $this->input->post('Level'),
                    'RegisterDate' => date('Y-m-d')
                );
            }
            echo $this->Persons_model->Update_Person_Category($data, $id);
        } else {
            echo 'AccessDenied';
        }
    }

    public function Set_Person_City_Edit_C()
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Edit']) || $this->session_data['Edit'] == '1') {
            $id = $this->input->post('id');
            $data = array(
                'Name' => $this->input->post('Name'),
            );
            echo $this->Persons_model->Update_Person_City($data, $id);
        } else {
            echo 'AccessDenied';
        }
    }

    public function Set_Person_Category_State_C()
    {
        $id = $this->input->post('id');
        $State = $this->input->post('state');
        $data = array(
            'Status' => $State
        );
        echo $this->Persons_model->Set_Person_Category_State($data, $id);
    }

    public function Set_Person_City_State_C()
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Edit']) || $this->session_data['Edit'] == '1') {
            $id = $this->input->post('id');
            $State = $this->input->post('state');
            $data = array(
                'Status' => $State
            );
            echo $this->Persons_model->Set_Person_City_State($data, $id);
        } else {
            echo 'AccessDenied';
        }
    }

    public function Set_Person_State_C()
    {
        $id = $this->input->post('id');
        $State = $this->input->post('state');
        $data = array(
            'Status' => $State
        );
        echo $this->Persons_model->Set_Person_State($data, $id);
    }

    public function Del_Person_C($data)
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Delete']) || $this->session_data['Delete'] == '1') {
            echo $this->Persons_model->Del_Person_Persons($data);
        } else {
            echo 'AccessDenied';
        }
    }

    public function UnDel_Person_C($data)
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Delete']) || $this->session_data['Delete'] == '1') {
            echo $this->Persons_model->UnDel_Person_Persons($data);
        } else {
            echo 'AccessDenied';
        }
    }

    public function Del_Persons_Category_C($data)
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Delete']) || $this->session_data['Delete'] == '1') {
            echo $this->Persons_model->Del_Category_Persons($data);
        } else {
            echo 'AccessDenied';
        }
    }

    public function Del_Persons_City_C($data)
    {
        if (isset($this->session_data['FA']) || $this->session_data['FA'] == '1' || isset($this->session_data['Persons']) || $this->session_data['Persons'] == '1' || isset($this->session_data['Delete']) || $this->session_data['Delete'] == '1') {
            echo $this->Persons_model->Del_City_Persons($data);
        } else {
            echo 'AccessDenied';
        }
    }

    public function Get_Person_Detail($data)
    {
        echo(json_encode($this->Persons_model->Get_Person_With_id($data)));
    }

    public function Get_Person_Category_Detail($data)
    {
        echo(json_encode($this->Persons_model->Get_Person_Category_With_id($data)));
    }

    public function Get_Person_City_Detail($data)
    {
        echo(json_encode($this->Persons_model->Get_Person_City_With_id($data)));
    }


    /*------------ Reminder -------------*/
    public function Set_Reminder()
    {
        $this->load->model('admin/Manager_Reminder_model');
        $data = $this->input->post();
        $res = $this->Persons_model->Get_Person_With_id($data['userId']);
        $arr = [
            'Status' => 0,
            'Active' => 1,
            'Mobile' => $res[0]->Mobile,
            'Name' => $res[0]->Name,
            'LName' => $res[0]->LName,
        ];
        $data = array_merge($data, $arr);

        $this->Manager_Reminder_model->Add_Reminder($data);
    }

    public function get_person_inventory()
    {
        echo json_encode($this->Persons_model->get_person_inventory($this->input->post('id')));
    }

    public function get_person_credit_limit()
    {
        echo json_encode($this->Persons_model->get_person_credit_limit($this->input->post('id')));
    }


//    public function setEvent()
//    {
//        $personId=$this->input->post('personId');
//        $subject=$this->input->post('subject');
//        $body=$this->input->post('body');
//        $category=$this->input->post('category');
//
//        echo $this->Persons_model->setEvent($personId,$subject,$body,$category);
//    }


    public function Send_Sms_Single_C()
    {
        $token = $this->session_data['token'];
        $Message = $this->input->post('Message');
        $Mobile = $this->input->post('Mobile');
        $this->load->library('smsCore');
        $smsCorev = new smsCore();
        date_default_timezone_set("Asia/Tehran");
        $SendDateTime = date("Y-m-d") . "T" . date("H:i:s");
        echo $smsCorev->SendMessage(array($Mobile), $Message,$token, $SendDateTime);
    }

    public function Send_Sms_Bulk_C()
    {
        $BatchWork = $this->input->post('BatchWork');
        $token = $this->session_data['token'];
        $Message = $this->input->post('Message');
        $MobileBatchWork = $this->input->post('MobileBatchWork');
        $this->load->library('smsCore');
        $smsCorev = new smsCore();
        date_default_timezone_set("Asia/Tehran");
        $SendDateTime = date("Y-m-d") . "T" . date("H:i:s");
        echo $smsCorev->SendMessage($MobileBatchWork, $Message,$token, $SendDateTime);
    }
    /*------------ Avanak -------------*/

    public function sendSmsCall()
    {
        $this->load->library('encryption');
        $token = $this->encryption->decrypt($this->session_data['token']);
        $Message = $this->input->post('Message');
        $Mobile = $this->input->post('Mobile');
        $repeat = $this->input->post('repeat');
        $this->load->library('Avanak');
        $Avanak = new Avanak();
        $FullMessage = $Message;

        if ($repeat == 'on') {
            $FullMessage = $Message . '، بازخوانی: ' . $Message;
        }
        $result = $Avanak->GenerateTTS($FullMessage);
        if ($result == 'Err') {
            echo 0;
            return;
        }
        $data['messageId'] = $result->GenerateTTSResult;
        $data['numbers'] = "$Mobile";
        $res = $Avanak->CreateCampaign($data);
        $campaignId = $res->CreateCampaignResult;
        if ($res == 'Err') {
            echo 0;
            return;
        } else {
            $this->load->model('Avanak_model');
            echo $this->Avanak_model->sendSmsCall($data['numbers'], $data['messageId'], $Message, $campaignId, $repeat, 1,$token);
        }
        //echo json_encode($res);
//        $res=$Avanak->QuickSendWithTTS($Message,"$Mobile");
//        if ($res == 'Err'){
//            echo 0;
//            return;
//        }else{
//            $this->load->model('Avanak_model');
//            echo $this->Avanak_model->sendSmsCall("$Mobile",$res->QuickSendWithTTSResult,$Message,0,$repeat,1);
//        }
    }

    public function SendSmsCall_Bulk()
    {
        $this->load->library('encryption');
        $token = $this->encryption->decrypt($this->session_data['token']);
//        $BatchWork = $this->input->post('BatchWork');
        $Message = $this->input->post('Message');
        $repeat = $this->input->post('repeat');
        $MobileBatchWork = $this->input->post('MobileBatchWork');
        $this->load->library('Avanak');
        $Avanak = new Avanak();
        $FullMessage = $Message;
        if ($repeat == 'on') {
            $FullMessage = $Message . '. بازخوانی پیام:' . $Message;
        }
        $result = $Avanak->GenerateTTS($FullMessage);
        if ($result == 'Err') {
            echo 0;
            return;
        }
        $data['messageId'] = $result->GenerateTTSResult;
        $data['numbers'] = '';
        foreach ($MobileBatchWork as $mobile) {
            $data['numbers'] .= $mobile . ",";
        }
//        $data['numbers']="$Mobile";
        $res = $Avanak->CreateCampaign($data);
        $campaignId = $res->CreateCampaignResult;

        if ($res == 'Err') {
            echo 0;
            return;
        } else {
            $this->load->model('Avanak_model');
            echo $this->Avanak_model->sendSmsCall($data['numbers'], $data['messageId'], $Message, $campaignId, $repeat, count($MobileBatchWork),$token);
        }
    }


    public function Get_Persons_With_Search_c()
    {
        echo json_encode($this->Persons_model->Get_Persons_With_Search($this->input->post('term')));
    }
    public function UploadExcel()
    {
        $this->load->library('upload');
        $category = $this->input->post('category');
        $city = $this->input->post('city');
        $credit_limit =preg_replace('/[^\d]/', '', $this->input->post('credit_limit'));

        $config['upload_path'] = "./assets/Excel";
        $config['allowed_types'] = "xlsx";
        $config['file_name'] = date('dmYHis');

        $this->upload->initialize($config);

        $this->upload->do_upload('fileExcel');

        $data_upload_files = $this->upload->data();
        $path = $data_upload_files['full_path'];
        $this->ExcelReading($path, $category, $city,$credit_limit);
    }
    public function ExcelReading($file_path, $category, $city,$credit_limit)
    {
        $dataExcel = array();
        include APPPATH . 'libraries/PHPExcel/Classes/PHPExcel/IOFactory.php';
        $objPHPExcel = PHPExcel_IOFactory::load($file_path);
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        $arrayCount = count($allDataInSheet);
        $this->load->library('encryption');
        for ($i = 2; $i <= $arrayCount; $i++) {
            if($allDataInSheet[$i]["A"] != '' && $allDataInSheet[$i]["B"] != ''){
                $excel['Name'] = $allDataInSheet[$i]["A"];
                $excel['LName'] = $allDataInSheet[$i]["B"];
                $excel['EMail'] = $allDataInSheet[$i]["C"];
                $excel['Barcode'] = $allDataInSheet[$i]["D"];
                $excel['Company'] = $allDataInSheet[$i]["E"];
                $excel['Mobile'] = $allDataInSheet[$i]["F"];
                $excel['Phone'] = $allDataInSheet[$i]["G"];
                $excel['Category'] = $category;
                $excel['City'] = $city;
                $excel['UserName'] = $excel['EMail'];
                $excel['EncryptData'] = $verifyCodeEncrypt = $this->encryption->encrypt($excel['Barcode']);;
                $excel['RegisterDate'] = date('Y-m-d');
                $excel['Status'] = '1';
                $excel['Active'] = '1';
                array_push($dataExcel, $excel);
            }

        }
        //echo json_encode($dataExcel);
        echo $this->Persons_model->Set_Person_All($dataExcel);
    }
}