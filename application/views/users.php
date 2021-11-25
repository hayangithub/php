<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url(); ?>images/logo.jpg"/>
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1990 12:00:00 GMT" />
        <title>Users List</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="<?php echo base_url(); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>build/css/custom.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>build/css/site-style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>build/css/inputeffects.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/animate/css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/toast/toastr.min.css" rel="stylesheet">


        <style>
            .panel-heading {
                border: 0;
                background-color: #282a3c;
                border-radius: 4px 4px 0px 0px;
            }
            .panel-default>.panel-heading {
                background-color: #2A3F54;
                color:#FFFFFF;
                border: 1px solid #1ABB9C;
            }

            .effect-7:focus {
                background-color: #FFFFFF;
                border-color: #3399FF; 
                border-width: 2px;
                transition: 0.6s;
            }

            .effect-7.btn-default.active, .effect-7.btn-default:active, .effect-7.open>.dropdown-toggle.btn-default {
                background-color: #FFFFFF;
                border-color: #3399FF; 
                border-width: 2px;
                transition: 0.6s;
            }
            .effect-7.btn-default.active, .effect-7.btn-default:active, .effect-7.open>.dropdown-toggle.btn-default:hover {
                background-color: #FFFFFF;
                border-color: #3399FF; 
                border-width: 2px;
                transition: 0.6s;
            }

            .effect-7.btn:hover{
                background-color: #FFFFFF;
                border-color: #3399FF; 
                border-width: 2px;
                transition: 0.6s;
            }
        </style>
        <script type="text/javascript">
            var baseUrl = "<?php echo base_url() ?>";</script>
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
                                <h2 style="text-align: center">Venue Booking Management System</h2>
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
                        <div class="clearfix"></div>
                        <br>
                        <!-- Search Panel -->
                        <div class="box-panel">
                            <form id="userSearchForm">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        <i class="glyphicon glyphicon-search"></i>
                                        Search Panel  
                                    </h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" id="btnCollapseExpand" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                            <i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6"> 
                                            <div class="form-group">
                                                <label>Employee No</label>
                                                <input type="text" class="form-control effect-7" id="employeeno_search" name="employeeno_search" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="form-control effect-7" name="department_search" id="department_search">
                                                    <option value="all">All Types</option>
                                                    <?php foreach ($departments as $row) { ?>
                                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control effect-7" id="email_search" name="email_search" autocomplete="off">
                                            </div>

                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control effect-7" name="status_search" id="status_search">
                                                    <option value="all">All Types</option>
                                                    <?php foreach ($enable_flag as $row) { ?>
                                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <button type="button" onclick="searchUserDone();" class="btn btn-sm btn-round btn-grey"> <i class="glyphicon glyphicon-search"></i> Search</button>
                                            <button type="button" id="clearUserSearchForm" class="btn btn-sm btn-round btn-danger"> <i class="glyphicon glyphicon-ban-circle"></i> Clear</button>
                                            <button type="button" id="addUserOpener" class="btn btn-sm btn-round btn-success" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-footer-->
                            </form>
                        </div>
                        <div class="row">                                        
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Users List</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Department</th>
                                                    <th>Email</th>
                                                    <th>Employee No</th>
                                                    <th>Mobile Phone</th>
                                                    <th>Ext</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>                  
                    </div>
                </div> 
                <!-- /page content -->

                <!-- footer content -->
                <?php $this->load->view('footer.php'); ?>
                <!-- /footer content -->

            </div>
        </div>
        <!-- Add Modal-->   
        <div class="modal fade in bs-example-modal-lg addUserModal" data-backdrop="static" data-keyboard="false" id="addUserModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-media-content">
                    <div class="modal-header modal-media-header">
                        <button type="button" class="close closeAdd">×</button>
                        <h4 class="box-title">Add New User</h4> 
                    </div>
                    <div class="modal-body pt0 pb0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 errorBox">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form enctype="multipart/form-data" id="formadd">
                                    <div class="row row-eq">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="row ptt10">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" name="firstNameAdd" id="firstNameAdd" class="form-control col-md-7 col-xs-12" maxlength="20" autocomplete="off" />                                                       
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" name="lastNameAdd" id="lastNameAdd" class="form-control col-md-7 col-xs-12" maxlength="20"  autocomplete="off"/>
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="emailAdd" id="emailAdd" class="form-control col-md-7 col-xs-12" maxlength="70" autocomplete="off"/>                                                     
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="passwordAdd" id="passwordAdd" class="form-control col-md-7 col-xs-12" maxlength="70" maxlength="6" autocomplete="off"/>                                                     
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Employee No.</label>
                                                        <input type="text" name="employeeNoAdd" id="employeeNoAdd" class="form-control col-md-7 col-xs-12" maxlength="10"  autocomplete="off"/>                                                     
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile No.</label>
                                                        <input type="text" name="mobileNoAdd" id="mobileNoAdd" class="form-control col-md-7 col-xs-12 numericOnly" maxlength="15" autocomplete="off"/>                                                       
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ext.</label>
                                                        <input type="text" name="extNoAdd" id="extNoAdd" class="form-control col-md-7 col-xs-12 numericOnly" maxlength="4"  autocomplete="off"/>
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>

                                            </div><!--./row--> 
                                        </div><!--./col-md-6--> 
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-eq ptt10">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label> Role </label>
                                                        <small class="req">*</small> 
                                                        <select class="selectpicker form-control effect-7" id="roleAdd" name="roleAdd" style="width:100%" multiple data-max-options="1" data-live-search="true">
                                                            <?php foreach ($userypes as $row) { ?>   
                                                                <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                                            <?php } ?>                                                                    }
                                                        </select>
                                                        <span class="text-danger roleAddError"></span>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-12 col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile"> Department</label>
                                                        <small class="req"> *</small> 
                                                        <div>
                                                            <select class="form-control select2" name="departmentAdd" id="departmentAdd" style="width:100%" tabindex="0" aria-hidden="false">
                                                                <?php foreach ($departments as $row) { ?>             
                                                                    <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>   
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-12 col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile"> Status</label>
                                                        <small class="req"> *</small> 
                                                        <div>
                                                            <select class="form-control select2" name="statusAdd" id="statusAdd" style="width:100%" tabindex="0" aria-hidden="false">
                                                                <?php foreach ($enable_flag as $row) { ?>             
                                                                    <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>   
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div> 
                                              <div class="col-sm-12" style="display:none">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile"> User Photo (gif,jpg,png) Max size 1 MB</label>
                                                        <div class="text-center">
                                                            <input type='file' id="imgInp" name="imgInp"/>
                                                            <img  style="border-radius: 50%; text-align: center;" id="userPhoto"  src="<?php echo base_url(); ?>/images/userEmpty.png" height="150px" width="150px" />
                                                        </div>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div> 
                                            </div><!--./row-->
                                        </div><!--./col-lg-6-->
                                    </div><!--./row-->   
                                    <div class="row">            
                                        <div class="box-footer">
                                            <div class="pull-right"> 
                                                <button type="submit"  class="btn btn-round btn-success">Save</button>
                                                <button type="button"  id="cancelAdd" class="btn btn-round btn-danger" >Cancel</button>

                                            </div>
                                        </div>
                                    </div><!--./row-->  
                                </form>                       
                            </div><!--./col-md-12-->       
                        </div><!--./row--> 
                    </div>
                </div>
            </div>    
        </div>


        <!-- Edit Modal-->
        <div class="modal fade in bs-example-modal-lg editUserModal" data-backdrop="static" data-keyboard="false" id="editUserModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-media-content">
                    <div class="modal-header modal-media-header">
                        <button type="button" class="close closeEdit">×</button>
                        <h4 class="box-title">Edit User</h4> 
                    </div>
                    <div class="modal-body pt0 pb0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 errorBox">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form enctype="multipart/form-data" id="formedit">
                                    <input type="hidden" name="intuseridEdit" id="intuseridEdit" value=""  />
                                    <div class="row row-eq">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="row ptt10">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" name="firstNameEdit" id="firstNameEdit" value="" maxlength="20" class="form-control col-md-7 col-xs-12" />                                                       
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" name="lastNameEdit" id="lastNameEdit" value="" maxlength="20" class="form-control col-md-7 col-xs-12"  />
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="emailEdit" id="emailEdit" value="" maxlength="70" class="form-control col-md-7 col-xs-12" />                                                     
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" name="passwordEdit" id="passwordEdit" class="form-control col-md-7 col-xs-12" maxlength="70" maxlength="6" autocomplete="off"/>                                                     
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Employee No.</label>
                                                        <input type="text" name="employeeNoEdit" id="employeeNoEdit" value="" maxlength="10" class="form-control col-md-7 col-xs-12"  />                                                     
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile No.</label>
                                                        <input type="text" name="mobileNoEdit" id="mobileNoEdit" value="" maxlength="15" class="form-control col-md-7 col-xs-12 numericOnly" />                                                       
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ext.</label>
                                                        <input type="text" name="extNoEdit" id="extNoEdit" value="" maxlength="4" class="form-control col-md-7 col-xs-12 numericOnly"  />
                                                    </div>
                                                    <span class="text-danger"></span>
                                                </div>

                                            </div><!--./row--> 
                                        </div><!--./col-md-6--> 
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-eq ptt10">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label> Role </label>
                                                        <small class="req">*</small> 
                                                        <select class="selectpicker form-control effect-7" id="roleEdit" name="roleEdit" style="width:100%" multiple data-max-options="1" data-live-search="true">
                                                            <?php foreach ($userypes as $row) { ?>   
                                                                <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                                            <?php } ?>                                                                    }
                                                        </select>
                                                        <span class="text-danger roleEditError"></span>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-12 col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile"> Department</label>
                                                        <small class="req"> *</small> 
                                                        <div>
                                                            <select class="form-control select2" name="departmentEdit" id="departmentEdit" style="width:100%" tabindex="0" aria-hidden="false">
                                                                <?php foreach ($departments as $row) { ?>             
                                                                    <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>   
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-12 col-md-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile"> Status</label>
                                                        <small class="req"> *</small> 
                                                        <div>
                                                            <select class="form-control select2" name="statusEdit" id="statusEdit" style="width:100%" tabindex="0" aria-hidden="false">
                                                                <?php foreach ($enable_flag as $row) { ?>             
                                                                    <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>   
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-12" style="display:none">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile"> User Photo (gif,jpg,png) Max size 1 MB</label>
                                                        <div class="text-center">
                                                            <input type='file' id="imgInp" name="imgInp"/>
                                                            <img  style="border-radius: 50%; text-align: center;" id="userPhoto"  src="<?php echo base_url(); ?>/images/userEmpty.png" height="150px" width="150px" />
                                                        </div>
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div> 
                                            </div><!--./row-->
                                        </div><!--./col-lg-6-->
                                    </div><!--./row-->   
                                    <div class="row">            
                                        <div class="box-footer">
                                            <div class="pull-right">              
                                                <button type="submit" class="btn btn-round btn-success" >Save</button>
                                                <button type="button" id="cancelEdit" class="btn btn-round btn-danger editUserModalCancel">Cancel</button>

                                            </div>
                                        </div>
                                    </div><!--./row-->  
                                </form>                       
                            </div><!--./col-md-12-->       
                        </div><!--./row--> 
                    </div>
                </div>
            </div>    
        </div>

        <div class="loading hidden">Loading&#8230;</div>
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Datatables -->
        <script src="<?php echo base_url(); ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url(); ?>vendors/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
        <!-- Toast Theme Scripts -->
        <script src="<?php echo base_url(); ?>vendors/toast/toastr.min.js"></script>
        <!-- Custom Theme Scripts -->
        <script src="<?php echo base_url(); ?>build/js/custom.min.js"></script>
        <script src="<?php echo base_url(); ?>build/js/site-js.js"></script>
        <script src="<?php echo base_url(); ?>build/js/user_module/users.js"></script>


        <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#btnCollapseExpand").click(function () {
                                                        $(".box-body").slideToggle(1500); // toggle collapse
                                                        $(".box-footer").slideToggle(1800); // toggle collapse
                                                    });
                                                    let userController = new UserController();
                                                    userController.initLoadData();
                                                });
                                                function searchUserDone() {
                                                    let employeeno_search = $('#employeeno_search').val();
                                                    let department_search = $('#department_search').val();
                                                    let email_search = $('#email_search').val();
                                                    let status_search = $('#status_search').val();
                                                    let userController = new UserController();
                                                    userController.searchUserData(employeeno_search, department_search, email_search, status_search);
                                                }
                                                $("#imgInp").change(function () {
                                                    readURL(this);
                                                });
                                                function readURL(input) {
                                                    if (input.files && input.files[0]) {
                                                        var reader = new FileReader();
                                                        reader.onload = function (e) {
                                                            $('#userPhoto').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(input.files[0]);
                                                    }
                                                }

                                                $('#addUserOpener').click(function () {
                                                    $('.addUserModal').modal('show');
                                                });
                                                $('input[type=text]').on('input', function (e) {
                                                    $(this).parent().parent().find('span').text("");
                                                });
                                                 $('#passwordAdd').on('input', function (e) {
                                                    $(this).parent().parent().find('span').text("");
                                                });
                                                $('#roleAdd').change(function () {
                                                    $('.roleAddError').text("");
                                                });
                                                $('#roleEdit').change(function () {
                                                    $('.roleEditError').text("");
                                                });
                                                $('.closeAdd, #cancelAdd').click(function () {
                                                    addUserModalClose();
                                                });
                                                $('.closeEdit,#cancelEdit').click(function () {
                                                    editUserModalClose();
                                                });
                                                $('#clearUserSearchForm').click(function () {
                                                    $('#userSearchForm')[0].reset();
                                                });


                                                $('#formadd').submit(function (e) {
                                                    e.preventDefault();
                                                    let validationResult = true;
                                                    $('#formadd').find('input[type=text]', 'select', 'input[type="password"]').each(function () {
                                                        console.log(this.name + "  " + this.value);
                                                        if (isEmpty(this.value) && !isEmpty(this.id)) {
                                                            validationResult = false;
                                                            $(this).parent().parent().find('span').text("This Field is Required");
                                                        }
                                                    });
                                                    if ($('#roleAdd').val() == null) {
                                                        validationResult = false;
                                                        $('.roleAddError').text("This Field is Required");
                                                    }
                                                    if (isEmpty($('#passwordAdd').val())) {
                                                        validationResult = false;
                                                         $('#passwordAdd').parent().parent().find('span').text("This Field is Required");
                                                    }
                                                    if (!isEmail($('#emailAdd').val())) {
                                                        validationResult = false;
                                                        $('#emailAdd').parent().parent().find('span').text("Please Enter a Valid Email");
                                                    }


                                                    if (validationResult === true) {
                                                        var inputFile = $('#imgInp');
                                                        var fileToUpload = inputFile[0].files[0];
                                                        var $form = $("#formadd");
                                                        //var other_data = getFormData($form);
                                                        var other_data = JSON.stringify(serializeObject("formadd")); //JSON.stringify($('#formadd').serializeArray());
                                                        var data = new FormData();
                                                        console.log(other_data);
                                                        data.append("file", fileToUpload);
                                                        data.append("formData", other_data);
                                                        $.ajax({
                                                            url: '<?php echo base_url() ?>users/addNewUser',
                                                            type: 'POST',
                                                            data: data,
                                                            processData: false,
                                                            contentType: false,
                                                            cache: false,
                                                            beforeSend: function () {
                                                                $(".loading").removeClass('hidden');
                                                                $(".loading").addClass('show');
                                                            },
                                                            success: function (data) {
                                                                data = $.parseJSON(data);
                                                                $('.errorBox').empty();
                                                                if (data['errorImage'] === "yes") {
                                                                    $('.errorBox').append('<p class="error">- Either Image format or size not supported</p>');
                                                                    return;
                                                                }
                                                                if (data['result']['errorCode'] === "0001") {
                                                                    $('.errorBox').append('<p class="error">- ' + data['result']['errorDesc'] + '</p>');
                                                                    return;
                                                                }
                                                                if (data['result']['errorCode'] === "0002") {
                                                                    $('.errorBox').append('<p class="error">- ' + data['result']['errorDesc'] + '</p>');
                                                                    return;
                                                                }
                                                                if (data['result']['errorCode'] === "0000") {
                                                                    addUserModalClose();
                                                                    toastr.options.progressBar = true;
                                                                    toastr.options.closeButton = true;
                                                                    toastr.options.positionClass = "toast-top-right";
                                                                    toastr.success("New User Added Successfuly")
                                                                    let userController = new UserController();
                                                                    userController.initLoadData();
                                                                }
                                                            },
                                                            error: function (xhr) { // if error occured
                                                                alert("Error occured.please try again");
                                                            },
                                                            complete: function () {
                                                                $(".loading").removeClass('show');
                                                                $(".loading").addClass('hidden');
                                                            }
                                                        });
                                                    }
                                                });

                                                function addUserModalClose() {
                                                    $('#formadd')[0].reset();
                                                    $('.text-danger').text("");
                                                    $('.selectpicker').selectpicker('deselectAll');
                                                    $("#addUserModal").modal("hide");
                                                }
                                                function editUserModalClose() {
                                                    $('.text-danger').text("");
                                                    $("#editUserModal").modal("hide");
                                                }
                                                function getFormData($form) {
                                                    var unindexed_array = $form.serializeArray();
                                                    var indexed_array = {};
                                                    $.map(unindexed_array, function (n, i) {
                                                        indexed_array[n['name']] = n['value'];
                                                    });
                                                    return indexed_array;
                                                }

                                                function serializeObject(formID)
                                                {
                                                    var o = {};
                                                    var a = $('#' + formID).serializeArray();
                                                    $.each(a, function () {
                                                        if (o[this.name] !== undefined) {
                                                            if (!o[this.name].push) {
                                                                o[this.name] = [o[this.name]];
                                                            }
                                                            o[this.name].push(this.value || '');
                                                        } else {
                                                            o[this.name] = this.value || '';
                                                        }
                                                    });
                                                    return o;
                                                }
                                                ;
                                                function editUser(intuserid) {
                                                    $.ajax({
                                                        url: '<?php echo base_url() ?>users/editUser',
                                                        type: 'POST',
                                                        data: {'intuserid': intuserid},
                                                        beforeSend: function () {
                                                            $(".loading").removeClass('hidden');
                                                            $(".loading").addClass('show');
                                                        },
                                                        success: function (data) {
                                                            data = $.parseJSON(data);
                                                            if (data['errorCode'] == "0000") {
                                                                //Set Depatrments Menu
                                                                var optionDepartmentsHTML = "";
                                                                $('#departmentEdit').empty();
                                                                $.each(data['departments'], function (i, item) {
                                                                    var selected = "";
                                                                    if (data['specific_user']['chdepartment'] == item['vchparamcode']) {
                                                                        selected = "selected"
                                                                    }
                                                                    optionDepartmentsHTML += '<option value=' + item['vchparamcode'] + ' ' + selected + '>' + item['vchparamdesc'] + '</option>';
                                                                });
                                                                $('#departmentEdit').append(optionDepartmentsHTML);
                                                                //Set User Status Menu
                                                                var optionStatusHTML = "";
                                                                $.each(data['enable_flag'], function (i, item) {
                                                                    var selected = "";
                                                                    if (data['specific_user']['chstatus'] === item['vchparamcode']) {
                                                                        selected = "selected"
                                                                    }
                                                                    optionStatusHTML += '<option value=' + item['vchparamcode'] + ' ' + selected + '>' + item['vchparamdesc'] + '</option>';
                                                                });
                                                                $('#statusEdit').empty();
                                                                $('#statusEdit').append(optionStatusHTML);
                                                                $('#intuseridEdit').val(data['specific_user']['intuserid']);
                                                                $('#firstNameEdit').val(data['specific_user']['vchfirstname']);
                                                                $('#lastNameEdit').val(data['specific_user']['vchlastname']);
                                                                $('#emailEdit').val(data['specific_user']['vchemail']);
                                                                $('#mobileNoEdit').val(data['specific_user']['vchphoneno']);
                                                                $('#extNoEdit').val(data['specific_user']['vchext']);
                                                                $('#employeeNoEdit').val(data['specific_user']['vchemployeeno']);
                                                                $('#roleEdit').selectpicker('val', data['roles']);
                                                                $(".editUserModal").modal("show");
                                                            }
                                                        },
                                                        error: function (xhr) { // if error occured
                                                            alert("Error occured.please try again");
                                                        },
                                                        complete: function () {
                                                            $(".loading").removeClass('show');
                                                            $(".loading").addClass('hidden');
                                                        }
                                                    });
                                                }

                                                $('#formedit').submit(function (e) {
                                                    e.preventDefault();
                                                    let validationResult = true;
                                                    $('#formedit').find('input[type=text]', 'select', 'input[type=password]').each(function () {
                                                        console.log(this.name + "  " + this.value);
                                                        if (isEmpty(this.value) && !isEmpty(this.id)) {
                                                            validationResult = false;
                                                            $(this).parent().parent().find('span').text("This Field is Required");
                                                        }
                                                    });
                                                    if ($('#roleEdit').val() == null) {
                                                        validationResult = false;
                                                        $('.roleEditError').text("This Field is Required");
                                                    }

                                                    if (!isEmail($('#emailEdit').val())) {
                                                        validationResult = false;
                                                        $('#emailEdit').parent().parent().find('span').text("Please Enter a Valid Email");
                                                    }

                                                    console.log(validationResult);
                                                    if (validationResult === true) {
                                                        var inputFile = $('#imgInp');
                                                        var fileToUpload = inputFile[0].files[0];
                                                        var $form = $("#formedit");
                                                        //var other_data = getFormData($form);
                                                        var other_data = JSON.stringify(serializeObject("formedit")); //JSON.stringify($('#formadd').serializeArray());
                                                        var data = new FormData();
                                                        console.log(other_data);
                                                        data.append("file", fileToUpload);
                                                        data.append("formData", other_data);
                                                        $.ajax({
                                                            url: '<?php echo base_url() ?>users/editUserDone',
                                                            type: 'POST',
                                                            data: data,
                                                            processData: false,
                                                            contentType: false,
                                                            cache: false,
                                                            beforeSend: function () {
                                                                $(".loading").removeClass('hidden');
                                                                $(".loading").addClass('show');
                                                            },
                                                            success: function (data) {
                                                                data = $.parseJSON(data);
                                                                $('.errorBox').empty();
                                                                if (data['errorImage'] === "yes") {
                                                                    $('.errorBox').append('<p class="error">- Either Image format or size not supported</p>');
                                                                    return;
                                                                }
                                                                if (data['result']['errorCode'] === "0001") {
                                                                    $('.errorBox').append('<p class="error">- ' + data['result']['errorDesc'] + '</p>');
                                                                    return;
                                                                }
                                                                if (data['result']['errorCode'] === "0002") {
                                                                    $('.errorBox').append('<p class="error">- ' + data['result']['errorDesc'] + '</p>');
                                                                    return;
                                                                }
                                                                if (data['result']['errorCode'] === "0000") {
                                                                    editUserModalClose();
                                                                    toastr.options.progressBar = true;
                                                                    toastr.options.closeButton = true;
                                                                    toastr.options.positionClass = "toast-top-right";
                                                                    toastr.success("User Data Updated Successfuly")
                                                                    let userController = new UserController();
                                                                    userController.initLoadData();
                                                                }
                                                            },
                                                            error: function (xhr) { // if error occured
                                                                alert("Error occured.please try again");
                                                            },
                                                            complete: function () {
                                                                $(".loading").removeClass('show');
                                                                $(".loading").addClass('hidden');
                                                            }
                                                        });
                                                    }
                                                });



        </script>
    </body>
</html>