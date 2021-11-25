class ReservationController {

    initLoadData() {
        
        if ($.fn.DataTable.isDataTable('#datatable-responsive1')) {
            $('#datatable-responsive1').DataTable().destroy();
        }
        var dataTable = $('#datatable-responsive1').DataTable({
            order: [],
            columnDefs: [{orderable: false, targets: [0, 1, 2, 3, 4, 5]}],
            // "processing": true,
            "serverSide": true,
            "paging": true,
            "searching": false,
            // "language":
            //      {
            //          "processing": "<img style='width:50px; height:50px;' src=" + baseUrl + "'build/images/lg.double-ring-spinner.gif' />",
            //      },
            "ajax": {
                url: baseUrl + "reserve/showReservationDone",
                type: "post",
                beforeSend: function () {
                    $(".loading").removeClass('hidden');
                    $(".loading").addClass('show');
                    var status = checkUserSessionData();
                    if (status === "0004") {
                    alert("Your session has expired. Please sign in again");
                    window.location.href = baseUrl + "home/doLogout";
                    return false;
                }
                },
                error: function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    alert("Error occured.please try again");
                },

                complete: function () {
                    $(".loading").removeClass('show');
                    $(".loading").addClass('hidden');
                }
            },
            "columns": [
                {
                    data: null, render: function (data, type, row) {
                        return data['intreserveid'] + "  <input type='checkbox' class='reservationList' name='reservationList[]' value=" + data['intreserveid'] + ":" + data['introomid'] + ">";
                    }
                },
                // {"data": "intreserveid"},
                {"data": "vchroomno"},
                /*{
                 data: null, render: function (data, type, row)
                 {
                 var str = data['rooms'];
                 if (!isEmpty(str)) {
                 str = str.replace(/,/g, '<br>');
                 return str;
                 } else {
                 return  "-";
                 }
                 }
                 },*/
                {
                    data: null, render: function (data, type, row) {
                        return  data['vchfirstname'] + "  " + data['vchlastname'];
                    }
                },
                {"data": "dtfrom"},
                {"data": "dtto"},
                {
                    data: null, render: function (data, type, row) {
                        if (!isEmpty(data['vchstatus'])) {
                            if (data['vchstatus'] === "P") {
                                return " <span class='label label-with-highlight label-warning'> " + data['vchStatusDesc'] + " </span>";
                            } else if (data['vchstatus'] === "A") {
                                return " <span class='label label-with-highlight label-success'> " + data['vchStatusDesc'] + " </span>";
                            } else if (data['vchstatus'] === "R") {
                                return " <span class='label label-with-highlight label-danger'> " + data['vchStatusDesc'] + " </span>";
                            }
                        } else {
                            return  "-";
                        }
                    }
                },
                        //{
                        //   data: null, render: function (data, type, row)
                        //  {
                        //       return "<a href='#' onClick=editUser('" + data['intreserveid'] + "') class='btn-success-in-table'> <i class='glyphicon glyphicon-ok'></i> Approve</a> \n\
                        //             <a href='#' onClick=editUser('" + data['intreserveid'] + "') class='btn-danger-in-table'> <i class='glyphicon glyphicon-remove'></i> Reject</a>";
                        //  }
                        // }
            ]

        });
    }

    // Search Reservation Data
    searchReservationData(status_search, datetfrom_search, dateto_search, vchroomno_search) {
        if ($.fn.DataTable.isDataTable('#datatable-responsive1')) {
            $('#datatable-responsive1').DataTable().destroy();
        }

        var dataTable = $('#datatable-responsive1').DataTable({
            order: [],
            columnDefs: [{orderable: false, targets: [0, 1, 2, 3, 4, 5]}],
            // "processing": true,
            "serverSide": true,
            "paging": true,
            "searching": false,
            // "language":
            //      {
            //          "processing": "<img style='width:50px; height:50px;' src=" + baseUrl + "'build/images/lg.double-ring-spinner.gif' />",
            //      },
            "ajax": {
                url: baseUrl + "reserve/showReservationDone",
                type: "post",
                data: {'status_search': status_search, 'datetfrom_search': datetfrom_search, 'dateto_search': dateto_search, 'vchroomno_search': vchroomno_search},
                beforeSend: function () {
                    $(".loading").removeClass('hidden');
                    $(".loading").addClass('show');
                    var status = checkUserSessionData();
                    if (status === "0004") {
                    alert("Your session has expired. Please sign in again");
                    window.location.href = baseUrl + "home/doLogout";
                    return false;
                }
                },
                error: function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    alert("Error occured.please try again");
                },
                complete: function () {
                    $(".loading").removeClass('show');
                    $(".loading").addClass('hidden');
                }
            },
            "columns": [
                {
                    data: null, render: function (data, type, row) {
                        return data['intreserveid'] + "  <input type='checkbox' class='reservationList' name='reservationList[]' value=" + data['intreserveid'] + ":" + data['introomid'] + ">";
                    }
                },
                // {"data": "intreserveid"},
                {"data": "vchroomno"},
                /*{
                 data: null, render: function (data, type, row)
                 {
                 var str = data['rooms'];
                 if (!isEmpty(str)) {
                 str = str.replace(/,/g, '<br>');
                 return str;
                 } else {
                 return  "-";
                 }
                 }
                 },*/
                {
                    data: null, render: function (data, type, row) {
                        return  data['vchfirstname'] + "  " + data['vchlastname'];
                    }
                },
                {"data": "dtfrom"},
                {"data": "dtto"},
                {
                    data: null, render: function (data, type, row) {
                        if (!isEmpty(data['vchstatus'])) {
                            if (data['vchstatus'] === "P") {
                                return " <span class='label label-with-highlight label-warning'> " + data['vchStatusDesc'] + " </span>";
                            } else if (data['vchstatus'] === "A") {
                                return " <span class='label label-with-highlight label-success'> " + data['vchStatusDesc'] + " </span>";
                            } else if (data['vchstatus'] === "R") {
                                return " <span class='label label-with-highlight label-danger'> " + data['vchStatusDesc'] + " </span>";
                            }
                        } else {
                            return  "-";
                        }
                    }
                },
                        //{
                        //   data: null, render: function (data, type, row)
                        //  {
                        //       return "<a href='#' onClick=editUser('" + data['intreserveid'] + "') class='btn-success-in-table'> <i class='glyphicon glyphicon-ok'></i> Approve</a> \n\
                        //             <a href='#' onClick=editUser('" + data['intreserveid'] + "') class='btn-danger-in-table'> <i class='glyphicon glyphicon-remove'></i> Reject</a>";
                        //  }
                        // }
            ]

        });
    }

    initLoadDataForFacultyMember() {
        if ($.fn.DataTable.isDataTable('#datatable-responsive1')) {
            $('#datatable-responsive1').DataTable().destroy();
        }

        var dataTable = $('#datatable-responsive1').DataTable({
            order: [],
            //columnDefs: [{orderable: false, targets: [6,8]}],
            // "processing": true,
            "serverSide": true,
            "paging": true,
            "searching": false,
            "language":
                    {
                        "processing": "<img style='width:50px; height:50px;' src=" + baseUrl + "'build/images/lg.double-ring-spinner.gif' />",
                    },
            "ajax": {
                url: baseUrl + "reserve/showReservationDone",
                type: "post",
                error: function (xhr, error, thrown) {
                    console.log(xhr);
                    console.log(error);
                    alert("Error occured.please try again");
                }
            },
            "columns": [

                {"data": "intreserveid"},
                {
                    data: null, render: function (data, type, row)
                    {
                        var str = data['rooms'];
                        if (!isEmpty(str)) {
                            str = str.replace(/,/g, '<br>');
                            return str;
                        } else {
                            return  "-";
                        }
                    }
                },
                {
                    data: null, render: function (data, type, row) {
                        return  data['vchfirstname'] + "  " + data['vchlastname'];
                    }
                },
                {"data": "dtfrom"},
                {"data": "dtto"},
                {
                    data: null, render: function (data, type, row) {
                        if (data['vchstatus'] === "Pending") {
                            return " <span class='label label-with-highlight label-warning'> " + data['vchstatus'] + " </span>";
                        }
                    }
                },
            ]

        });
    }

}


