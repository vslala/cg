<style type="text/css">
	body{
		padding-top: 150px;
	}
</style>
<div class="container">
		<!-- Search Thread -->
		  <div class="row" id="search_form_row"></div>
		  <input type="hidden" value="<?= base_url(); ?>process/searchThread/" id="thread_search_url" />
		  <script type="text/javascript" src="<?= base_url(); ?>js/reactJSSearch.js"></script>
		  <!-- / -->
	<div class="row">
		<div class="page-header">
			<h2>Notifications</h2>
		</div>
		<div class="row">
			<ul class="list-group">
			<?php foreach ($notifications as $n): ?>


			  <li class="list-group-item">
			  	<img href="<?= base_url(); ?>profile/index/<?= $n['user_id']; ?>" style="width: 50px;" src="<?= $n['image_url']; ?>" class="th" />
			  	<a href="<?= base_url(); ?>profile/index/<?= $n['user_id']; ?>"><?= $n['username']; ?></a> replied to your thread 
			  	<a href="<?= $n['event_id']; ?>"><?= $n['event']; ?></a>
			  </li>
			

			<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>