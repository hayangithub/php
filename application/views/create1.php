<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gentelella Alela! | </title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>build/css/custom.min.css" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <a href="index.html"><img src="<?php echo base_url(); ?>images/logo.jpg" alt="..." class="img-circle profile_img"> </a>
                            </div>
                            <div class="profile_info">
                                <h2 style="text-align: center">Grade Sheet Management System</h2>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br />
                        <!-- sidebar menu -->
                        <?php include("sidebar_menu.php"); ?>
                        <!-- /sidebar menu -->
                    </div>
                </div>

                <!-- top navigation -->
                <?php include("top_nav.php"); ?>
                <!-- /top navigation -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Assessment Configuration </h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Add Assessments</h2>                                      
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table class="table" id="assessment-table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Assessment type</th>
                                                    <th>Mark</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbl_posts_body">
                                                <tr>
                                                    <th scope="row"><input type="checkbox" name="" value="" id="" /></th>
                                                    <td>
                                                        <select name="">
                                                            <option value="">Quiz</option>
                                                            <option value="">Mid-Term</option>
                                                            <option value="">Practical</option>
                                                            <option value="">Project</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="" value="" id="" />
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary" type="button">Add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <button class="btn btn-primary" id="add-record" type="button">Add</button>
                                                <button class="btn btn-warning" type="reset">Delete</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">                                   
                                <div class="x_content">
                                    <div class="ln_solid"></div>  
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button class="btn btn-primary" type="button">Cancel</button>
                                            <button class="btn btn-primary" type="reset">Reset</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>vendors/iCheck/icheck.min.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>


        <script>
            $("#add-record").click(function () {
                var rowCount = $('#tbl_posts_body tr').length;
                console.log("length " + rowCount);
                var htmlString = '<tr>';
                htmlString += '<th scope="row"><input type="checkbox" name="" value="" id="" /></th>';
                htmlString += '<td>';
                htmlString += '<select name="assessment-name">';
                htmlString += '<option value="quiz">Quiz</option>';
                htmlString += '<option value="midterm">Mid-Term</option>';
                htmlString += '<option value="practical">Practical</option>';
                htmlString += '<option value="project">Project</option>';
                htmlString += '</select>';
                htmlString += '</td>';
                htmlString += '<td>';
                htmlString += '<input type="text" name="" value="" id="" />';
                htmlString += '</td>';
                htmlString += '<td>';
                htmlString += '<button class="btn btn-primary" type="button">Remove</button>';
                htmlString += '</td>';
                htmlString += '</tr>';
                $('#tbl_posts_body').append(htmlString);
            });
        </script>

    </body>
</html>