@extends('layouts.bootstrapstyle')

@section('content')
<h3 class="text-center" style="margin-top: 10px;margin-bottom:10px;">My To-do list</h3>
<div class="row">
    <div class="col-sm-6 offset-sm-3 ">
        <form role="form" action="logMeIn" method="post">
            <div class="form-group row">
                <label for="user" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <!--<div id="loader" class="loader"></div>-->
            <div class="form-group row">
                <label class="col-sm-6 offset-sm-3 col-form-label ">
                    <p id="errorlogin" style="color:red"></p>
                </label>
                <div class="col-sm-3 col-form-label" hidden>
                    <div id="loader" class=" pull-right" >
                        <p><img src="{{ URL::asset('/bootstrap/Spinner.gif')}}" width="40px" height="40px">
                        </p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <button id="login" type="button" class="btn btn-primary">Log me in</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#login').click(function () {
        user = $('#username').val();
        pass = $('#password').val();
        $('#loader').show();
        $.ajax({
            url: 'logMeIn',
            type: 'POST',
            data: {username: user,
                password: pass
            }, success: function (data) {
                $('#loader').hide();
                if (data.valid == true) {
                    $(location).attr('href', 'http://localhost/ensolvers/public/taskslist');
                } else {
                    console.log(data);
                    $("#errorlogin").text(data.error);
                    $('#username').focus();
                }
            }
        });
    });
</script>
@stop
