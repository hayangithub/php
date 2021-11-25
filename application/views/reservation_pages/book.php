<?php
$userData = getUserSessionData();
$userType = "";
if ((in_array("FA", $userData['roles'])) && (!in_array("AD", $userData['roles']) && !in_array("MA", $userData['roles']))) {
    $userType = "FA";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url(); ?>images/logo.jpg"/>
        <title>Reservation</title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">   
        <!-- Select2 -->
        <link href="<?php echo base_url(); ?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="<?php echo base_url(); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">       
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>build/css/site-style.css" rel="stylesheet">
        <!-- Custom Theme Style -->      
        <link href="<?php echo base_url(); ?>build/css/custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="<?php echo base_url(); ?>vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>build/css/inputeffects.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>vendors/animate/css/animate.min.css" rel="stylesheet">
        <!-- Toast Theme Style -->
        <link href="<?php echo base_url(); ?>vendors/toast/toastr.min.css" rel="stylesheet">
        <?php if ($userType == "FA") { ?>
            <style>
                .reservationList {    
                    display: none   ;        }    

            </style>
        <?php } ?>
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
                        <?php $this->load->view('sidebar_menu.php'); ?>
                        <!-- /sidebar menu -->
                    </div>
                </div>
                <!-- top navigation -->
                <?php $this->load->view('top_nav.php'); ?>
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="clearfix"></div>
                        <br>
                        <!-- Search Panel -->
                        <div class="box-panel">
                            <form id="reservationSearchForm">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        <i class="glyphicon glyphicon-search"></i>
                                        Search Reservation  
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
                                                <label>Class / Lab / Hall</label>
                                                <input type="text" class="form-control effect-7" id="vchroomno_search" name="vchroomno_search" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control effect-7" name="status_search" id="status_search">
                                                    <option value="all">All</option>
                                                    <?php foreach ($booking_status as $row) { ?>
                                                        <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label>Date-From</label>
                                                <input type="text" class="form-control effect-7" id="datetimepicker6_search" name="datetfrom_search" autocomplete="off">
                                            </div>
                                            <div class="form-group">
                                                <label>Date-To</label>
                                                <input type="text" class="form-control effect-7" id="datetimepicker7_search" name="dateto_search" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <button type="button" onclick="searchReservationDone();" class="btn btn-sm btn-round btn-grey"> <i class="glyphicon glyphicon-search"></i> Search</button>
                                            <button type="button" id="clearReservationSearchForm" class="btn btn-sm btn-round btn-danger"> <i class="glyphicon glyphicon-ban-circle"></i> Clear</button>

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
                                        <h2>Venue Reservation List</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_title">
                                        <?php if (in_array("AD", $userData['roles']) || in_array("MA", $userData['roles'])) { ?>
                                            <button type="button" id="approveReservation" class="btn btn-round btn-sm btn-primary" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-ok"></i> Approve</button>
                                            <button type="button" id="rejectReservation" class="btn btn-round btn-sm btn-dark"> <i class="glyphicon glyphicon-remove"></i> Reject</button>
                                        <?php } ?>
                                        <?php if ((in_array("FA", $userData['roles'])) && (!in_array("AD", $userData['roles']) && !in_array("MA", $userData['roles']))) { ?>
                                            <button type="button" id="addReservationOpener1" class="btn btn-round btn-sm btn-success" data-target=""><i class="glyphicon glyphicon-plus"></i> Add</button>
                                           <!-- <button type="button" id="approveReservation" class="btn btn-round btn-sm btn-danger" data-toggle="modal" data-target=""><i class="glyphicon glyphicon-remove"></i> Cancel</button> -->
                                        <?php } ?>

                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="x_content">
                                        <table id="datatable-responsive1" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <?php if ($userType == "FA") { ?>
                                                        <th>Reservation ID</th>
                                                    <?php } else { ?>
                                                        <th>Action</th>
                                                    <?php } ?>
                                                    <th>Class / Lab / Hall No.</th>
                                                    <th>Requested By</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>

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
        <div class="loading hidden">Loading&#8230;</div>

        <!--Add Modal -->
        <div class="modal fade in bs-example-modal-lg" data-backdrop="static" data-keyboard="false" id="addReservationModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-media-content">
                    <div class="modal-header modal-media-header">
                        <button type="button" class="close" onclick="addReservationModalClose();" autocomplete="off">×</button>
                        <h4 class="box-title">Add New Reservation</h4> 
                    </div>
                    <div class="modal-body pt0 pb0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form id="formadd" accept-charset="utf-8" method="post">
                                    <div class="row row-eq">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="row ptt10">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Date Time / Start</label>
                                                        <input type='text' class="form-control col-md-7 col-xs-12" id='datetimepicker6' name="dtfrom" class="form-control" />
                                                    </div>
                                                    <span id="dtFromError" class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Date Time / End</label>
                                                        <input type='text' class="form-control col-md-7 col-xs-12"  id='datetimepicker7' name="dtto" class="form-control" />
                                                    </div>
                                                    <span id="dtToError" class="text-danger"></span>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label> Room/ Hall/ Lab No </label>
                                                        <small class="req">*</small> 
                                                        <select class="selectpicker form-control" id="introomid" name="introomid" style="width:100%" multiple data-max-options="5" data-live-search="true">
                                                            <?php foreach ($blocks as $block) { ?> 
                                                                <optgroup label="<?php echo "<b><u>" . $block['vchparamdesc'] . "</u></b>"; ?>">
                                                                    <?php
                                                                    foreach ($rooms as $room) {
                                                                        if ($block['vchparamcode'] == $room['chblock']) {
                                                                            ?>
                                                                            <option value="<?php echo $room['introomid']; ?>"><?php echo $room['vchroomno']; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?> 
                                                            </optgroup>
                                                        </select>
                                                        <span id="roomError" class="text-danger"></span>
                                                    </div>
                                                </div>                    
                                            </div><!--./row--> 
                                        </div><!--./col-md-6--> 
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-eq ptt10">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputFile"> Purpose</label>
                                                        <small class="req"> *</small> 
                                                        <div>
                                                            <select class="form-control select2" id="vchpurpose" name="vchpurpose" style="width:100%" name="consultant_doctor" tabindex="0" aria-hidden="false">
                                                                <?php foreach ($reserve_purpose as $row) { ?>             
                                                                    <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>   
                                                                <?php } ?>
                                                            </select>                                                          
                                                        </div>

                                                    </div>
                                                </div> 
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="remark">Remarks</label> 
                                                        <textarea name="vchremarks" id="vchremarks" class="form-control"></textarea>
                                                    </div> 
                                                </div>

                                            </div><!--./row-->
                                        </div><!--./col-lg-6-->
                                    </div><!--./row-->   
                                    <div class="row">            
                                        <div class="box-footer">
                                            <div class="pull-right">  
                                                <button type="button" onclick="add_reservation();" data-loading-text="Save" class="btn btn-round btn-success" atocomplete="off" >Save</button>
                                                <button type="button" onclick="addReservationModalClose();" data-loading-text="Cancel" class="btn btn-round btn-danger" autocomplete="off" >Cancel</button>
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
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- bootstrap-daterangepicker -->
        <script src="<?php echo base_url(); ?>vendors/moment/min/moment.min.js" ></script>
        <script src="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url(); ?>vendors/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
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
        <script src="<?php echo base_url(); ?>build/js/reservation_module/reserve.js"></script>

        <script>
                                                    $(document).ready(function () {
                                                        $("#btnCollapseExpand").click(function () {
                                                            $(".box-body").slideToggle(1500); // toggle collapse
                                                            $(".box-footer").slideToggle(1800); // toggle collapse
                                                        });
                                                        var date = new Date();
                                                        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                                                        var date2 = new Date();
                                                        var today2 = new Date(date2.getFullYear(), date2.getMonth(), date2.getDate(), date2.getHours(), date2.getMinutes(), date2.getSeconds());
                                                        //,date2.getHours(),date2.getMinutes(),date2.getSeconds()

                                                        $('#datetimepicker6').datetimepicker({
                                                            format: "DD/MM/YYYY - hh:mm A",
                                                            minDate: moment(),
                                                            //minTime:0,
                                                            showClose: true,
                                                            icons: {
                                                                close: "glyphicon glyphicon-eye-close"
                                                            }
                                                        });
                                                        $('#datetimepicker7').datetimepicker({
                                                            useCurrent: false,
                                                            format: "DD/MM/YYYY - hh:mm A",
                                                            //  minDate: moment(),
                                                            //minDate: today,
                                                            showClose: true,
                                                            icons: {
                                                                close: "glyphicon glyphicon-eye-close"
                                                            }
                                                        });
                                                        $("#datetimepicker6").on("dp.change", function (e) {
                                                            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                                                            //$('#datetimepicker6').data("DateTimePicker").hide();
                                                        });
                                                        $("#datetimepicker7").on("dp.change", function (e) {
                                                            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
                                                            // $('#datetimepicker7').data("DateTimePicker").hide();
                                                        });

                                                        $("#datetimepicker7").on("dp.show", function (e) {
                                                            if (isEmpty($('#datetimepicker6').val())) {
                                                                alert("Please Select Start Date First");
                                                            }
                                                        });
                                                        $("#datetimepicker6").on("dp.hide", function (e) {
                                                            var dp6 = $('#datetimepicker6').val();
                                                            $('#datetimepicker7').val(dp6);

                                                        });


                                                        $('#datetimepicker6_search').datetimepicker({
                                                            format: "DD/MM/YYYY",
                                                            //minDate: today,
                                                            showClose: true,
                                                            icons: {
                                                                close: "glyphicon glyphicon-eye-close"
                                                            }
                                                        });
                                                        $('#datetimepicker7_search').datetimepicker({
                                                            useCurrent: false,
                                                            format: "DD/MM/YYYY",
                                                            //minDate: today,
                                                            showClose: true,
                                                            icons: {
                                                                close: "glyphicon glyphicon-eye-close"
                                                            }
                                                        });
                                                        $("#datetimepicker6_search").on("dp.change", function (e) {
                                                            $('#datetimepicker7_search').data("DateTimePicker").minDate(e.date);
                                                            //$('#datetimepicker6').data("DateTimePicker").hide();
                                                        });
                                                        $("#datetimepicker7_search").on("dp.change", function (e) {
                                                            $('#datetimepicker6_search').data("DateTimePicker").maxDate(e.date);
                                                            // $('#datetimepicker7').data("DateTimePicker").hide();
                                                        });
                                                        let reservationController = new ReservationController();
                                                        reservationController.initLoadData();


                                                    });
        </script>
        <script type="text/javascript">

            $('#datatable-responsive1').on('page.dt', function () {
                // if (checkUserSessionData() === false) {
                //       alert("Your Session is Already Expired")
                //     window.location.href = baseUrl + "home/doLogout";
                // }
            });
            $('#datatable-responsive1').on('length.dt', function () {
                //  if (checkUserSessionData() === false) {
                //      alert("Your Session is Already Expired")
                //      window.location.href = baseUrl + "home/doLogout";
                //  }
            });


            /////////// Search Reservation Function///////////////
            function searchReservationDone() {
                let status_search = $('#status_search').val();
                let datetfrom_search = $('#datetimepicker6_search').val();
                let dateto_search = $('#datetimepicker7_search').val();
                let vchroomno_search = $('#vchroomno_search').val();
                let reservationController = new ReservationController();
                reservationController.searchReservationData(status_search, datetfrom_search, dateto_search, vchroomno_search)
            }
            /////////// Clear Search Form///////////////
            $('#clearReservationSearchForm').click(function () {
                $('#reservationSearchForm')[0].reset();
            });

            /////////// add Reservation Function///////////////
            function add_reservation() {
                var result = true;
                var dtfrom = $('#datetimepicker6').val();
                var dtto = $('#datetimepicker7').val();
                var introomid = $('#introomid').val();
                var vchremarks = $('#vchremarks').val();
                var vchpurpose = $('#vchpurpose').val();

                if (isEmpty(dtfrom)) {
                    result = false;
                    $('#dtFromError').text("This Field is Required");
                }
                if (isEmpty(dtto)) {
                    result = false;
                    $('#dtToError').text("This Field is Required");
                }
                if (isEmpty(introomid)) {
                    result = false;
                    $('#roomError').text("This Field is Required");
                }


                if (result === true) {
                    $.ajax({
                        url: '<?php echo base_url() ?>/reserve/addNewResearvation',
                        type: 'POST',
                        data: {'dtfrom': dtfrom, "dtto": dtto, "introomid": introomid, "vchremarks": vchremarks, "vchpurpose": vchpurpose},
                        beforeSend: function () {
                            $(".loading").removeClass('hidden');
                            $(".loading").addClass('show');
                        },
                        success: function (data) {
                            data = $.parseJSON(data);
                            if (data['errorCode'] === "0000") {
                                addReservationModalClose();
                                toastr.options.progressBar = true;
                                toastr.options.closeButton = true;
                                toastr.options.positionClass = "toast-top-right";
                                toastr.success("Reservation Added Successfuly")
                                let reservationController = new ReservationController();
                                reservationController.initLoadData();
                            }
                            if (data['errorCode'] === "0002") {
                                var str = "";
                                $.each(data['errorRooms'], function (i, item) {
                                    str += "Room No. " + item['vchroomno'] + " is already reserved from " + item['dtfrom'] + " to " + item['dtto'] + "<br>";
                                });
                                toastr.options.timeOut = 0;
                                toastr.options.extendedTimeOut = 0;
                                toastr.options.positionClass = "toast-top-full-width";
                                toastr.options.progressBar = true;
                                toastr.options.closeButton = true;
                                toastr.error(str)

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
            }

            function addReservationModalClose() {
                $('#formadd')[0].reset();
                $('.text-danger').text("");
                $('.selectpicker').selectpicker('deselectAll');
                $('#datetimepicker6').data("DateTimePicker").clear();
                $('#datetimepicker7').data("DateTimePicker").clear();
                $("#addReservationModal").modal("hide");
            }


            $('#addReservationOpener').click(function () {
                $('#addReservationModal').modal('show');
            });
            $('#addReservationOpener1').click(function () {
                $('#addReservationModal').modal('show');
            });
            $('#approveReservation').click(function () {
                var arr = [];
                $('input[name^="reservationList"]').each(function () {
                    if ($(this).is(':checked')) {
                        // if (jQuery.inArray($(this).val(), arr) === -1) {
                        arr.push($(this).val());
                        // }
                    }
                });
                if (arr.length === 0) {
                    alert("Nothing Selected")
                    return;
                } else {
                    // alert(arr);
                }
                $.ajax({
                    url: '<?php echo base_url() ?>/reserve/approveResearvation',
                    type: 'POST',
                    data: {'reservationList': arr},
                    beforeSend: function () {
                        $(".loading").removeClass('hidden');
                        $(".loading").addClass('show');
                    },
                    success: function (data) {
                        data = $.parseJSON(data);
                        if (data['errorCode'] === "0000") {
                            toastr.options.progressBar = true;
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = "toast-top-right";
                            toastr.success("Data Updated Successfuly");
                            let reservationController = new ReservationController();
                            reservationController.initLoadData();
                        }
                        if (data['errorCode'] === "0001") {
                            toastr.options.timeOut = 0;
                            toastr.options.extendedTimeOut = 0;
                            // toastr.options.positionClass = "toast-top-full-width";
                            toastr.options.progressBar = true;
                            toastr.options.closeButton = true;
                            toastr.error(data['errorDesc'])

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
            });
            $('#rejectReservation').click(function () {
                var arr = [];
                $('input[name^="reservationList"]').each(function () {
                    if ($(this).is(':checked')) {
                        // if (jQuery.inArray($(this).val(), arr) === -1) {
                        arr.push($(this).val());
                        // }
                    }
                });
                if (arr.length === 0) {
                    alert("Nothing Selected")
                    return;
                } else {
                    // alert(arr);
                }
                $.ajax({
                    url: '<?php echo base_url() ?>/reserve/rejectResearvation',
                    type: 'POST',
                    data: {'reservationList': arr},
                    beforeSend: function () {
                        $(".loading").removeClass('hidden');
                        $(".loading").addClass('show');
                    },
                    success: function (data) {
                        data = $.parseJSON(data);
                        if (data['errorCode'] === "0000") {
                            toastr.options.progressBar = true;
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = "toast-top-right";
                            toastr.success("Data Updated Successfuly");
                            let reservationController = new ReservationController();
                            reservationController.initLoadData();
                        }
                        if (data['errorCode'] === "0001") {
                            toastr.options.timeOut = 0;
                            toastr.options.extendedTimeOut = 0;
                            // toastr.options.positionClass = "toast-top-full-width";
                            toastr.options.progressBar = true;
                            toastr.options.closeButton = true;
                            toastr.error(data['errorDesc'])

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
            });

            $('#datetimepicker6').on('click', function (e) {
                $('#dtFromError').text("");
            });
            $('#datetimepicker7').on('click', function (e) {
                $('#dtToError').text("");
            });
            $('#introomid').change(function () {
               $('#roomError').text("");
            });
        </script>
    </body>
</html>
