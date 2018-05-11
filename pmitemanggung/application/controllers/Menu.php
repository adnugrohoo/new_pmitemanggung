<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {	

	function __construct(){
    parent::__construct();
    $this->load->library(array('session'));
    $this->load->model('Menu_model','mMenu');   
  }

    public function index(){  
        $logged_in = $this->session->userdata('adminpmi_logged_in') && ($this->session->userdata('adminpmi_level')=='admin');
        if($logged_in){            
            $data['menus'] = $this->mMenu->get_menu(0);
            $data['submenus'] = $this->mMenu->get_menu(1);     
            $data['body'] = "menu/v_menu";
            $this->load->view('template/home', $data);
        }else{ 
            redirect("Admin/dashboardlogin");
        }
    }

    function datatables_ajax()
    {
		/** AJAX Handle */
		if( $this->input->is_ajax_request() )  {

			$this->load->model('Menu_model');

			/**
			 * Mengambil Parameter dan Perubahan nilai dari setiap 
 			 * aktifitas pada table
 			 *
			 */
			$datatables  = $_POST;
			$datatables['table']    = 'menu_nav';
			$datatables['id-table'] = 'menu_id';
			
			/**
			 * Kolom yang ditampilkan
			 */
			$datatables['col-display'] = array(
			               'menu',
			               'url',
			               'icon_nav',
			               'isParent'
			             );
			/**
			* menggunakan table join
			*/
			// $datatables['join']    = 'INNER JOIN position ON position = id_position';
			$this->Menu_model->Datatables($datatables);
		}
		return;
    }

    function json(){
        $this->load->library('datatables');
        $this->datatables->add_column('foto', '<img src="http://www.rutlandherald.com/wp-content/uploads/2017/03/default-user.png" width=20>', 'foto');
        $this->datatables->select('first_name, last_name,office,start_date');
        $this->datatables->add_column('action', anchor('menu/edit/.$1','Edit',array('class'=>'btn btn-danger btn-sm')), 'id_karyawan');
        $this->datatables->add_column('action', anchor('menu/edit/.$1','Delete',array('class'=>'btn btn-danger btn-sm')), 'id_karyawan');
        $this->datatables->from('karyawan');
        return print_r($this->datatables->generate());
    }

    function data_barang(){
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data=$this->mMenu->barang_list($start,$length);
        echo json_encode($data);
    }
}