<style type="text/css">
body{
  padding-top: 50px;
}
.inline-text{
  display: inline-block;
}
#notification_dropdown{
  width: 300px;
}

</style>
<input type="hidden" value="<?= base_url(); ?>" id="base_address" />
<nav class="navbar navbar-fixed-top header">
 	<div class="col-md-12">
        <div class="navbar-header">
          <a class="navbar-brand" rel="home" href="<?= base_url(); ?>home/index" title="Buy Sell Rent Everyting">
            <img style="max-width:100px; height:45px; margin-top: -7px;"
                 src="<?= base_url(); ?>images/static/logo.png" class="th">
          </a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse1">
          <i class="glyphicon glyphicon-list"></i>
          </button>

        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse1">

              <!-- <div class="input-group" style="max-width:470px;">
                <input type="text" class="form-control" autocomplete="off" placeholder="Search" name="searchTerm" id="srch-term">
                <div class="help-block"  style="z-index: -1;" id="search_result_parent_div">
                    <ul id="search_result" class="list-group">

                    </ul>
                    <!-- Ajax search contents will be loaded here -->
                <!-- </div>
                <div class="input-group-btn">
                  <button class="btn btn-default btn-primary" type="submit" id="submitBtn"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div> --> 

          <ul class="nav navbar-nav navbar-right">

             <!-- <li>@if(isset($userImage[0]))<a href="<?= base_url(); ?>" class="pull-right">{!! Html::image($userImage[0]['image_url'],"dp",['title'=>'profile_image', 'class'=>'img img-responsive img-rectangle', 'style'=>'height: 25px;']) !!}</a> @endif</li> -->
             <?php if($this->session->userdata('id')): ?>
               <li style="font-size: small;">
                <a href="<?= base_url(); ?>profile/index/<?php if($this->session->userdata('id')) echo $this->session->userdata('id'); ?>" >
                  Logged in as: <?php if(isset($dp[0]['image_url'])): ?><img src="<?= $dp[0]['image_url']; ?>" class="th" style="width: 25px;"><?php endif; ?><?= $this->session->userdata('username'); ?>
                </a>
              </li>
            <?php endif; ?>
             <li >
                <a href="#" data-dropdown="notification_dropdown" aria-controls="notification_dropdown" aria-expanded="false">
                  <i class="glyphicon glyphicon-th-large"></i><span class="badge">
                  <?php if(isset($notifications[0])): ?>
                    <?= $notifications[0]['notification_count']; ?>
                  <?php else: ?>
                    0
                  <?php endif; ?>
                </span>
                </a>
                <div class="notifications-dropdown-wrapper">
                  <ul class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1" id="notification_dropdown">

                    <?php if(isset($notifications[0])): ?>
                    <?php foreach($notifications as $n): ?>
                      <li <?php if($n['status'] == true) echo 'style="background-color: yellow;" '; ?>>
                        <a class="inline-text" style="color: blue; font-weight: bold;" href="<?= base_url(); ?>profile/index/<?= $n['user_id']; ?>"><?= $n['username']; ?></a>
                        &nbsp; <span class="inline-text"> replied to your thread </span>
                        <a class="inline-text" style="color:blue; font-weight: bold;" href="<?= $n['event_id']; ?>"><?= $n['event'] ?></a>
                      </li>
                      <li class="nav-divider"></li>
                    <?php endforeach; ?>    
                    <?php endif; ?> 
                    <li><a href="<?= base_url(); ?>home/notification" >See all Notifications</a></li>  

                  </ul>
                </div>
             </li>

             <!-- Notification for questions and discussions -->
             <!-- <li>
                <a href="#" id="notification_toggle" class="dropdown-toggle @if(isset($notifications[0])) {{ 'bg-danger' }} @else {{ 'bg-success' }} @endif" data-toggle="dropdown"><i class="glyphicon glyphicon-bell">
                     @if(isset($notifications[0]))
                    <span class="badge">
                            {{ count($notifications) }}
                    </span>
                    @endif
                </i></a>

                @if(isset($notifications[0]))
                <ul class="dropdown-menu">
                  @foreach($notifications as $n)
                    @if(intval($n->n_for) == 1)
                    <li><a href="{{ route('show', ["id"=>$n->n_id_of, "title"=>"answered to the question number ".$n->n_id_of]) }}" class="dropdown_link"><span class="label label-info pull-right"></span><strong>{{ $n->n_by }}</strong> answered your question</a></li>
                     <li class="nav-divider"></li>
                    @elseif($n->n_for == 2)
                    <li><a href="{{ route('singleDiscussion', ["id"=>$n->n_id_of, "title"=>"discussion number ".$n->n_id_of]) }}" class="dropdown_link"><span class="label label-info pull-right"></span><strong>{{ $n->n_by }}</strong> replied on your discussion</a></li>
                    <li class="nav-divider"></li>
                    @elseif($n->n_for == 21)
                    <li><a href="{{ route('singleDiscussion', ["id"=>$n->n_id_of, "title"=>"Reply on discussion number ".$n->n_id_of]) }}" class="dropdown_link"><span class="label label-info pull-right"></span><strong>{{ $n->n_by }}</strong> replied on this discussion you previously replied to.</a></li>
                    <li class="nav-divider"></li>
                    @elseif($n->n_for == 3)
                    <li><a href="{{ route('singleMessage', $n->n_id_of) }}" class="dropdown_link"><span class="label label-info pull-right"></span><strong>{{ $n->n_by }}</strong> messaged you</a></li>
                    <li class="nav-divider"></li>
                    @elseif($n->n_for == 4)
                    <li><a href="{{ route('show', ["id"=>$n->n_id_of, "title"=>"Comment on the answer with question number ".$n->n_id_of]) }}" class="dropdown_link"><span class="label label-info pull-right"></span><strong>{{ $n->n_by }}</strong> commented on your answer</a></li>
                    <li class="nav-divider"></li>
                    @elseif($n->n_for == 41)
                    <li><a href="{{ route('show', ["id"=>$n->n_id_of, "title"=>"Comment on the comment with question number ".$n->n_id_of]) }}" class="dropdown_link"><span class="label label-info pull-right"></span><strong>{{ $n->n_by }}</strong> commented on your comment on this question</a></li>
                    <li class="nav-divider"></li>
                    @endif
                  @endforeach
                </ul>
                @endif
             </li> -->

            <!-- Notification ends here -->

             <li><a href="<?= base_url(); ?>process/logout"><i class="glyphicon glyphicon-log-out"></i></a></li>
           </ul>
        </div>
     </div>
