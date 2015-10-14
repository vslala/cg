<style type="text/css">
body{
  padding-top: 150px;
}
a{
  display: block;
}
#thread_wrapper{
  padding: 10px;
}
.small-text{
  font-size: xx-small;
}
.category-heading{
  font-weight: bolder;
  font-size: large;
  font-family: tahoma sans-serif;
}
.category-wrapper{
  height: 500px;

}

</style>
<div class="container">
  <!-- Search Thread -->
  <div class="row" id="search_form_row"></div>
  <input type="hidden" value="<?= base_url(); ?>process/searchThread/" id="thread_search_url" />
  <script type="text/javascript" src="<?= base_url(); ?>js/reactJSSearch.js"></script>
  <!-- / -->

  <div class="row">
    <div class="page-header"><h3>Top Questions</h3></div>
  </div>
  <div class="row">

    <!-- Threads -->
    <div class="small-10 columns">
        <div class="list-section" id="list_section"></div>
        <input type="hidden" name="getThreadsUrl" id="getThreadsUrl" value="<?= base_url(); ?>process/getThreads">
        <input type="hidden" value="<?= base_url(); ?>" id="base_url" />
        <script type="text/javascript" src="<?= base_url(); ?>js/reactJSHome.js"></script>
    </div>

    <!-- Categories -->
    <div class="small-2 columns">
      <div class="category-wrapper">
        <ul class="nav small-text" > 
          <li class="category-heading">Categories</li>
          <?php foreach ($categories as $c): ?>
              <?php 
              if($c['thread_count'] == 0){
              continue;
              }
              ?>
            <li>
              <a class="link" href="<?= base_url(); ?>thread/category/<?= $c['id']; ?>">
                <?= $c['category_name']; ?>
                <span class="badge"><?= $c['thread_count']; ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
        
  </div>

</div>