<?php
include 'functions.php';
$pdo = connection();
$msg = '';
if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $release_date = isset($_POST['release_date']) ? $_POST['release_date'] : '';
    $eps = isset($_POST['eps']) ? $_POST['eps'] : '';
    $synopsis = isset($_POST['synopsis']) ? $_POST['synopsis'] : '';


    $stmt = $pdo->prepare('INSERT INTO animelist VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $genre, $release_date, $eps, $synopsis]);

    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Add New Anime</h2>
    <form action="create.php" method="post" action="index.php" enctype="multipart/form-data">
        <label for="id">ID</label>
        <input type="text" name="id" id="id" autocomplete="off">
        <label for="name">Title</label>
        <input type="text" name="name" id="name" autocomplete="off">
        <label for="genre">Genre</label>
        <input type="text" name="genre" id="genre" autocomplete="off">
        <label for="release date">Release Date</label>
        <input type="text" name="release_date" id="release_date" autocomplete="off">
        <label for="eps">Eps</label>
        <input type="text" name="eps" id="eps" autocomplete="off">
        <label for="synopsis">Synopsis</label>
        <textarea rows="15" cols="150" type="text" name="synopsis" id="synopsis" autocomplete="off"></textarea>
        <input type="submit" value="Create">
        
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>