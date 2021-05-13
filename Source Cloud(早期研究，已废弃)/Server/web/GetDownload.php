<?php 
error_reporting(0);
require("kernl\conf.php"); //初始化数据库配置
require('kernl\Connect.Class.php');
// 调整时区
if (PHP_VERSION >= '5.1') 
{
date_default_timezone_set('PRC');
}

// 实例化类
$dou = new DbMysql(DBSERVER, USER, PASSWORD, DB, 'utf8');

//公共函数
if (!function_exists('format_json')) {

/**
* 格式化API输出的json
* @param $return_code string 返回的状态码
* @param $data array 要返回的数据
* @param $error_info string 要返回的错误信息
*/
function format_json($return_code, $data, $error_info = '') 
{
	if (empty($data)) 
	{
		$data = array();
	}
	echo json_encode( array( 'return_code' => $return_code,
							 'data' => $data,
							 'error_info' => $error_info
	));
	exit;
}

}


function get_ini_file($file_name = "demo.ini")
{
 $str=file_get_contents($file_name);//读取ini文件存到一个字符串中.
 $ini_list = explode("\r\n",$str);//按换行拆开,放到数组中.
 $ini_items = array();
 foreach($ini_list as $item)
 {
  $one_item = explode("=",$item);
  if(isset($one_item[0])&&isset($one_item[1])) $ini_items[trim($one_item[0])] = trim($one_item[1]); //存成key=>value的形式.
 }
 return $ini_items;
}

function get_ini_item($ini_items = null,$item_name = '') //获得INI条目的值.
{
   if(empty($ini_items)) 
   { 
	   return "";
   } else {
	   return $ini_items[$item_name];
   		}
}


//执行判断
if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	format_json('-1','NULL','Error Request Method!');
} else {
	if($_POST['hash'] == NULL || $_POST['username'] == NULL)  //提交的数据如果为空
	{
		format_json('-2','NULL','Post Data Failed!');
	} else {
		$sql = "SELECT download_id.username,download_id.downloadid,download_id.timestamp,file.filename,file.checksum,file.size,file.type,file.filepath FROM download_id INNER JOIN file ON download_id.filename = file.filename AND download_id.fileSum = file.checksum AND download_id.username = file.username Where download_id.downloadid ='" . $_POST['hash'] . "' AND download_id.username = '".$_POST['username']."';";
		$query = $dou -> query($sql);
		if($dou -> affected_rows() == 0 || $dou -> affected_rows() == -1) 
		{
			format_json('0','NULL','No Data!');
		} else {
			$row = $dou -> fetch_array($query);
			$ini_items = get_ini_file("../Server.ini");
			$path = str_replace(get_ini_item($ini_items,'UploadFiles').'\\','' ,$row['filepath']);
			$data = array( 'FileName' => $row['filename'],
						   'Hash' => $row['checksum'],
					       'Size' => $row['size'],
				  	       'Type' => $row['type'],
				  	       'ServerName' => $row['$path'] );
			//format_json('1','{FileName:'.$row['filename'].'},{Hash:'.$row['checksum'].'},{Size:'.$row['size'].'},{Type:'.$row['type'].'},{ServerName:'.$path.'}','');
			format_json('1',$data,'');
		}
	}
}
?>

