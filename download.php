<?php
$file_name = "qrcode.png";
if(is_file($file_name))
{
  if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }
  switch(strtolower(substr(strrchr($file_name,'.'),1)))
  {
	  case 'pdf': $mime = 'application/pdf'; break;
	  case 'zip': $mime = 'application/zip'; break;
	  case 'jpeg':
	  case 'jpg': $mime = 'image/jpg'; break;
	  case 'png': $mime = 'image/png'; break;
	  default: $mime = 'application/force-download';
  }
  header('Pragma: public');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Cache-Control: private',false);
  header('Content-Type: '.$mime);
  header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: '.filesize($file_name));
  readfile($file_name);
}

?>