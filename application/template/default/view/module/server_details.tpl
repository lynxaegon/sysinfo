<div id="module_server_details" class="box">
  <div class="top">Server Details</div>
  <div class="middle">
    <table>
      <tr>
        <td>Cpu: </td>
        <td width="25px"></td>
        <td><?=$cpuModel?></td>
      </tr>
      <tr>
        <td>Running: </td>
        <td width="25px"></td>
        <td><?=$distribution?></td>
      </tr>
      <tr>
        <td>Wan Ip: </td>
        <td width="25px"></td>
        <td><?=$wanIP." (".$_SERVER["HTTP_HOST"].")"?></td>
      </tr>
      <tr>
        <td>Temperature: </td>
        <td width="25px"></td>
        <td><?=$temperature?></td>
      </tr>
      <tr>
        <td>Uptime: </td>
        <td width="25px"></td>
        <td><?=$uptime?></td>
      </tr>
    </table>
  </div>
  <div class="bottom"></div>
</div>