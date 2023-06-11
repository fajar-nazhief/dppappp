<?php
include_once('../simple_html_dom.php');

echo file_get_html('http://surabaya.okezone.com/read/2013/06/16/521/822781/warga-jombang-dihebohkan-dengan-penangkapan-babi-ngepet')->plaintext;
?>