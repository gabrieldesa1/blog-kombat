<?php
    include_once("templates/header.php");
    include_once("data/categories.php");

    if (isset($_GET['id'])) {
        $postId = (int)$_GET['id'];

        $mysqli = new mysqli("localhost", "root", "root", "blog");

        if ($mysqli->connect_errno) {
            echo "Falha na conexão: " . $mysqli->connect_error;
            exit();
        }

        $sql = "SELECT * FROM posts WHERE id = $postId";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $currentPost = $result->fetch_assoc();
        } else {
            echo "Post não encontrado.";
            exit();
        }
    } else {
        echo "ID não fornecido.";
        exit();
    }
?>

<main id="post-container">
    <div class="content-container">
        <h1 id="main-title"><?= $currentPost['title'] ?></h1>
        <p id="post-description"><?= $currentPost['description'] ?></p>

        <div class="img-container">
            <img src="<?= $BASE_URL ?>/img/<?= $currentPost['img'] ?>" alt="<?= $currentPost['title'] ?>">
        </div>

        <p class="post-content"><?= $currentPost['content'] ?></p>
    </div>

    <aside id="nav-container">
        <div class="nav-container">
            <h3 id="tags-title">Tags</h3>
            <ul id="tag-list">
                <?php foreach(explode(',', $currentPost['tags']) as $tag): ?>
                    <li><a href="#"><?= trim($tag) ?></a></li>
                <?php endforeach; ?>
            </ul>

            <h3 id="categories-title">Categorias</h3>
            <ul id="categories-list">
                <?php foreach($categories as $category): ?>
                    <li><a href="#"><?= $category ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>
</main>

<?php
    include_once("templates/footer.php");
?>
