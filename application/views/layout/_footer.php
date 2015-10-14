<?php if(isset($unsetFooter)): ?>

<?else: ?>
<link href="http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>css/footer.css">
    
    <section class="contact-footer">
      <div class="row wide">
        <div class="medium-6 columns">
          <div class="row">
            <div class="small-6 medium-12 columns">
              <h4 class="location">VSProductions</h4>
              <p>Jabalpur, India<br>
               </p>

              <h4 class="phone">+91 9827-9837-62</h4>
            </div>
            <div class="small-6 medium-12 columns">
              <h4 class="email">Email</h4>
              <p>vsproductions007@gmail.com</p>

              <h4>Social</h4>
              <div class="social">
                <ul class="inline-list">
                  <li><a href="https://www.twitter.com/vs_shrivastava"><i class="fi-social-twitter"></i></a></li>
                  <li><a href="https://www.facebook.com/varun.shrivastava.3"><i class="fi-social-facebook"></i></a></li>
                  <li><a href="#"><i class="fi-social-linkedin"></i></a></li>
                  <li><a href="https://www.github.com/vslala"><i class="fi-social-github"></i></a></li>
                </ul>
                <ul class="inline-list">
                  <li><a href="#"><i class="fi-social-pinterest"></i></a></li>
                  <li><a href="https://www.youtube.com/channel/UCMkZyz-apjY2bDmDsisv7Xg"><i class="fi-social-youtube"></i></a></li>
                  <li><a href="https://www.instagram.com/vs_lala"><i class="fi-social-instagram"></i></a></li>
                  <li><a href="https://plus.google.com/+Varunshrivastava007"><i class="fi-social-google-plus"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="medium-6 columns">
          <p class="form-lead">Let's catch up with some wine and cheese</p>
          <p class="form-lead-in">and I'll become the story teller for a day</p>
          <?= form_open('process/contact', ['class'=>"round-inputs", 'id'=>'contact_form']) ?>
            <div class="row">
              <div class="large-12 columns">
                <input type="text" placeholder="Name" name="name" minlength="3" required/>
              </div>
              <div class="large-12 columns">
                <input type="email" placeholder="Email" name="email" required/>
              </div>
              <div class="large-12 columns">
                <input type="text" placeholder="Telephone" name="telephone" minlength="10" maxlength="10" required/>
              </div>
              <div class="large-12 columns" id="btn_wrap">
                <textarea minlength="10" placeholder="Say 'what' again. Say 'what' again, I dare you, I double dare you..." name="message" required></textarea>
                <button id="contactSubmitBtn" href="#" type="submit" class="button round">Submit</button>
                
              </div>
            </div>
          <?= form_close(); ?>
        </div>
      </div>
    </section>
<?php endif; ?>

<script src="<?= base_url(); ?>js/vendor/jquery.js"></script>
    <script src="<?= base_url(); ?>js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#contact_form').submit(function(event){
      event.preventDefault();

      var $url = $(this).attr('action');
      var data = $(this).serialize();
      var $btn_wrap = $('#btn_wrap');
      var $msg = $('<br /><span class="alert success"></span>');
      $btn_wrap.append($msg);

      $.ajax({
        url: $url,
        data: data,
        type: "POST",
        success: function(){
          $msg.html('Thanks for contacting us. We will get back to you shortly. GODSPEED!!!');
        },
        error: function(xhr, status, err){
          console.log(xhr.responseText);
        }
      })
    });
    FB.XFBML.parse(document.getElementById('fb_comments'));
  })
 </script>
</body>
</html>