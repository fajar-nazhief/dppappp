<?php
ini_set( 'memory_limit', '200M' );
ini_set('upload_max_filesize', '200M');  
ini_set('post_max_size', '200M');  
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

$config['files_folder'] = UPLOAD_PATH . 'files/';

$config['files_allowed_file_ext'] = array(
	'a'	=> array('mpga', 'mp2', 'mp3', 'ra', 'rv', 'wav'),
	'v'	=> array('mpeg', 'mpg', 'mpe', 'qt', 'mov', 'avi', 'movie'),
	'd'	=> array('pdf', 'xls', 'ppt', 'txt', 'text', 'log', 'rtx', 'rtf', 'xml', 'xsl', 'doc', 'docx', 'xlsx', 'word', 'xl'),
	'i'	=> array('bmp', 'gif', 'jpeg', 'jpg', 'jpe', 'png', 'tiff', 'tif'),
	'o'	=> array('psd', 'gtar', 'swf', 'tar', 'tgz', 'xhtml', 'zip', 'css', 'html', 'htm', 'shtml')
);

$config['max_size'] = '1000000';
$config['max_width']  = '1024000';
$config['max_height']  = '768000';