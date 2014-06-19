<?php 

//Build an array of the POST data you want to send to the thumbifier.
$data = array(
  "token"     => "<843201D9A63E4806CFCF1871CFBCD101>",
  "url"       => "http://eltdp.dev/test.docx",
  "quality"   => "80",
  "size"      => "256x256",
  "reference" => "my_internal_file_db_id",
  "page"      => "0",
  "callback"  => "http://eltdp.dev/thumbnail-callback.php",
);

//Build a HTTP Query from with the data you want to post (the above array)
$postdata = http_build_query($data);
//Set the options for the HTTP Stream to be a POST method and to contain your HTTP Query data (your POST data)
$opts = array("http" =>
  array(
    "method"  => "POST",
    "header"  => "Content-type: application/x-www-form-urlencoded",
    "content" => $postdata
  )
);
//Create a stream with the above options, which will make the file_get_contents perform a POST to the web service.
$context  = stream_context_create($opts);
//Now call the thumbify.me service as a POST with your given data.
$result = file_get_contents("http://www.thumbify.me", false, $context);  

print_r($result);