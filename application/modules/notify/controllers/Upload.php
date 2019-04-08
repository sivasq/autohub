<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function single_img_upload($image_name, $image_path)
    {
        $this->load->library('upload');

        if (isset($_FILES[$image_name]) && !empty($_FILES[$image_name]))
        {
            if (!is_dir($image_path))
            {
                mkdir($image_path, 777, TRUE);
            }

            if ($_FILES[$image_name]['error'] != 4)
            {
                //Image file configurations
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = '*';
                $config['max_size'] = 0;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload($image_name))
                {
                    //if files not uploaded                    
                    return $this->upload->display_errors();
                    //echo $this->upload->file_name;
                }
                else
                {   
                    //return $this->upload->data();
                    return true;
                }
            }
        }
    }

    public function multiple_img_upload($image_name, $image_path)
    {
        $this->load->library('upload');

        if (isset($_FILES[$image_name]) && !empty($_FILES[$image_name]))
        {
            if ($_FILES[$image_name]['error'] != 4)
            {
                $filesCount = count($_FILES[$image_name]['name']);

                for($i = 0; $i < $filesCount; $i++)
                {
                    $_FILES['multiple_image']['name'] = $_FILES[$image_name]['name'][$i];
                    $_FILES['multiple_image']['type'] = $_FILES[$image_name]['type'][$i];
                    $_FILES['multiple_image']['tmp_name'] = $_FILES[$image_name]['tmp_name'][$i];
                    $_FILES['multiple_image']['error'] = $_FILES[$image_name]['error'][$i];
                    $_FILES['multiple_image']['size'] = $_FILES[$image_name]['size'][$i];

                    if (!is_dir($image_path))
                    {
                        mkdir($image_path, 777, TRUE);
                    }

                    $config['upload_path'] = $image_path;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';

                    $config['file_name'] = $_FILES["multiple_image"]['name'];

                    $this->load->library('upload', $config);

                    $this->upload->initialize($config);

                    if($this->upload->do_upload('multiple_image'))
                    {

                        $fileData[] = $this->upload->data();
    
                        //$uploadData[$i]['image'] = $fileData['file_name'];                        
                    
                    }else{

                        //$error = array('msg' => 'Error in uploading file');
                        //$json_error = json_encode($error);
                        return $this->upload->display_errors();
                        //echo $this->upload->file_name;
                    }
                }

                if(!empty($fileData))
                {
                    //Insert image information into the database
                    return $fileData;
                }

            }
        }
    }
}

?>