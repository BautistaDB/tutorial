<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


	<?php if ($this->session->userdata('logged_in')){ ?>
		<div class="mb-4">
			<a href="<?php echo site_url('/news/create'); ?>" class="btn btn-primary btn-lg"> Create New </a>
		</div>
		<?php } else{?>			
			<button><a href="<?php echo site_url('/users/login'); ?>" class="btn btn-primary btn-lg"> Login </a></button>
		<?php } ?>
	

<div class="container mt-5">
    <h2 class="mb-4"><?php echo $title; ?></h2>

    <?php foreach ($news as $news_item): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title"><?php echo $news_item['title']; ?></h3>
                <p class="card-text"><?php echo $news_item['text']; ?></p>
                <a href="<?php echo site_url('news/'.$news_item['slug']); ?>" class="btn btn-outline-primary">See more</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>

