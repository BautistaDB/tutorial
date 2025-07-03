<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5">
    <h2 class="mb-4"><?php echo $title; ?></h2>

    <div class="mb-4">
        <a href="<?php echo site_url('/news/create'); ?>" class="btn btn-primary btn-lg"> Create New </a>
    </div>


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

