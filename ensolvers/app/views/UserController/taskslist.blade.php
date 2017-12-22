@extends('layouts.bootstrapstyle')

@section('content')
<div class="offset-sm-9 col-sm-4 mt-1 text-right">   
    <b>User:</b> <span>{{$username}}</span>
    <a href="http://localhost/ensolvers/public/logout">Log out</a>

</div>
<h3 class="text-center" style="margin-top: 10px;margin-bottom:10px;">My To-do list</h3>
<div class="row">
    <div class="col-sm-8 offset-sm-2 ">
        <ul class="list-group">
            @foreach ($tasks as $task)
            <li class="list-group-item ">
                <div class="row">
                    <div class="col-sm-1">
                        @if($task->done==1)
                        <i class="fa fa-check-square-o"></i>
                        @elseif($task->done==0)
                        <i class="fa fa-square-o"></i>
                        @endif
                    </div>
                    <div class='col-sm-9'>
                        <h4 class="small"><b>{{$task->title}}</b></h4>
                    </div>
                    <div class=" offset-sm-1 ">
                        <a class="delete" id="{{$task->id}}" href="#"><p hidden>{{$task->title}}</p><i class="fa fa-trash"></i></a>
                        <a class="edit" id="{{$task->id}}" href="#">
                            <p id="hiddentitle" hidden>{{$task->title}}</p>
                            <p id="hiddendate" hidden>{{$task->dueDate}}</p>
                            <p id="hiddendescription" hidden>{{$task->description}}</p>
                            <p id="hiddendone" hidden>{{$task->done}}</p>
                            <i class="fa fa-pencil"></i></a>
                    </div>
                </div>
            </li>
            @endforeach
            <li class="list-group-item">
                <button id="" type="button" class="btn btn-primary btn-sm pull-right"
                        data-toggle="modal" data-target="#modalNewTask">
                    Create new to-do item
                </button>
            </li>
        </ul>
    </div>
