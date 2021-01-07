<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';


    // Instantiate DB Objects $ Connect
     $database = new Database();
    // calls the connect function inside Database.php
     $db = $database->connect();


    // Instantiate Blog post object
     $post = new Post($db);

    //Blog post query
     $all_posts = $post->get_posts();

    // Get row count
     $num_of_rows = $all_posts->rowCount();


    // Check if there are any posts
    if($num_of_rows > 0){

        // post array
        $post_array = array();
        $post_array['data'] = array();

        while($row = $all_posts->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => html_entity_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            // Push to "data"
            array_push($post_array['data'], $post_item);
        }

        // Turn to JSON & Output 
        echo json_encode($post_array);

    }else{
        echo json_encode(array($message =>'No Posts Found'));
    }

?>