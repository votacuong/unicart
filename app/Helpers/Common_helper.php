<?php
function isMobile()
{
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

	{
		return true;
	}
	return false;
}

function abb_number_format($number, $format_number_subtract = 2)
{
	
	if ($format_number_subtract < 2)
	{
		
		$number = floor($number);
		
	}
	
	$number = (float) $number;
	
	return number_format($number, $format_number_subtract, '.', ',');
	
}

function abb_raw_json_encode($input, $flags = 0) 
{
	
	$fails = implode('|', array_filter(array(
		'\\\\',
		$flags & JSON_HEX_TAG ? 'u003[CE]' : '',
		$flags & JSON_HEX_AMP ? 'u0026' : '',
		$flags & JSON_HEX_APOS ? 'u0027' : '',
		$flags & JSON_HEX_QUOT ? 'u0022' : '',
	)));
	
	$pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
	
	$callback = function ($m) {
		
		return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
		
	};
	
	return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
	
}

function abb_json_decode($str)
{
	
	return json_decode($str, JSON_UNESCAPED_UNICODE);
	
}

function raw_json_encode($input, $flags = 0) 
{
	
	$fails = implode('|', array_filter(array(
		'\\\\',
		$flags & JSON_HEX_TAG ? 'u003[CE]' : '',
		$flags & JSON_HEX_AMP ? 'u0026' : '',
		$flags & JSON_HEX_APOS ? 'u0027' : '',
		$flags & JSON_HEX_QUOT ? 'u0022' : '',
	)));
	
	$pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
	
	$callback = function ($m) {
		
		return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
		
	};
	
	return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
	
}

function encode_string($string, $key = 'adb-techcom-logistic')
{
	
	if (empty($string))return;
	
	$key    = sha1($key);
	
	$strLen = strlen($string);
	
	$keyLen = strlen($key);
	
	$j = 0;
	
	$hash = '';
	
	for ($i = 0; $i < $strLen; $i++)
	{
		
		$ordStr = ord(substr($string,$i,1));
		
		if ($j == $keyLen) { $j = 0; }
		
		$ordKey = ord(substr($key,$j,1));
		
		$j++;
		
		$hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
		
	}
	
	return $hash;
	
}

function decode_string($string, $key = 'adb-techcom-logistic')
{
	
	if (empty($string))return;
	
	$key    = sha1($key);
	
	$strLen = strlen($string);
	
	$keyLen = strlen($key);
	
	$j = 0;
	
	$hash = '';
	
	for ($i = 0; $i < $strLen; $i+=2) 
	{
		
		$ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
		
		if ($j == $keyLen) { $j = 0; }
		
		$ordKey = ord(substr($key,$j,1));
		
		$j++;
		
		$hash .= chr($ordStr - $ordKey);
		
	}
	
	return $hash;
	
}

function get_your_session_id($ip = false)
{
	
	return encode_string(json_encode(__getBrowser()));
	
}

function adddate($vardate,$added)
{
	
	$data = explode("-", $vardate);
	
	$date = new DateTime();            
	
	$date->setDate($data[0], $data[1], $data[2]);
	
	$date->modify("".$added."");
	
	$day= $date->format("Y-m-d");
	
	return $day;    
	
}

function get_activities_session()
{
	
	$db = \Config\Database::connect();
				
	$builder = $db->table( "app_activities_session" );
	
	$builder->where( 'session_id', get_your_session_id() );

	$data = (array)$builder->get()->getRow();
	
	$builder->where('UNIX_TIMESTAMP(date_created) <= ', strtotime(adddate(date("Y-m-d"), "-10 days")));
		
	$builder->delete();
	
	if (!isset($data['session_id']))
	{
		
		$AppConfig = new \Config\AppConfig();
		
		$builder = $db->table( "app_currency" );
	
		$builder->where( 'code', $AppConfig->system_currency );

		$currency = (array)$builder->get()->getRow();
		
		$builder = $db->table( "app_activities_session" );
	
		$id = $builder->insert([
		
			'currency'=>$AppConfig->system_currency,
			
			'symbol'=>$currency['symbol'],
			
			'language'=>$AppConfig->system_language,
			
			'session_id'=>get_your_session_id(),
			
			'date_created'=>date("Y-m-d")
			
		]);
		
		return [
		
			'id'=>$id,
			
			'currency'=>$AppConfig->system_currency,
			
			'symbol'=>$currency['symbol'],
			
			'language'=>$AppConfig->system_language
			
		];
	}
	
	return $data;
	
}

