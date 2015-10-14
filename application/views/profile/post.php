<style type="text/css">
@keyframes colorchange{
	from {background-color: white;}
	to {background-color: lightgrey;}
}
*{
	margin: 0px;
}
body{
  padding-top: 150px;
}
a{
  display: block;
}
#thread_wrapper{
  padding: 10px;
}
.datetime{
  font-size: xx-small;
}
.edit-form{
	padding: 10px;
	border: lightyellow; 
}
.list-inline{
	display: inline-block;
}
.thread{
	display: block;
	padding: 0px 5px 0px 5px;
}
.thread:hover{
	background-color: lightgrey;
	animation-name: colorchange;
	animation-duration: 1s;
}
.links{
	padding: 0px 0px 10px 10px;
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
			<h2><img src="<?php if(isset($dp[0]['image_url'])) echo $dp[0]['image_url']; else echo 'http://s6.postimg.org/bdl0esqtd/Profile_Holder.png'; ?>" class="th" style="width: 50px;" />My Threads</h2>
		</div>
	</div>
	<div class="row">
		<div class="small-12 columns"></div>
		<?php foreach ($threads as $t): ?>
			<div class="thread_wrapper" id="thread_wrapper">
		      <div class="row">
		        <div class="small-2 columns" >
		          <a href="<?= $t['thread_url']; ?>#disqus_thread"></a>
		        </div>
		        <div class="small-8 columns">
		          <a class="thread" href=<?= $t['thread_url']; ?>>
		            	<?= $t['title']; ?>       	
		          </a>
		            <br />
		            <div class="links">
		            	<a class="list-inline" href="#collapse_<?= $t['id']; ?>" data-toggle="collapse" role="button">edit</a> |&nbsp;
		            	<a class="list-inline" href="<?= base_url(); ?>process/deleteThread/<?= $t['id']; ?>">delete</a>
		            </div>
	            	<div class="collapse edit-form" id="collapse_<?= $t['id']; ?>">
	            		<h4>Edit Form</h4>
	            	<?= form_open('process/editThread'); ?>
	            		<input type="text" name="title" value="<?= $t['title']; ?>" />
	            		<textarea rows="2" name="description" id="description_text"><?= $t['description']; ?></textarea>
	            		<input type="text" name="image_url" value="<?= $t['image_url'] ?>" />
	            		<script type="text/javascript">
	            		CKEDITOR.replace('description_text');

					            		/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
				          var disqus_shortname = 'campusguru'; // required: replace example with your forum shortname

				          /* * * DON'T EDIT BELOW THIS LINE * * */
				          (function () {
				          var s = document.createElement('script'); s.async = true;
				          s.type = 'text/javascript';
				          s.src = '//' + disqus_shortname + '.disqus.com/count.js';
				          (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
				          }());

	            		</script>
	            		<input type="hidden" name="threadID" value="<?= $t['id']; ?>" />
	            		<button class="button" type="submit">Save</button>
	            	<?= form_close(); ?>
	            	</div>
		          
		        </div>
		        <div class="small-2 columns">
		          <span class="help-block datetime"><?= $t['created_at']; ?></span>
		        </div>
		      </div>
		      <hr />
		    </div>
			<?php endforeach; ?>
		</div>
	</div>
	
</div>