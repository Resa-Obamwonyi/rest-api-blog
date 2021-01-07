<?php
 // Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: PUT');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


 include_once '../../config/Database.php';
 include_once '../../models/Post.php';
 

 // Instantiate DB Objects $ Connect
  $database = new Database();
 // calls the connect function inside Database.php
  $db = $database->connect();


 // Instantiate Blog post object
  $post = new Post($db);

  // Get the raw posted data
  $data = json_decode(file_get_contents("php://input"));

  //Set id to be updated
  $post->id = $data->id;

  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;

  // Update the post
  if($post->update_post()){
     echo json_encode(
         array('message' => 'Post Updated!!')
     );
  }
  else{
      echo json_encode(
         array('message' => 'Post Not Updated!!')
      );
  }

?>