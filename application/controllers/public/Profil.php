<?php

class Profil extends Private_Controller {

    public function index() {
        $this->load->model('functions_model');
        $data['functions_list'] = $this->functions_model->get(array('orderby' => 'menu_order ASC'));
        $this->load->model('experiences_model');
        $data['experiences_list'] = $this->experiences_model->get(array('orderby' => 'menu_order ASC'));
        $this->load->model('cities_model');
        $data['cities_list'] = $this->cities_model->get(array('orderby' => 'menu_order ASC'));
        $this->load->model('professions_status_model');
        $data['professions_status_list'] = $this->professions_status_model->get(array('orderby' => 'menu_order ASC'));
//        echo '<pre>' . print_r($this->user, true) . '</pre>';
        $data['form'] = ObjToArray($this->user);
        if ($this->input->post('action') === "submit") {
            $data['form'] = array_merge($data['form'], $this->input->post());
        }
//        echo '<pre>' . print_r($data['form'], true) . '</pre>';
        $this->_manage_form();
        /* OUTPUT */
        $this->smarty->view(strtolower(basename(__FILE__, '.php')) . '.tpl', $data);
    }
    

    private function _manage_form() {
//        echo '<pre>' . print_r($_FILES, true) . '</pre>';
        if ($this->input->post('action') === "submit") {
            $update_data = $this->input->post();
            // AVATAR UPLAOD
            $config['upload_path'] = $this->upload_folder;
            $config['encrypt_name'] = TRUE;
            if (!file_exists(FCPATH . $this->upload_folder)) {
                mkdir(FCPATH . $this->upload_folder, 0755, TRUE);
            }
            $config['allowed_types'] = 'gif|GIF|jpg|JPG|jpeg|JPEG|png|PNG';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('avatar')) {
                $upload_data = $this->upload->data();
//                echo '<pre>' . print_r($upload_data, true) . '</pre>';
                $update_data['avatar'] = $this->upload_folder . $upload_data['file_name'];
//                echo '<pre>' . print_r($upload_data, true) . '</pre>';
                // Image resize
                $this->load->library('image_lib');
                $config['source_image'] = FCPATH . $update_data['avatar'];
                $config['maintain_ratio'] = FALSE;
                $config['new_image'] = FCPATH . $this->upload_folder . $upload_data['raw_name'] . '_crop' . $upload_data['file_ext'];
                if ($upload_data['image_width'] > $upload_data['image_height']) {
                    $config['width'] = $upload_data['image_height'];
                    $config['height'] = $upload_data['image_height'];
                    $config['x_axis'] = (($upload_data['image_width'] - $upload_data['image_height']) / 2);
                    $config['y_axis'] = 0;
                } else if ($upload_data['image_width'] < $upload_data['image_height']) {
                    $config['width'] = $upload_data['image_width'];
                    $config['height'] = $upload_data['image_width'];
                    $config['y_axis'] = (($upload_data['image_height'] - $upload_data['image_width']) / 2);
                    $config['x_axis'] = 0;
                } else {
                    $config['width'] = $upload_data['image_width'];
                    $config['height'] = $upload_data['image_width'];
                    $config['y_axis'] = (($upload_data['image_height'] - $upload_data['image_width']) / 2);
                    $config['x_axis'] = 0;
                }
//                $config['x_axis'] = '100';
//                $config['y_axis'] = '60';
//                echo '<pre>' . print_r($config, true) . '</pre>';
//                die();
                $this->image_lib->initialize($config);

                if ($this->image_lib->crop()) {
//                    echo '<pre>' . print_r("GOQFOR RESIZE", true) . '</pre>';
                    $config = array(
                        'width' => 150,
                        'height' => 150,
                        'x_axis' => 0,
                        'y_axis' => 0,
                        'source_image' => $config['new_image'],
                        'new_image' => FCPATH . $this->upload_folder . $upload_data['raw_name'] . '_150x150' . $upload_data['file_ext'],
                    );
                    $this->image_lib->initialize($config);
                    if (!$this->image_lib->resize()) {
                        echo $this->image_lib->display_errors();
                    } else {
//                        echo '<pre>' . print_r("RESIZE OK", true) . '</pre>';
                    }
                }
            } else {
                $error = array('error' => $this->upload->display_errors());
//                echo '<pre>' . print_r($error, true) . '</pre>';
            }

            if ($this->users_model->update_user_profil($update_data)) {
//                die('die after save');
                $this->session->set_flashdata('msg_type', 'success');
                $this->session->set_flashdata('msg', "Votre profil a bien été enregistré.");
//                die('before redirect OK');
                //redirect(current_url());
                redirect("http://m-saic.be/members/view/". $this->user->user_id . "/");
                exit;
            }
        }
    }
    
    // Page externe confiramtion Delete
//    public function delete_confirmation() {
//        echo 'souhaitez-vous vraiment supprimer votre compte ?';
//        echo '<a href="'.site_url('delete').'">OUIQJEQCONFIRME</a>';
//        echo '<a href="'.site_url('profil').'">NON</a>';
//    }
    
    public function delete() {
        $this->users_model->remove($this->user->user_id);
        redirect('logout');
        exit;
    }

}
