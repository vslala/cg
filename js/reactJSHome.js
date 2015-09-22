 var getThreadsUrl = $('#getThreadsUrl').val();
        var $base_url = $('#base_url').val();

        var ThreadWrapper = React.createClass({displayName: "ThreadWrapper",
          loadThreadsFromServer: function(){
            $.get(this.props.source, function(data){
              data = $.parseJSON(data);
              this.setState({data: data});
            }.bind(this));
          },
          getInitialState: function(){
            return {data: []};
          },
          componentDidMount: function(){
            this.loadThreadsFromServer();
            setInterval(this.loadThreadsFromServer, 10000);
          },
          render: function(){
            return (
              React.createElement(Thread, {data: this.state.data})
              );
          }
        });

        var Thread = React.createClass({displayName: "Thread",
          render: function(){
            var threadNodes = this.props.data.map(function(item){
              return (
                    React.createElement("div", {className: "thread_wrapper", id: "thread_wrapper"}, 
                  React.createElement("div", {className: "row"}, 
                    React.createElement("div", {className: "small-2 columns"}, 
                      React.createElement("span", {className: "help-block left"}, "Answers", React.createElement("span", {className: "badge"}, item.total_answers))
                    ), 
                    React.createElement("div", {className: "small-8 columns"}, 
                      React.createElement("a", {style: {"display": "block"}, href: item.thread_url}, 
                        item.title, 
                        React.createElement("br", null), 
                        React.createElement("label", {className: "label label-default"}, item.tag)
                      )
                    ), 
                    React.createElement("div", {className: "small-2 columns"}, 
                      React.createElement("label", {className: "small-text"}, "Posted by:  ", React.createElement("a", null, item.username)), 
                      React.createElement("span", {className: "help-block small-text"}, item.created_at)
                    )
                  )
                    )

                );
            });

          return (
            React.createElement("div", {className: "threads"}, 
              threadNodes
            )
            );
          }
        });

        React.render(
          React.createElement(ThreadWrapper, {source: getThreadsUrl}),
          document.getElementById('list_section')
          );