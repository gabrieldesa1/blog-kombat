<?php
    $mysqli = new mysqli("localhost", "root", "root", "blog");

    if ($mysqli->connect_errno) {
        echo "Falha na conexão: " . $mysqli->connect_error;
        exit();
    }

    $sql = "SELECT * FROM posts";
    $result = $mysqli->query($sql);

    // Armazenar os posts em uma variável
    $posts = [];
    if ($result->num_rows > 0) {
        while ($post = $result->fetch_assoc()) {
            // Adiciona os posts ao array
            $post['tags'] = explode(',', $post['tags']); 
            $posts[] = $post;
        }
    } else {
        echo "Nenhum post encontrado.";
    }

    $mysqli->close();
?>

<?php include_once("templates/header.php"); ?>

<main>
    <div id="title-container">
        <h1>Blog Kombat</h1>
        <p>exemplo exemplo exemplo</p>
    </div>
    <div id="posts-container">
        <?php foreach($posts as $post): ?>
            <div class="post-box">
                <img src="<?= $BASE_URL ?>/img/<?= $post['img'] ?>" alt="<?= $post['title'] ?>">
                <h2 class="post-title">
                    <a href="<?= $BASE_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                </h2>
                <p class="post-description"><?= $post['description'] ?></p>
                <div class="tags-container">
                <?php foreach($post['tags'] as $tag): ?>
                        <a href="#"><?= $tag ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php 
    include_once("templates/footer.php");
?>
