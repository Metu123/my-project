<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sheltos - Reports page">
    <meta name="keywords" content="sheltos">
    <meta name="author" content="sheltos">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon" />
    <title>Sheltos - Reports page</title>

   <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">

    <!-- map css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vector-map.css">

    <!-- Template css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">

</head>

<body>

    
    <div class="page-wrapper">

        <!-- page header start -->
        <div class="page-main-header row">
            <div id="sidebar-toggle" class="toggle-sidebar col-auto">
                <i data-feather="chevrons-left"></i>
            </div>
            
            <div class="nav-right col p-0">

            </div>
        </div>

        <!-- page header end -->
        <div class="page-body-wrapper">

            <!-- page sidebar start -->
            <div class="page-sidebar">
                <div class="logo-wrap">
                    
                        <img src="../assets/images/logo/4.png" class="img-fluid for-light" alt="">
                        <img src="../assets/images/logo/9.png" class="img-fluid for-dark" alt="">
                    
                </div>
                <div class="main-sidebar">
                    <div id="mainsidebar">
                       <ul class="sidebar-menu custom-scrollbar">
                            <li class="sidebar-item">
                                <a href="{{ url('/admin/dashboard') }}" class="sidebar-link only-link">
                                    <i data-feather="airplay"></i> 
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{ url('/admin/users') }}" class="sidebar-link only-link">
                                    <i data-feather="users"></i>
                                    <span>Users</span>
                                </a>
                            </li>

                            <li class="sidebar-item">
                                <a href="{{ url('/admin/reports') }}" class="sidebar-link only-link">
                                    <i data-feather="bar-chart-2"></i>
                                    <span>Reports</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- page sidebar end -->

            <div class="page-body">

                <!-- Container-fluid start -->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="page-header-left">
                                    <h3>All Reports
                                        <small>Welcome to admin panel</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <!-- Breadcrumb start -->
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/admin/dashboard') }}">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Reports</li>
                                </ol>
                                <!-- Breadcrumb end -->
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid end -->

                <!-- Container-fluid start -->
                <div class="container-fluid">
                    <div class="row report-summary">
                    <form method="GET" action="{{ route('admindashboard') }}" class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by Property Title or ID"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
        </form>

                       
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <h5>Recent transactions</h5>
                                </div>
                                <div class="card-body report-table">
                                    <div class="table-responsive transactions-table">
                                        @if(count($reports) > 0)
        <table class="table table-bordernone m-0">
                <thead >
                <tr>
                    <th class="light-font">Rank</th>
                    <th class="light-font">Property ID</th>
                    <th class="light-font">Report Count</th>
                    <th class="light-font">Descriptions</th>
                    <th class="light-font">Action</th> <!-- New Delete Column -->
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $index => $report)
                    <tr>
                        <td>{{ (($currentPage - 1) * $perPage) + $index + 1 }}</td> <!-- Rank -->
                        <td>{{ $report['_id'] }}</td>
                        <td>{{ $report['report_count'] }}</td>
                        <td>
                            <ul>
                                @foreach($report['descriptions'] as $description)
                                    <li>{{ $description }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <form action="{{ route('admin.reports.delete', $report['_id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this report?');" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="d-flex justify-content-center mt-3">
            @php
                $totalPages = ceil($total / $perPage);
            @endphp

            @for ($i = 1; $i <= $totalPages; $i++)
                <a href="{{ route('admin.reports', ['page' => $i]) }}" class="btn btn-sm btn-primary">{{ $i }}</a>
            @endfor
        </div>
    @else
        <p class="text-center text-danger">No reports available.</p>
    @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid end -->

            </div>


        </div>
    </div>

    <!-- tap to top start -->
    <div class="tap-top">
        <div>
            <i class="fas fa-arrow-up"></i>
        </div>
    </div>
    <!-- tap to top end -->

    <!-- customizer start -->
    <div class="customizer-wrap">
        <div class="customizer-links">
            <i data-feather="settings"></i>
        </div>
        <div class="customizer-contain custom-scrollbar">
            <div class="setting-back">
                <i data-feather="x"></i>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-4">Layout type</h6>
                </div>
                <div class="option-setting">
                    <span>Light</span>
                    <label class="switch">
                        <input type="checkbox" name="chk1" value="option" class="setting-check"><span class="switch-state"></span>
                    </label>
                    <span>Dark</span>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-4">Layout Direction</h6>
                </div>
                <div class="option-setting">
                    <span>LTR</span>
                    <label class="switch">
                        <input type="checkbox" name="chk2" value="option" class="setting-check1"><span class="switch-state"></span>
                    </label>
                    <span>RTL</span>
                </div>
            </div>
            <div class="layouts-settings">
                <div class="customizer-title">
                    <h6 class="color-4">Unlimited Color</h6>
                </div>
                <div class="option-setting unlimited-color-layout">
                    <div class="form-group">
                        <label for="ColorPicker6">color 6</label>
                        <input id="ColorPicker6" type="color" value="#f35d43" name="Default">
                    </div>
                    <div class="form-group">
                        <label for="ColorPicker7">color 7</label>
                        <input id="ColorPicker7" type="color" value="#f34451" name="Default"> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- customizer end -->

    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="../assets/js/feather-icon/feather.min.js"></script>
    <script src="../assets/js/feather-icon/feather-icon.js"></script>

    <!-- sidebar js -->
    <script src="../assets/js/sidebar.js"></script>

    <!-- apex chart js-->
    <script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="../assets/js/admin-dashboard.js"></script>

    <!-- vector map js-->
    <script src="../assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/js/vector-map/map/jquery-jvectormap-asia-mill.js"></script>

    <!--admin js -->
    <script src="../assets/js/admin-script.js"></script>
    <script src="../assets/js/report.js"></script>

    <!-- Customizer js-->
    <script src="../assets/js/customizer.js"></script>

    <!-- Color-picker js-->
    <script src="../assets/js/color/custom-colorpicker.js"></script>

</body>

</html>