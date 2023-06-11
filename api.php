<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

	require_once 'config.php';
	
	function data($data){
	     $data = trim(htmlentities(strip_tags($data)));
	     return mysql_real_escape_string(stripslashes($data));
	}
	
	function salt()
	{
		return substr(md5(uniqid(rand(), true)), 0, 6);
	}
	
	function keygen($length=10)
		{
			$key = '';
			list($usec, $sec) = explode(' ', microtime());
			mt_srand((float) $sec + ((float) $usec * 100000));
			
			$inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));
		
			for($i=0; $i<$length; $i++)
			{
			    $key .= $inputs{mt_rand(0,61)};
			}
			return $key;
		}

	function hash_password_db($identity, $password)
	{
	   if (empty($identity) || empty($password))
	   {
		return FALSE;
	   } 
	   
	      $query = "SELECT * FROM default_users WHERE username = '".data(trim($identity))."' 
	   or email = '".data(trim($identity))."' 
	   and active = '1'";
			
	   $result = mysql_query($query);
			if (mysql_affected_rows() <> 0) {
				while ( $row = mysql_fetch_assoc($result) )
					{ 
						     $salt = $row['salt'];
					}
					return sha1($password . $salt);
			}else{
			   return FALSE;
			}
			
 

		 

		 
	}
	
	function cektoken($token="",$username="")
		{
			  $query = "SELECT  *  FROM default_users where id='".$username."' and keycode='".$token."'";
			$result = mysql_query($query);
			
			if(empty($result)){
				 
				return $geojson = array('status' => 'gagal');
				exit;
			} 
		}
	
 	$db_server = mysql_connect($db_hostname, $db_username, $db_password);
	if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
	mysql_select_db($db_database) or die("Unable to select database: " . mysql_error());
	//$_SERVER['QUERY_STRING'] = base64_decode();
	$str = base64_decode($_SERVER['QUERY_STRING']);
	
	$valstring = explode("~", $str); 
	$command = $valstring[0];
	
	$data = array();
    
	switch($command){
	     case "loginPetugas":
		     
				@$username = htmlspecialchars(trim($_POST['username']));
				@$password = trim(htmlspecialchars(str_replace('sadsd','',$_POST['password']))); 
				$keycode = md5(uniqid(rand()));
			 
			 	  $pass =  hash_password_db($_POST['username'], $_POST['password']);
			       $query = "SELECT a.*,b.name,c.gravatar FROM default_users as a,default_groups as b,
								default_profiles as c  WHERE a.email = '".data($username)."' AND a.password = '" .data($pass). "'
								and a.group_id = b.id and a.id = c.user_id ";
			 	$result = mysql_query($query);
					if (mysql_affected_rows()<> 0) {
						$gupdate ="update default_users set keycode='".$keycode."' where username=".$username;
							mysql_query($gupdate);
						while ( $row = mysql_fetch_assoc($result) )
							{ 		
								$geojson = array(
									'username' => $row['username'] ,
									'mail' => $row['email'] ,
									'type' => $row['group_id'] ,
									'group' => $row['name'] ,
									'keycode' => $row['keycode'] , 
									'status' => 'sukses',
									'gravatar' => $row['gravatar'], 
									'user_id' => $row['id']
								);
								
								$uid = $row['id'];
							}
							
							
				 	
			} else {
				$geojson = array('status' => 'gagal');
			}
			break;
		case "cekmaxjenis" :
			$query = "SELECT  *  FROM default_kegiatan_status where id_jenis=".$valstring[1];
			$result = mysql_query($query);
			$num_rows = mysql_num_rows($result);
			
			if (mysql_affected_rows()<> 0) {
				 $geojson = array('max' => $num_rows);
			}else{
				$geojson = array('status' => 'gagal');
			}
			
			
			break;
		case "kategorikegiatan" :
			$query = "SELECT  *  FROM default_kegiatan_categories where id_jenis=".$valstring[1];
			$result = mysql_query($query);
			
			if (mysql_affected_rows()<> 0) {
				while ( $row = mysql_fetch_assoc($result) )
					{  $geojson[] = $row; }
			}else{
				$geojson = array('status' => 'gagal');
			}
			
			
			break;
		case "jeniskegiatan" :
			$query = "SELECT  *  FROM default_kegiatan_jenis ";
			$result = mysql_query($query);
			
			if (mysql_affected_rows()<> 0) {
				while ( $row = mysql_fetch_assoc($result) )
					{  $geojson[] = $row; }
			}else{
				$geojson = array('status' => 'gagal');
			}
			
			
			break;
	    case "likeStatus" :
		if(count(array_filter($valstring)) == count($valstring)) {
			     $status = $valstring[1];
				$id_kegiatan = $valstring[2];
				$user_id= $valstring[3];
				
				if(!empty($valstring[3]) AND ($valstring[3] <>'null')){ 
						$query = "SELECT  *  FROM default_kegiatan_like where id_user=".$user_id." AND id_kegiatan=".$id_kegiatan;
						$result = mysql_query($query);
						
						if (mysql_affected_rows()<> 0) {
								$query_insert = "UPDATE default_kegiatan_like set status=".$status." where id_user=".$user_id." and id_kegiatan=".$id_kegiatan."";
								$result_insert = mysql_query($query_insert);
							//if (mysql_affected_rows()<> 0) {
								 $query1 = "SELECT  count(*)as jml,status  FROM default_kegiatan_like where id_kegiatan=".$id_kegiatan." group by status";
								$result1 = mysql_query($query1);
								if (mysql_affected_rows()<> 0) {
									
									 while ( $rowcount = mysql_fetch_assoc($result1) )
											 {
											 $stta = $rowcount['status'];
											 $like[$stta] = $rowcount['jml'];
											 }
					    
								}
								
							
							  $geojson = array('status' => 'success','result'=> (!empty(@$like['1'])?@$like['1']:'0').' suka ,'.(!empty(@$like['2'])?@$like['2']:'0').' tidak suka');
							//}
								 
						}else{
							$query_insert = "INSERT INTO default_kegiatan_like VALUES(null,".$user_id.",".$id_kegiatan.",'NOW()',".$status.")";
							$result_insert = mysql_query($query_insert);
							if (mysql_affected_rows()<> 0) {
								
								$query1 = "SELECT  count(*)as jml,status  FROM default_kegiatan_like where id_kegiatan=".$id_kegiatan." group by status";
								$result1 = mysql_query($query1);
								if (mysql_affected_rows()<> 0) {
									
									 while ( $rowcount = mysql_fetch_assoc($result1) )
											 {
											 $stta = $rowcount['status'];
											 $like[$stta] = $rowcount['jml'];
											 }
					    
								}
								
							
							  $geojson = array('status' => 'success','result'=> @$like[1].' suka ,'.@$like[2].' tidak suka');
								 
							}else{
								
							 $geojson = array('status' => 'gagal');
							}
							
						}
						
					}else{
						$geojson = array('status' => 'gagal');
					}
				
				
				
				
			 } else {
				$geojson = array('status' => 'gagal');
				exit;
			 }

		
		
			
			
			
			break;
		case "listKegiatan" :
			//print_r($valstring);
			  $token = $valstring[1];
			  if(empty($token)){
				$geojson = array('status' => 'notoken');
			  }else{
				if(@($valstring[2]) =='undefined'){
					$limitstart = 0;
				}else{
					$limitstart = $valstring[2];
				}
				
				if(!empty($valstring[3]) AND $valstring[3] <> 'undefined'){
					$qtambahan = ' AND a.kategori = '.$valstring[3];
				}else{
					$qtambahan = '';
				}
				
				//echo $limitstart;
				//exit;
				 $nextlimit = $limitstart + 10;
				  $query = "SELECT  a.*,(select count(id) from default_kegiatan_like  where a.id = id_kegiatan and status=1)as st_like,(select count(id) from default_kegiatan_like  where a.id = id_kegiatan and status=2)as st_unlike,b.imageUrl,f.display_name,c.title as judul_kategori,c.id as id_kategori,d.title as status_title,d.warna as status_warna,e.title as title_jenis
				 FROM default_kegiatan as a,default_kegiatan_detail as b , default_kegiatan_categories as c ,default_kegiatan_status as d,default_kegiatan_jenis as e,default_profiles as f
				 where a.id = b.id_kegiatan and a.status = b.status AND
				 a.id_pemohon = f.user_id AND 
				 a.kategori = c.id  and a.id_jenis = d.id_jenis and d.id_jenis = e.id ".$qtambahan." AND
				 a.status = d.id_status order by id DESC limit  ".$limitstart.",10 ";
				 $result = mysql_query($query);
				if (mysql_affected_rows()<> 0) {
				    $geojson['limit'] = array('limit' => $nextlimit,'name'=>'limit');
				    while ( $row = mysql_fetch_assoc($result) )
					    {  $geojson[] = $row; }
				}else{
					 
						$geojson = array('status' => 'gagal');
					}
			  }
			  
			 
			 
			
			
			break;
		case "confirmed" :
			@$id = $_POST['id'];
			@$status = $_POST['status'];
			@$descr = $_POST['deskripsi'];
			@$image = $_POST['image'];
			 @$user_id= $_POST['user_id'];
			if(!empty($id)) {
			$querycek = "select * from default_kegiatan_detail where  status ='".$status."' AND  id_kegiatan=".$id;
			$resultcek = mysql_query($querycek);
			if (mysql_affected_rows()<> 0) {
				$geojson = array('status' => 'gagal','detail'=> 'Tidak dapat mengupdate statusyang sama');
				
			}else{
				$query = "update  default_kegiatan set status ='".$status."' where id=".$id;
				 $result = mysql_query($query);
				 
				 
				  $query2 = "insert into  default_kegiatan_detail values(NULL,'".$id."','".$status."','".$descr."','".date('Y-m-d H:i:s')."','".$image."',".$user_id.") ";
				 $result2 = mysql_query($query2);
				 
					$geojson = array('status' => 'sukses');
			}
			
			}else{
				$geojson = array('status' => 'gagal');
			 
			}
			
			
			break;
		case  "AnggotaBaru" :
			$lat = data($_POST['lat']);
			$lng = data($_POST['lng']);
			$address = data($_POST['address']);
			$phone = data($_POST['phone']);
			$email = data($_POST['email']);
			$username = data($_POST['username']);
			$password = data($_POST['password']);
			$group = data($_POST['group']);
			$device_id = data($_POST['device_id']);
			$salt = salt();
			$pass_enc = sha1($password.$salt);
			
			$now = strtotime(date('Y-m-d H:i:s') );
			
			$cek = hash_password_db($username,$password);
			//echo sha1('digital214a974d');
			 if(empty($username) && empty($password)){
				
				$geojson = array('status' => 'gagal');
				exit;
			 }
			 
			if(empty($cek)){
			  $sql = "INSERT INTO default_users values(NULL,'".$email."','".$pass_enc."','".$salt."','".$group."','".$device_id."','1','-','".$now."','".$now."','".$username."','','','".$lat."','".$lng."','0')";
			 mysql_query($sql);
			 $id = mysql_insert_id();
			
			if(!empty($id)){
				 $sqlprofiles = "INSERT INTO default_profiles values(NULL,
				'".$id."',
				'".$username."',
				'".$username."',
				'".$username."',
				'',
				'Eng',
				'',
				'-',
				'".$phone."',
				'".$phone."',
				'".$address."',
				'".$lat."',
				'".$lng."',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-',
				'-', 
				'".$now."' 
				)";
				mysql_query($sqlprofiles);
				$geojson['status'] = 'success';
			}else{
				$geojson = array('status' => 'error');
			}
			
			
			}else{
				$geojson['status'] = 'error';
			}
			
			 
								
		break;
	
