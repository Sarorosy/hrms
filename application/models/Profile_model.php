<?php
class Profile_model extends CI_Model {

    public function get_profile($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('tbl_admin');
        return $query->row_array();
    }

    public function save_profile($user_id, $data) {
        $this->db->where('id', $user_id);
        $this->db->update('tbl_admin', $data);
    }

    public function update_file($user_id, $field, $filename) {
        $this->db->where('id', $user_id);
        $this->db->update('tbl_admin', [$field => $filename]);
    }
    public function update_password($user_id, $new_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in database
        $data = array(
            'pass' => $hashed_password,
            'decrypt_pass' => $new_password
        );

        $this->db->where('id', $user_id);
        $this->db->update('tbl_admin', $data);

        return $this->db->affected_rows() > 0;
    }
}
?>
