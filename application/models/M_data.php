<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

    public function getData($id = null)
    {
        if ($id === null) {

            return $this->db->get('karyawan')->result_array();
        } else {
            return $this->db->get_where('karyawan', ['id' => $id])->result_array();
        }
    }

    public function deleteAPI($id)
    {
        $this->db->delete('karyawan', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function get_data()
    {
        $query = $this->db->select('*')
            ->from('karyawan')
            ->order_by('id', 'DESC')
            ->get()->result_array();
        return $query;
    }

    public function insert($data)
    {
        $this->db->insert('karyawan', $data);
        return TRUE;
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('karyawan', $data);

        return TRUE;
    }

    public function delete($id)
    {
        $this->db->where($id);
        $this->db->delete('karyawan');

        return TRUE;
    }

    public function get_id($id)
    {
        return $this->db->get_where('karyawan', ['id' => $id])->row_array();
    }
}

/* End of file M_data.php */
