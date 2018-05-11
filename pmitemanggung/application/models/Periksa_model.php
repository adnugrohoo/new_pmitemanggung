<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periksa_model extends CI_Model {
	var $table = 'periksa';
    var $column_order = array('pendonorNo','pendonorName','periksaTanggal','periksaTensi','periksaSuhu','periksaRiwayatMedis','periksaKeputusan',null); //set column field database for datatable orderable
    var $column_search = array('pendonorNo','pendonorName','periksaTanggal', 'periksaTensi', 'periksaSuhu'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('periksaId' => 'desc'); // default order 

    public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    /*
    *  Awal blok fungsi mengambil nilai dari tipe data enum
    */

    function get_enum( $table , $field )
    {
        $query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
        $row = $this->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value; 
        }
        return $enums;
    }
    /*
    *  Akhir blok fungsi mengambil nilai dari tipe data enum
    */

    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
        $this->db->join('pendonor', 'pendonor.pendonorId = periksa.pendonorId');
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                    // $this->db->join('pendonor', 'pendonor.pendonorId = periksa.pendonorId');
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                    // $this->db->join('pendonor', 'pendonor.pendonorId = periksa.pendonorId');
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            // $this->db->join('pendonor', 'pendonor.pendonorId = periksa.pendonorId');
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            // $this->db->join('pendonor', 'pendonor.pendonorId = periksa.pendonorId');
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}