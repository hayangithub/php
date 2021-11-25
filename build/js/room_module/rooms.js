class RoomDataTable {
    setVchroomno(vchroomno) {
        this._vchroomno = vchroomno;
    }
    getVchroomno() {
        return this._vchroomno;
    }
    setVchroomtype(vchroomtype) {
        this._vchroomtype = vchroomtype;
    }
    getVchroomtype() {
        return this._vchroomtype;
    }
    setChblock(chblock) {
        this._chblock = chblock;
    }
    getChblock() {
        return this._chblock;
    }
    initLoadData() {
        if ($.fn.DataTable.isDataTable('#datatable-responsive1')) {
            $('#datatable-responsive1').DataTable().destroy();
        }

        var dataTable = $('#datatable-responsive1').DataTable({
            order: [],
            columnDefs: [{orderable: false, targets: [0, 1, 2, 3, 4, 5, 6]}],
            // "processing": true,
            "serverSide": true,
            "paging": true,
            "searching": false,
            //"language":
            //   {
            //      "processing": "<img style='width:100px; height:100px;' src=' " + baseUrl + "build/images/lg.double-ring-spinner.gif' />",
            //  },

            "ajax": {
                url: baseUrl + "rooms/showRoomsDone",
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
                {"data": "vchroomno"},
                {"data": "vchroomtype"},
                {"data": "chblock"},
                {"data": "intcapacity"},
                {
                    data: null, render: function (data, type, row)
                    {
                       // if (!isEmpty(data['vchfirstname']) && !isEmpty(data['vchlastname'])) {
                        //    return data['vchfirstname'] + " " + data['vchlastname']
                       // } else {
                       //     return  "-";
                       // }
                        var str = "-"
                        if (!isEmpty(data['manager1'])) {
                            str = data['manager1'];
                        }
                        if (!isEmpty(data['manager2'])) {
                            str += "<br>" + data['manager2'];
                        }
                        return str;
                    }
                },
                {
                    data: null, render: function (data, type, row) {
                        if (data['chstatus'] == "Active") {
                            return "<span class='label label-with-highlight label-with-highlight-success'> " + data['chstatus'] + " </span>";
                        }
                        if (data['chstatus'] == "Inactive") {
                            return "<span class='label label-with-highlight label-danger'> " + data['chstatus'] + " </span>";
                        }
                    }
                },
                {
                    data: null, render: function (data, type, row)
                    {
                        return "<a href='#' onClick=edit_room('" + data['introomid'] + "') class='btn-edit-in-table'> <i class='glyphicon glyphicon-pencil'></i> Edit</a>";
                    }
                },
            ]
        });
    }
    searchRoomData(vchroomno, vchroomtype, chblock) {
        this.setVchroomno(vchroomno);
        this.setVchroomtype(vchroomtype);
        this.setChblock(chblock);
        if ($.fn.DataTable.isDataTable('#datatable-responsive1')) {
            $('#datatable-responsive1').DataTable().destroy();
        }
        var dataTable = $('#datatable-responsive1').DataTable({
            order: [],
            columnDefs: [{orderable: false, targets: [0, 1, 2, 3, 4, 5, 6]}],
            //"processing": true,
            "serverSide": true,
            "paging": true,
            "searching": false,
            //"language":
            //  {
            //     "processing": "<img style='width:100px; height:100px;' src=' " + baseUrl + "build/images/lg.double-ring-spinner.gif' />",
            //  },


            //initComplete: function () {
            //$(".loading").removeClass('show');
            // $(".loading").addClass('hidden');
            // },
            "ajax": {
                url: baseUrl + "rooms/showRoomsDone",
                type: "post",
                data: {'vchroomno_search': this.getVchroomno(), 'chblock_search': this.getChblock(), 'vchroomtype_search': this.getVchroomtype()},
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

                // beforeSend: function () {
                // $(".loading").removeClass('hidden');
                //$(".loading").addClass('show');
                //},
            },
            "columns": [
                {"data": "vchroomno"},
                {"data": "vchroomtype"},
                {"data": "chblock"},
                {"data": "intcapacity"},
                {
                    data: null, render: function (data, type, row)
                    {
                        //if (!isEmpty(data['vchfirstname']) && !isEmpty(data['vchlastname'])) {
                        //     return data['vchfirstname']+ " " +data['vchlastname'] 
                        // } else {
                        //     return  "-";
                        // }
                        var str = "-"
                        if (!isEmpty(data['manager1'])) {
                            str = data['manager1'];
                        }
                        if (!isEmpty(data['manager2'])) {
                            str += "<br>" + data['manager2'];
                        }
                         return str;
                    }
                },
                {
                    data: null, render: function (data, type, row) {
                        if (data['chstatus'] == "Active") {
                            return "<span class='label label-with-highlight label-with-highlight-success'> " + data['chstatus'] + " </span>";
                        }
                        if (data['chstatus'] == "Inactive") {
                            return "<span class='label label-with-highlight label-danger'> " + data['chstatus'] + " </span>";
                        }
                    }
                },
                {
                    data: null, render: function (data, type, row)
                    {
                        return "<a href='#' onClick=edit_room('" + data['introomid'] + "') class='btn-edit-in-table'> <i class='glyphicon glyphicon-pencil'></i> Edit</a>";
                    }
                },
            ]
        });
    }

}