<style type="text/css">
	body{
		padding-top: 150px;
	}
</style>
<div class="container">
	<div class="row">
		<div class="page-header">
			<div class="h3"><?= $answer[0]['answer']; ?></div>
		</div>
	</div>
	<div class="row">
		<div className="fb-like" data-href="<?= $answer[0]['answer_url']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
		<br />
		<div id="disqus_thread"></div>
		<div data-mobile="true" className="fb-comments" data-href="<?= $answer[0]['answer_url']; ?>" data-numposts="5" id="fb_comments"></div> 
		<hr />
	</div>
</div>