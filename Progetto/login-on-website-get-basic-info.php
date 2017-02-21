<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '990807884348806',
  'app_secret' => '75623fb4313f49d32e9d0d331db57246',
  'default_graph_version' => 'v2.6',
  ]);

$fb->CURL_OPTS['CURLOPT_CONNECTTIMEOUT'] = 30; 

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','user_birthday', 'user_location', 'user_website','user_friends', 'user_likes','user_photos, user_posts', 'user_hometown', 'user_education_history', 'user_religion_politics']; // optional
	
try {
	if (isset($_SESSION['facebook_access_token'])) {
		$accessToken = $_SESSION['facebook_access_token'];
	} else {
  		$accessToken = $helper->getAccessToken();
	}
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 	// When Graph returns an error
 	echo 'Graph returned an error: ' . $e->getMessage();

  	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  	exit;
 }

if (isset($accessToken)) {
	if (isset($_SESSION['facebook_access_token'])) {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		// getting short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

	  	// OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		// Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		// setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}
	/*
	// redirect the user back to the same page if it has "code" GET variable
	if (isset($_GET['code'])) {
		header('Location: ./');
	}
	*/
	// get data
	//QUI INCLUDERE ed ESCLUDERE LE VARIE COSE
	try {
		//get picture photo of user
		$requestPicture = $fb->get('/me/picture?redirect=false&height=300'); //getting user picture
		$picture = $requestPicture->getGraphUser();
		// getting basic info about user
		//$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
		$profile_request = $fb->get('/me?fields=name,first_name,last_name,birthday,website,location,hometown,education,religion, gender');
		$profile = $profile_request->getGraphNode()->asArray();
		$profile_2 = $profile_request->getGraphUser();
		// get list of friends' names
		$requestFriends = $fb->get('/me/taggable_friends?fields=name&limit=100');
		$friends = $requestFriends->getGraphEdge();
		// get list of pages liked by user
		$requestLikes = $fb->get('/me/likes?limit=100');
		$likes = $requestLikes->getGraphEdge();
		// getting all photos of user
		$photos_request = $fb->get('/me/photos?limit=100&type=uploaded');
		$photos = $photos_request->getGraphEdge();
		// getting email
		$response = $fb->get('/me?locale=en_US&fields=name,email');
		$userNode = $response->getGraphUser();
		//post user
		$posts_request = $fb->get('/me/posts?limit=500');

		//$interessi = $fb->get('/me/likes');
		//$int = $interessi->getGraphEdge();
		//var_dump($int);
		

	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		echo 'Graph returned an error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ./");
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	//CREAZIONE FILE DI TESTO
	//for writing on file
	$myfile = fopen($profile['id']. '_retrieved_data' . '.txt', "w") or die("Unable to open file!");
	//INCLUDERE CHMOD per i permessi
	$txt = "-RETRIEVED_DATA:\n\n\n";
	fwrite($myfile, $txt);
            
		//print photo user
		// showing picture on the screen
	if(isset($picture['url'])){
		echo "<img src='".$picture['url']."'/>";
		// saving picture
		$img = __DIR__.'/'.$profile['id'].'_profile_picture'.'.jpg';
		file_put_contents($img, file_get_contents($picture['url']));
	}
		// printing data PROFILE on screen
		echo "</br></br>". "PROFILE".'</br></br>';
		// printing $profile array on the screen which holds the basic info about user
		print_r($profile);
		//more specific
		echo "</br></br>SPECIFIC-PROFILE".'</br>';
		echo '</br></br>';
	if(isset($profile['id'])){
		echo "-ID_PROFILO: ". $profile['id'] . '</br></br>';
		$txt = "-ID_PROFILO: ". $profile['id'] . "\n";
		fwrite($myfile, $txt);
	}
	if(isset($userNode['email'])){
		//get email
		//var_dump($userNode->getField('email'), $userNode['email']);
		echo "-EMAIL: ". $userNode['email'] . '</br></br>';
		$txt = "-EMAIL: ". $userNode['email'] . "\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['name'])){
		echo "-NOME_COMPLETO: ". $profile['name'] . '</br></br>';
		$txt = "-NOME_COMPLETO: ". $profile['name'] . "\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['first_name'])){
		echo "-NOME-". $profile['first_name'] . '</br></br>';
		$txt = "-NOME: ". $profile['first_name'] . "\n";
		fwrite($myfile, $txt);
	}

	if(isset($profile['last_name'])){
		echo "-COGNOME-". $profile['last_name'] . '</br></br>';
		$txt = "-COGNOME: ". $profile['last_name'] . "\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['gender'])){
		echo "-SESSO-". $profile['gender'] . '</br></br>';
		$txt = "-SESSO: ". $profile['gender'] . "\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['birthday'])){
		echo "-DATA-NASCITA: ". $profile['birthday']->format('d-m-Y').'</br></br>';
		$txt = "-DATA-NASCITA: ". $profile['birthday']->format('d-m-Y')."\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['website'])){
		echo "-SITO-WEB: ". $profile['website'].'</br></br>';
		$txt = "-SITO-WEB: ". $profile['website']."\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['location'])){
		echo "-CITTA-ATTUALE: ". $profile['location']['name'].'</br></br>';
		$txt = "-CITTA-ATTUALE: ". $profile['location']['name']."\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['hometown'])){
		echo "-HOMETOWN: ". $profile['hometown']['name'].'</br></br>';
		$txt = "-HOMETOWN: ". $profile['hometown']['name']."\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['religion'])){
		$religione=strval($profile['religion']);
		$rel = str_replace('()', '', $religione); // Replaces all spaces with ''.
		echo "-RELIGIONE: ". $rel .'</br></br>';
		$txt = "-RELIGIONE: ". $rel ."\n";
		fwrite($myfile, $txt);
	}
	if(isset($profile['education'])){
		echo "-STUDI".'</br></br>';
		$txt = "\n\nSTUDI:\n\n";
		fwrite($myfile, $txt);
		$total_education = array();
		$total_education = $profile['education'];
		foreach ($total_education as $key) {
				echo "<b>".$key['school']['name'] ."</b>"."</br>";
				$txt = $key['school']['name']."\n";
				fwrite($myfile, $txt);
				//$txt = $key['school']['name']."\n";
				//fwrite($myfile, $txt);
			}
		var_dump($total_education);
	}

		// printing data FRIENDS on screen
		echo '</br></br>'."FRIENDS".'</br></br>';
		$txt = "\n\nFRIENDS:\n\n";
		fwrite($myfile, $txt);

		// if have more friends than 100 as we defined the limit above on line no. 70
		if ($fb->next($friends)) {
			$allFriends = array();
			$friendsArray = $friends->asArray();
			$allFriends = array_merge($friendsArray, $allFriends);
			while ($friends = $fb->next($friends)) {
				$friendsArray = $friends->asArray();
				$allFriends = array_merge($friendsArray, $allFriends);
			}
			foreach ($allFriends as $key) {
				echo $key['name'] . "<br>";
				$txt = $key['name']."\n";
				fwrite($myfile, $txt);
			}
			echo count($allfriends);
		} else {
			$allFriends = $friends->asArray();
			$totalFriends = count($allFriends);
			foreach ($allFriends as $key) {
				echo $key['name'] . "<br>";
				$txt = $key['name']."\n";
				fwrite($myfile, $txt);
			}
		}

		// printing data LIKE on screen
		echo '</br></br>'."INTERESTS(LIKE)".'</br></br>';
		$txt = "\n\nINTERESTS(LIKE):\n\n";
		fwrite($myfile, $txt);

		$totalLikes = array();
		if ($fb->next($likes)) {	
			$likesArray = $likes->asArray();
			$totalLikes = array_merge($totalLikes, $likesArray); 
			while ($likes = $fb->next($likes)) { 
				$likesArray = $likes->asArray();
				$totalLikes = array_merge($totalLikes, $likesArray);
			}
		} else {
			$likesArray = $likes->asArray();
			$totalLikes = array_merge($totalLikes, $likesArray);
		}

		// printing data on screen
		foreach ($totalLikes as $key) {
			echo $key['name'] . '<br>';
			$txt = $key['name']."\n";
			fwrite($myfile, $txt);

		}
		//foto 
		echo "</br></br>". "PHOTOS".'</br></br>';
		$all_photos = array();
		if ($fb->next($photos)) {
			$photos_array = $photos->asArray();
			$all_photos = array_merge($photos_array, $all_photos);
			while ($photos = $fb->next($photos)) {
				$photos_array = $photos->asArray();
				$all_photos = array_merge($photos_array, $all_photos);
			}
		} else {
			$photos_array = $photos->asArray();
			$all_photos = array_merge($photos_array, $all_photos);
		}

		$i=0;
		foreach ($all_photos as $key) {
			$photo_request = $fb->get('/'.$key['id'].'?fields=images');
			$photo = $photo_request->getGraphNode()->asArray();
			echo '<img src="'.$photo['images'][2]['source'].'"><br>';

			$img = __DIR__.'/'.$profile['id']. '_phhoto_'. $i .'.jpg';
			file_put_contents($img, file_get_contents($photo['images'][2]['source']));
			$i++;
		}
		// post
		$total_posts = array();
		$posts_response = $posts_request->getGraphEdge();
		if($fb->next($posts_response)) {
			$response_array = $posts_response->asArray();
			$total_posts = array_merge($total_posts, $response_array);
			while ($posts_response = $fb->next($posts_response)) {	
				$response_array = $posts_response->asArray();
				$total_posts = array_merge($total_posts, $response_array);	
			}
			//print_r($total_posts);
		} else {
			$posts_response = $posts_request->getGraphEdge()->asArray();
			//print_r($posts_response);

		}
		echo '<br>';
		echo '<br>';
		// printing data on screen
		echo "<pre>";
		var_dump($posts_response);
		echo "</pre>";
		
		//echo "<b>". count($posts_response)."</b>"; //num_element $post_response
		//$i=count($posts_response);
		echo "</br></br>". "POST".'</br>';
		echo "In ordine cronologico dal più recente".'</br></br>';
		$txt = "\n\nPOST\nIn ordine cronologico dal più recente\n\n";
		fwrite($myfile, $txt);

		foreach ($posts_response as $key) {
			
			if(isset($key['story'])){
				echo $key['story']. '</br>'; //questo è quello che riguarda le modifiche dei dati dell'account
				$txt = $key['story']."\n";
				fwrite($myfile, $txt);
			}
			if(isset($key['message'])){
				echo $key['message'] . "-DATE:-> "; //questo è un messaggio del POST scritto dall'utente
				$vars = get_object_vars($key['created_time']); 
				//print_r ( $vars );
				echo $vars['date']. '</br>';
				$txt = $key['message']."-DATE: ".$vars['date']."\n";
				fwrite($myfile, $txt);
			}


		//$txt = $key['name']."\n";
		//fwrite($myfile, $txt);
		

	}

	fclose($myfile);
	//NON FUNZIONA!!
	/*
	 echo'<li><a href="?action=logout">Logout</a></li>';
	 if(isset($_GET['action']) && $_GET['action'] === 'logout'){
	}

	*/



	
	
 /*
$logoutUrl = $helper->getLogoutUrl($accessToken, 'http://localhost:8888/master');
echo '<a href="' . $logoutUrl . '">Logout of Facebook!</a>';
*/

  	// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']
} else {
	// replace your website URL same as added in the developers.facebook.com/apps e.g. if you used http instead of https and you used non-www version or www version of your website then you must add the same here
	$loginUrl = $helper->getLoginUrl('http://localhost:8888/master/login-on-website-get-basic-info.php', $permissions);
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';


}







