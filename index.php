<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo APP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css" />

</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php">ToDo APP</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" data-toggle="modal" data-target="#addToDo">
                    <a class="nav-link" href="#">ADD ToDo</a>
                </li>
                <li class="nav-item" data-toggle="modal" data-target="#dataModal">
                    <a class="nav-link " href="#" class="view_data">ToDoS Category</a>
                </li>


            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center text-danger font-weight-normal my-3">ToDo</h4>
            </div>

        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showTodos">

                </div>
            </div>
        </div>
    </div>


    <!-- ADD ToDo -->
    <div class="modal fade" id="addToDo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">ADD ToDo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="form-data">
                        <div class="form-group">
                            <input type="text" name="category" class="form-control" placeholder='Category' required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="status" class="form-control" placeholder="Status" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" value="ADD ToDo"
                                class="btn btn-success btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit ToDo -->
    <div class="modal fade" id="editToDo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">EDIT ToDo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="edit-form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="category" class="form-control" id="category" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" id="title" required>
                        </div>
                        <div class="form-group">
                            <input type="number" name="status" class="form-control" id="status" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" id="update" value="UPDATE ToDo"
                                class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ToDo CAT -->

    <div class="modal fade" id="dataModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title">ToDo Categories</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->

                <div class="modal-body modal-body px-4" id="category_detail">
                    <table class="table table-striped table-sm table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Marks</th>
                                <th>TodOs Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $conn = mysqli_connect("localhost","root","","todo_list");
                        function countCateg($count_categ){
                        $count_categ=' SELECT category,COUNT(*) as Marks from todos group by Marks';
                        }
                        if($conn->connect_error){
                            die("Connection failed".$conn->connect_error);
                        }

                        $sql="SELECT category from todos";
                        $result = $conn-> query($sql);
                        
                        if ($result->num_rows>0){
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".countCateg($count_categ)."</td><td>".$row["category"]."</td></tr>";
                            }
                            echo"</table>";
                        }
                        else{
                            echo "0 result";
                        }
                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            showAllUsers();

            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        action: "view"
                    },
                    success: function (response) {
                        // console.log(response);
                        $("#showTodos").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });

                    }
                });
            }



            //insert ajax request
            $("#insert").click(function (e) {
                if ($("#form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize() + "&action=insert",
                        success: function (response) {
                            Swal.fire({
                                title: 'ToDo added successfully!',
                                type: 'success'
                            })
                            $("#addToDo").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUsers();
                        }
                    });
                }
            });

            //Edit ToDo
            $("body").on("click", ".editBtn", function (e) {
                e.preventDefault();
                edit_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        edit_id: edit_id
                    },
                    success: function (response) {
                        data = JSON.parse(response);
                        $("#id").val(data.id)
                        $("#category").val(data.category)
                        $("#title").val(data.title)
                        $("#status").val(data.status)
                    }
                })
            });


            //update ajax request
            $("#update").click(function (e) {
                if ($("#edit-form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize() + "&action=update",
                        success: function (response) {
                            Swal.fire({
                                title: 'ToDo update successfully!',
                                type: 'success'
                            })
                            $("#editToDo").modal('hide');
                            $("#edit-form-data")[0].reset();
                            showAllUsers();
                        }
                    });
                }
            });

            //Delete ajax request
            $("body").on("click", ".delBtn", function (e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                del_id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "action.php",
                            type: "POST",
                            data: {
                                del_id: del_id
                            },
                            success: function (response) {
                                tr.css('background-color', '#ff6666');
                                Swal.fire(
                                    'Deleted!',
                                    'ToDo deleted successfully!',
                                    'succes'
                                )
                                showAllUsers();
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>