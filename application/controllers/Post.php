

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Account_model');
        $this->load->model('Post_model');
        $this->load->library('form_validation');
        $this->load->helper('date');
        $this->load->helper('text');
        date_default_timezone_set("Asia/Singapore");
    }

    // | SCHOOL ANNOUNCEMENT FUNCTIONALITIES |

    public function announce()
    {
        $config['upload_path']          = './images/posts/';
        $config['allowed_types']        = 'gif|jpg|png|JPG';
        $config['max_size']             = 512;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('caption', 'Caption', 'strip_tags');
        if (empty($this->input->post('caption')) && !$this->upload->do_upload('attachment')) {
            redirect('Admin/academic_calendar');
        } else {

            if ($this->form_validation->run() == FALSE) {
                redirect('Admin/academic_calendar');
            } else {
                if (!$this->upload->do_upload('attachment')) {
                    $data['msg'] = array('success' => 'Image successfully uploaded');

                    $data1 = array(
                        'post_account_id' => $this->session->acc_number,
                        'post_caption' => $this->input->post('caption'),
                        'post_created' => time()
                    );
                    $this->Post_model->announce($data1);
                } else {
                    $data['msg'] = array('success' => 'Image successfully uploaded');
                    $data = array('upload_data' => $this->upload->data());
                    $filename = $data['upload_data']['file_name'];

                    $data1 = array(
                        'post_account_id' => $this->session->acc_number,
                        'post_caption' => $this->input->post('caption'),
                        'post_image' => $filename,
                        'post_created' => time()
                    );

                    $this->Post_model->announce($data1);

                    $this->load->library('image_lib');

                    $config1['image_library'] =  'gd2';
                    $config1['source_image'] = './images/posts/' . $filename;
                    $config1['new_image'] = './images/posts/processed/';
                    $config1['maintain_ratio'] = TRUE;
                    $config1['width']         = 500;
                    $config1['height']       = 500;

                    $this->image_lib->initialize($config1);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }
                redirect('Admin/academic_calendar');
            }
        }
    }

    public function updatePost($post_id)
    {
        $config['upload_path']          = './images/posts/';
        $config['allowed_types']        = 'gif|jpg|png|JPG';
        $config['max_size']             = 512;
        $config['max_width']            = 2048;
        $config['max_height']           = 2048;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('caption', 'Caption', 'strip_tags');

        if ($this->form_validation->run() == FALSE) {
            redirect('Admin/academic_calendar');
        } else {
            if (!$this->upload->do_upload('attachment')) {
                $data['msg'] = array('success' => 'Image successfully uploaded');
                $fullname = $this->session->Firstname . ' ' . $this->session->Lastname;
                $data = array(
                    'post_caption' => $this->input->post('caption'),
                    'post_edited' => time()
                );
                $this->Post_model->updatePost($post_id, $data);
            } else {
                $data['msg'] = array('success' => 'Image successfully uploaded');
                $data = array('upload_data' => $this->upload->data());
                $filename = $data['upload_data']['file_name'];
                $fullname = $this->session->Firstname . ' ' . $this->session->Lastname;

                $data = array(
                    'post_account' => $fullname,
                    'post_caption' => $this->input->post('caption'),
                    'post_image' => $filename,
                    'post_edited' => time()
                );

                $this->Post_model->updatePost($post_id, $data);

                $this->load->library('image_lib');

                $config1['image_library'] =  'gd2';
                $config1['source_image'] = './images/posts/' . $filename;
                $config1['new_image'] = './images/posts/processed/';
                $config1['maintain_ratio'] = TRUE;
                $config1['width']         = 500;
                $config1['height']       = 500;

                $this->image_lib->initialize($config1);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
            redirect('Admin/academic_calendar');
        }
    }

    public function fetchPost($post_id)
    {
        $data = $this->Post_model->fetchPost($post_id);
        $this->load->view('includes_admin/admin_header');
        $this->load->view('includes_admin/admin_topnav');
        $this->load->view('includes_admin/admin_sidebar');

        $this->load->view('content_admin/school_announcements/view', $data);

        $this->load->view('includes_admin/admin_contentFooter');
        $this->load->view('includes_admin/admin_rightnav');
        $this->load->view('includes_admin/admin_footer');
    }

    public function announcement($post_id)
    {
        $data = $this->Post_model->fetchPost($post_id);
        $this->load->view('includes_student/student_header');
        $this->load->view('includes_student/student_topnav');
        $this->load->view('includes_student/student_sidebar');

        $this->load->view('content_student/student_view_announcement', $data);

        $this->load->view('includes_student/student_contentFooter');
        $this->load->view('includes_student/student_rightnav');
        $this->load->view('includes_student/student_footer');
    }

    public function deletePost($post_id)
    {
        $this->Post_model->deletePost($post_id);
        redirect('Admin/academic_calendar');
    }

    public function editPost($post_id)
    {
        $data = $this->Post_model->fetchPost($post_id);
        $this->load->view('includes_admin/admin_header');
        $this->load->view('includes_admin/admin_topnav');
        $this->load->view('includes_admin/admin_sidebar');

        $this->load->view('content_admin/school_announcements/edit', $data);

        $this->load->view('includes_admin/admin_contentFooter');
        $this->load->view('includes_admin/admin_rightnav');
        $this->load->view('includes_admin/admin_footer');
    }

    // | END OF SCHOOL ANNOUNCEMENT FUNCTIONALITIES |
}
