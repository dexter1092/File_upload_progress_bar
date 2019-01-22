<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['v_files'] = directory_map('./Uploads/');

		$this->load->view('welcome_message',$data);
	}

	public function post(){
		$configVideo['upload_path'] = 'Uploads'; # check path is correct
		$configVideo['max_size'] = '102400';
		$configVideo['allowed_types'] = 'mp4'; # add video extenstion on here
		$configVideo['overwrite'] = FALSE;
		$configVideo['remove_spaces'] = TRUE;
		$video_name = random_string('numeric', 5);
		$configVideo['file_name'] = $video_name;

		$this->load->library('upload', $configVideo);
		$this->upload->initialize($configVideo);

		if (!$this->upload->do_upload('file1')) # form input field attribute
		{
		    # Upload Failed
		    print_r($this->upload->display_errors());
		}
		else
		{
		    # Upload Successfull
		    // redirect('welcome');
		}
	}
}
