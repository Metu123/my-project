
@include('header')
@include('partials.verify-email')

    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        <img src="../assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Dashboard</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- user dashboard section start -->
    <section class="user-dashboard small-section">
            <div class="container">
                <div class="row">
                       <div class="col-lg-3">
                        <div class="sidebar-user sticky-cls">
                            <div class="user-profile">
                                <div class="media">

                                    <div class="media-body">
                                        <h5>{{ session('user') }}</h5>
                                        <h6 class="font-roboto">{{ session('user_email') }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-list">
                                <ul class="nav nav-tabs right-line-tab">
                                    <li class="nav-item"><a class="nav-link active"
                                            href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/property/create') }}">create property</a></li>
                                    <li class="nav-item"><a class="nav-link " href="{{ url('/profile') }}">My profile</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/faq') }}">faq</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/terms') }}">Terms & Condition</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/privacy') }}">Privacy</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
<div class="col-lg-9">
    <div class="dashboard-content">
        <div id="dashboard">
            <div class="user-wrapper">
                <div class="row">
    <div class="col-md-4">
        <div class="common-card">
            <div class="widgets">
                <div class="media">
                    <div class="media-body">
                        <p>Total Property</p>
                        <h5>{{ $totalProperties }}</h5>
                    </div>
                    <div class="small-bar">
                        <div class="small-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="common-card">
            <div class="widgets widget-1">
                <div class="media">
                    <div class="media-body">
                        <p>Total Views</p>
                        <h5>{{ number_format($totalViews) }}</h5>
                    </div>
                    <div class="small-bar">
                        <div class="small-chart1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="common-card">
            <div class="widgets widget-2">
                <div class="media">
                    <div class="media-body">
                        <p>Average CTR</p>
                        <h5>{{ $averageCTR }}%</h5>
                    </div>
                    <div class="small-bar">
                        <div class="small-chart2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                <!-- Table Section -->


<div class="container">
    <h2 class="text-center mb-4">My Properties</h2>

    @if (session()->has('user'))
        <table class="table table-hover" id="propertyTable">
            <thead style="background-color: #dcdcdc; color: #333;">
                <tr>
                    <th onclick="sortTable(0)">No</th>
                    <th onclick="sortTable(1)">Title</th>
                    <th onclick="sortTable(2)">Status</th>
                    <th onclick="sortTable(3)">Type</th>
                    <th onclick="sortTable(4)">Price(PKR}</th>
                    <th onclick="sortTable(5)">Views</th>
                    <th onclick="sortTable(6)">Clicks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($properties) > 0)
                    @foreach($properties as $key => $property)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ url('/property/' . $property->_id) }}" class="text-primary">
                                    {{ $property->property_title ?? 'N/A' }}
                                </a>
                            </td>
                            <td>{{ $property->status ?? 'N/A' }}</td>
                            <td>{{ $property->type ?? 'N/A' }}</td>
                            <td>{{ number_format((float)$property->price, 2) }}</td>
                            <td>{{ $property['views'] ?? 0 }}</td>
                            <td>{{ $property['click_count'] ?? 0 }}</td>
                            <td>
                                <!-- Delete Button -->
                                <form action="{{ route('dashboard.delete', $property->_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                
                                <!-- Update Button -->
                                <a href="{{ url('/property/update/' . $property->_id) }}" class="btn btn-warning btn-sm">Update</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">No properties found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    @else
        <p class="text-center text-danger">You must be logged in to view properties.</p>
    @endif
</div>

<script>
    function sortTable(columnIndex) {
        let table = document.getElementById("propertyTable");
        let rows = Array.from(table.rows).slice(1);
        let sortedRows = rows.sort((rowA, rowB) => {
            let cellA = rowA.cells[columnIndex].innerText.toLowerCase();
            let cellB = rowB.cells[columnIndex].innerText.toLowerCase();
            return cellA.localeCompare(cellB, undefined, { numeric: true });
        });

        table.tBodies[0].append(...sortedRows);
    }
</script>

<style>
    .table th {
        cursor: pointer;
        text-align: center;
    }
    .table th:hover {
        text-decoration: underline;
    }
    .table tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>






                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- user dashboard section end -->
    <!-- tap to top start -->
    <div class="tap-top">
        <div>
            <i class="fas fa-arrow-up"></i>
        </div>
    </div>
    <!-- tap to top end -->

    <!-- log out modal start -->
    <div class="modal fade edit-profile-modal logout-modal" id="logout">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logging out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Are you sure ? you want to log out.</h6>
                    <p>Once you will be logged out and will be unable to log in back.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dashed color-2 btn-pill" data-bs-dismiss="modal">no</button>
                    <button type="button" onclick="document.location='layout-2.html'" class="btn btn-gradient color-2 btn-pill">yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- log out modal end -->

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
                    <h6 class="color-2">Layout type</h6>
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
                    <h6 class="color-2">Layout Direction</h6>
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
                    <h6 class="color-2">Unlimited Color</h6>
                </div>
                <div class="option-setting unlimited-color-layout">
                    <div class="form-group">
                        <label for="ColorPicker3">color 3</label>
                        <input id="ColorPicker3" type="color" value="#ff5c41" name="Default">
                    </div> 
                    <div class="form-group">
                        <label for="ColorPicker4">color 4</label>
                        <input id="ColorPicker4" type="color" value="#ff8c41" name="Default">
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <!-- customizer end -->

    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- popper js-->
    <script src="../assets/js/popper.min.js"></script>

    <!-- feather icon js-->
    <script src="../assets/js/feather-icon/feather.min.js"></script>
    <script src="../assets/js/feather-icon/feather-icon.js"></script>

    <!-- slick js -->
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/slick-animation.min.js"></script>
    <script src="../assets/js/custom-slick.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- chartist chart js-->
    <script src="../assets/js/chart/chartist/chartist.js"></script>
    <script src="../assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>

    <!-- apexchart js-->
    <script src="../assets/js/chart/apex-chart/apex-chart.js"></script>

    <!-- dashboard js-->
    <script src="../assets/js/dashboard.js"></script>

    <!-- Template js-->
    <script src="../assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="../assets/js/customizer.js"></script>

    <!-- wow js-->
    <script src="../assets/js/wow.min.js"></script>

    <!-- Color-picker js-->
    <script src="../assets/js/color/template-color.js"></script>

</body>

</html>