</nav>
<div class="navbar navbar-default navbar-fixed-top" id="subnav">
    <div class="col-md-12">
        <div class="navbar-header">

          <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> Home <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
          <ul class="nav dropdown-menu">
              <li><a href="<?= base_url(); ?>profile/index/<?= $id; ?>"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Profile</a></li>
              <li><a href="<?= base_url(); ?>home/index"><i class="glyphicon glyphicon-dashboard" style="color:#0000aa;"></i> Home</a></li>
              <li><a href="<?= base_url(); ?>thread/index"><i class="glyphicon glyphicon-education" style="color:#0000aa;"></i> Start Thread</a></li>
              <li><a href="<?= base_url(); ?>blog"><i class="glyphicon glyphicon-pencil" style="color:#0000aa;"></i> Blog</a></li>
              <li class="nav-divider"></li>
              <li><a href="#"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
              <li><a href="<?= base_url(); ?>process/logout"><i class="glyphicon glyphicon-log-out" style="color:#11dd11;"></i> Logout</a></li>
          </ul>


          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse2">
          <ul class="nav navbar-nav navbar-right">
             <li class="<?php if(isset($setBlogActive)) echo 'active'; ?>"><a href="<?= base_url(); ?>/blog">Blogs</a></li>
             <li><a href="<?= base_url(); ?>profile/post/<?= $this->session->userdata('id'); ?>">My Threads</a></li>
             <li class="<?php if(isset($setThreadActive)) echo 'active'; ?>"><a href="<?= base_url(); ?>thread/index">Start a Thread</a></li>
           </ul>
        </div>
     </div>
</div>
  