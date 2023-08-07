<?php
include 'functions.php';
$pdo = connection();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$stmt = $pdo->prepare('SELECT * FROM animelist ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$animelists = $stmt->fetchAll(PDO::FETCH_ASSOC);
$num_animelists = $pdo->query('SELECT COUNT(*) FROM animelist')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Anime List</h2>
	<a href="create.php" class="create-contact">Add Anime</a>
	<table>
        <thead>
            <tr>
                <td>id</td>
                <td>Title</td>
                <td>Genre</td>
                <td>Release Date</td>
                <td>Eps</td>
                <td>Synopsis</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animelists as $animelist): ?>
            <tr>
                <td><?=$animelist['id']?></td>
                <td><?=$animelist['name']?></td>
                <td><?=$animelist['genre']?></td>
                <td><?=$animelist['release_date']?></td>
                <td><?=$animelist['eps']?></td>
                <td><?=$animelist['synopsis']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$animelist['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$animelist['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_animelists): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>