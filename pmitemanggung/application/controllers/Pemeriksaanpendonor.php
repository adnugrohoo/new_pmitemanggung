<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemeriksaanpendonor extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('session','form_validation','pagination'));
	    $this->load->helper(array('url','form','security'));
        // $this->load->model('Pendonor_model','mPeriksa');
        $this->load->model('Menu_model','mMenu');  
        $this->load->model('Periksa_model', 'mPeriksa');      
    }

    public function index(){  
        $logged_in = $this->session->userdata('adminpmi_logged_in') && ($this->session->userdata('adminpmi_level')=='admin');
        if($logged_in){            
            $data['menus'] = $this->mMenu->get_menu(0);
            $data['submenus'] = $this->mMenu->get_menu(1);     
            $data['body'] = "donordarah/v_pemeriksaan";
            $this->load->view('template/home', $data);
        }else{ 
            redirect("Admin/dashboardlogin");
        }
    }

    public function periksa_ajax_list()
    {
        $list = $this->mPeriksa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $periksa) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $periksa['pendonorNo'];
            $row[] = $periksa['pendonorName'];
            $row[] = $periksa['periksaTanggal'];
            $row[] = $periksa['periksaTensi'];
            $row[] = $periksa['periksaSuhu'];
            $row[] = $periksa['periksaRiwayatMedis'];
            $row[] = $periksa['periksaKeputusan'];
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_periksa('."'".$periksa['periksaId']."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_periksa('."'".$periksa['periksaId']."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->mPeriksa->count_all(),
                        "recordsFiltered" => $this->mPeriksa->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // public function ajax_edit($id)
    // {
    //     $data = $this->mPeriksa->get_by_id($id);
    //     $data->pendonorBirthDate = ($data->pendonorBirthDate == '0000-00-00') ? '' : $data->pendonorBirthDate; // if 0000-00-00 set tu empty for datepicker compatibility
    //     echo json_encode($data);
    // }
 
    // public function ajax_add()
    // {
    //     $this->_validate();
    //     $data = array(
    //             'pendonorNo' => $this->input->post('pendonorNo'),
    //             'pendonorName' => $this->input->post('pendonorName'),
    //             'pendonorGender' => $this->input->post('pendonorGender'),
    //             'pendonorAddress' => $this->input->post('pendonorAddress'),
    //             'pendonorBirthDate' => $this->input->post('pendonorBirthDate'),
    //         );
    //     $insert = $this->mPeriksa->save($data);
    //     echo json_encode(array("status" => TRUE));
    // }
 
    // public function ajax_update()
    // {
    //     $this->_validate();
    //     $data = array(
    //             'pendonorNo' => $this->input->post('penoonorNo'),
    //             'pendonorName' => $this->input->post('pendonorName'),
    //             'pendonorGender' => $this->input->post('pendonorGender'),
    //             'pendonorAddress' => $this->input->post('pendonorAddress'),
    //             'pendonorBirthDate' => $this->input->post('pendonorBirthDate'),
    //         );
    //     $this->mPeriksa->update(array('pendonorId' => $this->input->post('pendonorId')), $data);
    //     echo json_encode(array("status" => TRUE));
    // }
 
    // public function ajax_delete($id)
    // {
    //     $this->mPeriksa->delete_by_id($id);
    //     echo json_encode(array("status" => TRUE));
    // }
 
 
    // private function _validate()
    // {
    //     $data = array();
    //     $data['error_string'] = array();
    //     $data['inputerror'] = array();
    //     $data['status'] = TRUE;
 
    //     if($this->input->post('pendonorNo') == '')
    //     {
    //         $data['inputerror'][] = 'pendonorNo';
    //         $data['error_string'][] = 'Nomor is required';
    //         $data['status'] = FALSE;
    //     }
 
    //     if($this->input->post('pendonorName') == '')
    //     {
    //         $data['inputerror'][] = 'pendonorName';
    //         $data['error_string'][] = 'Name is required';
    //         $data['status'] = FALSE;
    //     }
 
    //     if($this->input->post('pendonorBirthDate') == '')
    //     {
    //         $data['inputerror'][] = 'pendonorBirthDate';
    //         $data['error_string'][] = 'Date of Birth is required';
    //         $data['status'] = FALSE;
    //     }
 
    //     if($this->input->post('pendonorGender') == '')
    //     {
    //         $data['inputerror'][] = 'pendonorGender';
    //         $data['error_string'][] = 'Please select gender';
    //         $data['status'] = FALSE;
    //     }
 
    //     if($this->input->post('pendonorAddress') == '')
    //     {
    //         $data['inputerror'][] = 'pendonorAddress';
    //         $data['error_string'][] = 'Addess is required';
    //         $data['status'] = FALSE;
    //     }
 
    //     if($data['status'] === FALSE)
    //     {
    //         echo json_encode($data);
    //         exit();
    //     }
    // }
}