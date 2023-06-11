<?php 

$config['files_folder'] = UPLOAD_PATH . 'files/';
$config['width']     = 480;

$config['files_allowed_file_ext'] = array(
	'a'	=> array('mpga', 'mp2', 'mp3', 'ra', 'rv', 'wav'),
	'v'	=> array('mpeg', 'mpg', 'mpe', 'qt', 'mov', 'avi', 'movie','mp4'),
	'd'	=> array('pdf', 'xls', 'ppt', 'txt', 'text', 'log', 'rtx', 'rtf', 'xml', 'xsl', 'doc', 'docx', 'xlsx', 'word', 'xl'),
	'i'	=> array('bmp', 'gif', 'jpeg', 'jpg', 'jpe', 'png', 'tiff', 'tif'),
	'o'	=> array('psd', 'gtar', 'swf', 'tar', 'tgz', 'xhtml', 'zip', 'css', 'html', 'htm', 'shtml')
);