<div id="module_server_details" class="box">
  <div class="top">Memory &nbsp; <?=$this->generateGraph()?></div>
<div class="middle">
<table>
  <tr>
    <td>Used: <?=$ramUsed." Mb"?></td>
    <td width="25px"></td>
    <td>Free: <?=$ramFree." Mb"?></td>
  </tr>
  <tr>
    <td>Total: <?=$ramTotal." Mb"?></td>
    <td width="25px"></td>
    <td>Cached: <?=$ramCached." Mb"?></td>
  </tr>
</table>
</div>
<div class="bottom"></div>
</div>