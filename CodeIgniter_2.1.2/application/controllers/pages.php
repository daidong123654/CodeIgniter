<?php
class pages extends CI_Controller 
{
	public function view($page='home')
	{				
		if ( !file_exists('application/views/pages/'.$page.'.php'))
		{
			echo "要载入的页面不存在，请检查路径是否正确。".$page;
			show_404();
		}
		$data['title']=ucfirst($page);
		$this->load->view('templates/header.php');
		$this->load->view('pages/'.$page,$data);
		$this->load->view('templates/footer.php');
	
	}
}

?>


