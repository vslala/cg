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
			<?php foreach ($replies as $reply): ?>
			<div class="row">
				<img class="th" style="width: 50px;" src="<?= $reply['image_url']; ?>" />
				<span class="usernameText"><?= $this->encrypt->decode($reply['username']); ?></span><br />
				<span class="replyText"><?= $reply['answer']; ?></span>
				<!-- <span class="left"> -->
					<div class="fb-like" data-href="<?= $reply['answer_url']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
					<br />
					<div class="fb-comments" data-href="<?= $reply['answer_url']; ?>" data-numposts="5"></div>
				<!-- </span> -->
			</div>
			<hr />
		<?php endforeach; ?>
		</div>
		<input type="hidden" value="<?= base_url(); ?>process/getReplies/<?= $thread[0]['id']; ?>" id="getRepliesUrl" />
		<script type="text/jsx">
			var replyUrl = $('#getRepliesUrl').val();

			var AnswerBox = React.createClass({
				loadFromServer: function (){
					$.get(this.props.source, function(data){
						data = $.parseJSON(data);
						this.setState({data: data});
					}.bind(this));
				},
				getInitialState: function(){
					return {data: []};
				},
				componentDidMount: function(){
					this.loadFromServer();
					setInterval(this.loadFromServer, this.props.pollInterval);
				},
				render: function(){
					
					return (
							<AnswerList data={this.state.data} />
						);
				}
			});

			var AnswerList = React.createClass({
				render: function(){
					var answerNodes = this.props.data.map(function(item){
						return (
							<div className="row" id="answer_row">
								<img className="th" style={{"width": "50px"}} src={item.image_url} />
								<span className="usernameText">{item.username}</span><br />
								<span className="replyText" dangerouslySetInnerHTML={{__html: item.answer}}></span><br />
									<div className="fb-like" data-href={item.answer_url} data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
									<br />
									<div data-mobile="true" className="fb-comments" data-href={item.answer_url} data-numposts="5"></div>
									<hr />
							</div>
							);
					});
					return (
						<div className="answerList">
							{{answerNodes}}
						</div>
						);
				}
			})

			React.render(
			  <AnswerBox source={replyUrl} pollInterval={5000} />,
			  document.getElementById('answer_wrap')
			);
		</script>
		
		<?php if($this->session->userdata('id')): ?>
			<?= form_open('process/reply', ['id'=>'answer_form', 'role'=>'form']); ?>
			<input value="<?= $thread[0]['id']; ?>" name="threadID" type="hidden">
			<input type="hidden" value="<?= $thread[0]['title']; ?>" name="threadTitle" />
			<textarea rows="2" name="reply" id="replyTextArea" placeholder="Reply to this thread"></textarea>
			<script>CKEDITOR.replace('replyTextArea');</script>
			<button class="button" type="submit" name="replySubmitBtn" >Post Your Answer</button>
			<?= form_close(); ?>
		<?php else: ?>
			<span class="link"><a href="<?= base_url(); ?>#login">Login</a></span> |
			<span class="link"><a href="<?= base_url(); ?>#register_section">Register</a>&nbsp; to Answer</span> 
		<?php endif; ?>
		<script type="text/javascript">
			$(document).ready(function(){

				var $answerForm = $('#answer_form');
				var $textarea = $('#replyTextArea');

				$answerForm.submit(function(e){
					e.preventDefault();

					for ( instance in CKEDITOR.instances ) {
					            CKEDITOR.instances[instance].updateElement();
					        }
					var url = $(this).attr('action');
					var data = $(this).serialize();

					$.ajax({
						url: url,
						type: 'POST',
						data: data,
						success: function(response){
							$textarea.val('');
							FB.XFBML.parse();
						},
						error: function(xhr,status,err){
							console.log(xhr.responseText);
						}
					});
				})
			})
	 	</script>
	</div>	
</div>