case  "AgendaBaru" :
			$lat = data($_POST['lat']);
			$lng = data($_POST['lng']);
			$address = data($_POST['address']);
			$title = data($_POST['name']);
			$deskripsi = data($_POST['deskripsi']);
			$jam = date('H:i:s'); 
			$penghubung = data($_POST['penghubung']);
			$tanggal = date('Y-m-d');
			$phone = data($_POST['phone']);
			
			$uid_pengirim = data($_POST['uid_pengirim']);
			$uid_penerima = data($_POST['uid_penerima']); 
			
			$status = 0;
			$kategori = data($_POST['kategori']);
			$id_jenis = data($_POST['id_jenis']); 
			
			$image = $_POST['image'];
			 
			//echo sha1('digital214a974d');
			 
			if(!empty($title) && !empty($uid_pengirim) && !empty($uid_penerima)){
			 $sql = "INSERT INTO default_kegiatan values(NULL,'".$title."'
			,'".$deskripsi."'
			,'".$uid_pengirim."'
			,'".$uid_penerima."'
			,'".$address."'
			,'".$penghubung."'
			,'".$phone."'
			,'".$tanggal."'
			,'".$jam."'
			,'".$lat."'
			,'".$lng."'
			,'".$status."'
			,'".$kategori."'
			,'".$id_jenis."')";
			mysql_query($sql);
			$id = mysql_insert_id();
			
			  $geojson['status'] = 'sukses';
			  
			$query2 = "insert into  default_kegiatan_detail values(NULL,'".$id."','".$status."','".$deskripsi."','".$tanggal." ".date('H:i:s')."','".$image."',".$uid_pengirim.") ";
			$result2 = mysql_query($query2);
			
			}else{
				$geojson['status'] = 'error';
			}
			
			 
								
		break;

		// --- User Check Duplicate ------------------------------------------------------------------------------------------------------------------------------------
		case "loginCheck":
			$query = "SELECT username FROM app_table_user WHERE keycode = '".$valstring[1]."' AND username = '".$valstring[2]."' ";
			$result = mysql_query($query);
			while ( $row = mysql_fetch_assoc($result) )
			{ $geojson[] = $row; }
			break;
		// --- User Check Duplicate ------------------------------------------------------------------------------------------------------------------------------------
		case "refreshKeycode":
			$keycode = md5(uniqid(rand()));
			$queryNext = "UPDATE app_table_user SET keycode = '$keycode' where username = '$valstring[2]'";
			$resultNext = mysql_query($queryNext);		
			break;

		// --- User Check Duplicate ------------------------------------------------------------------------------------------------------------------------------------
		case "getHydran":
		  
		    if(!empty($valstring[1])){
			  $radius = $valstring[1];
			 $latlng = explode(',',str_replace(array('LatLng(',')'),'',$valstring[2]));
			 $lat = $latlng[0];
			 $lng = $latlng[1];
			 $query = "SELECT 
						*,( 6371 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance 
						FROM app_damkar_hidran 
						HAVING distance < '".$radius."' 
						ORDER BY distance";
		    }else{
			$query = "SELECT * FROM app_damkar_hidran";
		    }
			
			$dbquery = mysql_query($query);
			$feature = array();
			$geojson = array(
				    'type' => 'FeatureCollection',
				    'features' => array()
				    );
				    while($row = mysql_fetch_assoc($dbquery)) {
					$feature = array(
					'type' => 'Feature',
					'geometry' => array(
					'type' => 'Point',
					'coordinates' => array((float)$row['LNG'], (float)$row['LAT'])
					),
					'properties' => array(
					'id' => $row['NO'],
					'header' => 'LOKASI HYDRAN DAMKAR',
					'body' => $row['KOTA'].'<br>'.$row['KECAMATAN'].'<br>'.$row['ALAMAT'] 
					 
					)
					);
					 
				        array_push($geojson['features'], $feature);
				    };
				    
				    mysql_close($db_server);  
			break;
		    case "getBitek":
		     $db ='app_poi_cctv_bitek';
		    if(!empty($valstring[1])){
			$radius = $valstring[1];
			 $latlng = explode(',',str_replace(array('LatLng(',')'),'',$valstring[2]));
			 $lat = $latlng[0];
			 $lng = $latlng[1];
			 $query = "SELECT 
						*,( 6371 * acos( cos( radians('$lat') ) * cos( radians( LAT ) ) * cos( radians( LNG ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( LAT ) ) ) ) AS distance 
						FROM ".$db." 
						HAVING distance < '".$radius."' 
						ORDER BY distance";
		    }else{
			$query = "SELECT * FROM ".$db;
		    }
		    
			//$query = "SELECT * FROM app_damkar_pos";
			$dbquery = mysql_query($query);
			$feature = array();
			$geojson = array(
				    'type' => 'FeatureCollection',
				    'features' => array()
				    );
				    while($row = mysql_fetch_assoc($dbquery)) {
					$feature = array(
					'type' => 'Feature',
					'geometry' => array(
					'type' => 'Point',
					'coordinates' => array((float)$row['LNG'], (float)$row['LAT'])
					),
					'properties' => array(
					'id' => $row['CCTV_ID'],
					'header' => $row['NAME'],
					'url_image' => $row['SITE_IP'],
					'body' => $row['ADDRESS'].'<br>Area: '.$row['AREA'].'<br>owner: '.$row['OWNER'] 
					 
					)
					);
					 
				        array_push($geojson['features'], $feature);
				    };
				    
				    mysql_close($db_server);  
			break;
		case "getDamkar":
		     
		    if(!empty($valstring[1])){
			$radius = $valstring[1];
			 $latlng = explode(',',str_replace(array('LatLng(',')'),'',$valstring[2]));
			 $lat = $latlng[0];
			 $lng = $latlng[1];
			 $query = "SELECT 
						*,( 6371 * acos( cos( radians('$lat') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$lng') ) + sin( radians('$lat') ) * sin( radians( lat ) ) ) ) AS distance 
						FROM app_damkar_pos 
						HAVING distance < '".$radius."' 
						ORDER BY distance";
		    }else{
			$query = "SELECT * FROM app_damkar_pos";
		    }
		    
			//$query = "SELECT * FROM app_damkar_pos";
			$dbquery = mysql_query($query);
			$feature = array();
			$geojson = array(
				    'type' => 'FeatureCollection',
				    'features' => array()
				    );
				    while($row = mysql_fetch_assoc($dbquery)) {
					$feature = array(
					'type' => 'Feature',
					'geometry' => array(
					'type' => 'Point',
					'coordinates' => array((float)$row['LNG'], (float)$row['LAT'])
					),
					'properties' => array(
					'id' => $row['NO'],
					'header' => $row['POS_PEMADAM'],
					'body' => $row['ALAMAT'].'<br>'.$row['RT_RW'].'<br>'.$row['KELURAHAN'] 
					 
					)
					);
					 
				        array_push($geojson['features'], $feature);
				    };
				    
				    mysql_close($db_server);  
			break;
		case "getLaporan":
		     
		   
			 $query = "SELECT * FROM qlue_report where timestamp >= DATE_SUB(CURDATE(), INTERVAL 3 DAY) AND type='".data($valstring[1])."' ";
		    
		    
			//$query = "SELECT * FROM app_damkar_pos";
			$dbquery = mysql_query($query);
			$feature = array();
			$geojson = array(
				    'type' => 'FeatureCollection',
				    'features' => array()
				    );
				    while($row = mysql_fetch_assoc($dbquery)) {
					$feature = array(
					'type' => 'Feature',
					'geometry' => array(
					'type' => 'Point',
					'coordinates' => array((float)$row['lng'], (float)$row['lat'])
					),
					'properties' => array(
					'status' => $row['detail_status'],
					'url_image' => $row['detail_image'],
					'id' => $row['id'],
					'header' =>
					'Pelapor : '.$row['username'].'<br>'
					.'Kelurahan : '.$row['detail_name_kel'].'<br>'
					.'Waktu : '.$row['timestamp'].'<br>'
					.'Status : '.$row['detail_status'].'<br>', 
					'body' => '<br>'.$row['detail_description'] 
					 
					)
					);
					 
				        array_push($geojson['features'], $feature);
				    };
				    
				    mysql_close($db_server);  
			break;
		    case "getLaporanWarga":
		     
		   
			  $query = "SELECT a.*,b.first_name as username FROM users_info as a,users as b where a.user_id = b.id and category_id='".data($valstring[1])."' ";
		    
		    
			//$query = "SELECT * FROM app_damkar_pos";
			$dbquery = mysql_query($query);
			$feature = array();
			$geojson = array(
				    'type' => 'FeatureCollection',
				    'features' => array()
				    );
				    while($row = mysql_fetch_assoc($dbquery)) {
					
					if($row['status'] == 'Baru' ){
						$color = 'red';
					}
					if($row['status'] == 'Proses' ){
						$color = 'orange';
					}
					if($row['status'] == 'Selesai' ){
						$color = 'green';
					}
					$feature = array(
					'type' => 'Feature',
					'geometry' => array(
					'type' => 'Point',
					'coordinates' => array((float)$row['longitude'], (float)$row['latitude'])
					),
					'properties' => array(
					'status' => $row['status'],
					'color' =>$color,
					'url_image' => 'http://180.250.156.242/pengaduan/uploads/laporan/'.$row['info_image'],
					'id' => $row['info_id'],
					'header' =>
					'Pelapor : '.$row['username'].'<br>' 
					.'Waktu : '.$row['info_date'].'<br>' , 
					'body' => '<br>'.$row['info_text'] 
					 
					)
					);
					 //106.8420716,-6.4427459 'coordinates' => array((float)$row['longitude'], (float)$row['latitude'])
				        array_push($geojson['features'], $feature);
				    };
				    
				    mysql_close($db_server);  
			break;
		case "getPetugasLocationOnline":
			$queryNext = "select a.* from roam_userpetugas as a,(SELECT * FROM roam_userpetugas_history where ((( UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(timestamp))/60/60) <= 720)  GROUP BY username ORDER BY timestamp ASC) as b where a.username = b.username
			";
			$resultNext = mysql_query($queryNext);
			while ( $row = mysql_fetch_assoc($resultNext) )
			{ $data[] = $row; }
			break;
		case "getPetugas":  
			$queryNext = "SELECT * FROM roam_userpetugas WHERE lat != '0.000000' AND lng != '0.000000'"; 
			$dbquery = mysql_query($queryNext);
			$feature = array();
			$geojson = array(
				    'type' => 'FeatureCollection',
				    'features' => array()
				    );
				    while($row = mysql_fetch_assoc($dbquery)) {
					$feature = array(
					'type' => 'Feature',
					'geometry' => array(
					'type' => 'Point',
					'coordinates' => array((float)$row['lng'], (float)$row['lat'])
					),
					'properties' => array(
					'name' => $row['nama'],
					'username' => $row['username'],
					'icon' => 'fa-street-view',
					'phone' => $row['phone'],
					'id' => $row['userid']  
					 
					)
					);
					 
				        array_push($geojson['features'], $feature);
				    };
				    
				    mysql_close($db_server); 
			break;
		case "getPetugasHistory": 
			$valstring[3] = date('Y-m-d',strtotime(str_replace(',','',$valstring[3])));
			$valstring[4] = date('Y-m-d',strtotime(str_replace(',','',$valstring[4])));
			$queryNext = "SELECT * FROM roam_userpetugas_history WHERE username = '".$valstring[2]."' AND DATE_FORMAT(timestamp, '%Y-%m-%d') >= '".$valstring[3]."' AND DATE_FORMAT(timestamp, '%Y-%m-%d') <= '".$valstring[4]."'";
			$resultNext = mysql_query($queryNext);
			while ( $row = mysql_fetch_assoc($resultNext) )
			{ $geojson[] = $row; }
			break;
		case "loginCheck":
			$query = "SELECT username FROM app_table_user WHERE keycode = '".$valstring[1]."' AND username = '".$valstring[2]."' ";
			$result = mysql_query($query);
			while ( $row = mysql_fetch_assoc($result) )
			{ $data[] = $row; }
			break;
		// --- User Check Duplicate ------------------------------------------------------------------------------------------------------------------------------------
		case "refreshKeycode":
			$keycode = md5(uniqid(rand()));
			$queryNext = "UPDATE app_table_user SET keycode = '$keycode' where username = '$valstring[2]'";
			$resultNext = mysql_query($queryNext);		
			break; 
		case "getPetugasTerdekat":
			$lat = $valstring[2];
			$lng = $valstring[3];
			$dinas = $valstring[4];

			$queryNext = "SELECT *, SQRT( POW( 69.1 * ( lat - ".$lat.") , 2 ) +
							POW( 69.1 * ( ".$lng." - lng ) * COS( lat / 57.3 ) , 2 ) ) AS distance FROM
							roam_userpetugas WHERE status = '0' AND type = 'dinas' AND dinas = '$dinas' AND lat != '0.000000' AND lng != '0.000000' ORDER BY distance ASC LIMIT 20";
//							roam_userpetugas WHERE status = '0' AND type = 'dinas' AND dinas = '$dinas' AND lat != '0.000000' AND lng != '0.000000' AND login_terakhir >= SUBDATE( NOW(), INTERVAL 30 DAY) ORDER BY distance ASC LIMIT 5";

			$resultNext = mysql_query($queryNext);
			while ( $row = mysql_fetch_assoc($resultNext) )
			{ $data[] = $row; }
			break;
		// --- Pencarian Data ------------------------------------------------------------------------------------------------------------------------------------
		case "searchData":
			$string = $valstring[2];
			if (empty($string)) { return; }
			//$data = array();
			$sql = "SHOW TABLES FROM ".$db_database;
			$tables_result = mysql_query($sql);
			if (!$tables_result) {
			  echo "Database error, could not list tables\nMySQL error: " . mysql_error(); exit;
			}
			while ($table = mysql_fetch_row($tables_result)) {
    		  //echo "Table: {$table[0]}\n\n";
			  if($table[0] === "app_bappeda_musrenbang2014") { continue; }
			  if($table[0] === "app_bappeda_musrenbang2015") { continue; }
			  if($table[0] === "app_border_kecamatan") { continue; }
			  if($table[0] === "app_border_kelurahan") { continue; }
			  if($table[0] === "app_energi_lajar") { continue; }
			  if($table[0] === "app_energi_pju") { continue; }
			  if($table[0] === "app_kominfo_tower_microcell") { continue; }
			  if($table[0] === "app_poi_cctv_bitek") { continue; }
			  if($table[0] === "app_poi_cctv_dishub") { continue; }
			  if($table[0] === "app_poi_cctv_dpu") { continue; }
			  if($table[0] === "app_polyline_fiberoptik") { continue; }
			  if($table[0] === "app_poi_rutebusway") { continue; }
			  if($table[0] === "app_table_datagambar") { continue; }
			  if($table[0] === "app_table_datapenduduk") { continue; }
			  if($table[0] === "app_table_namadinas") { continue; }
			  if($table[0] === "app_table_user") { continue; }
			  if($table[0] === "roam_dispatchnote") { continue; }
			  if($table[0] === "roam_dispatch") { continue; }
			  if($table[0] === "roam_userpetugas") { continue; }
			  if($table[0] === "roam_userpetugas_history") { continue; }
			  
			  $fields_result = mysql_query("SHOW COLUMNS FROM ".$table[0]);
			  if (!$fields_result) {
				echo 'Could not run query: ' . mysql_error();
				exit;
			  }
			  if (mysql_num_rows($fields_result) > 0) {
				while ($field = mysql_fetch_assoc($fields_result)) {
				  if (stripos($field['Type'], "VARCHAR") !== false || stripos($field['Type'], "TEXT") !== false) {
					  $target = $field['Field'];
					  $sql = "SELECT * FROM ".$table[0]." WHERE ".$field['Field']." LIKE '%$string%'";
			
					  $result = mysql_query($sql);
					  while ( $row = mysql_fetch_assoc($result) )
						  { 		
							  $data[] = array(
								  'label' => $table[0] ,
								  'col' => $field['Field'] ,
								  'text' => $row[$target] ,
								  'value' => $row
							  );
						  }
					  //echo json_encode($data);
				  }
				}
			  }
			}
			break;

	}
	// print_r($data);
	//echo json_encode($data);
	header("Content-Type:application/json",true);
	echo json_encode($geojson);
?>

