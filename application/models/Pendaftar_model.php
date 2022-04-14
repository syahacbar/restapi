<?php

class Pendaftar_model extends CI_Model
{
    function getPendaftar($id=NULL)
    {
        if($id === NULL) {

            $this->db->select(
                'tb.*, 
                ts.nama_smta AS namasmta,
                (SELECT p1.namaprodi FROM prodi p1 WHERE p1.idprodi=tb.prodipilihan1) AS pilihan1,
                (SELECT p2.namaprodi FROM prodi p2 WHERE p2.idprodi=tb.prodipilihan2) AS pilihan2,
                (SELECT p3.namaprodi FROM prodi p3 WHERE p3.idprodi=tb.prodipilihan3) AS pilihan3,
                (SELECT namajurusan FROM jurusansmta WHERE idjurusansmta=tb.jurusansmta) AS jurusansmta,
                (SELECT namajenissmta FROM jenissmta WHERE idjenissmta=tb.jenissmta) AS jenissmta,
            ');
            $this->db->from('t_biodata tb');
            $this->db->join('t_smta ts', 'ts.id = tb.nama_smta');
            $query = $this->db->get()->result_array();
        } else {
            $query = $this->db->get_where('t_biodata',['idt_biodata' => $id])->result_array();
        }

        return $query;
    }
    function updatePendaftar($data,$id)
    {
        $this->db->update('t_biodata',$data,['idt_biodata' => $id]);
        return $this->db->affected_rows();
    }
}