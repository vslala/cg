$(document).ready(function(){/* jQuery toggle layout */
    alert();

    base_url = null;
    if($("#base_address").val()){
        base_url = $("#base_address").val()+'/';
    }else{
        base_url = "http://campusguru.eu1.frbit.net/";
    }
    //
    //setInterval(function(){
    //    console.log(base_url);
    //}, 1000);

    // load_img = '<img src="http://www.ajaxload.info/images/exemples/25.gif" >';
    load_img = '<img src="http://s6.postimg.org/izhhdr2d9/image.gif" >';

    $(".content").hover(function(){
       $("#click_here").toggle(500);
   });

    $("a").click(function(event){
        if(this.hash)
        {
            var hash = this.hash.substr(1);
            var $toElement = $("a[name=" + hash + "]");
            var toPosition = $toElement.position().top;
            $("body,html").animate({
                scrollTop : toPosition

            },2000,"easeOutExpo");

            //console.log(toPosition);
            return false;
        }

        if(location.hash)
        {
            var hash = location.hash;
            window.scroll(0,0);
            console.log(hash);
            $("a[name=" + hash + "]").click();
        }
    });

    // Ajax Status Post
    /* Status Post */
    $("#status_form").submit(function (event) {
        event.preventDefault();

        var statusBox = $(this).parent().find("#status_box");

        var url = $(this).attr("action");
        var data = $(this).serialize();
        if(data == "" || data == null){ return; }
        var updateLikeStatusLink = $("#statusLike").attr("href");
        var updateDislikeStatusLink = $("#statusDislike").attr("href");
        var statusSection = $("#status_section");
        $(statusSection).html(load_img);
        //var imgLocation = "http://localhost/campusguru/public/";
        var statusContent = $(statusBox).val();
        $(statusBox).val('');

        $.ajax({
            url : url,
            type : "PUT",
            data : data,
            success : function(data){
                //console.log(data);
                data = $.parseJSON(data);
                console.log(data);
                //console.log(data[0]['username']);
                $(statusSection).empty();
                for(var i=0; i < data.length; i++)
                {
                    if(data[i]['likeCount'] == null)
                    {
                        data[i]['likeCount'] = 0;
                    }
                    if(data[i]['dislikeCount'] == null || data[i]['dislikeCount'] == '')
                    {
                        data[i]['dislikeCount'] = 0;
                    }
                    $(statusSection).append(
                        '<ul class="nav nav-pills list-inline">' +
                        '<li>' +
                        '<a href="'+ base_url +'/user/profile/visit/'+ data[i]['username'] +'">' +
                        '<img src="'+ data[i]['image_url'] +'" alt="'+ data[i]['image_name'] +'" class="img img-thumbnail img-responsive", style="height: 100px;"],) !!}' +
                        '</a> ' +
                        '</li>' +
                        '<li style="margin-top: 2%;">' +
                        '<span style="font-family: cursive,Lobster; font-weight: bold; color: #843534;">'+ data[i]['status'] +'</span>' +
                        '<br>' +
                        '<div class="help-block">created at: ' + data[i]['created_at'] +''+
                    '</li>' +
                        '<br>' +
                        '<li>' +
                        '<ul class="list-inline">' +
                        '<a href="'+ updateLikeStatusLink +'class="inline" id="statusLike">' +
                        '<span class="badge">'+ data[i]['likeCount'] +'</span>' +
                        '<span class="glyphicon glyphicon-thumbs-up"></span>' +
                        '</a>' +
                        '<a href="'+ updateDislikeStatusLink +'class="inline" id="statusDislike">' +
                        '<span class="badge">'+ data[i]['dislikeCount'] +'</span>' +
                        '<span class="glyphicon glyphicon-thumbs-down"></span>' +
                        '</a>' +
                        '</ul>' +
                        '</li>' +
                    '</ul>' +
                    '<hr>'
                );
                }

            },
            error : function(xhr, status, msg){
                alert("There was some error posting the status. Please Try again!");
                $(statusBox).val(statusContent);
                //console.log("ERROR: " + xhr.responseText());
            }
        });
    });

    // Random jokes generator
    $("#quote").append(load_img);
    setInterval(function(){
        $("#quote").append(load_img);
        $.ajax({
            url: "http://api.icndb.com/jokes/random",
            type: "GET",
            success: function (data) {

                //data = $.parseJSON(data);
                $("#quote").html(data.value['joke'] + "<br>" + "<span class='help-block'>#" + data.value['id'] + "</span><br>");
                //console.log(data.value['id']);
            }
        });
    }, 20000);

    // Top 5 Questions with images ajax
    setInterval(function(){
        var list_of_questions = $("#list_of_questions");
        $(list_of_questions).html(load_img);
        var url = $("#fetchQuestionUrl").val();

        $.ajax({
            url : url,
            type : "GET",
            success : function(data){
                data = $.parseJSON(data);
                $(list_of_questions).empty();
                $.each(data, function (key,value) {
                    $(list_of_questions).append("<a style='font-family: tahoma, arial, helvetica, sans-serif; " +
                    "font-weight: bold; color: #000000;' class='list-group-item' " +
                    "href='"+ base_url +"user/show/question/"+ value.id +"/"+ value.title +"'>" +
                    "<img class='img img-responsive img-thumbnail' " +
                    "style='width: 50px;' " +
                    "src='"+base_url+value.image_url+"'>"+ value.title +"" +
                    "<span class='glyphicon glyphicon-question-sign'></span>" +
                    "</a>");
                    //console.log(value.id + ":" + value.title);
                });

            },
            error : function(xhr,status,msg){
                console.log("ERROR: We are working on it!");
            }
        });
    }, 60000);

    // Top 5 Discussions with images ajax
    setInterval(function(){
        var list_of_discussions = $("#list_of_discussions");
        $(list_of_discussions).html(load_img);
        var url = $("#fetchDiscussionUrl").val();

        $.ajax({
            url : url,
            type : "GET",
            success : function(data){
                data = $.parseJSON(data);
                $(list_of_discussions).empty();
                $.each(data, function (key,value) {
                    $(list_of_discussions).append("<a style='font-family: tahoma, arial, helvetica, sans-serif; " +
                    "font-weight: bold; color: #000000;' class='list-group-item' " +
                    "href='"+ base_url +"user/view/single/discussions/"+ value.id +"/"+ value.title +"'>" +
                    "<img class='img img-responsive img-thumbnail' " +
                    "style='width: 50px;' " +
                    "src='"+base_url+value.image_url+"'>"+ value.title +"" +
                    "<span class='glyphicon glyphicon-cloud'></span>" +
                    "</a>");
                    //console.log(value.id + ":" + value.title);
                });

            },
            error : function(xhr,status,msg){
                console.log("ERROR: " + xhr.responseText);
            }
        });
    }, 60000);

    /*
    status like count incrementer
     */
    $("body").on("click", "#statusLike", function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var badge = $(this).find('.badge');

        $.ajax({
            url : url,
            type : "GET",
            success : function(data){
                $(badge).html(data);
                console.log(data);
            },
            error : function(xhr,status,msg){
                console.log("ERROR: "+ xhr.responseText);
            }
        });
    });

    /*
     status dislike count incrementer
     */
    $("body").on("click", "#statusDislike", function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var badge = $(this).find('.badge');
        console.log(url);

        $.ajax({
            url : url,
            type : "GET",
            success : function(data){
                $(badge).html(data);
            },
            error : function(xhr,status,msg){
                console.log("ERROR: "+ xhr.responseText);
            }
        });
    });

    /*
    Most Liked Status Fetch
     */
    setInterval(function () {
        var mostLikedStatus = $("#most_liked_status");
        var url = $("#mostLikedStatusUrl").val();
        $(mostLikedStatus).html(load_img);
        $.ajax({
            url : url,
            type : "GET",
            success : function(data){
                data = $.parseJSON(data);
                $(mostLikedStatus).html(data[0]['status'] + '<br>' + '' +
                '<a class="active btn btn-primary btn-sm"><span class="badge">'+ data[0]['likeCount'] +'</span></a>' +
                '' +
                    '  |  ' +
                    '<a class="active btn btn-danger btn-sm"><span class="badge badge-primary">'+ data[0]['dislikeCount'] +'</span></a>' +
                    ''
                );
            },
            error : function(xhr, status, msg){
                console.log("ERROR: "+ xhr.responseText);
            }
        });
    }, 60000);

    /*
     Most Liked Display Picture Fetch
     */
    //setInterval(function () {
    //    var mostLikedImage = $("#most_liked_picture");
    //    var url = $("#mostLikedImageUrl").val();
    //    console.log(url);
    //    $(mostLikedImage).html(load_img);
    //    $.ajax({
    //        url : url,
    //        type : "GET",
    //        success : function(data){
    //            data = $.parseJSON(data);
    //            cosnole.log(data);
    //            $(mostLikedImage).html('<img src="'+ base_url+ data[0].image_url +'" class="img img-responsive img-thumbnail" />    <br>' +
    //                '<a class="active btn btn-primary btn-sm"><span class="badge">'+ data[0].likeCount +'</span></a>'
    //            );
    //        },
    //        error : function(xhr, status, msg){
    //            console.log("ERROR: "+ xhr.responseText);
    //        }
    //    });
    //}, 60000);

    /*
    Search VIA username at the _top-nav
     */
    $("#srch-term").keyup(function(){
        $("#submitBtn").click();
    });
    $("#searchForm").submit(function(event){
        event.preventDefault();
        var searchResult = $("#search_result");
        var url = $(this).attr("action");
        var data = $(this).serialize();
        //if(data == "" || data == null){
        //    return;
        //}
        console.log(url);

        $.ajax({
            url : url,
            type : "PUT",
            data : data,
            success : function(data){
                data = $.parseJSON(data);
                if(data == null || data.length <= 0)
                {
                    $(searchResult).next().remove();
                } else {
                    $.each(data, function (key, value) {
                        $(searchResult).html('<a style="text-decoration: none;" href="'+ base_url +'user/profile/visit/'+ value.username +'">' +
                            '<li class="list-group-item">' +
                            '<span class="glyphicon glyphicon-user"></span>' +
                            '<span style="font-family: cursive, Lobster;' +
                            'font-weight: bolder; font-size: large; color: black;">' +
                            value.username+
                            '</span>' +
                            '</li>' +
                            '</a>'
                        );
                    })

                }


            },
            error : function(xhr,status,msg){
                console.log("ERROR: "+ xhr.responseText);
            }
        });

        return false;
    });

    /*
    Fade message div
     */
    $("#message_div").fadeOut(5000);
    ///*
    //Send message form ajax
    // */
    //$("#message_form").submit(function(event){
    //    event.preventDefault();
    //    var url = $(this).attr("action");
    //    var data = $(this).serialize();
    //
    //    $.ajax({
    //        url : url,
    //        data : data,
    //        type : "POST",
    //        success : function (data){
    //            window.location.reload();
    //        },
    //        error : function(xhr,status,msg){
    //            alert("ERROR: "+ xhr.responseText);
    //        }
    //    });
    //});

    /*
    Form Validation plugin from jquery for User Registeration Form
     */
    $('#reg_form').validate({
        rules: {
            name: {
              required : true
            },
            username: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            },
            branch: {
                required: true
            },
            college: {
                required: true,
                minlength: 3
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }


    });

    /*
     Form Validation plugin from jquery for Ask Question Form
     */
    $('#ask_question').validate({
        rules: {
            title: {
                required : true,
                minlength : 10
            },
            tags: {
                required: true,
                minlength : 3
            },
            content: {
                required: true,
                minlength: 20,
                maxlength: 3000
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }


    });

    /*
    Fadeout for message spans
     */
    $("#message").fadeOut(5000);

    /*
    Enter other branch or stream
     */
    $("#input_branch").change(function(){
        if($(this).val() == "other"){
            var value = prompt("Enter your branch name");
            $(this).append('<option value="'+ value +' " selected="selected">'+ value +'</option> ');

        }
    });

    /*
    Suggestion Box
     */
    $("#suggestion_form").submit(function(event){
        event.preventDefault();
        var url = $(this).attr("action");
        var data = $(this).serialize();
        var suggestionBoxDiv = $("#suggestion_box_div");

        $.ajax({
            url : url,
            type : "PUT",
            data : data,
            success : function(data) {
                $(suggestionBoxDiv).html(data);
            },
            error: function(xhr,status,message) {
                console.log("ERROR: " + xhr.responseText);
            }
        });
    });

    /*
    Blog Comment Ajax Post
     */
    $("body").on("submit","#blog_comment_form", function (event) {
        event.preventDefault();
        var url = $(this).attr("action");
        var data = $(this).serialize();
        var comments = $(this).parent().parent().find("#comments");
        var blogCommentTextField = $(this).parent().parent().parent().find("#blogCommentTextField");

        $.ajax({
            url : url,
            data : data,
            type : "POST",
            success : function(data){
                data = $.parseJSON(data);

                $(comments).append('<li class="list-group-item">' +
                '<div class="help-block">' +
                '<span class="glyphicon glyphicon-time pull-right time">'+ data[0].created_at +'</span>' +
                '</div> ' +
                '<a href="'+ base_url+'/user/profile/visit/'+data[0].username + '">' +
                '<img style="height: 50px;" class="img img-responsive img-thumbnail" src="'+ base_url+data[0].image_url+'">' +
                '<span class="username">'+ data[0].username +'</span>' +
                '</a>' +
                '<p class="comment">'+ data[0].comment +'</p>' +
                '</li>');

                $(blogCommentTextField).val('');
                $(blogCommentTextField).focus();
            },
            error : function(xhr,status,msg){
                console.log("ERROR: " + xhr.responseText );
            }
        })
    });

    /*
    Post answer comments by ajax
     */
    $("body").on("submit", "#commentForm", function(event){
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();
        var comments = $(this).parent().find("#comments");
        var commentTextField = $(this).parent().parent().parent().find("#commentTextField");
        //console.log($(comments).attr('id') + "    " + $(commentTextField).attr('id'));

        $.ajax({
            url : url,
            data : data,
            type : "PUT",
            success : function(data){
                data = $.parseJSON(data);

                $(comments).append('<li class="list-group-item">' +
                '<div class="help-block">' +
                '<span class="glyphicon glyphicon-time pull-right time">'+ data[0].created_at +'</span>' +
                '</div> ' +
                '<a href="'+ base_url+'/user/profile/visit/'+data[0].username + '">' +
                '<img style="height: 50px;" class="img img-responsive img-thumbnail" src="'+ base_url+data[0].image_url+'">' +
                '<span class="username">'+ data[0].username +'</span>' +
                '</a>' +
                '<p class="comment">'+ data[0].comment +'</p>' +
                '</li>');

                $(commentTextField).val('');
                $(commentTextField).focus();
            },
            error : function(xhr,status,msg){
                console.log("ERROR: " + xhr.responseText );
            }
        })
    });

    /*
    Attach Image Button Click
     */
    function checkImage(src) {
        var img = new Image();
        img.onload = function() {
            // code to set the src on success
            var currentValue = $("#status_box").val();
            $('#status_box').val(currentValue + '<br><a href="'+ src +'"><img src="' + src + '" class="img img-responsive img-thumbnail" style="height: 200px;" /></a><br>');
        };
        img.onerror = function() {
            // doesn't exist or error loading
            console.log("NO IMAGE");
        };

        img.src = src; // fires off loading of image
    }
    $("#attach_url").click(function(event){
        event.preventDefault();
        var url = prompt("Enter the complete image url here.");
        checkImage(url);
    });

    /*
    Embed Video to the status
     */
    $("#embed_video").click(function(event){
        event.preventDefault();
        var videoUrl = prompt("Enter the emedded url of the video:");
        var currentValue = $("#status_box").val();
        $('#status_box').val(currentValue + '<div class="auto-resizable-iframe">' +
        '<div>'+ videoUrl +'</div>' +
        '</div><br>');
    })

    /*
    Search question and Discussion
     */
    $("#search_term").keyup(function(event){
        event.preventDefault();
        var SHOWURL = $("#show_url").val();
        var searchTerm = $(this).val();
        var table = $("#table_from").val();
        var url = $("#search_for_q_n_d").attr('href');
        var list = $("#content_list");
        console.log("SEARCH TERM: "+searchTerm+ " | "+ "TABLE: "+table + "URL: "+url);

        $.ajax({
            url : url+'/'+searchTerm+'/'+table,
            type: "GET",
            success: function(data){
                data = $.parseJSON(data);
                $(list).empty();
                $.each(data, function(index, value){
                    $(list).append('<li>' +
                    '<a href="'+ base_url+SHOWURL+'/'+value.id+'/'+value.title +'" id="question_link">' +
                    '<img src="'+ base_url + value.image_url +'"alt="'+ value.image_name + '" class="img img-responsive img-thumbnail profile_pic" />' +
                    ''+ value.title +'');
                });
                //console.log(data[0].id);
            },
            error : function(xhr,status,msg){
                console.log("ERROR: "+ xhr.responseText);
            }
        });
    });

    /*
    Notification delete when button is clicked
     */
    $("#notification_toggle").click(function(){

    })
});
/*
 Form Validation plugin from jquery for Status Form
 */
var validateStatusForm = $('#status_form').validate({
    rules: {
        status: {
            required : true
        }
    },
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }


});