<?php
if(@$_FILES['fileVideo']['tmp_name']){
	require_once 'Google/autoload.php';
	$key = file_get_contents('the_key.txt');

	require_once 'Google/Client.php';
	require_once 'Google/Service/YouTube.php';
	 
	$application_name 	= 'Ichibanlist Uploader'; 
	$client_secret 		= 'Y5ylmncAp2PzrUaduXaMBAnb';
	$client_id 			= '270244185110-7ckg2k8v7jc93diiqqqt998amdrj9okf.apps.googleusercontent.com';
	$scope 				= array('https://www.googleapis.com/auth/youtube.upload', 'https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtubepartner');

	$videoPath 			= $_FILES['fileVideo']['tmp_name'];
	$videoTitle 		= "ichibanlist.com - ".$_POST['video_title'];
	$videoDescription 	= $_POST['video_description'];
	$videoCategory 		= "22";
	$videoTags 			= array("post attachment");
	 
	try{
		$client = new Google_Client();
		$client->setApplicationName($application_name);
		$client->setClientId($client_id);
		$client->setAccessType('offline');
		$client->setAccessToken($key);
		$client->setScopes($scope);
		$client->setClientSecret($client_secret);
	 
		if ($client->getAccessToken()) {
			if($client->isAccessTokenExpired()) {
				$newToken = json_decode($client->getAccessToken());
				$client->refreshToken($newToken->refresh_token);
				$token = $client->getAccessToken();
				file_put_contents('the_key.txt', $token);
			}
	 
			$youtube = new Google_Service_YouTube($client);
	 
			$snippet = new Google_Service_YouTube_VideoSnippet();
			$snippet->setTitle($videoTitle);
			$snippet->setDescription($videoDescription);
			$snippet->setCategoryId($videoCategory);
			$snippet->setTags($videoTags);
	 
			$status = new Google_Service_YouTube_VideoStatus();
			$status->setPrivacyStatus('private');
	 
			$video = new Google_Service_YouTube_Video();
			$video->setSnippet($snippet);
			$video->setStatus($status);
	 
			$chunkSizeBytes = 1 * 1024 * 1024;
	 
			$client->setDefer(true);
	 
			$insertRequest = $youtube->videos->insert("status,snippet", $video);
	 
			$media = new Google_Http_MediaFileUpload(
				$client,
				$insertRequest,
				'video/*',
				null,
				true,
				$chunkSizeBytes
			);
			$media->setFileSize(filesize($videoPath));
	 
			$status = false;
			$handle = fopen($videoPath, "rb");
			while (!$status && !feof($handle)) {
				$chunk = fread($handle, $chunkSizeBytes);
				$status = $media->nextChunk($chunk);
			}
	 
			fclose($handle);
			
			if ($status->status['uploadStatus'] == 'uploaded') {
				$data['id'] 		= $status->id;
				$modeldata			= $status->snippet['modelData'];
				$data['thumbnails']	= $modeldata['thumbnails'];
				$data['local']		= $modeldata['localized'];
				print_r(json_encode($data));
			}
	 
			$client->setDefer(true);
	 
		} else{
			echo 'Problems creating the client';
		}
	 
	} catch(Google_Service_Exception $e) {
		print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage();
		print "Stack trace is ".$e->getTraceAsString();
	}catch (Exception $e) {
		print "Caught Google service Exception ".$e->getCode(). " message is ".$e->getMessage();
		print "Stack trace is ".$e->getTraceAsString();
	}
}
?>