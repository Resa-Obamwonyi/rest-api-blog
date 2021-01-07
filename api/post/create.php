<?php 
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

     $post->title = $data->title;
     $post->body = $data->body;
     $post->author = $data->author;
     $post->category_id = $data->category_id;

     // Create the post

     if($post->create_post()){
        echo json_encode(
            array('message' => 'Post Created!!')
        );
     }
     else{
         echo json_encode(
            array('message' => 'Post Not Created!!')
         );
     }


?>