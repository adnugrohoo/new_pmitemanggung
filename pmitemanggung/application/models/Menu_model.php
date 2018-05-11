<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

    public function get_menu($pParent=''){
        if ($pParent == 0){
            $this->db->where('submenu_id', $pParent);
        } else {
            $this->db->where('submenu_id != 0');
        }
        $result = $this->db->get('menu_nav');
        return $result->result_array();
    }

    public function get_datatable_menus($start = 0,$limit = 0){
        $this->db->limit($limit,$start);   
        return $this->db->get('menu_nav');
    }
    
    public function total_rows_menus(){ 
        $result = $this->db->get('menu_nav');
        return $result->num_rows();
    }
    
    public function get_books()
     {
          return $this->db->get("books");
     }
     
     function Datatables($dt)
    {
        $columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];

        // $join = $dt['join'];

        $sql  = "SELECT {$columns} FROM {$dt['table']}";


        $data = $this->db->query($sql);

        $rowCount = $data->num_rows();

        $data->free_result();

        // pengkondisian aksi seperti next, search dan limit
        $columnd = $dt['col-display'];
        $count_c = count($columnd);

        // search
        $search = $dt['search']['value'];

        /**
         * Search Global
         * pencarian global pada pojok kanan atas
         */
        $where = '';
        if ($search != '') {   
            for ($i=0; $i < $count_c ; $i++) {
                $where .= $columnd[$i] .' LIKE "%'. $search .'%"';
                
                if ($i < $count_c - 1) {
                    $where .= ' OR ';
                }
            }
        }
        
        /**
         * Search Individual Kolom
         * pencarian dibawah kolom
         */
        for ($i=0; $i < $count_c; $i++) { 
            $searchCol = $dt['columns'][$i]['search']['value'];
            if ($searchCol != '') {
                $where = $columnd[$i] . ' LIKE "%' . $searchCol . '%" ';
                break;
            }
        }

        /**
         * pengecekan Form pencarian
         * pencarian aktif jika ada karakter masuk pada kolom pencarian.
         */
        if ($where != '') {
            $sql .= " WHERE " . $where;
            
        }
        
        // sorting
        $sql .= " ORDER BY {$columnd[$dt['order'][0]['column']]} {$dt['order'][0]['dir']}";
        
        // limit
        $start  = $dt['start'];
        $length = $dt['length'];

        $sql .= " LIMIT {$start}, {$length}";
        
        $list = $this->db->query($sql);

        /**
         * convert to json
         */
        $option['draw']            = $dt['draw'];
        $option['recordsTotal']    = $rowCount;
        $option['recordsFiltered'] = $rowCount;
        $option['data']            = array();

        foreach ($list->result() as $row) {
        /**
         * custom gunakan
         * $option['data'][] = array(
         *                       $row->columnd[0],
         *                       $row->columnd[1],
         *                       $row->columnd[2],
         *                       $row->columnd[3],
         *                       $row->columnd[4],
         *                       .....
         *                     );
         */
        //  $option['data'][] = array(
        //                         $row->columnd[0],
        //                         $row->columnd[1],
        //                         $row->columnd[2],
        //                         $row->columnd[3]
        //                       );
           $rows = array();
           for ($i=0; $i < $count_c; $i++) { 
               $rows[] = $row->$columnd[$i];

           }
           
            // $rows[] = array(
            //     'invoice_no' => $r->invoice_no,
            //     'nama_event' => $r->nama_event,
            //     'user_id' => $r->user_id,
            //     'status_name' => $r->status_name,
            //     'time_book' => $r->time_book,
            //     'provider' => $r->provider,
            //     'nama_bank' => $r->channel_bank,
            //     'buttonIssued' => '<button type="button" name="cancel" class="btn btn-success issued_hotel" id="'.$r->trx_id.'"><span class="fa fa-check fa-xs"></span></button>',
            //     'buttonCancel' => '<button type="button" name="cancel" class="btn btn-danger cancel_hotel" id="'.$r->trx_id.'"><span class="fa fa-remove fa-xs"></span></button>'
            // );
           $option['data'][] = $rows;
        }

        // eksekusi json
        echo json_encode($option);

    }

    function barang_list($start,$limit){
        $this->db->limit($limit,$start);
        $hasil = $this->db->get("tbl_barang");
        return $hasil->result();
    }
}