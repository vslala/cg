<style type="text/css">
body{
	padding-top: 150px;
}
.thread-wrap{
	background-color: rgba(100,150,150,0.2);
	padding: 10px;
}
#answer_row{
	margin-top: 2px;
}
.link{
	font-size: small;
}
</style>
<div class="container">
	<div class="thread-wrap">
		<div class="row">
			<div class="">
				<div class="h3">
					<img class="th" style="width: 50px;" src="<?= $thread[0]['dp']; ?>">
					<?= $thread[0]['title']; ?>
					<div class="right">
						<span class="help-block">
							<label>Posted by: 
								<a href="<?= base_url(); ?>profile/index/<?= $thread[0]['user_id']; ?>">
									<strong><?= $thread[0]['username']; ?></strong>
								</a>
							</label>
							<?= $thread[0]['created_at']; ?>
						</span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="small-12 columns">
				<p><?= $thread[0]['description']; ?></p>
				<p>
				<?php foreach ($tags as $t):  ?>
					<label class="label info"><?= $t['tag']; ?></label>
				<?php endforeach; ?>
				<div class="fb-like" data-href="<?= $thread[0]['thread_url']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</div>
		</div>
	</div>
	<hr />

	<div class="row" id="answers">

		<div class="answersWrap" id="answer_wrap">
			<h2>Replies <span class="glyphicon glyphicon-triangle-bottom"></h2>
			<div class="row">
				<div class="comment_box">
					<div id="disqus_thread"></div>
						<script type="text/javascript">
						    /* * * CONFIGURATION VARIABLES * * */
						    var disqus_shortname = 'campusguru';
						    
						    /* * * DON'T EDIT BELOW THIS LINE * * */
						    (function() {
						        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
						        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						    })();
						</script>
						<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
				</div>
			</div>

		</div>

		
	</div>

</div>

