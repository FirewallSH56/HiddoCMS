<?php
function encrypt ($key,$iv,$str)
{     
  $block=mcrypt_get_block_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
  $padding=$block-(strlen($str) % $block);
  $str.=str_repeat(chr($padding), $padding);  
  $encryptxt=mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$str,MCRYPT_MODE_CBC,$iv);  
  $encryptxt64=base64_encode($encryptxt);
  return $encryptxt64;
}
function decrypt ($key,$iv,$str)
{     
  $block=mcrypt_get_block_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
  $padding=$block-(strlen($str) % $block);
  $str.=str_repeat(chr($padding), $padding);  
  $decryptxt=mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,$str,MCRYPT_MODE_CBC,$iv);  
  $decryptxt64=base64_decode($decryptxt);
  return $decryptxt64;
}
echo encrypt("ykio124A","12345678901234561234567890123456","test")."\n<br/>";
echo decrypt("ykio124A","12345678901234561234567890123456","xHqKvRQ6FXehOGGMrKoek04146M2l9bv1ScP6C1qCyg=")."\n<br/>";
?>