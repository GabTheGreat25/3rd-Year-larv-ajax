<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Comment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS only -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sl-1.4.0/datatables.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/r-2.3.0/sl-1.4.0/datatables.min.js">
    </script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"
        integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .container {
            margin-top: -10rem;
        }

        .be-comment-block {
            /* margin-bottom: 50px !important; */
            margin-top: 7rem;
            background-color: #edeff2;
            border-radius: 2px;
            padding: 1.5rem 8rem 4rem 8rem;
            /* border: 1px solid #ffffff; */
        }

        .be-comment-text {
            font-size: 13px;
            line-height: 18px;
            color: #7a8192;
            display: block;
            background: #f6f6f7;
            border: 1px solid #edeff2;
            padding: 15px 20px 20px 20px;
        }

        .form-group.fl_icon .icon {
            position: absolute;
            top: 1px;
            left: 16px;
            width: 48px;
            height: 48px;
            background: #f6f6f7;
            color: #b5b8c2;
            text-align: center;
            line-height: 50px;
            -webkit-border-top-left-radius: 2px;
            -webkit-border-bottom-left-radius: 2px;
            -moz-border-radius-topleft: 2px;
            -moz-border-radius-bottomleft: 2px;
            border-top-left-radius: 2px;
            border-bottom-left-radius: 2px;
        }

        .form-group .form-input {
            font-size: 1.5rem;
            line-height: 50px;
            font-weight: 400;
            /* color: #b4b7c1; */
            width: 100%;
            height: 50px;
            padding-left: 20px;
            padding-right: 20px;
            border: 1px solid #edeff2;
            border-radius: 3px;
            outline: none;
        }

        .form-group.fl_icon .form-input {
            padding-left: 70px;
        }

        .form-group textarea.form-input {
            height: 150px;
            outline: none;
        }

        .text {
            text-align: center;
            padding-bottom: 1rem;
        }

        .wrapper {
            display: grid;
            background-color: #edeff2;
            border-radius: 2px;
            padding: 1.5rem 8rem 4rem 8rem;
            margin: 4rem 19rem;
        }
    </style>

<body>
    <section>
        <form action="#" method="#" enctype="multipart/form-data">
            <div style="display: grid; justify-content: end;">
                <a href="/home" class="btn btn-danger"
                    style="padding: .7rem 1.5rem; margin: 2rem 6rem 0 3rem; font-size: 2rem; font-weight: 500; font-style:italic; z-index: 9999;"
                    role="button">Home</a>
            </div>
            <div class="container">
                <div class="be-comment-block">
                    <div class="be-comment-content">

                        <div class="form-group">
                            <h1 class="text">Send Feeback About Our Service!</h1>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="operator_id" name="operator_id" value={{
                                    $operator->operator_id }}>
                            </div>
                        </div>

                        <form class="form-block">
                            <div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group fl_icon">
                                            <div class="icon"><i class="fa fa-user"></i></div>
                                            <input class="form-input" type="text" placeholder="Your name" id="username"
                                                name="username">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group fl_icon">
                                            <div class="icon"><i class="fa fa-phone"></i></div>
                                            <input class="form-input" type="text" placeholder="Cellphone Number"
                                                id="contact_number" name="contact_number">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group fl_icon">
                                        <div class="icon"><i class="fa fa-plus-star"></i></div>
                                        <input class="form-input" type="number" min="1" max="5" placeholder="Rating"
                                            id="ratings" name="ratings">
                                    </div>
                                </div>
                            </div>

                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <textarea class="form-input" placeholder="Comment" id="comments"
                                    name="comments"></textarea>
                            </div>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 10rem 1fr;">
                        <div>
                            <button id="addCommentBtn" type="submit" class="btn btn-primary"
                                onclick="return confirm('Do you want to add this comment?')">Save
                                &#128190;
                            </button>
                        </div>
                        <div>
                            <a href="{{url()->previous()}}" class="btn btn-default" style="padding: .7rem 1.5rem;"
                                role="button">Cancel</a>
                        </div>
                    </div>
        </form>
    </section>

    <section>
        @foreach($operatorr as $opera)
        <div class="wrapper">
            <div class="media">
                <a class="pull-left" href="#"><img class="media-object"
                        src="https://thumbs.dreamstime.com/b/flat-avatar-illustration-icon-beard-man-sunglasses-tough-guy-eps-vector-men-dressed-red-blouse-metrosexual-hair-88699969.jpg"
                        width="200" height="200" alt="image"></a>
                <div class="media-body">
                    <h4 class="media-heading" style="font-weight: 700;">{{ $opera->username}}</h4>
                    <p style="font-size: 2rem; font-style:italic;">{{ $opera->contact_number}}</p>
                    <p style="font-size: 2rem; font-style:italic;">{{ $opera->comments}}</p>
                    <ul class="list-unstyled list-inline media-detail pull-left">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                            <li><i class="fa fa-calendar"> <span style="padding-left: 1rem;"></i>{{ $opera->ratings}}
                            </li>
                            </span>
                            <span>
                                <li><i class="fa fa-thumbs-up"> <span style="padding-left: 1rem;"></i>69 Likes</li>
                            </span>
                            </span>
                        </div>

                    </ul>
                </div>
            </div>
        </div>
        </div>
        @endforeach


</body>

</html>
<script>
    $("#addCommentBtn").click(function(e){
        e.preventDefault();
        var username = $('#username').val();
        var contact_number = $('#contact_number').val();
        var comments = $('#comments').val();
        var ratings =  $('#ratings').val();
        var operator_id = $('#operator_id').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {username:username, contact_number:contact_number, comments:comments, ratings:ratings, _token: '{{csrf_token()}}'},
            url: "/comment/updateComment/"+ operator_id,
            success: function(data) {
                window.location.reload();
            },
            error: function(error) {
                console.log(error.responseJSON.errors.username);
                console.log(error.responseJSON.errors.contact_number);
                console.log(error.responseJSON.errors.comments);
                console.log(error.responseJSON.errors.ratings);
                console.log(error);
            }
        });
    });
</script>