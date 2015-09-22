  var $threadSearch = $('#thread_search_url').val();

    var SearchBox = React.createClass({displayName: "SearchBox",
      render: function(){
        return (
          React.createElement("div", {className: "SearchBox"}, 
            React.createElement(SearchForm, {source: this.props.source})
          )
          );
      }
    })

    var SearchForm = React.createClass({displayName: "SearchForm",
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
            React.createElement("ul", {className: "nav searchRow"}, 
              React.createElement("li", {className: "searchData"}, 
                React.createElement("a", {href: item.thread_url}, item.title)
              )
            )
            );
        });
        return (
          React.createElement("form", {id: "search_form"}, 
            React.createElement("input", {onKeyUp: this.handleKeyUp.bind(this), type: "text", name: "search", id: "searchBar", placeholder: "Type the search term and hit enter"}), 
            React.createElement("div", {className: "searchTitle"}), 
            React.createElement("div", {className: "search-nodes"}, 
              searchNodes
            )
          )
          );
      }
    });

    React.render(
      React.createElement(SearchBox, {source: $threadSearch}),
      document.getElementById('search_form_row')
      );