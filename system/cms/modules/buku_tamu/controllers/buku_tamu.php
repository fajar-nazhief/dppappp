<?php  defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Comments controller (frontend)
 *
 * @author 		Phil Sturgeon, Yorick Peterse - PyroCMS Dev Team
 * @package 	PyroCMS
 * @subpackage 	Comments module
 * @category 	Modules
 */
class Buku_tamu extends Public_Controller {

	/**
	 * An array containing the validation rules
	 * @access private
	 * @var array
	 */
    protected $validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'Judul',
			'rules' => 'trim|htmlspecialchars|required'
		) ,
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|htmlspecialchars|required'
		) ,
		array(
			'field' => 'name',
			'label' => 'Email',
			'rules' => 'trim|htmlspecialchars|required'
		),
		array(
			'field' => 'pesan',
			'label' => 'Pesan',
			'rules' => 'trim|htmlspecialchars|required'
		)
	);

	/**
	 * Constructor method
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::Public_Controller();
		$this->db->set_dbprefix('default_'); 
		// Load the required classes
	 
    }

    public function index(){
    

        $this->template->title('Buku Tamu', 'Buku Tamu' )  
			->build( 'index' );
    }

    public function create(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules($this->validation_rules);

        if ($this->form_validation->run())
		{
			
			// They are trying to put this live
			 

			$post_data = array(
				'title'				=> $this->input->post('title'),
                'slug'				=> url_title($this->input->post('title')),
                'name'				=> $this->input->post('name'),
                'email'				=> $this->input->post('email'),
                'body'				=> $this->input->post('pesan'),  
				'created_on'		=> now(),
				'createdby'			=> '1',
				'json_data' 		=> serialize($_POST)
			);
			 
			   $this->db->insert('buku_tamu', $post_data);
				$id = $this->db->insert_id();

			if ($id)
			{
				$this->pyrocache->delete_all('my_m');
				$this->session->set_flashdata('success','Terimkasih!');
			}
			else
			{
				 $this->session->set_flashdata('error', 'Error:');
			}

			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit' ? redirect('buku_tamu') : redirect('buku_tamu');
		}
		else
		{
            $this->session->set_flashdata('error', 'Error:');
			// Go through all the known fields and get the post values
			foreach ($this->validation_rules as $key => $field)
			{
				@$post->$field['field'] = set_value($field['field']);
            } 
           redirect('buku_tamu');
        }
        
        $this->template->title('Buku Tamu', 'Buku Tamu' ) 
        ->set('post',$post)	
        ->build( 'index' );

    }
}