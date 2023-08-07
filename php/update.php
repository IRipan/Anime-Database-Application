<?php
include 'functions.php';
$pdo = connection();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
        $release_date = isset($_POST['release_date']) ? $_POST['release_date'] : '';
        $eps = isset($_POST['eps']) ? $_POST['eps'] : '';
        $synopsis = isset($_POST['synopsis']) ? $_POST['synopsis'] : '';
        
        $stmt = $pdo->prepare('UPDATE animelist SET id = ?, name = ?, genre = ?, release_date = ?, eps = ?, synopsis = ? WHERE id = ?');
        $stmt->execute([$id, $name, $genre, $release_date, $eps, $synopsis, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM animelist WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $animelist = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$animelist) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$animelist['id']?></h2>
    <form action="update.php?id=<?=$animelist['id']?>" method="post">
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$animelist['id']?>" id="id">
        <label for="name">Title</label>
        <input type="text" name="name" value="<?=$animelist['name']?>" id="name" autocomplete="off">
        <label for="genre">Genre</label>
        <input type="text" name="genre" value="<?=$animelist['genre']?>" id="genre" autocomplete="off">
        <label for="release date">Release Date</label>
        <input type="text" name="release_date" value="<?=$animelist['release_date']?>" id="release_date" autocomplete="off">
        <label for="eps">Eps</label>
        <input type="text" name="eps" value="<?=$animelist['eps']?>" id="eps" autocomplete="off">
        <label for="synopsis">Synopsis</label>
        <textarea rows="15" cols="150" type="text" name="synopsis"  id="synopsis" autocomplete="off"></textarea>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>