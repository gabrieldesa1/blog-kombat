<?php
// Conexão
$mysqli = new mysqli("localhost", "root", "root", "blog");

if ($mysqli->connect_errno) {
    echo "Falha na conexão: " . $mysqli->connect_error;
    exit();
}

include 'data/posts.php';

// Percorre o array e insere
foreach ($posts as $post) {
    $title = $mysqli->real_escape_string($post['title']);
    $description = $mysqli->real_escape_string($post['description']);
    $tags = $mysqli->real_escape_string(implode(',', $post['tags'])); // transforma array em string separada por vírgula
    $img = $mysqli->real_escape_string($post['img']);

    $sql = "INSERT INTO posts (title, description, tags, img) 
            VALUES ('$title', '$description', '$tags', '$img')";

    if (!$mysqli->query($sql)) {
        echo "Erro ao inserir post: " . $mysqli->error;
    }
}

echo "Posts importados com sucesso!";
?>
