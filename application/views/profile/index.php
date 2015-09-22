
<style type="text/css">
body{
    padding-top: 150px;
}
#profile_edit_modal{
    overflow-y: scroll;
}
#social_add_ons{
    margin-top: 50px;
}
#para{
    font-family: tahoma sans-serif;
    font-size: medium;
    font-weight: 300;
}
</style>

<div class="container">
    <div class="row">
        <div class="small-4 columns">
            <img class="th" src="<?php if(isset($dp[0]['image_url'])) echo $dp[0]['image_url']; else echo 'http://s6.postimg.org/bdl0esqtd/Profile_Holder.png'; ?>" /><br />
            <?= form_open_multipart('process/upload', ['id'=>'dp_upload_form']); ?>
            <div class="form-group">
                <input type="file" class="form-control" id="userfile" name="userfile">
                <input type="submit" class="hidden" value="upload" id="file_upload_button" />
            </div>
            <?= form_close(); ?>
        </div>
        <div class="small-8 columns">
            <ul class="small-block-grid-2">
                <li>
                    <span class="glyphicon glyphicon-user"><?= $username ?></span><br />
                    <span class="glyphicon glyphicon-envelope"><?= $email; ?></span><br />
                    <span class="glyphicon glyphicon-">College: <?= $college; ?></span><br />
                    <span class="glyphicon glyphicon-">Branch: <?= $branch[0]['branch_name']; ?></span><br />
                </li>
                <li>
                    <a href="<?= base_url(); ?>thread/index" class="button alert">Start a New Thread</a><br />
                    <a href="#" data-reveal-id="profile_edit_modal" class="button">Edit Profile</a>
                    <a href="<?= base_url(); ?>profile/post/<?= $id; ?>" class="button success">View My Threads</a>
                </li>
            </ul>
            <div class="row" id="social_add_ons">
                <ul class="small-block-grid-5">
                    <?php if(isset($userProfile[0]['instagram'])): ?>
                        <li><a target="_blank" class="webicon instagram large" href="https://www.instagram.com/<?= $userProfile[0]['instagram']; ?>">Instagram</a></li>
                    <?php endif; ?>
                    <?php if(isset($userProfile[0]['facebook'])): ?>
                    <li><a target="_blank" class="webicon facebook large" href="https://www.facebook.com/<?= $userProfile[0]['facebook']; ?>">Facebook</a></li>
                    <?php endif; ?>
                    <?php if(isset($userProfile[0]['twitter'])): ?>
                    <li><a target="_blank" class="webicon twitter large" href="https://www.twitter.com/<?= $userProfile[0]['twitter']; ?>">Twitter</a></li>
                    <?php endif; ?>
                    <?php if(isset($userProfile[0]['github'])): ?>
                    <li><a  target="_blank" class="webicon github large" href="https://www.github.com/<?= $userProfile[0]['github']; ?>">Github</a></li>
                    <?php endif; ?>
                    <?php if(isset($userProfile[0]['about_me'])): ?>
                    <li><a target="_blank" class="webicon aboutme large" href="https://about.me/<?= $userProfile[0]['about_me']; ?>">About Me</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
<hr />
<div class="container">
    <div class="small-4 columns">
            <table>
                <thead>
                    <tr>
                        <th>Summary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Answers :</td>
                        <td><?= $userProfile[0]['total_answers']; ?></td>
                    </tr>
                    <tr>
                        <td>Threads Started :</td>
                        <td><?= $userProfile[0]['threads_started']; ?></td>
                    </tr>
                    <tr>
                        <td>Reputation :</td>
                        <td>
                            <?php echo pow(intval($userProfile[0]['total_answers']),intval($userProfile[0]['threads_started'])); ?>
                            <span class="glyphicon glyphicon-star"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Seen :</td>
                        <td><?= $userProfile[0]['last_seen']; ?></td>
                    </tr>
                    <tr>
                        <td>Status :</td>
                        <td><?php if($userProfile[0]['active']) echo 'online'; else echo 'offline'; ?></td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div class="small-8 columns">
        <div class="row">
            <div class="small-12 columns">
                <?php if (isset($userProfile[0]['about'])): ?>
                <div class="panel">
                    <h3>About</h3>
                    <p class="lead" id="para">
                        
                     <?= $userProfile[0]['about']; ?>
                        
                    </p>
                </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
    <!-- Modal Starts Here -->
    <div id="profile_edit_modal" class="reveal-modal" data-reveal aria-labelledby="profileEdit" aria-hidden="true" role="dialog">
          <h2 id="modalTitle">Edit your profile information</h2>
          <hr />
          <p class="lead">
            <?= form_open('process/updateProfile', ['role'=>'form', 'id'=>'profile_edit_form']); ?>
            <div class="row">
                <div class="small-3 columns">
                    <strong>About</strong>
                </div>
                <div class="small-9 columns">
                    <textarea rows="4" name="about"  id="about" placeholder="Tell us about yourself"><?php if(isset($userProfile[0]['about'])) echo $userProfile[0]['about']; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong>Website</strong>
                </div>
                <div class="small-9 columns">
                    <input type="text" name="website" value="<?php if(isset($userProfile[0]['website'])) echo $userProfile[0]['website']; ?>" id="website" placeholder="Link to your website (if any)"/>
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong>Facebook Profile</strong>
                </div>
                <div class="small-9 columns">
                    <input type="text" name="facebook" value="<?php if(isset($userProfile[0]['facebook'])) echo $userProfile[0]['facebook']; ?>" id="fb_profile" placeholder="link to your facebook (if you want to)" />
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong>Twitter Username</strong>
                </div>
                <div class="small-9 columns">
                    <input type="text" name="twitter" value="<?php if(isset($userProfile[0]['twitter'])) echo $userProfile[0]['twitter']; ?>" id="twitter" placeholder="link to your facebook (if you tweet)" />
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong>Instagram Username</strong>
                </div>
                <div class="small-9 columns">
                    <input type="text" name="instagram" value="<?php if(isset($userProfile[0]['instagram'])) echo $userProfile[0]['instagram']; ?>" id="instagram" placeholder="link to your facebook (only if you want to)" />
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong>Github Username</strong>
                </div>
                <div class="small-9 columns">
                    <input type="text" name="github" value="<?php if(isset($userProfile[0]['github'])) echo $userProfile[0]['github']; ?>" id="github" placeholder="link to your facebook (if you got one)" />
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong>About Me Username</strong>
                </div>
                <div class="small-9 columns">
                    <input type="text" name="aboutme" value="<?php if(isset($userProfile[0]['about_me'])) echo $userProfile[0]['about_me']; ?>" id="aboutme" placeholder="Your About Me Username" />
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong>Date of Birth</strong>
                </div>
                <div class="small-9 columns">
                    <input type="date" name="dob" value="<?php if(isset($userProfile[0]['dob'])) echo $userProfile[0]['dob']; ?>" id="dob" />
                </div>
            </div>
            <div class="row">
                <div class="small-3 columns">
                    <strong></strong>
                </div>
                <div class="small-9 columns">
                    <input type="submit" name="profileSubmitBtn" id="profile_submit_btn" class="button" value="Update"/>
                </div>
            </div>
            <?= form_close(); ?>
          </p>
          <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>
    <!-- Modal Ends here -->
</div>
            

<script type="text/javascript">
$(document).ready(function() {

var $fileInput = $('#userfile');
$fileInput.change(function(){
    alert();
    $('#dp_upload_form').submit();
});


$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});
</script>