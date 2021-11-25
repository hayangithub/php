class UserController {

    setIntuserid(intuserid) {
        this._intuserid = intuserid;
    }
    getIntuserid() {
        return  this._intuserid;
    }
    setVchfirstname(value) {
        this._vchfirstname = value;
    }
    getVchfirstname() {
        return this._vchfirstname;
    }
    setVchlastname(value) {
        this._vchlastname = value;
    }
    getvchlastname() {
        return this._vchlastname;
    }
    setVchemail(value) {
        this._vchemail = value;
    }
    getVchemail() {
        return this._vchemail;
    }
    setChstatus(value) {
        this._chstatus = value;
    }
    getChstatus() {
        return this._chstatus;
    }
    setChdepartment(value) {
        this._chdepartment = value;
    }
    getChdepartment() {
        return this._chdepartment;
    }
    setVchphoneno(value) {
        this._vchphoneno = value;
    }
    getVchphoneno() {
        return this._vchphoneno;
    }
    setVchext(value) {
        this._vchext = value;
    }
    getVchext() {
        return this._vchext;
    }
    setPrivilageCode(value) {
        this._privilageCode = value;
    }
    getPrivilageCode() {
        return this._privilageCode;
    }
    setPrivilageDesc(value) {
        this._privilageDesc = value;
    }
    getPrivilageDesc() {
        return this._privilageDesc;
    }

    setVchEmployeeNo(value) {
        this._vchemployeeno = value;
    }
    getVchEmployeeNo() {
        return this._vchemployeeno;
    }

    initLoadData() {
        if ($.fn.DataTable.isDataTable('#datatable-responsive1')) {
            $('#datatable-responsive1').DataTable().destroy();
        }

        var dataTable = $('#datatable-responsive1').DataTable({
            order: [],
            columnDefs: [{orderable: false, targets: [6, 8]}],
            // "processing": true,
            "serverSide": true,
            "paging": true,
            "searching": false,
            "language":
                    {
                        "processing": "<img style='width:50px; height:50px;' src=" + baseUrl + "'build/images/lg.double-ring-spinner.gif' />",
                    },
            "ajax": {
                url: baseUrl + "users/showUsersDone",
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
                        return  data['vchfirstname'] + "  " + data['vchlastname'];
                    }
                },
                {"data": "chdepartment"},
                {"data": "vchemail"},
                {"data": "vchemployeeno"},
                {"data": "vchphoneno"},
                {"data": "vchext"},
                {
                    data: null, render: function (data, type, row)
                    {
                        var str = data['privilage_desc'];
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
                        if (data['status'] == "A") {
                            return "<span class='label label-with-highlight label-with-highlight-success'> " + data['chstatus'] + " </span>";
                        }
                        if (data['status'] == "I") {
                            return "<span class='label label-with-highlight label-danger'> " + data['chstatus'] + " </span>";
                        }
                    }
                },
                {
                    data: null, render: function (data, type, row)
                    {
                        return "<a href='#' onClick=editUser('" + data['intuserid'] + "') class='btn-edit-in-table'> <i class='glyphicon glyphicon-pencil'></i> Edit</a>";
                    }
                }
            ]

        });
    }
    searchUserData(employeeno_search, department_search, email_search, status_search) {
        this.setVchemail(email_search);
        this.setChdepartment(department_search);
        this.setChstatus(status_search);
        this.setVchEmployeeNo(employeeno_search);
        if ($.fn.DataTable.isDataTable('#datatable-responsive1')) {
            $('#datatable-responsive1').DataTable().destroy();
        }
        var dataTable = $('#datatable-responsive1').DataTable({
            // "processing": true,
            "serverSide": true,
            "paging": true,
            "searching": false,
            "language":
                    {
                        "processing": "<img style='width:50px; height:50px;' src=" + baseUrl + "'build/images/lg.double-ring-spinner.gif' />",
                    },
            "ajax": {
                url: baseUrl + "users/searchUsers",
                type: "post",
                data: {'employeeno_search': this.getVchEmployeeNo(),
                    'department_search': this.getChdepartment(),
                    'status_search': this.getChstatus(),
                    'email_search': this.getVchemail()},
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
                        return  data['vchfirstname'] + "  " + data['vchlastname'];
                    }
                },
                {"data": "chdepartment"},
                {"data": "vchemail"},
                {"data": "vchemployeeno"},
                {"data": "vchphoneno"},
                {"data": "vchext"},
                {
                    data: null, render: function (data, type, row)
                    {
                        var str = data['privilage_desc'];
                        if (!isEmpty(str)) {
                            str = str.replace(/,/g, '<br>');
                            // str=str.replace(",", "<br>");
                            return str;
                        } else {
                            return  "-";
                        }
                    }
                },
                {
                    data: null, render: function (data, type, row) {
                        if (data['status'] == "A") {
                            return "<span class='label label-with-highlight label-with-highlight-success'> " + data['chstatus'] + " </span>";
                        }
                        if (data['status'] == "I") {
                            return "<span class='label label-with-highlight label-danger'> " + data['chstatus'] + " </span>";
                        }
                    }
                },
                {
                    data: null, render: function (data, type, row)
                    {
                        return "<a href='#' onClick=editUser('" + data['intuserid'] + "') class='btn-edit-in-table'> <i class='glyphicon glyphicon-pencil'></i> Edit</a>";
                    }
                }
            ]
        });
    }

}