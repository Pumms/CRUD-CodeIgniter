<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_model
{
    public function menu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function addmenu()
    {
        $this->db->insert('user_menu', ['menu' => $this->input->post('menu', true)]);
    }

    public function submenu()
    {
        $query = "SELECT * FROM user_menu JOIN user_sub_menu ON user_menu.id = user_sub_menu.menu_id ORDER BY user_sub_menu.id ASC";
        return $this->db->query($query)->result_array();
    }

    public function addsubmenu()
    {
        $data = [
            'title' => $this->input->post('title', true),
            'menu_id' => $this->input->post('menu', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => $this->input->post('is_active', true)
        ];
        $this->db->insert('user_sub_menu', $data);
    }
}
