<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller {

    // Declare $Crud_model as a class property
    public $Crud_model;
    public $db;
    public $session;
    public $form_validation;
    public function __construct() {
        parent::__construct();
        $this->load->model('Crud_model');
        $this->Crud_model = $this->Crud_model;
        $this->load->library('form_validation');
    }

    public function index() {
        $data['result'] = $this->Crud_model->getAllData(); // Ensure 'result' key is set in $data array
        $this->load->view('crudView', $data); // Pass $data to the view
    }
    

    public function create() {
        // Set form validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[student.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('course', 'Course', 'required|alpha_numeric_spaces|min_length[3]|max_length[10]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the form with errors
            $this->load->view('crudView');
        } else {
            // Validation passed, proceed with saving the data
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'course' => $this->input->post('course')
            );
            $this->Crud_model->createData($data);
            
            redirect("CrudController");
        }
    }

  
    public function edit($id) {
        $row = $this->Crud_model->getData($id);
        if (!$row) {
            show_404();
        }
        $data['row'] = $row;
        $this->load->view('crudEdit', $data);
    }

    public function update($id) {
        // Set form validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|alpha_numeric_spaces|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_exists['.$id.']');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('course', 'Course', 'required|alpha_numeric_spaces|min_length[3]|max_length[10]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the edit form with errors
            $data['row'] = $this->Crud_model->getData($id);
            $this->load->view('crudEdit', $data);
        } else {
            // Validation passed, proceed with updating the data
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'course' => $this->input->post('course')
            );
            $this->Crud_model->updateData($id, $data);
            redirect('CrudController');
        }
    }
    public function delete($id) {
        $this->Crud_model->deleteData($id);
        redirect('CrudController');
    }

    // Custom callback function to check if the email exists for the current student during update
    public function check_name_exists($name) {
        if ($this->Crud_model->isDuplicate('name', $name)) {
            $this->form_validation->set_message('check_name_exists', 'This name is already taken.');
            return FALSE;
        }
        return TRUE;
    }

    // Callback function to check if the email already exists
    public function check_email_exists($email) {
        if ($this->Crud_model->isDuplicate('email', $email)) {
            $this->form_validation->set_message('check_email_exists', 'This email is already registered.');
            return FALSE;
        }
        return TRUE;
    }

    // Callback function to check if the phone number already exists
    public function check_phone_exists($phone) {
        if ($this->Crud_model->isDuplicate('phone', $phone)) {
            $this->form_validation->set_message('check_phone_exists', 'This phone number is already registered.');
            return FALSE;
        }
        return TRUE;
    }
}
