<?php
//Start by getting the data POSTed to the callback by the thumbifier (remember it's JSON encoded).
$data = json_decode($_POST['data'], true);

//We'll use the GUID as our filename, but you should probably do something a bit smarter
$file = "/path_to_storage/{$data['payload']['guid']}.jpg";
//You could use the reference you passed in to write to a more appropriate file name
//$file = "/path_to_storage/{$data['payload']['reference']}.jpg"

//Check to see if everything has gone well
if($data['status'] === "success") {
  //If it has, then write the base64 decoded data to a file (which gives us our jpg file)
  file_put_contents($file, base64_decode($data['payload']['image']));
} else {
  //If it hasn't then, panic! Or just do something smarter
  echo "Bad things have happened like ->" . $data['payload']['message'];
}   