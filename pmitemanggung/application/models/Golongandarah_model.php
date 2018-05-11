<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golongandarah_model extends CI_Model {
	var $table = 'pendonor';
  var $column_order = array('pendonorNo','pendonorName','pendonorGender','pendonorAddress','pendonorBirthDate',null); //set column field database for datatable orderable
  var $column_search = array('pendonorNo','pendonorName','pendonorAddress'); //set column field database for datatable searchable just firstname , lastname , address are searchable
  var $order = array('pendonorId' => 'desc'); // default order 

  public function __construct() {
  
    parent::__construct();
    $this->load->database();
      
	}
  
  function get_data()
  {
    // $this->db->select('comGolonganDarahName');
    $query = $this->db->get('comgolongandarah');
    return $query->result();
  }
}