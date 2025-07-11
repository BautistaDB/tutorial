<html>

<head>
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<div id="mensaje-login"> <!-- solo para que aparezca el mensaje --> </div>

<?php
	echo '<h2>' . $news_item['title'] . '</h2>';
	echo $news_item['text'];
?>

<div>
	<button id="upvote" data-id-news="<?= $news_item['id'] ?>" class="vote-button">⇑</button>
	<button id="downvote" data-id-news="<?= $news_item['id'] ?>" class="vote-button down">⇓</button>
</div>

<div>
    <p>Votos positivos: <?= $upvotes ?></p>
    <p>Votos negativos: <?= $downvotes ?></p>
</div>


<?php if (isset($votos)) : ?>
	<div>
		<p>Votos: <?= $votos['total'] ?></p>
		<p>Votos positivos: <?= $votos['positivos'] ?></p>
		<p>Votos negativos: <?= $votos['negativos'] ?></p>
	</div>
<?php endif; ?>

<script type="module">

	import { upvote, downvote,} from '/<?= URL_PREFIX ?>assets/js/vote.js';

	const upvoteButton = document.getElementById('upvote');
	upvoteButton.addEventListener('click', upvote);
	
	const downvoteButton = document.getElementById('downvote');
	downvoteButton.addEventListener('click', downvote);
		
</script>

</html>
