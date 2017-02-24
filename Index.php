<?php

$Data1 = utf8_decode(urldecode( file_get_contents('php://input') ));
$Data1 = str_replace("jason=","",$Data1);



$string = json_decode( $Data1 );
file_put_contents("gif.txt",$Data1 );
	
	function objectToArray( $object )
	{
		if( !is_object( $object ) && !is_array( $object ) )
		{
			return $object;
		}
		if( is_object( $object ) )
		{
			$object = get_object_vars( $object );
		}
		return array_map( 'objectToArray', $object );
	}


	$token = 'توکن رو اینجا قرار بدید';


	$result = objectToArray($string);
	$user_id = $result['message']['from']['id'];
	$username = $result['message']['from']['username'];


	file_put_contents("user_id.txt",$user_id );

	$channel_id = ' آدرس کانال';
	$label = '@ تگ کانال';
	
	$sent = 'پست مورد نظر در کانال ' . $channel_id . ' فرستاده شد 😊' ;
	
	$welcome = 'به ربات کمکی کانال ' .$channel_id . ' خوش آمدید!' . PHP_EOL . PHP_EOL . 'شما هر پستی تو این ربات ارسال کنید ، آی دی استفاده شده در پست و لینک آن به صورت اتوماتیک به آی دی کانال شما تغییر داده شده و به کانال ' . $channel_id . ' اضافه می شود' . PHP_EOL . PHP_EOL . 'طراحی و کدنویسی شده توسط @Moharak' ;

	if( ($username === "یوزر نیم شما بدون ادساین")  ){
	
		
		$text = $result['message']['text'];
		
		$photoIDsize = count( $result['message']['photo'] ); 
		$photoID = $result['message']['photo'][$photoIDsize - 1]['file_id'];
		
		$videoID = $result['message']['video']['file_id'];
		
		$documentID = $result['message']['document']['file_id'];
		
		$audioID = $result['message']['audio']['file_id'];
		
		$voiceID = $result['message']['voice']['file_id'];



		$type = 0;
		// 0 null ; 1 text , 2 img , 3 video , 4 document , 5 audio , 6 voice ;
		
		if( $text != null){
			$type = 1;
		} else if ( $photoID != null ){
			$type = 2;
		} else if ( $videoID != null ){
			$type = 3;
		} else if ( $documentID != null ){
			$type = 4;
		} else if ( $audioID != null ){
			$type = 5;
		} else if ( $voiceID != null ){
			$type = 6;
		}
		
		
		if($type === 1){
			
			if ($text !== "/start"){
			
				$newtext = str_replace("\n"," \n ",$text);
				
				$Rstring = strstr($newtext, '@');
				$arr123 = explode(' ',trim($Rstring));
				
				$newtext = str_replace($arr123[0],$label,$newtext);
				
				
				$Lstring = strstr($newtext, 'http');
				$arr1234 = explode(' ',trim($Lstring));
				
				$newtext = str_replace($arr1234[0],$label,$newtext);
				
				$newtext = str_replace(" \n ","\n",$newtext);
				
				if (strpos($newtext, $label) === false) {
					$newtext .= PHP_EOL . PHP_EOL . $label;
				}


				$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$channel_id;
				
				$url .= '&text=' . urlencode($newtext) ;

				$url .= '&disable_notification=false' ;
			
				$res = file_get_contents($url);
				
				
				
				$url2 = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
				
				$url2 .= '&text=' . $sent ;
			
				$res2 = file_get_contents($url2);

			} else {
				
				
				$url2 = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
				
				$url2 .= '&text=' . urlencode($welcome) ;
			
				$res2 = file_get_contents($url2);

			}
			
		} else if($type === 2){
			
			
			$newtext = str_replace("\n"," \n ",$result['message']['caption']);
			
			$Rstring = strstr($newtext, '@');
			$arr123 = explode(' ',trim($Rstring));
			
			$newtext = str_replace($arr123[0],$label,$newtext);
			
			
			$Lstring = strstr($newtext, 'http');
			$arr1234 = explode(' ',trim($Lstring));
			
			$newtext = str_replace($arr1234[0],$label,$newtext);
			
			$newtext = str_replace(" \n ","\n",$newtext);

			if( $result['message']['caption'] == null ){
				$newtext = $label;
			}
			
			if (strpos($newtext, $label) === false) {
				$newtext .= PHP_EOL . PHP_EOL . $label;
			}

			
			
			$url = 'https://api.telegram.org/bot'.$token.'/sendPhoto?chat_id='.$channel_id;
			
			$url .= '&caption=' . urlencode($newtext) ;

			$url .= '&photo=' . $photoID;
			
			$url .= '&disable_notification=false' ;
		
			$res = file_get_contents($url);
			
						
			$url2 = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
			
			$url2 .= '&text=' . $sent ;
		
			$res2 = file_get_contents($url2);


		} else if($type === 3){
			
			
			$newtext = str_replace("\n"," \n ",$result['message']['caption']);
			
			$Rstring = strstr($newtext, '@');
			$arr123 = explode(' ',trim($Rstring));
			
			$newtext = str_replace($arr123[0],$label,$newtext);
			
			
			$Lstring = strstr($newtext, 'http');
			$arr1234 = explode(' ',trim($Lstring));
			
			$newtext = str_replace($arr1234[0],$label,$newtext);
			
			$newtext = str_replace(" \n ","\n",$newtext);

			if( $result['message']['caption'] == null ){
				$newtext = $label;
			}
			
			if (strpos($newtext, $label) === false) {
				$newtext .= PHP_EOL . PHP_EOL . $label;
			}

			
			
			$url = 'https://api.telegram.org/bot'.$token.'/sendVideo?chat_id='.$channel_id;
			
			$url .= '&caption=' . urlencode($newtext) ;

			$url .= '&video=' . $videoID;
			
			$url .= '&disable_notification=false' ;
		
			$res = file_get_contents($url);
			
						
			$url2 = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
			
			$url2 .= '&text=' . $sent ;
		
			$res2 = file_get_contents($url2);
			
			
		} else if($type === 4){
			
			
			$newtext = str_replace("\n"," \n ",$result['message']['caption']);
			
			$Rstring = strstr($newtext, '@');
			$arr123 = explode(' ',trim($Rstring));
			
			$newtext = str_replace($arr123[0],$label,$newtext);
			
			
			$Lstring = strstr($newtext, 'http');
			$arr1234 = explode(' ',trim($Lstring));
			
			$newtext = str_replace($arr1234[0],$label,$newtext);
			
			$newtext = str_replace(" \n ","\n",$newtext);

			if( $result['message']['caption'] == null ){
				$newtext = $label;
			}
			
			if (strpos($newtext, $label) === false) {
				$newtext .= PHP_EOL . PHP_EOL . $label;
			}

			
			
			$url = 'https://api.telegram.org/bot'.$token.'/sendDocument?chat_id='.$channel_id;
			
			$url .= '&caption=' . urlencode($newtext) ;

			$url .= '&document=' . $documentID;
			
			$url .= '&disable_notification=false' ;
		
			$res = file_get_contents($url);
			
						
			$url2 = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
			
			$url2 .= '&text=' . $sent ;
		
			$res2 = file_get_contents($url2);
			
			
		} else if($type === 5){
			
			
			$newtext = str_replace("\n"," \n ",$result['message']['caption']);
			
			$Rstring = strstr($newtext, '@');
			$arr123 = explode(' ',trim($Rstring));
			
			$newtext = str_replace($arr123[0],$label,$newtext);
			
			
			$Lstring = strstr($newtext, 'http');
			$arr1234 = explode(' ',trim($Lstring));
			
			$newtext = str_replace($arr1234[0],$label,$newtext);
			
			$newtext = str_replace(" \n ","\n",$newtext);

			if( $result['message']['caption'] == null ){
				$newtext = $label;
			}
			
			if (strpos($newtext, $label) === false) {
				$newtext .= PHP_EOL . PHP_EOL . $label;
			}

			
			
			$url = 'https://api.telegram.org/bot'.$token.'/sendAudio?chat_id='.$channel_id;
			
			$url .= '&caption=' . urlencode($newtext) ;

			$url .= '&audio=' . $audioID;
			
			$url .= '&title=' . $label;
			
			$url .= '&performer=' . $label;
			
			$url .= '&disable_notification=false' ;
		
			$res = file_get_contents($url);
			
						
			$url2 = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
			
			$url2 .= '&text=' . $sent ;
		
			$res2 = file_get_contents($url2);
			
			
		} else if($type === 6){
			
			
			$newtext = str_replace("\n"," \n ",$result['message']['caption']);
			
			$Rstring = strstr($newtext, '@');
			$arr123 = explode(' ',trim($Rstring));
			
			$newtext = str_replace($arr123[0],$label,$newtext);
			
			
			$Lstring = strstr($newtext, 'http');
			$arr1234 = explode(' ',trim($Lstring));
			
			$newtext = str_replace($arr1234[0],$label,$newtext);
			
			$newtext = str_replace(" \n ","\n",$newtext);

			if( $result['message']['caption'] == null ){
				$newtext = $label;
			}
			
			if (strpos($newtext, $label) === false) {
				$newtext .= PHP_EOL . PHP_EOL . $label;
			}
						
			$url = 'https://api.telegram.org/bot'.$token.'/sendVoice?chat_id='.$channel_id;
			
			$url .= '&caption=' . urlencode($newtext) ;

			$url .= '&voice=' . $voiceID;
						
			$url .= '&disable_notification=false' ;
		
			$res = file_get_contents($url);
			
						
			$url2 = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
			
			$url2 .= '&text=' . $sent ;
		
			$res2 = file_get_contents($url2);
			
			
		} else{
			
			$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
			
			$url .= '&text=' . urlencode("فقط از متن ، عکس ، فیلم ، سند ، صدا و موسیقی پشتیبانی می شود 😔") ;
		
			$res = file_get_contents($url);

			
		}
		
		
		
		
	
	
	
	} else {
		

			$url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$user_id;
			
			$url .= '&text=' . urlencode("شما درسترسی لازم به این ربات را ندارید. 😐 \nدرصورتی که تمایل به داشتن همچین رباتی هستید به @Moharak مراجعه کنید.") ;
		
			$res = file_get_contents($url);

		
	}


	



	

?>
