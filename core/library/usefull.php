<?php
function convert($number,$perSecond=false) {
  $thousandArray = array();
  $thousandArray[0] = '';
  $thousandArray[1] = 'K';
  $thousandArray[2] = 'M';
  $thousandArray[3] = 'G';
  $thousandArray[4] = 'T';
  $thousandArray[5] = 'P';

  for ($i = 0; $number > 1024 && $i < count($thousandArray); $i++) {
    $number /= 1024;
  }
  return number_format($number,2).' '.$thousandArray[$i].'b'.($perSecond?"/s":"");
}
?>