function __getBrowser()
{ 

	$u_agent  = $_SERVER['HTTP_USER_AGENT'];
	
	$bname    = 'Unknown';
	
	$platform = 'Unknown';
	
	$version  = "";
	
	if (preg_match('/linux/i', $u_agent))
	{
		
		$platform = 'linux';
		
	}
	
	if(preg_match('/macintosh|mac os x/i', $u_agent))
	{
		
		$platform = 'mac';
		
	}
	elseif(preg_match('/windows|win32/i', $u_agent))
	{
		
		$platform = 'windows';
		
	}
	
	if(preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent))
	{
		
		$bname = 'Internet Explorer';
		
		$ub = "MSIE";
		
	}
	elseif(preg_match('/Firefox/i', $u_agent))
	{
		
		$bname = 'Mozilla Firefox';
		
		$ub = "Firefox";
		
	}
	elseif(preg_match('/OPR/i', $u_agent))
	{
		
		$bname = 'Opera';
		
		$ub = "Opera";
		
	}
	elseif(preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent))
	{
		
		$bname = 'Google Chrome';
		
		$ub = "Chrome";
		
	}
	elseif(preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent))
	{
		
		$bname = 'Apple Safari';
		
		$ub = "Safari";
		
	}
	elseif(preg_match('/Netscape/i', $u_agent))
	{
		
		$bname = 'Netscape';
		
		$ub = "Netscape";
		
	}
	elseif(preg_match('/Edge/i', $u_agent))
	{
		
		$bname = 'Edge';
		
		$ub = "Edge";
		
	}
	elseif(preg_match('/Trident/i', $u_agent))
	{
		
		$bname = 'Internet Explorer';
		
		$ub = "MSIE";
		
	}
	else
	{
		$bname = 'Apple Safari';
		$ub = "Safari";
	}
	
	$known = array('Version', $ub, 'other');
	
	$pattern = '#(?<browser>' . join('|', $known) .
	')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	
	if (!preg_match_all($pattern, $u_agent, $matches)) 
	{

	}
	
	$i = count($matches['browser']);
	
	if ($i != 1) 
	{
		
		if (strripos($u_agent, "Version") < strripos($u_agent, $ub))
		{
			
			$version = $matches['version'][0];
			
		}
		else 
		{
			
			$version = isset($matches['version'][1])?$matches['version'][1]:1;
			
		}
		
	}
	else 
	{
		
		$version = $matches['version'][0];
		
	}
	
	if ($version == null || $version == "") 
	{
		
		$version = "?";
		
	}
	
	return 	array(
	
		'ub'        => $ub,
		
		'userAgent' => $u_agent,
		
		'name'      => $bname,
		
		'version'   => $version,
		
		'platform'  => $platform,
		
		'pattern'   => $pattern			
		
	);
	
} 

function uploadFile($id, $name, $sub)
{
	
	$target_dir = dirname(dirname(dirname(__FILE__)))."/public/images/".$sub.'/';
	
	$imageFileType = strtolower(pathinfo($_FILES[$name]["name"],PATHINFO_EXTENSION));
	
	$target_file = $target_dir . $id.'.'.$imageFileType;
	
	if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file))
	{
		
	} 
	else 
	{
		
	}
	
	return $id.'.'.$imageFileType;
	
}

function uploadDocumentFile($id, $name, $sub)
{
	
	$target_dir = dirname(dirname(dirname(__FILE__)))."/public/images/".$sub.'/';
	
	if (!is_dir($target_dir))
	{
		
		mkdir($target_dir, 0777);
		
	}
	
	$imageFileType = strtolower(pathinfo($_FILES[$name]["name"],PATHINFO_EXTENSION));
	
	$target_file = $target_dir . "/". $_FILES[$name]["name"];

	if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) 
	{
		
	} 
	else 
	{
		
	}
	
	return $_FILES[$name]["name"];
	
}

function generateRandomString($length = 10) 
{
	
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
    $charactersLength = strlen($characters);
	
    $randomString = '';

    for ($i = 0; $i < $length; $i++) 
	{
		
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
		
    }

    return $randomString;
	
}

