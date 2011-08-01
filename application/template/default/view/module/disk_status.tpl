<?php $this->load->library("usefull");?>
<div id="module_server_details" class="box">
  <div class="top">Disk &nbsp;
<?php
echo '[';

echo '<font color="green"><b>';
for($i=1;$i<=$diskPercent;$i++)
  echo '|';
echo '</b></font>';

echo '<font color="white"><b>';
for($i=1;$i<=$diskFreePercent;$i++)
  echo '&nbsp';
echo '</b></font>';

echo ']';
?>
</div>
<div class="middle">
<table>
  <tr>
    <td>Used: <?=convert($diskUsed)?></td>
    <td width="25px"></td>
    <td>Free: <?=convert($diskFree)?></td>
    <td width="25px"></td>
    <td>Total: <?=convert($diskTotal)?></td>
  </tr>
</table>
</div>
<div class="bottom"></div>
</div>