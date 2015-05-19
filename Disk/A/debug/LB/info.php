<?PHP
$sys_info_array = array ();
		$sys_info_array ['gmt_time'] = gmdate ( "Y年m月d日 H:i:s", time () );
		$sys_info_array ['bj_time'] = gmdate ( "Y年m月d日 H:i:s", time () + 8 * 3600 );
		$sys_info_array ['server_ip'] = gethostbyname ( $_SERVER ["SERVER_NAME"] );
		$sys_info_array ['software'] = $_SERVER ["SERVER_SOFTWARE"];
		$sys_info_array ['port'] = $_SERVER ["SERVER_PORT"];
		$sys_info_array ['admin'] = $_SERVER ["SERVER_ADMIN"];
		$sys_info_array ['diskfree'] = intval ( diskfreespace ( "." ) / (1024 * 1024) ) . 'Mb';
		$sys_info_array ['current_user'] = @get_current_user ();
		date_default_timezone_set("Asia/Shanghai");
		$sys_info_array ['timezone'] = date_default_timezone_get();
//		$db=new Medoo(OSA_DB_ID);
//		$mysql_version = $db->query("select version()")->fetchAll();
//		$sys_info_array ['mysql_version'] = $mysql_version[0]['version()'];
//		echo '<pre>';
//		print_r($sys_info_array);
//		echo '</pre>';
?>
<table class="table table-striped table-hover table-condensed">
  <tbody>
    <tr>
      <td>服务器时间</td>
      <td><?php echo $sys_info_array ['gmt_time']?> (格林威治标准时间)</td>
      <td></td>
    </tr>
    <tr>
      <td>服务器时间</td>
      <td colspan="2"><?php echo $sys_info_array ['bj_time']?> (北京时间)</td>
    </tr>
    <tr>
      <td>服务器ip地址</td>
      <td colspan="2"><?php echo $sys_info_array ['server_ip']?> </td>
    </tr>
    <tr>
      <td>服务器解译引擎</td>
      <td colspan="2"><?php echo $sys_info_array ['software']?></td>
    </tr>
    <tr>
      <td>web服务端口</td>
      <td colspan="2"><?php echo $sys_info_array ['port']?></td>
    </tr>
    <tr>
      <td>服务器管理员</td>
      <td colspan="2"><?php echo $sys_info_array ['admin']?></td>
    </tr>
    <tr>
      <td>服务端剩余空间</td>
      <td colspan="2"><?php echo $sys_info_array ['diskfree']?></td>
    </tr>
    <tr>
      <td>系统当前用户名</td>
      <td colspan="2"><?php echo $sys_info_array ['current_user']?></td>
    </tr>
    <tr>
      <td>系统时区</td>
      <td colspan="2"><?php echo $sys_info_array ['timezone']?></td>
    </tr>
  </tbody>
</table>
