@include('header')
@include('partials.verify-email')

    <!-- breadcrumb start -->
    <section class="ratio_40 breadcrumb-section p-0 single-property-images">
        <div class="main-property-slider arrow-image">
            <div>
                <div>
                    <img src="../{{ $property['image_1'] }}" class="bg-img" alt="">
                </div>
            </div>
            <div>
                <div>
                   <img src="../{{ $property['image_2'] }}" class="bg-img" alt="">
                </div>
            </div>
            <div>
                <div>
                    <img src="../{{ $property['image_3'] }}" class="bg-img" alt="">
                </div>
            </div>
            <div>
                <div>
                    <img src="../{{ $property['image_4'] }}" class="bg-img" alt="">
                </div>
            </div>
             <div>
                <div>
                    <img src="../{{ $property['image_5'] }}" class="bg-img" alt="">
                </div>
            </div>
             <div>
                <div>
                   <img src="../{{ $property['image_6'] }}" class="bg-img" alt="">
                </div>
            </div>
             <div>
                <div>
                    <img src="../{{ $property['image_7'] }}" class="bg-img" alt="">
                </div>
            </div>
             <div>
                <div>
                    <img src="../{{ $property['image_8'] }}" class="bg-img" alt="">
                </div>
            </div>
        </div>
        <div class="single-property-section">
            <div class="container">
                <div class="single-title">
                    <div class="left-single">
                        <div class="d-flex">
                            <h2 class="mb-0">{{ $property['property_title'] }} </h2>
                            <span><span class="label label-shadow ms-2">For
                                    {{ $property['status'] }}</span></span>
                        </div>
                        <p class="mt-2">{{ $property['location'] }}, {{ $property['city'] }}, {{ $property['landmark'] }}</p>
                        <ul>
                            <li>
                                <div>
                                    <img src="../assets/images/svg/icon/double-bed.svg" class="img-fluid" alt="">
                                    <span>{{ $property['beds'] }} Bedrooms</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <img src="../assets/images/svg/icon/bathroom.svg" class="img-fluid" alt="">
                                    <span>{{ $property['baths'] }} Bathrooms</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <img src="../assets/images/svg/icon/square-ruler-tool.svg" class="img-fluid ruler-tool" alt="">
                                    <span>{{ $property['area'] }} marla</span>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="right-single">
                        <h2 class="price">{{ $property['price'] }} PKR<span>/ start From </span></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- single property start -->
    <section class="single-property">
        <div class="container">
            <div class="row ratio_65">
                <div class="col-xl-9 col-lg-8">
                    <div class="description-section">
                        <div class="description-details">
                            <div class="desc-box">
                                <div class="menu-top" id="searchBar">
                                    <div class="container">
                                        <ul class="nav">
                                            <li class="active"><a class="" href="#about">about</a></li>
                                            <li><a class="" href="#feature">feature</a></li>
                                            <li><a class="" href="#gallery">gallery</a></li>
                                            <li><a class="" href="#video">video</a></li>
                                            <li><a class="" href="#details">details</a></li>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="about page-section" id="about">
                                    <h4>Property Brief</h4>
                                    <div class="row">
    @php
        $descriptionParts = explode('.', $property['description']); // Split description by periods
    @endphp

    @foreach ($descriptionParts as $part)
        @if (!empty(trim($part))) 
            <div class="col-sm-4">
                <p>{{ trim($part) }}.</p>
            </div>
        @endif
    @endforeach
</div>

                                </div>
                            </div>
                            <div class="desc-box">
    <div class="page-section feature-dec" id="feature">
        <h4 class="content-title">Features</h4>
        <div class="single-feature row">
            @php
                $featureIcons = [
                    'Free Wi-Fi' => 'fas fa-wifi',
                    'Elevator Lift' => 'fas fa-hands',
                    'Power Backup' => 'fas fa-power-off',
                    'Laundry Service' => 'fas fa-monument',
                    'Security Guard' => 'fas fa-user-shield',
                    'CCTV' => 'fas fa-video',
                    'Emergency Exit' => 'fas fa-door-open',
                    'Doctor On Call' => 'fas fa-first-aid',
                    'Shower' => 'fas fa-shower',
                    'Free Parking In The Area' => 'fas fa-car',
                    'Air Conditioning' => 'fas fa-fan',
                ];

                $chunks = array_chunk($property['features'], 4); // Split into groups of 4
            @endphp

            @foreach ($chunks as $chunk)
                <div class="col-xxl-3 col-xl-4 col-6">
                    <ul>
                        @foreach ($chunk as $feature)
                            <li>
                                <i class="{{ $featureIcons[$feature] ?? 'fas fa-check' }}"></i> {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>

                            <div class="desc-box">
                                <div class="page-section ratio3_2" id="gallery">
                                    <h4 class="content-title">gallery</h4>
                                    <div class="single-gallery">
                                        <div class="gallery-for">
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_1'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_2'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_3'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_4'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_5'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_6'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_7'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="bg-size">
                                                    <img src="../{{ $property['image_8'] }}" class="bg-img" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gallery-nav">
                                            <div>
                                                <img src="../{{ $property['image_1'] }}" class="bg-img" alt="">
                                            </div>
                                            <div>
                                                <img src="../{{ $property['image_2'] }}" class="bg-img" alt="">
                                            </div>
                                            <div>
                                                <img src="../{{ $property['image_3'] }}" class="bg-img" alt="">
                                            </div>
                                            <div>
                                                <img src="../{{ $property['image_4'] }}" class="bg-img" alt="">
                                            </div>
                                            <div>
                                                <img src="../{{ $property['image_5'] }}" class="bg-img" alt="">
                                            </div>
                                            <div>
                                                <img src="../{{ $property['image_6'] }}" class="bg-img" alt="">
                                            </div>
                                            <div>
                                                <img src="../{{ $property['image_7'] }}" class="bg-img" alt="">
                                            </div>
                                            <div>
                                                <img src="../{{ $property['image_8'] }}" class="bg-img" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desc-box">
    <div class="page-section ratio_40" id="video">
        <h4 class="content-title">Video</h4>
        <div class="play-bg-image">
            <div class="video-container">
                @php
                    // Extract YouTube video ID from the URL
                    preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $property['video_link'], $matches);
                    $videoId = $matches[1] ?? '';
                @endphp

                @if($videoId)
                    <iframe width="100%" height="400px"
                        src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&autoplay=0&showinfo=0&controls=1"
                        frameborder="0" allowfullscreen>
                    </iframe>
                @endif
            </div>
        </div>
    </div>
