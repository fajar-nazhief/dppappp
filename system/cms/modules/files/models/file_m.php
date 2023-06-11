<?php   defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * PyroCMS
 *
 * An open source CMS based on CodeIgniter
 *
 * @package		PyroCMS
 * @author		PyroCMS Dev Team
 * @license		Apache License v2.0
 * @link		http://pyrocms.com
 * @since		Version 1.0-dev
 * @filesource
 */

/**
 * PyroCMS File Model
 *
 * Interacts with the files table in the database.
 *
 * @author		Dan Horrigan <dan@dhorrigan.com>
 * @author		Eric Barnes <eric@pyrocms.com>
 * @package		PyroCMS
 * @subpackage	Files
 */
class File_m extends MY_Model {

	protected $table = 'files';

	// ------------------------------------------------------------------------

	/**
	 * Exists
	 *
	 * Checks if a given file exists.
	 *
	 * @access	public
	 * @param	int		The file id
	 * @return	bool	If the file exists
	 */
	function getFile($params=array()){
		
		if(!empty($params['id'])){
			$this->db->where('id',$params['id']);
		}
		if(!empty($params['folder_id'])){
			$this->db->where('folder_id',$params['folder_id']);
		}
		
		 
		// Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		elseif (isset($params['limit']))
			$this->db->limit($params['limit']);
		
		$query=$this->db->get('files');
		return $query->result();
	}
	
	public function exists($file_id)
	{
		return (bool) (parent::count_by(array('id' => $file_id)) > 0);
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete a file
	 *
	 * Deletes a single file by its id and remove it from the db.
	 *
	 * @params	int	The file id
	 * @return 	bool
	 */
	public function delete($id)
	{
		$this->load->helper('file');

		if ( ! $image = parent::get($id))
		{
			return FALSE;
		}

		@unlink(FCPATH.'/' . $this->config->item('files_folder').'/'.$image->filename);

		parent::delete($image->id);

		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete a file
	 *
	 * Deletes a single file by its id
	 *
	 * @params	int	The file id
	 * @return 	bool
	 */
	public function delete_file($id)
	{
		$this->load->helper('file');

		if ( ! $image = parent::get($id))
		{
			return FALSE;
		}

		@unlink(FCPATH.'/' . $this->config->item('files_folder').'/'.$image->filename);

		return TRUE;
	}

	// ------------------------------------------------------------------------

	/**
	 * Delete multiple files
	 *
	 * Delete all files contained within a folder.
	 *
	 * @params int	Folder id
	 * @return void
	 */
	public function delete_files($folder_id)
	{
		$this->load->helper('file');

		$image = parent::get_many_by(array('folder_id' => $folder_id));

		if ( ! $image)
		{
			return FALSE;
		}

		foreach ($image as $item)
		{
			@unlink(FCPATH.'/' . $this->config->item('files_folder').'/'.$item->filename);
			parent::delete($item->id);
		}

		return TRUE;
	}
}

/* End of file file_m.php */
/* Location: ./system/cms/modules/files/models/file_m.php */
