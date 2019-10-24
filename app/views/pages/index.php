<?php require APPROOT . '/views/inc/header.php'; ?>

<?php echo $data['title']; ?> to /pages/index :-)

<br><br>
Show all posts:
<br>
<?php
	$posts = $data['posts'];
?>

<?php foreach($posts as $post) : ?>
	<li><?php echo $post->title; ?></li>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
