<?php
$this->load->view('room_pages/head_section.php');
$userData = getUserSessionData();
?>
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
                        <form id="roomSearchForm">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <i class="glyphicon glyphicon-search"></i>
                                    Search Classes / Labs / Halls   
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
                                            <label>Block</label>
                                            <select class="form-control" name="chblock_search" id="chblock_search">
                                                <option value="all">All Blocks</option>
                                                <?php foreach ($blocks as $row) { ?>
                                                    <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="vchroomtype_search" id="vchroomtype_search">
                                                <option value="all">All Types</option>
                                                <?php foreach ($roomtypes as $row) { ?>
                                                    <option value="<?php echo $row['vchparamcode']; ?>"><?php echo $row['vchparamdesc']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Class / Lab / Hall No.</label>
                                            <input type="text" class="form-control" id="vchroomno_search" name="vchroomno_search" autocomplete="off">
                                        </div>
                                    </div>
                                </div>  

                                <hr>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <button type="button" onclick="searchRoomDone();" class="btn btn-sm btn-round btn-grey"> <i class="glyphicon glyphicon-search"></i> Search</button>
                                        <button type="button" id="clearRoomSearchForm" class="btn btn-sm btn-round btn-danger"> <i class="glyphicon glyphicon-ban-circle"></i> Clear</button>
                                        <?php if (in_array("AD", $userData['roles'])) { ?>
                                            <button type="button" class="btn btn-sm btn-round btn-success" data-toggle="modal" data-target=".addmodal"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                    <div class="row">                                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Classes / Labs / Halls List</h2>
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
                                                <th>Class / Lab / Hall No.</th>
                                                <th>Type</th>
                                                <th>Block</th>
                                                <th>Capacity</th>
                                                <th>Person In Charge</th>
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
    <?php $this->load->view('room_pages/add_modal.php'); ?>
    <!-- Edit Modal-->
    <?php $this->load->view('room_pages/edit_modal.php'); ?>

    <!--Auto Logout Modal -->
    <?php $this->load->view('auto_logout_modal.php'); ?>

    <div class="loading hidden">Loading&#8230;</div>

    <?php $this->load->view('room_pages/js_lib_section.php'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            let roomDataTable = new RoomDataTable();
            roomDataTable.initLoadData();
            startAutoLogoutTimer();
        });

        //////Search Room Function//////    
        function searchRoomDone() {
            let chblock_search = $('#chblock_search').val();
            let vchroomtype_search = $('#vchroomtype_search').val();
            let vchroomno_search = $('#vchroomno_search').val();
            let roomDataTable = new RoomDataTable();
            roomDataTable.searchRoomData(vchroomno_search, vchroomtype_search, chblock_search);

        }

        //////Clear Room Search Form//////                          
        $('#clearRoomSearchForm').click(function () {
            $('#roomSearchForm')[0].reset();
        });

        $('#intuseridAdd, #intuseridEdit').change(function () {
            $('.intuseridAddError').text("");
            $('.intuseridEditError').text("");
        });
        //////Add New Room ////// 
        function add_room() {
            var result = true;
            var chblock = $('#chblock').val();
            var vchroomtype = $('#vchroomtype').val();
            var vchroomno = $('#vchroomno').val();
            var capacity = $('#capacity').val();
            var status = $('#status').val();
            var intuserid = $('#intuseridAdd').val();
            var intuserid2 = $('#intuseridAdd2').val();

            if (isEmpty(vchroomno)) {
                var v = $('#vchroomno').parent().find("span");
                v.text("This Field is Required");
                v.removeClass("hidden");
                v.addClass("show");
                result = false;
            }
            if (isEmpty(capacity)) {
                var v = $('#capacity').parent().find("span");
                v.text("This Field is Required");
                v.removeClass("hidden");
                v.addClass("show");
                result = false;
            }
            if (isEmpty(intuserid)) {
                validationResult = false;
                $('.intuseridAddError').text("This Field is Required");
            }

            if (result === true) {
                if (Array.isArray(intuserid)) {
                    intuserid = intuserid[0];
                }
                if (Array.isArray(intuserid2)) {
                    intuserid2 = intuserid2[0];
                }
                $.ajax({
                    url: '<?php echo base_url() ?>rooms/addnewroom',
                    type: 'POST',
                    data: {'chblock': chblock, 'vchroomtype': vchroomtype, "vchroomno": vchroomno, "capacity": capacity, "status": status, "intuserid": intuserid, "intuserid2": intuserid2},
                    beforeSend: function () {
                        $(".loading").removeClass('hidden');
                        $(".loading").addClass('show');
                    },
                    success: function (data) {
                        data = $.parseJSON(data);
                        if (data['errorCode'] === "0000") {
                            var roomDataTable = new RoomDataTable();
                            var chblock_search = $('#chblock_search').val();
                            var vchroomtype_search = $('#vchroomtype_search').val();
                            var vchroomno_search = $('#vchroomno_search').val();
                            toastr.options.progressBar = true;
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = "toast-top-right";
                            toastr.success("Data Added Successfuly")
                            roomDataTable.searchRoomData(vchroomno_search, vchroomtype_search, chblock_search);
                            addRoomModalClose();
                        }
                        if (data['errorCode'] !== "0000") {
                            alert(data['errorDesc']);
                        }
                    },
                    error: function (xhr, error, thrown) { // if error occured
                        console.log(xhr);
                        console.log(error);
                        alert("Error occured.please try again");
                    },
                    complete: function () {
                        $(".loading").removeClass('show');
                        $(".loading").addClass('hidden');
                    }
                });
            }
        }
        //////Get Room Info for Edit ////// 
        function edit_room(introomid) {
            $.ajax({
                url: '<?php echo base_url() ?>rooms/edit_room',
                type: 'POST',
                data: {'introomid': introomid},
                beforeSend: function () {
                    $(".loading").removeClass('hidden');
                    $(".loading").addClass('show');
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    if (data['errorCode'] == "0000") {
                        var optionBlockHTML = "";
                        $('#chblock_edit').empty();
                        $.each(data['blocks'], function (i, item) {
                            var selected = "";
                            if (data['specific_room']['chblock'] == item['vchparamcode']) {
                                selected = "selected"
                            }
                            optionBlockHTML += '<option value=' + item['vchparamcode'] + ' ' + selected + '>' + item['vchparamdesc'] + '</option>';
                        });
                        $('#chblock_edit').append(optionBlockHTML);
                        var optionRoomTypeHTML = "";
                        $.each(data['roomtypes'], function (i, item) {
                            var selected = "";
                            if (data['specific_room']['vchroomtype'] == item['vchparamcode']) {
                                selected = "selected"
                            }
                            optionRoomTypeHTML += '<option value=' + item['vchparamcode'] + ' ' + selected + '>' + item['vchparamdesc'] + '</option>';
                        });
                        $('#vchroomtype_edit').empty();
                        $('#vchroomtype_edit').append(optionRoomTypeHTML);
                        var optionEnableFlagHTML = "";
                        $.each(data['enable_flag'], function (i, item) {
                            var selected = "";
                            if (data['specific_room']['chstatus'] == item['vchparamcode']) {
                                selected = "selected"
                            }
                            optionEnableFlagHTML += '<option value=' + item['vchparamcode'] + ' ' + selected + '>' + item['vchparamdesc'] + '</option>';
                        });
                        $('#status_edit').empty();
                        $('#status_edit').append(optionEnableFlagHTML);
                        $('#vchroomno_edit').val(data['specific_room']['vchroomno']);
                        $('#capacity_edit').val(data['specific_room']['intcapacity']);
                        $('#introomidEdit').val(data['specific_room']['introomid']);
                        $('#intuseridEdit').selectpicker('val', data['pic']['intmanager1']);
                        $('#intuseridEdit2').selectpicker('val', data['pic']['intmanager2']);
                        $("#editRoomModal").modal("show");
                    }
                },
                error: function (xhr, error, thrown) { // if error occured
                    console.log(xhr);
                    console.log(error);
                    alert("Error occured.please try again");
                },
                complete: function () {
                    $(".loading").removeClass('show');
                    $(".loading").addClass('hidden');
                }
            });
        }
        //////Save Room Info after Edit ////// 
        function editRoomDone() {
            var result = true;
            var chblock = $('#chblock_edit').val();
            var vchroomtype = $('#vchroomtype_edit').val();
            var vchroomno = $('#vchroomno_edit').val();
            var capacity = $('#capacity_edit').val();
            var status = $('#status_edit').val();
            var intuserid = $('#intuseridEdit').val();
            var intuserid2 = $('#intuseridEdit2').val();
            var introomid = $('#introomidEdit').val();
            if (isEmpty(vchroomno)) {
                var v = $('#vchroomno_edit').parent().find("span");
                v.text("This Field is Required");
                v.removeClass("hidden");
                v.addClass("show");
                result = false;
            }
            if (isEmpty(capacity)) {
                var v = $('#capacity_edit').parent().find("span");
                v.text("This Field is Required");
                v.removeClass("hidden");
                v.addClass("show");
                result = false;
            }
            if (isEmpty(intuserid)) {
                result = false;
                $('.intuseridEditError').text("This Field is Required");
            }
            if (result === true) {
                if (Array.isArray(intuserid)) {
                    intuserid = intuserid[0];
                }
                if (Array.isArray(intuserid2)) {
                    intuserid2 = intuserid2[0];
                }
                $.ajax({
                    url: '<?php echo base_url() ?>rooms/editRoomDone',
                    type: 'POST',
                    data: {'vchroomno': vchroomno,
                        'chblock': chblock,
                        'vchroomtype': vchroomtype,
                        'capacity': capacity,
                        'status': status,
                        'intuserid': intuserid,
                        'intuserid2': intuserid2,
                        'introomid': introomid},
                    beforeSend: function () {
                        $(".loading").removeClass('hidden');
                        $(".loading").addClass('show');
                    },
                    success: function (data) {
                        data = $.parseJSON(data);
                        if (data['errorCode'] === "0000") {
                            var roomDataTable = new RoomDataTable();
                            var chblock_search = $('#chblock_search').val();
                            var vchroomtype_search = $('#vchroomtype_search').val();
                            var vchroomno_search = $('#vchroomno_search').val();
                            toastr.options.progressBar = true;
                            toastr.options.closeButton = true;
                            toastr.options.positionClass = "toast-top-right";
                            toastr.success("Data Updated Successfuly");
                            roomDataTable.searchRoomData(vchroomno_search, vchroomtype_search, chblock_search);
                            editRoomModalClose();
                        }
                        if (data['errorCode'] !== "0000") {
                            alert(data['errorDesc']);
                        }
                    },
                    error: function (xhr, error, thrown) { // if error occured
                        console.log(xhr);
                        console.log(error);
                        alert("Error occured.please try again");
                    },
                    complete: function () {
                        $(".loading").removeClass('show');
                        $(".loading").addClass('hidden');
                    }
                });
            }
        }
        function arrangeDataTable(dataList) {
            var trHTML = "";
            $.each(dataList, function (i, item) {
                trHTML += '<tr><td>' + item['vchroomno'] + '</td>';
                trHTML += '<td>' + item['vchroomtype'] + '</td>';
                trHTML += '<td>' + item['chblock'] + '</td>';
                trHTML += '<td>' + item['intcapacity'] + '</td>';
                trHTML += '<td><span class="label label-with-highlight' + ' ';
                if (item['chstatus'] == "Active") {
                    trHTML += 'label-with-highlight-success">' + item['chstatus'] + ' </span></td>';
                }
                if (item['chstatus'] == "Inactive") {
                    trHTML += 'label-danger">' + item['chstatus'] + ' </span></td>';
                }
                trHTML += '<td style="text-align:center;">';
                trHTML += '<a href="#" onClick="edit_room(\'' + item['vchroomno'] + '\')" class="btn-edit-in-table"> <i class="glyphicon glyphicon-pencil"></i> Edit</a>';
                trHTML += '</td></tr>';
            });
            var table = $('#datatable-responsive').DataTable();
            table.destroy();
            $("#datatable-responsive tbody").empty().promise().done(function () {
                $("#datatable-responsive tbody").html(trHTML);
                table.fnLengthChange(50);
                $("#datatable-responsive").DataTable().draw();
            });
        }
        function arrangeData() {

            var dataTable = $('#datatable-responsive1').DataTable({
                //"processing": true,
                "serverSide": true,
                "ajax": {
                    url: "<?php echo base_url() ?>rooms/showrooms2",
                    type: "post"
                },
                "columns": [
                    {"data": "vchroomno"},
                    {"data": "vchroomtype"},
                    {"data": "chblock"},
                    {"data": "intcapacity"},
                    {"data": "chstatus"},
                    {
                        data: null, render: function (data, type, row)
                        {
                            return "<a href='#' class='btn btn-danger' onclick=DeleteData('" + '' + "'); >Delete</a>";
                        }
                    },
                ]
            });
        }


        $('.closeEdit,#cancelEdit').click(function () {
            editRoomModalClose();
        });


        $('.closeAdd,#cancelAdd').click(function () {
            addRoomModalClose();
        });

        function editRoomModalClose() {
            $('.text-danger').text("");
            $("#editRoomModal").modal("hide");
        }


        function addRoomModalClose() {
            $('#addRoomForm')[0].reset();
            $('.text-danger').text("");
            $('.selectpicker').selectpicker('deselectAll');
            $("#addNewRoomModal").modal("hide");
        }


        $('input[type=text]').on('input', function (e) {
            $(this).parent().find('span').text("");
        });




        var intuseridAdd1 = $('#intuseridAdd').selectpicker();
        intuseridAdd1.on('shown.bs.select', function (e) {
            $('#intuseridAdd2 option').prop('disabled', false);
            $('#intuseridAdd2').selectpicker('deselectAll');
            $('#intuseridAdd2').selectpicker('refresh')
        });



        var intuseridAdd2 = $('#intuseridAdd2').selectpicker();
        intuseridAdd2.on('shown.bs.select', function (e) {
            if (isEmpty($('#intuseridAdd').val())) {
                alert('Please Select Main Person in Charge');
                $('.bootstrap-select').removeClass('open');
                return false;
            }
            $('#intuseridAdd2 option').prop('disabled', false);
            $('#intuseridAdd2').selectpicker('deselectAll')
            $('#intuseridAdd2').selectpicker('refresh')
            $("#intuseridAdd2 option").each(function () {
                var $thisOption = $(this);
                if (jQuery.inArray($thisOption.val(), $('#intuseridAdd').val()) !== -1) {
                    $thisOption.attr("disabled", "disabled");
                }
            });
            $('#intuseridAdd2').selectpicker('refresh')


        });


        var intuseridEdit1 = $('#intuseridEdit').selectpicker();
        intuseridEdit1.on('shown.bs.select', function (e) {
            $('#intuseridEdit2 option').prop('disabled', false);
            $('#intuseridEdit2').selectpicker('deselectAll');
            $('#intuseridEdit2').selectpicker('refresh')
        });



        var intuseridEdit2 = $('#intuseridEdit2').selectpicker();
        intuseridEdit2.on('shown.bs.select', function (e) {
            if (isEmpty($('#intuseridEdit').val())) {
                alert('Please Select Main Person in Charge');
                $('.bootstrap-select').removeClass('open');
                return false;
            }
            $('#intuseridEdit2 option').prop('disabled', false);
            $('#intuseridEdit2').selectpicker('deselectAll')
            $('#intuseridEdit2').selectpicker('refresh')
            $("#intuseridEdit2 option").each(function () {
                var $thisOption = $(this);
                if (jQuery.inArray($thisOption.val(), $('#intuseridEdit').val()) !== -1) {
                    $thisOption.attr("disabled", "disabled");
                }
            });
            $('#intuseridEdit2').selectpicker('refresh')


        });




    </script>
</body>
</html>