<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/ico" />

        <title>Gentelella Alela! | </title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url(); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?php echo base_url(); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?php echo base_url(); ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="<?php echo base_url(); ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?php echo base_url(); ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="<?php echo base_url(); ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url(); ?>/build/css/custom.min.css" rel="stylesheet">
        <link href='https://fullcalendar.io/js/fullcalendar-3.6.2/fullcalendar.css' rel='stylesheet' />
        <style>
            #calendar {
                margin-left: auto;
                margin-right: auto;
                width:100%;
            }
        </style>
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
                   <div class="row">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x-content">
                                <div class="row">
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                            </div>
                                            <div class="count">179</div>

                                            <h4>Bookings Made Today</h4>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-comments-o"></i>
                                            </div>
                                            <div class="count">179</div>

                                            <h3>Bookings for Today</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                                            </div>
                                            <div class="count">179</div>

                                            <h4>Total Bookings This Month</h4>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-check-square-o"></i>
                                            </div>
                                            <div class="count">179</div>

                                            <h3>New Sign ups</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2><i class="fa fa-calendar"></i> Event Schedule</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li style="float:right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div id="calendar1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start to do list -->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>To Do List <small>Sample tasks</small></h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">Settings 1</a>
                                                        </li>
                                                        <li><a href="#">Settings 2</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                            <div class="">
                                                <ul class="to_do">
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Create email address for new intern</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Create email address for new intern</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End to do list -->

                                <!-- start of weather widget -->
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Daily active users <small>Sessions</small></h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">Settings 1</a>
                                                        </li>
                                                        <li><a href="#">Settings 2</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="temperature"><b>Monday</b>, 07:30 AM
                                                        <span>F</span>
                                                        <span><b>C</b></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="weather-icon">
                                                        <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="weather-text">
                                                        <h2>Texas <br><i>Partly Cloudy Day</i></h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="weather-text pull-right">
                                                    <h3 class="degrees">23</h3>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="row weather-days">
                                                <div class="col-sm-2">
                                                    <div class="daily-weather">
                                                        <h2 class="day">Mon</h2>
                                                        <h3 class="degrees">25</h3>
                                                        <canvas id="clear-day" width="32" height="32"></canvas>
                                                        <h5>15 <i>km/h</i></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="daily-weather">
                                                        <h2 class="day">Tue</h2>
                                                        <h3 class="degrees">25</h3>
                                                        <canvas height="32" width="32" id="rain"></canvas>
                                                        <h5>12 <i>km/h</i></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="daily-weather">
                                                        <h2 class="day">Wed</h2>
                                                        <h3 class="degrees">27</h3>
                                                        <canvas height="32" width="32" id="snow"></canvas>
                                                        <h5>14 <i>km/h</i></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="daily-weather">
                                                        <h2 class="day">Thu</h2>
                                                        <h3 class="degrees">28</h3>
                                                        <canvas height="32" width="32" id="sleet"></canvas>
                                                        <h5>15 <i>km/h</i></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="daily-weather">
                                                        <h2 class="day">Fri</h2>
                                                        <h3 class="degrees">28</h3>
                                                        <canvas height="32" width="32" id="wind"></canvas>
                                                        <h5>11 <i>km/h</i></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="daily-weather">
                                                        <h2 class="day">Sat</h2>
                                                        <h3 class="degrees">26</h3>
                                                        <canvas height="32" width="32" id="cloudy"></canvas>
                                                        <h5>10 <i>km/h</i></h5>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end of weather widget -->
                            </div>
                        </div>
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
        <script src="<?php echo base_url(); ?>/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url(); ?>/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?php echo base_url(); ?>/vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="<?php echo base_url(); ?>/vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="<?php echo base_url(); ?>/vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="<?php echo base_url(); ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>/vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="<?php echo base_url(); ?>/vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="<?php echo base_url(); ?>/vendors/Flot/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/Flot/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/Flot/jquery.flot.time.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/Flot/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="<?php echo base_url(); ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="<?php echo base_url(); ?>/vendors/DateJS/build/date.js"></script>
  

        <!-- bootstrap-daterangepicker -->
        <script src="<?php echo base_url(); ?>/vendors/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="<?php echo base_url(); ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?php echo base_url(); ?>/build/js/custom.min.js"></script>
        <script>
            $(function () { // document ready
                var calendar = $('#calendar1');
                calendar.fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,listWeek'
                                // right: 'month,agendaWeek,agendaDay,listWeek'
                    },

                    defaultDate: moment().format("YYYY-MM-DD"),
                    allDaySlot: false,
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    events: [

                        {
                            title: 'Long Event',
                            start: '2019-08-07',
                            end: '2019-08-10'
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: '2019-05-09T16:00:00'
                        },
                        {
                            id: 999,
                            title: 'Repeating Event rrrrr ttttttt yyyyyyyy',
                            start: '2019-08-16T16:00:00'
                        },
                        {
                            title: 'Conference',
                            start: '2019-08-05',
                            end: '2019-08-09'
                        },
                        {
                            title: 'Meeting',
                            start: '2019-08-06T10:30:00',
                            end: '2019-08-06T12:30:00'
                        },
                        {
                            title: 'Lunch',
                            start: '2019-05-06T12:00:00'
                        },
                        {
                            title: 'Meeting',
                            start: '2019-08-06T14:30:00'
                        },
                        {
                            title: 'Happy Hour',
                            start: '2019-08-06T17:30:00'
                        },
                        {
                            title: 'Dinner',
                            start: '2019-08-06T20:00:00'
                        },
                        {
                            title: 'Movie',
                            start: '2019-08-07T07:00:00'
                        },
                        {
                            title: 'Click for Google',
                            url: 'http://google.com/',
                            start: '2019-08-28'
                        }
                    ]
                });

            });

  
  $(".fc-prev-button span").click(function(){
      var moment = calendar('getDate');
      moment=moment.format().split("T");
      alert("The current date of the calendar is " + moment[0]);
  //alert(getMonth());
});
function getMonth(){
  var date = $("#calendar1").fullCalendar('getDate');
  var month_int = date.getMonth
  return month_int;
}
        </script>	
    </body>
</html>