</div>


                            <div class="desc-box">
                                <div class="page-section" id="details">
                                    <div class="row">
                                        <div class="col-md-6 col-xl-4">
                                            <ul class="property-list-details">
                                                <li><span>Property Type :</span>{{ $property['type'] }}</li>
                                                <li><span>Property ID :</span> {{ (string) $property['_id']['$oid'] }}</li>
                                                <li><span>Property status :</span> {{ $property['status'] }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <ul class="property-list-details">
                                                <li><span>Price(pkr) :</span> {{ $property['price'] }}</li>
                                                <li><span>Property Size :</span> {{ $property['area'] }} marla</li>
                                                <li><span>room :</span> {{ $property['max_rooms'] }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-xl-4">
                                            <ul class="property-list-details">
                                                <li><span>City :</span> {{ $property['city'] }}</li>
                                                <li><span>Bedrooms :</span> {{ $property['beds'] }}</li>
                                                <li><span>Bathrooms :</span> {{ $property['baths'] }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="desc-box">
                                <div class="page-section" id="details">
                                 <a href="{{ url('/report/' . $property['_id']['$oid']) }}" class="btn btn-danger">Report Property</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="left-sidebar sticky-cls single-sidebar">
                        <div class="filter-cards">
                            <div class="advance-card">
                                <h6>Contact Info</h6>
                                <div class="category-property">
                                    <div class="agent-info">
                                        <div class="media">
                                            <img src="../assets/images/testimonial/3.png" class="img-50" alt="">
                                            <div class="media-body ms-2">
                                                <h6>{{ $property['created_by'] }}</h6>
                                                <p>{{ $property['email'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <ul>
    <li>
        <a href="https://wa.me/{{ str_replace(['+', '-'], '', $property['whatsapp_number']) }}" target="_blank">
            <i class="fab fa-whatsapp me-2 text-success"></i> {{ $property['whatsapp_number'] }}
        </a>
    </li>
    <li>
        <a href="tel:{{ str_replace(['+', ' '], '', $property['mobile_number']) }}">
            <i class="fas fa-phone-alt me-2"></i> {{ $property['mobile_number'] }}
        </a>
    </li>
    <li>
        <a href="mailto:{{ $property['email'] }}">
            <i class="fas fa-envelope me-2 "></i> {{ $property['email'] }}
        </a>
    </li>
</ul>

                                </div>
                            </div>
                           
                           
                            
                            <div class="advance-card">
                                <div class="category-property">
                                       <a href="/agent/{{ $property['created_by'] }}" class="btn btn-gradient color-4">
    Learn More
</a>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- single property end -->

    <!-- video modal start -->
    <div class="modal fade video-modal" id="videomodal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <iframe title="realestate" src="https://www.youtube.com/embed/Sz_1tkcU0Co" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- video modal end -->

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

    <!-- magnific js -->
    <script src="../assets/js/jquery.magnific-popup.js"></script>
    <script src="../assets/js/zoom-gallery.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="../assets/js/feather-icon/feather.min.js"></script>
    <script src="../assets/js/feather-icon/feather-icon.js"></script>

    <!-- smooth scroll js -->
    <script src="../assets/js/smooth-scroll.js"></script>

    <!-- range slider js -->
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../assets/js/range-slider.js"></script>

    <!-- slick js -->
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/slick-animation.min.js"></script>
    <script src="../assets/js/custom-slick.js"></script>

    <!-- print js -->
    <script src="../assets/js/print.js"></script>

    <!-- Template js-->
    <script src="../assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="../assets/js/customizer.js"></script>

    <!-- Color-picker js-->
    <script src="../assets/js/color/single-property.js"></script>

</body>

</html>