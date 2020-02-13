<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header.php', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer.php');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //Cek email sudah aktivasi atau belum
            if ($user['is_active'] == 1) {
                //Cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This Email has not been activited</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not Registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        //Validasi untuk mengecek elemen input
        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[32]', [
            'required' => 'Please fill this field',
            'max_length' => 'Name is too long'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Please fill this field',
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Please fill this field',
            'matches' => 'Password dont Match!',
            'min_length' => 'Password too Short'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        //kondisi ketika menjalankan validasi
        if ($this->form_validation->run() == false) {
            //kondisi apabila validiasi false
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header.php', $data);
            $this->load->view('auth/registration.php');
            $this->load->view('templates/auth_footer.php');
        } else {
            //kondisi apabila validasi true
            $email = $this->input->post('email', true);
            //Ambil nilai dari data yang di input dengan array
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            //siapkan token
            $token = base64_encode(random_bytes(32));

            if ($this->_sendEmail($token, 'verify')) {
                $usertoken = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                //Insert data ke database
                $this->db->insert('user', $data);
                $this->db->insert('user_token', $usertoken);
            }
            //Untuk membuat alert dengan session
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratuliations! Your account has beed Created! Please check your email to activation</div>');
            //mengganti halaman ketika sudah daftar
            redirect('auth');
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $verify_email = $this->db->get_where('user', ['email' => $email])->row_array();
        $verify_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

        if ($verify_email) {
            if ($verify_token) {
                //fitur waktu untuk token aktivasi
                if (time() - $verify_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated, please login.</div>');
                    redirect('auth');
                } else {
                    //jika tidak di aktiviasi user akan di hapus beserta token
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['token' => $token]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation Failed!, Link Expired!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation Failed!, Code invalid!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation Failed!, Wrong Email!</div>');
            redirect('auth');
        }
    }

    public function forgotpassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header.php', $data);
            $this->load->view('auth/forgot-password.php');
            $this->load->view('templates/auth_footer.php');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));

                if ($this->_sendEmail($token, 'forgot')) {
                    $usertoken = [
                        'email' => $email,
                        'token' => $token,
                        'date_created' => time()
                    ];

                    $this->db->insert('user_token', $usertoken);

                    //Insert data ke database
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email not registered or activated!</div>');
                redirect('auth');
            }
        }
    }

    public function forgotpass()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $verify_email = $this->db->get_where('user', ['email' => $email])->row_array();
        $verify_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

        if ($verify_email) {
            if ($verify_token) {
                //fitur waktu untuk token aktivasi
                //detik * menit * jam
                if (time() - $verify_token['date_created'] < (60 * 30)) {
                    $this->session->set_userdata('email_user', $email);
                    $this->changepassword();
                } else {
                    //jika tidak di klik dalam waktu 30 menit token akan dihapus
                    $this->db->delete('user_token', ['token' => $token]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry Link Expired</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation Failed!, Code invalid!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password Failed!, Wrong Email!</div>');
            redirect('auth');
        }
    }

    public function changepassword()
    {
        if (!$this->session->userdata('email_user')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header.php', $data);
            $this->load->view('auth/change-password.php');
            $this->load->view('templates/auth_footer.php');
        } else {
            $email = $this->session->userdata('email_user');
            $password = $this->input->post('password1');
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $this->db->set('password', $password_hash);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('email_user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been change, Please login</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'jubarkas.web@gmail.com',
            'smtp_pass' => 'jubarkas123',
            'smtp_port' => 465,
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        // $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->from('Belajar CI', 'Test Send Email');
        $this->email->to($this->input->post('email'));

        if ($type == "verify") {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Activate </a>');
        } else {
            $this->email->subject('Forgot Password');
            $this->email->message('Click this link to Reset your Password : <a href="' . base_url() . 'auth/forgotpass?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Forgot Password </a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            // echo $this->email->print_debugger();
            // die;

            //simbol ' = &apos;
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to send Email, We&apos;re so sorry :(</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Your have been logout!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked.php');
    }
}