function generateqrcode($length = 10) 
{
	
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
    $charactersLength = strlen($characters);
	
    $randomString = '';

    for ($i = 0; $i < $length; $i++) 
	{
		
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
		
    }
	
	$db = \Config\Database::connect();
				
	$builder = $db->table( "app_items" );
	
	$builder->where( 'qrcode', $randomString );

	$data = (array)$builder->get()->getRow();
	
	if (isset($data['id']))
	{
		
		return generateqrcode($length);
		
	}
	
    return $randomString;
	
}

function generatekeycode($length = 10) 
{
	
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	
    $charactersLength = strlen($characters);
	
    $randomString = '';

    for ($i = 0; $i < $length; $i++) 
	{
		
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
		
    }
	
	$db = \Config\Database::connect();
				
	$builder = $db->table( "app_items" );
	
	$builder->where( 'keycode', $randomString );

	$data = (array)$builder->get()->getRow();
	
	if (isset($data['id']))
	{
		
		return generatekeycode($length);
		
	}
	
    return $randomString;
	
}

function clientID($length = 10) 
{
	
    $characters = '0123456789';
	
    $charactersLength = strlen($characters);
	
    $randomString = '';

    for ($i = 0; $i < $length; $i++) 
	{
		
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
		
    }

    return $randomString;
	
}

function v_base_url( $url )
{
	
	$App = new \Config\App();
	
	$base_url = str_replace('/index.php', '/', $App->baseURL);
	
	return $base_url.'/'.$url;
	
}

function is_empty()
{
	$App = new \Config\App();
	
	$c = str_replace(array($App->baseURL, '/'), array('', ''), getUrl());
	
	return $c == '';
}

function v_redirect( $url )
{
	
	header('Location: '.v_base_url( $url ));
	
	exit();
	
}

function getUrl()
{
	
	return (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
}

function urlOrder($field, $orderby)
{
	
	$url = getUrl();
	
	if( strpos($url, '?') !== false){
		
		$ex = explode('?', $url);
		
		$params = explode('&', $ex[1]);
		
		if ( strpos( $ex[1], 'order=' ) !== false )
		{
			foreach( $params as $key => $value )
			{
				if ( strpos( $value, 'order=' ) !== false )
				{
					
					$params[$key] = 'order='.$field;
					
				}
				
				if ( strpos( $value, 'orderby=' ) !== false )
				{
					
					$params[$key] = 'orderby='.$orderby;
					
				}
				
			}
			return $ex[0].'?'.implode('&', $params);
		}
		else
		{
			
			return $ex[0].'?'.implode('&', $params).'&order='.$field.'&orderby='.$orderby;
			
		}
		
	}
	
	return $url.'?order='.$field.'&orderby='.$orderby;
	
}

function isAdmin()
{
	
	return strpos( getUrl(), 'admin' ) !== false ? true: false;
	
}

function orderby($field)
{
	$url = getUrl();
	
	if( strpos($url, '?') !== false)
	{
		
		$params = explode('?', $url);
		
		if ( strpos($params[1], $field) === true)
		{
			
			return true;
			
		}
		
		$params = explode('&', $params[1]);
		
		foreach( $params as $key => $value )
		{
			
			if ( strpos( $value, $field ) !== false )
			{
				
				foreach( $params as $key => $value )
				{
					
					if ( strpos( $value, 'desc' ) !== false )
					{
						
						return false;
						
					}
				
				}
				
			}
			
		}
		
		return true;
		
	}
	
	return false;
	
}

function addMessage($message, $type = 'success')
{
	
	$messages = session()->get('messages');
	
	if ( $type == 'success' )
	{
		
		$messages[] = '<div class="text-success">'.$message.'</div>';
		
	}
	else
	{
		$messages[] = '<div class="text-danger">'.$message.'</div>';
		
	}
	
	session()->set('messages', $messages);
	
}

function showMessages()
{
	
	$messages = session()->get('messages');
	
	if ( !is_array($messages) )
	{
		
		$messages = [];
		
	}
	
	session()->set('messages', []);
	
	if ( count($messages) > 0 )
	{
		return '<div class="col-lg-12 grid-margin">
					<div class="card">
					  <div class="card-body">
							'.implode(PHP_EOL, $messages).'
					  </div>
					</div>
				</div>';
	}
	
}

?>