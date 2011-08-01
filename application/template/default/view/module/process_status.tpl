<div id="module_server_details" class="box">
  <div class="top">Processes</div>
  <div class="middle">
<?php

echo '<table>';
foreach($process as $key => $value)
{
  echo '<tr>';
  echo '<td>'. $key .'</td>';
  echo '<td width="25px"></td>';
  echo '<td><img src="application/template/default/images/'.$value.'.png"/></td>';
  echo '</tr>';
}
echo '</table>';
?>
</div>
<div class="bottom"></div>
</div>
