<?php

class News extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
        $this->load->library('pagination');
    }

    public function index()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect(site_url('user/login'));
        }
        $data['news'] = [];
        $data['title'] = 'News archive';
        $this->load->library('pagination');

        $params = array();
        $limit_per_page = 5;
        $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_records = $this->news_model->get_total();

        if ($total_records > 0) {
            // get current page records
            $data["news"] = $this->news_model->get_news($limit_per_page, $start_index);

            $config['base_url'] = base_url('news/index');
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;

            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = '</ul>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';

            $config['prev_link'] = '<i class="fa fa-long-arrow-left"></i>Previous Page';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['next_link'] = 'Next Page<i class="fa fa-long-arrow-right"></i>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            // build paging links
            $data["links"] = $this->pagination->create_links();
        }



        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $data['news_item'] = $this->news_model->get_news($slug);

        if (empty($data['news_item'])) {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect(site_url('user/login'));
        } else {
            $data['user_id'] = $this->session->userdata('user_id');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');
        } else {
            $this->news_model->set_news();
            redirect(base_url('news'));
        }
    }

    public function edit()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect(site_url('user/login'));
        } else {
            $data['user_id'] = $this->session->userdata('user_id');
        }

        $id = $this->uri->segment(3);
        //$id = $this->input->post('id');

        if (empty($id)) {
            show_404();
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Edit a news item';
        $data['news_item'] = $this->news_model->get_news_by_id($id);

        if ($data['news_item']['user_id'] != $this->session->userdata('user_id')) {
            $currentClass = $this->router->fetch_class(); // class = controller
            redirect(site_url($currentClass));
        }

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('news/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->news_model->set_news($id);
            //$this->load->view('news/success');
            redirect(site_url('news'));
        }
    }

    public function delete()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect(site_url('user/login'));
        }

        $id = $this->uri->segment(3);

        if (empty($id)) {
            show_404();
        }

        $news_item = $this->news_model->get_news_by_id($id);

        if ($news_item['user_id'] != $this->session->userdata('user_id')) {
            $currentClass = $this->router->fetch_class(); // class = controller
            redirect(site_url($currentClass));
        }

        $this->news_model->delete_news($id);
        redirect(base_url('news'));
    }
}
