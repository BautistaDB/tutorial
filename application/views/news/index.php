<h2><?php echo $title; ?></h2>

<button style="padding: 12px 24px; font-size: 18px;">
  <a href="<?php echo site_url('/news/create'); ?>" style="text-decoration: none; color: inherit;">Create New</a>
</button>


<?php foreach ($news as $news_item): ?>

        <h3><?php echo $news_item['title']; ?></h3>
        <div class="main">
                <?php echo $news_item['text']; ?>
        </div>
        <p><button><a href="<?php echo site_url('news/'.$news_item['slug']); ?>" style="padding: 12px 24px; font-size: 14px;">View article</a></button></p>

<?php endforeach; ?>
