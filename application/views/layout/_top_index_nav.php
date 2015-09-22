<style>
   .brand-css{
    /*color: #204d74;*/
    font-weight: 700;
    font-family: Tahoma, sans-serif;
   }
   </style>
   <div class="navbar navbar-default navbar-fixed-top" style="margin-top: 0px;">
         <div class="container">
           <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand brand-css" href="<?= base_url(); ?>" id="top_home_nav"><span class="brand-name">Campus Guru</span></a>
           </div>
           <div class="collapse navbar-collapse" id="navbar-ex-collapse">
             <ul class="nav navbar-nav navbar-right">
               <li class="<?php if(isset($setBlogActive)) echo 'active'; ?>">
                 <a href="<?= base_url(); ?>blog">Blog</a>
               </li>
               <li class="<?php if(isset($setDiscussionActive)) echo 'active'; ?>">
                  <a href="<?= base_url(); ?>home/index">Discussions</a>
               </li>
               <li>
                <a href="<?= base_url(); ?>#register_section">Register</a>
               </li>
               <li>
                   <a href="<?= base_url(); ?>#login">Login</a>
               </li>
             </ul>
             <ul class="nav navbar-nav navbar-right">
               <li class="<?php if(isset($setAboutActive)) echo 'active'; ?>">
                 <a href="">About</a>
               </li>
             </ul>
           </div>
         </div>
       </div>