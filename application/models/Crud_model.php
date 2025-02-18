<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function createData($data) {
        $this->db->insert('student', $data);
    }

    public function isDuplicate($field, $value) {
        $this->db->where($field, $value);
        $query = $this->db->get('student');
        return $query->num_rows() > 0;
    }

    // Retrieve all student data
    public function getAllData() {
        $query = $this->db->get('student');
        return $query->result();
    }

    // Retrieve data of a specific student by ID
    public function getData($id) {
        $query = $this->db->query("SELECT * FROM student WHERE id = ?", array($id));
        return $query->row();
    }

    // Update student data by ID
    public function updateData($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('student', $data);
    }

    // Delete student data by ID
    public function deleteData($id) {
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->delete('student');
        }
    }

    // Check if an email already exists for any student other than the one specified by ID
    public function checkEmailExist($email, $id = null) {
        $this->db->where('email', $email);
        
        if ($id !== null) {
            // Exclude the current student record from the email check during update
            $this->db->where('id !=', $id);
        }
        
        $query = $this->db->get('student');
        return $query->row();  // Return row if email exists, otherwise null
    }
    public function checkPhoneExists($phone) {
        $this->db->where('phone', $phone);
        $query = $this->db->get('student');
        return $query->num_rows() > 0;  // Return TRUE if phone exists, otherwise FALSE
    }

    // Check if email already exists in the database
    public function checkEmailExists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('student');
        return $query->num_rows() > 0;  // Return TRUE if email exists, otherwise FALSE
    }

}
