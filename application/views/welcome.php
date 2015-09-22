<style type="text/css">
body {
    margin: 0;
    padding-top: 100px;
    width: 100%;
    height: 100%;
    display: table;
    font-weight: 100;
}
.content {
    text-align: center;
    display: inline-block;
    margin-bottom: 100px;
}

.title {
    font-size: 96px;
    margin-bottom: 40px;
    color: orangered;
    font-weight: bold;
}

.quote {
    font-size: 24px;
    color: #000000;
    font-family: 'Lobster', cursive;
}

#click_here{
    font-family: tahoma, arial, helvetica, sans-serif, cursive;
    font-weight: 100;
    display: none;
}

a:hover{
    display: block;
}

.message{
    font-family: Lobster, cursive;
    font-weight: bolder;
    font-size: 32px;
}
</style>
<div class="container">
    <div class="row">
        <div class="small-2 columns"></div>
        <div class="small-10 columns">

 <div class="row">
    
<a href="#register_section">
	<div class="content">

	    <img src="<?= base_url(); ?>images/static/logo.png" alt="Campus Guru Logo">
		<div class="title">Campus Guru</div>
		<div class="quote"><?php if(isset($inspiringQuote)) echo $inspiringQuote; ?></div>
		<p id="click_here">Click to start...</p>
	</div>
</a>

 </div>

<div class="row">
    <a name="register_section"></a>

    <div class="register">

    <div class="panel panel-primary">
        
        <?php if($this->session->flashdata('register_error')): ?>
        <center>
            <span class="alert alert-danger message"><?= $this->session->flashdata('register_error'); ?></span>
        </center>
        <?php endif; ?>
    
        <div class="panel-heading">
            <div class="h2">Join Campus Guru</div>
        </div>

        <div class="panel-body">
        <?= form_open('process/signup',["role"=>"form", "id"=>"reg_form"]); ?>
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="name_input"
                                        placeholder="Enter Your full name here" required
                                        >
                                    <div class="alert-info" id="help_block" style="display: none; font-family: cursive, 'Lobster'">
                                        Please provide the correct name as this will be displayed in your profile
                                    </div>
                                </div>
                              <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Unique Username" required/>
                              </div>
                              <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email_input" placeholder="Enter email" required>
                              </div>
                              <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="input_password" placeholder="Password" required>
                              </div>
                              <div class="form-group">
                                <label for="college">College/School</label>
                                <input type="text" name="college" id="input_college" class="form-control" placeholder="Enter College/School Name" required>
                              </div>
                              <div class="form-group">
                                <label for="branch">Choose your branch below</label>
                                <select class="form-control" name="branch" id="input_branch" required>
                                    <option value="null" disabled selected>select here...</option>
                                    <?php foreach ($branches as $b): ?>
                                    <option value="<?= $b['id']; ?>" name="<?= $b['id']; ?>"><?= $b['branch_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                              </div>
                              <button type="submit" class="btn btn-lg btn-primary">Register </button>
                              <br>
                              <a href="#login">Already have an account. Click Here...</a>
                        <?= form_close(); ?>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row" style="margin-top: 200px;">

        <div class="panel panel-primary">
            <?php if($this->session->flashdata('login_error')): ?>
            <center>
                <span class="alert alert-danger message"><?= $this->session->flashdata('login_error'); ?></span>
            </center>
            <?php endif; ?>
        					<div class="panel-heading">
        						<strong class="h2"> Sign in to continue</strong>
        					</div>
        					<div class="panel-body">
        					<?= form_open('process/signin',['role'=>'form']); ?>
                                <fieldset>
								<div class="row">
                                    <center>
    									<div class="center-block">
    										<img class="profile-img img-circle"
    											src="http://s6.postimg.org/aeo5mks75/web_icon_110006884_011314int1.png" style="height: 100px;" alt="">
    									</div>
                                    </center>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span>
												<input class="form-control" placeholder="Username Or Email" name="username" type="text">
											</div>
										</div>
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
												<input class="form-control" placeholder="Password" name="password" type="password" value="">
											</div>
										</div>
										<div class="form-group">
										    <div class="input-group">

										        <input type="checkbox" name="remember" class="checkbox checkbox-inline" id="remember" />
										        <label class="checkbox-inline" for="remember">Remember Me</label>
										    </div>
										</div>

										<div class="form-group">
											<input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
										</div>
 										<div class="form-group">
 										    <div class="input-group">
 										        <a class="pull-right" href="{{ route('forgotPassword') }}">forgot password</a>
 										    </div>
 										</div>
									</div>
								</div>
							</fieldset>
                            <?= form_close(); ?>
                </div>
                <center>
                <div class="panel-footer ">
                	Don't have an account!<br> <a href="#register_section"> Sign Up Here </a>
                </div>
            </center>
            </div>
<a name="login"></a>
</div>




</div><!-- Container ends here -->

