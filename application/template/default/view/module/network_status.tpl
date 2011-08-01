<?php $this->load->library("usefull");?>
<div id="module_network_status" class="box">
  <div class="top">Network Status</div>
  <div class="middle">
    <table>
      <tr>
        <td>Download: <?=convert($download,true)?></td>
        <td width="25px"></td>
        <td>Upload: <?=convert($upload,true)?></td>
      </tr>
      <tr>
        <td>Total: <?=convert($totalDownload)?></td>
        <td width="25px"></td>
        <td>Total: <?=convert($totalUpload)?></td>
      </tr>
    </table>
  </div>
  <div class="bottom"></div>
</div>