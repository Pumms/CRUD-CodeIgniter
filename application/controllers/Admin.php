<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['menu_breadcrumbs'] = $this->uri->segment(1);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'User Role';
        $data['menu_breadcrumbs'] = $this->uri->segment(1);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['menu_breadcrumbs'] = $this->uri->segment(1);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akses telah berhasil diubah!</div>');
    }

    public function edit($role_id)
    {
        $data['title'] = 'Edit Role';
        $data['menu_breadcrumbs'] = $this->uri->segment(1);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $data = $this->input->post('role', true);
            $id = $this->input->post('id', true);
            $this->db->where('id', $id);
            $this->db->update('user_role', ['role' => $data]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil diubah!</div>');
            redirect('admin/role');
        }
    }
    public function tambah()
    {
        $data['title'] = 'Tambah Role';
        $data['menu_breadcrumbs'] = $this->uri->segment(1);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            $data = $this->input->post('role', true);
            $this->db->insert('user_role', ['role' => $data]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil ditambahkan!</div>');
            redirect('admin/role');
        }
    }

    public function hapus($role_id)
    {
        $this->db->where('id', $role_id);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil dihapus!</div>');
        redirect('admin/role');
    }
}
