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
</style>

<div class="container">
  <div class="row" id="search_form_row">
  </div>
  <input type="hidden" value="<?= base_url(); ?>process/searchThread/" id="thread_search_url" />
  <script type="text/jsx">
    var $threadSearch = $('#thread_search_url').val();

    var SearchBox = React.createClass({
      render: function(){
        return (
          <div className="SearchBox">
            <SearchForm source={this.props.source} />
          </div>
          );
      }
    })

    var SearchForm = React.createClass({
      getInitialState: function(){
        return {data: []};
      },
      handleKeyUp: function(){
        var $searchResults = $('.search_results');
        var $searchTitle = $('.searchTitle'); 
        var $searchBar = $('#searchBar');
        var terms = $searchBar.val();

        $searchTitle.html('<strong>Search Results...</strong>');

        if(terms == ''){
          this.setState({data: []});
          $searchTitle.html('');
        }
        var searchUrl = this.props.source+terms;

        $.get(searchUrl, function(data){
          data = $.parseJSON(data);
          this.setState({data: data});
        }.bind(this));
      },
      render: function(){
        var searchNodes = this.state.data.map(function(item){
          return (
            <ul className="nav searchRow">
              <li className="searchData">
                <a href={item.thread_url}>{item.title}</a>
              </li>
            </ul>
            );
        });
        return (
          <form id="search_form">
            <input onKeyUp={this.handleKeyUp.bind(this)} type="text" name="search" id="searchBar" placeholder="Type the search term and hit enter" />
            <div className="searchTitle"></div>
            <div className="search-nodes">
              {searchNodes}
            </div>
          </form>
          );
      }
    });

    React.render(
      <SearchBox source={$threadSearch} />,
      document.getElementById('search_form_row')
      );
  </script>

  <div class="row">
    <div class="page-header"><h3><?= $category[0]['category_name']; ?></h3></div>
  </div>

  <div class="row">
    <div class="small-10 columns">
    <?php foreach ($threads as $t): ?>
    <div class="thread_wrapper" id="thread_wrapper">
        <div class="row">
          <div class="small-2 columns" >
            <a href="<?= $t['thread_url']; ?>#disqus_thread"></a>
          </div>
          <div class="small-8 columns">
            <a style="display: block;" href=<?= $t['thread_url']; ?>>
              <?= $t['title']; ?>
              <br />
              <?php foreach($tags as $tag): ?>
                <?php if ($tag['thread_id'] == $t['id']): ?>
                  <label class="label secondary"><?= $tag['tag']; ?></label>
                <?php endif; ?>
              <?php endforeach; ?>
            </a>
          </div>
          <div class="small-2 columns">
            <label class="small-text">Posted by:  <a href="<?= base_url(); ?>profile/index/<?= $t['user_id']; ?>"><?= $t['uname']; ?></a></label>
            <span class="help-block small-text"><?= $t['created_at']; ?></span>
          </div>
        </div>
          </div>
        <?php endforeach; ?>
        <?php if(! $this->session->userdata('id')): ?>
        <br />
        <center>
          <span class="link"><a href="<?= base_url(); ?>#login">Login</a></span> |
          <span class="link"><a href="<?= base_url(); ?>#register_section">Register</a> 
        </center>
      <?php endif; ?>
      </div>
      <div class="small-2 columns">
        <div class="category-wrapper">
        <ul class="nav small-text"> 
          <li class="category-heading">Categories</li>
          <?php foreach ($categories as $c): ?>
            <?php if ($c['thread_count'] == 0) continue; ?>
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

<script type="text/javascript">
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