</div>
<nav class="navbar fixed-bottom navbar-light bg-light">
    <div class="container">
        <div id="paginacion">
            {{$tasks->links()}}
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="modalNewTask" tabindex="-1" role="dialog" aria-labelledby="newTask" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">New to-do item task</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div id="divsuccess" class="offset-sm-3 col-sm-9">
                        <div id="success" class="alert alert-success" role="alert">
                            <p>Task saved!</p>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="editid" name="editid" hidden>               
                    <label for="title" class="col-sm-3 col-form-label">Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="newtitle" name="title">               
                    </div>
                    <div id="diverrortitle" class="offset-sm-3 col-sm-9">
                        <div id="errortitle" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">Due date:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="newdate" name="date">
                    </div>
                    <div id="diverrordate" class="offset-sm-3 col-sm-9">
                        <div id="errordate" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="newdescription" name="description" rows="5"></textarea>
                    </div>
                    <div id="diverrordescription" class="offset-sm-3 col-sm-9">
                        <div id="errordescription" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="done" class="col-sm-3 col-form-label" ></label>
                    <div class="col-sm-9">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" id="newdone" name="done">
                            Done
                        </label>
                    </div>
                    <div id="diverrordone" class="offset-sm-3 col-sm-9">
                        <div id="errordone" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="saveNewTask" type="button" class="btn btn-success btn-sm">Save </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MODAL EDIT-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="editTask" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Edit item task</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div id="divsuccessedit" class="offset-sm-3 col-sm-9">
                        <div id="successedit" class="alert alert-success" role="alert">
                            <p>Task updated!</p>
                        </div>
                    </div>
                    <label for="title" class="col-sm-3 col-form-label">Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="edittitle" name="edittitle">
                    </div>
                    <div id="diverrortitleedit" class="offset-sm-3 col-sm-9">
                        <div id="errortitleedit" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date" class="col-sm-3 col-form-label">Due date:</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="editdate" name="editdate">
                    </div>
                    <div id="diverrordateedit" class="offset-sm-3 col-sm-9">
                        <div id="errordateedit" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="editdescription" name="editdescription" rows="5"></textarea>
                    </div>
                    <div id="diverrordescriptionedit" class="offset-sm-3 col-sm-9">
                        <div id="errordescriptionedit" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label" ></label>
                    <div class="col-sm-9">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" id="editdone" name="editdone">
                            Done
                        </label>
                    </div>
                    <div id="diverrordoneedit" class="offset-sm-3 col-sm-9">
                        <div id="errordoneedit" class="alert alert-danger">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                    <button id="updateTask" type="button" class="btn btn-success btn-sm">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal to confirm delete-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">You will delete the task: </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="" id="titledelete"></p>
            </div>
            <h5 class="" id="titledelete"></h5>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button id="deleteTask" data-id type="button" class="btn btn-success">Delete</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //        <-- BUGFIX BOOTSTRAP-->
        $('#paginacion ul').addClass('pagination-sm');
        $('#paginacion ul li').addClass('page-item');
        $('#paginacion ul li a').addClass('page-link');
        $('#paginacion ul li span').addClass('page-link');
        hideAll();
    });

    function hideAll() {
        //ALERTS NEW
        $('#diverrortitle').hide();
        $('#diverrordate').hide();
        $('#diverrordescription').hide();
        $('#diverrordone').hide();
        $('#divsuccess').hide();

        //ALERTS EDIT
        $('#diverrortitleedit').hide();
        $('#diverrordateedit').hide();
        $('#diverrordescriptionedit').hide();
        $('#diverrordoneedit').hide();
        $('#divsuccessedit').hide();


    }
    ;
    //<--START FUNTIONS TO DELETE A EXISTENT TASK-->
    $('#deleteTask').click(function () {
        var id = $('#deleteTask').attr('data-id');
        $.ajax({
            url: 'deleteTask',
            type: 'POST',
            data: {id: id},
            success: function (data) {
                if (data.valid == true) {
                    $('#modalDelete').modal('toggle');
                    $('#' + id).closest('li').fadeOut(2000);
                } else {
                    console.log('Error!');
                }
            }
        });
    });
    $('.delete').click(function () {
        idTask = $(this).attr('id');
        titledelete = '"' + $('#' + idTask + ' p').text() + '"';
        $('#modalDelete').modal('show');
        $('#titledelete').text(titledelete);
        $('#deleteTask').attr('data-id', idTask);
    });
    //<--END FUNTIONS TO DELETE A EXISTENT TASK-->



    $('.edit').click(function () {
        id = $(this).attr('id');
        title = $(this).find('#hiddentitle').text();
        dueDate = $(this).find('#hiddendate').text();
        description = $(this).find('#hiddendescription').text();
        done = $(this).find('#hiddendone').text();
        console.log('En el input del modal va a haber:' + title);
        $('#editid').val(id);
        $('#edittitle').val(title);
        $('#editdate').val(dueDate);
        $('#editdescription').val(description);
        if (done == 1) {
            $('#editdone').prop('checked', true);
        } else {
            $('#editdone').prop('checked', false);
        }
        $('#modalEdit').modal('show');
    });

    $('#updateTask').click(function () {
        id = $('#editid').val();
        nuevotitulo = $('#edittitle').val();
        nuevafecha = $('#editdate').val();
        nuevadescripcion = $('textarea#editdescription').val();
        realizado = +$('#editdone').is(':checked');
        $.ajax({
            url: 'updateTask',
            type: 'POST',
            data: {
                title: nuevotitulo,
                date: nuevafecha,
                description: nuevadescripcion,
                done: realizado,
                id: id
            }, success: function (data) {
                hideAll();
                if (data.valid == false) {
                    console.log(data.errors);
                    if (typeof data.errors['title'] !== 'undefined') {
                        $('#errortitleedit p').text(data.errors['title'][0]);
                        $('#diverrortitleedit').fadeIn(1000);
                    }
                    if (typeof data.errors['date'] !== 'undefined') {
                        $('#errordateedit p').text(data.errors['date'][0]);
                        $('#diverrordateedit').fadeIn(1000);
                    }
                    if (typeof data.errors['description'] !== 'undefined') {
                        $('#errordescriptionedit p').text(data.errors['description'][0]);
                        $('#diverrordescriptionedit').fadeIn(1000);
                    }
                    if (typeof data.errors['done'] !== 'undefined') {
                        if (data.errors['done'][0] == 'validation.boolean') {
                            $('#errordoneedit p').text("Don't touch my code ;)");
                        } else {
                            $('#errordoneedit p').text(data.errors['done'][0]);
                        }
                        $('#diverrordoneedit').fadeIn(1000);
                    }
                } else { //if update -> update view
                    console.log(data);

                    hideAll();
                    location.reload();
                }
            }
        });
    });

    //<--AJAX TO SAVE NEW TASK-->    
    $('#saveNewTask').click(function () {
        nuevotitulo = $('#newtitle').val();
        nuevafecha = $('#newdate').val();
        nuevadescripcion = $('textarea#newdescription').val();
        nuevarealizacion = +$('#newdone').is(':checked');
        $.ajax({
            url: 'addNewTask',
            type: 'POST',
            data: {title: nuevotitulo,
                date: nuevafecha,
                description: nuevadescripcion,
                done: nuevarealizacion},
            success: function (data) {
                hideAll();
                if (data.valid == false) {
                    console.log(data.errors);
                    if (typeof data.errors['title'] !== 'undefined') {
                        $('#errortitle p').text(data.errors['title'][0]);
                        $('#diverrortitle').fadeIn(1000);
                    }
                    if (typeof data.errors['date'] !== 'undefined') {
                        $('#errordate p').text(data.errors['date'][0]);
                        $('#diverrordate').fadeIn(1000);
                    }
                    if (typeof data.errors['description'] !== 'undefined') {
                        $('#errordescription p').text(data.errors['description'][0]);
                        $('#diverrordescription').fadeIn(1000);
                    }
                    if (typeof data.errors['done'] !== 'undefined') {
                        if (data.errors['done'][0] == 'validation.boolean') {
                            $('#errordone p').text("Don't touch my code ;)");
                        } else {
                            $('#errordone p').text(data.errors['done'][0]);
                        }
                        $('#diverrordone').fadeIn(1000);
                    }
                } else {
                    hideAll();
                    console.log(data);
                    $('#newtitle').val('');
                    $('#newdate').val('');
                    $('textarea#newdescription').val('');
                    $('#newdone').prop('checked', false);
                    $('#divsuccess').fadeIn(1500);
                    $('#divsuccess').fadeOut(1500);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            }
        });
    });
</script>
@stop