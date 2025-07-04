<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>

    <label for="title">Title</label>
    <input type="text" name="title" /><br />

    <label for="text">Text</label>
    <textarea name="text"></textarea><br/>

	<label for="text">Autor: <?php echo $this->session->userdata('username') ?> </label>

    <input type="submit" name="submit" value="Create news item" />
	<button><a href="<?php echo site_url('/news'); ?>">Back to List News</a></button>

</form>
