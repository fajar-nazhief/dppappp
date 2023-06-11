<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Exceptions Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Exceptions
 */
class MY_Exceptions extends CI_Exceptions {

	/**
	 * 404 Not Found Handler
	 *
	 * @access	private
	 * @param	string
	 * @return	string
	 */
	public function show_404($page = '', $log_error = TRUE)
    {
        if (is_cli())
        {
            $heading = 'Not Found';
            $message = 'The controller/method pair you requested was not found.';
        }
        else
        {
            $heading = '404 Page Not Found This Time';
            $message = 'The page you requested was not found.';
        }
        // By default we log this, but allow a dev to skip it
        if ($log_error)
        {
            log_message('error', $heading.': '.$page);
        }
        echo $this->show_error($heading, $message, 'custom404', 404);//custom404 is in APPPATH.'views/errors/html/custom404.php'
        exit(4); // EXIT_UNKNOWN_FILE
    }

}

/* End of file Exceptions.php */
/* Location: ./system/libraries/Exceptions.php */