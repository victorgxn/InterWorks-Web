<?php
function depurar($cadena)
{
  $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $cadena);
  $string = trim($string);
  $string = stripslashes($string);
  $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  return $string;
}
