<?php
class News_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
    //$this->db->select()
  }
  public function get_news($slug = FALSE)
  {
	if ($slug === FALSE)
	{
		//得到数据表
		$query = $this->db->get('lib_news');
		return $query->result_array();
	}
  
	$query = $this->db->get_where('lib_news', array('slug' =>$slug));
	return $query->row_array();
  }
  public function get_db_info()
  {	
	return $this->db->get('show tables');
  }
  public function set_news()
  {
	$this->load->helper('url');
  
	$slug = url_title($this->input->post('title'), 'dash', TRUE);
  
	$data = array(
		'title' => $this->input->post('title'),
		'slug' => $slug,
		'text' => $this->input->post('text')
	);
  
	return $this->db->insert('lib_news', $data);
	}
  
}