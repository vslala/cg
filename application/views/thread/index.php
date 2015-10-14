<style type="text/css">
body{
	padding-top: 150px;
}
</style>
<div class="container">
	<div class="row">
		<div class="small-12 columns">
			<h3>Start a new Thread</h3>
		</div>
		<hr>
	<?php if ($this->session->flashdata('success_message')): ?>
		<span class="alert alert-success"><?= $this->session->flashdata('success_message'); ?></span>
	<?php endif; ?>
	<?php if ($this->session->flashdata('error_message')): ?>
		<span class="alert alert-danger"><?= $this->session->flashdata('error_message'); ?></span>
	<?php endif; ?>
    <?= form_open('process/startThread', ['id'=>'threadForm', 'role'=>'form']); ?>
		<div class="row">
			
			<div class="panel">
				<div class="row">
					<div class="small-3 columns">
						<strong> Title</strong>
					</div>
					<div class="small-9 columns">
						<input type="text" name="title" id="title" placeholder="Place the appropriate title for the thread" 
						minlength="10" required="true">
					</div>
				</div>
				<div class="row">
					<div class="small-3 columns">
						<strong> Description</strong>
					</div>
					<div class="small-9 columns">
						<textarea name="description" rows="4" id="description" placeholder="Describe your Thread"
						 minlength="10" maxlength="10000" required></textarea>
						 <script type="text/javascript">CKEDITOR.replace('description');</script>
					</div>
				</div>
				<div class="row">
					<div class="small-3 columns">
						<strong> Category</strong>
					</div>
					<div class="small-9 columns">
						<select name="category" required>
							<option selected disabled>Choose Category...</option>
							<?php foreach ($categories as $cat): ?>
								<option value="<?= $cat['id']; ?>"><?= $cat['category_name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="small-3 columns">
						<strong> Tags</strong>
					</div>
					<div class="small-9 columns">
						<input type="text" name="tags" id="tags" required="true" placeholder="ex #love #friendship #bootstrap etc...">
					</div>
				</div>
				<div class="row">
					<div class="small-3 columns">
						<strong> Featured Image URL</strong>
						<span class="help-block">(Image to use when sharing with facebook)</span>
					</div>
					<div class="small-9 columns">
						<input type="text" name="image_url" id="image" placeholder="http://xyz.jpeg">
					</div>
				</div>
				<div class="row">
					<div class="small-3 columns">
						<strong></strong>
					</div>
					<div class="small-9 columns">
						<button class="button" name="discussionSubmitBtn" type="submit">Publish My Thread</button>
					</div>
				</div>
			</div>
		</div>
    <?= form_close(); ?>
	</div>
</div> 
<script src="http://localhost/campusguru/js/vendor/jquery.js"></script>
<script src="http://localhost/campusguru/js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>




