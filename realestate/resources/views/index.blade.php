@include('header')
    <!-- home section start -->
    <section class="layout-home8 bg-img-2 ratio_landscape">
        <div class="container p-0">
            
            <div class="row m-0">
                <div class="col-xl-7 col-lg-8">
                    <div class="home-left-content">                        
                        <div class="home-content">
                            <h1 class="mt-0">
                                You're local Real estate
                                <br/>
                                professionals
                            </h1>
                            <h6 class="font-roboto mb-0">Residences can be classified by and connected to residences. Different types of housing  can be use same physical type.</h6>
                        </div>
                       <div class="search-with-tab">
    <div class="tab-content" id="home-tabContent">
        <div class="tab-pane fade show active" >
            <form id="search-form" action="{{ url('/testsearch') }}" method="GET">
    <div class="row review-form gx-3">
        <!-- Location Input -->
        <div class="col-lg-4 col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="Search your location">
            </div>
        </div>

        <!-- Property Status Dropdown -->
        <div class="col-lg-4 col-sm-6">
            <div class="dropdown">
                <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown">
                    <span id="selected-status">Property Status</span> <i class="fas fa-angle-down"></i>
                </span>
                <div class="dropdown-menu text-start">
                    <a class="dropdown-item status-option" data-value="Sale">Sale</a>
                    <a class="dropdown-item status-option" data-value="Rent">Rent</a>
                </div>
            </div>
            <input type="hidden" name="status" id="status-input">
        </div>

        <!-- Property Type Dropdown -->
        <div class="col-lg-4 col-sm-6">
            <div class="dropdown">
                <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown">
                    <span id="selected-type">Property Type</span> <i class="fas fa-angle-down"></i>
                </span>
                <div class="dropdown-menu text-start">
                    <a class="dropdown-item type-option" data-value="Home">Home</a>
                    <a class="dropdown-item type-option" data-value="Plot">Plot</a>
                    <a class="dropdown-item type-option" data-value="Commercial">Commercial</a>
                </div>
            </div>
            <input type="hidden" name="type" id="type-input">
        </div>

        <!-- Search Button -->
        <div class="col-lg-4 col-md-6">
            <button type="submit" class="btn btn-gradient color-4">Search</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Handle Status Dropdown
        document.querySelectorAll(".status-option").forEach(item => {
            item.addEventListener("click", function() {
                document.getElementById("selected-status").innerText = this.getAttribute("data-value");
                document.getElementById("status-input").value = this.getAttribute("data-value");
            });
        });

        // Handle Type Dropdown
        document.querySelectorAll(".type-option").forEach(item => {
            item.addEventListener("click", function() {
                document.getElementById("selected-type").innerText = this.getAttribute("data-value");
                document.getElementById("type-input").value = this.getAttribute("data-value");
            });
        });
    });
</script>


        </div>
    </div>
</div>

                    </div>
                </div>
                <div class="col-xl-5 col-lg-4">
                    <div class="home-right-image">
                        <img src="../assets/images/others/building.jpg" alt="" class="bg-img">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- home section end -->
    <!-- service section start -->
    <section class="service-section service-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="container">
                        <div class="title-3 text-start">
                            <h2>Property Services</h2>
                        </div>
                    </div>
                    <div class="service-slider arrow-gradient arrow-right">
                        <div>
                            <div class="service-wrapper">
                                <div class="top-img-box">
                                    <div>
                                        <img src="../assets/images/service/2.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="service-details">
                                    <h3><a href="{{ url('/tool') }}">Comprehensive Search Tools</a></h3>
                                    <p class="font-roboto">Our advanced filters and search options help users locate properties that meet their unique needs through tools like Property Finder and Home Installments Calculator along with Society Map, Real Estate Explorer, Land Tracker, Property Navigator, Area Insights and Invest Search.</p>
                                    <a href="{{ url('/tool') }}">View details</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="service-wrapper">
                                <div class="top-img-box">
                                    <div>
                                        <img src="../assets/images/service/1.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="service-details">
                                    <h3><a href="{{ url('/tool') }}">Property Listings</a></h3>
                                    <p class="font-roboto">Our property database for houses, apartments, shops, offices, plots and agricultural land receives regular updates</p>
                                    <a href="{{ url('/tool') }}">View details</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="service-wrapper">
                                <div class="top-img-box">
                                    <div>
                                        <img src="../assets/images/service/4.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="service-details">
                                    <h3>Blog News Updates</h3>
                                    <p class="font-roboto">Updated property values along with current construction industry news.</p>
                                    <a href="{{ url('/tool') }}">View details</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="service-wrapper">
                                <div class="top-img-box">
                                    <div>
                                        <img src="../assets/images/service/5.png" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="service-details">
                                    <h3><a href="{{ url('/tool') }}">Market Insights</a></h3>
                                    <p class="font-roboto">Stay informed about property values and market trends through consistent updates to make well-informed decisions.</p>
                                    <a href="{{ url('/tool') }}">View details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service section end -->
    <!-- tap to top start -->
    <div class="tap-top color-4">
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

    <!-- popper js-->
    <script src="../assets/js/popper.min.js"></script>

    <!-- magnific js -->
    <script src="../assets/js/jquery.magnific-popup.js"></script>
    <script src="../assets/js/zoom-gallery.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="../assets/js/feather-icon/feather.min.js"></script>
    <script src="../assets/js/feather-icon/feather-icon.js"></script>

    <!-- wow js-->
    <script src="../assets/js/wow.min.js" ></script>

    <!-- slick js -->
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/slick-animation.min.js"></script>
    <script src="../assets/js/custom-slick.js"></script>

    <!-- login js -->
    <script src="../assets/js/login.js"></script>

    <!-- Template js-->
    <script src="../assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="../assets/js/customizer.js"></script>

    <!-- Color-picker js-->
    <script src="../assets/js/color/layout4.js"></script>

</body>

</html>