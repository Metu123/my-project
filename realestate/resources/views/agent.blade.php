@include('header')

    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        @if(isset($profile))
        <img src="{{ asset('storage/' . $profile->cover_image) }}" class="bg-img img-fluid" alt="">
        @elseif(isset($error))
        <img src="../assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
         @endif
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Agent Profile</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Agent Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- agent profile section start -->
    <section class="agent-section property-section agent-profile-wrap">
    <div class="container">
        <div class="row ratio_55">
            <div class="col-xl-9 col-lg-8 property-grid-2">
                <div class="our-agent theme-card">
                    <div class="row">
                        @if(isset($profile))
                        <div class="col-sm-6 ratio_landscape">
                            <div class="agent-image">
                                <img src="{{ asset('storage/' . $profile->profile_image) }}" class="img-fluid bg-img" alt="">
                            </div>
                        </div>
                            <div class="col-sm-6">
                                <div class="our-agent-details">
                                    <h3 class="f-w-600">{{ $profile['first_name'] }} {{ $profile['last_name'] }}</h3>
                                    <h6>Real estate Property Agent</h6>
                                    <ul>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="map-pin"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>{{ $profile['city'] }}.</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="phone-call"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>{{ $profile['phone_number'] }}</h6>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="icons-square">
                                                    <i data-feather="mail"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6>{{ $profile['email'] }}</h6>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @elseif(isset($error))
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                @if(isset($profile))
                    <div class="about-agent theme-card">
                        <h3>About the agent</h3>
                        @php
                            $description = $profile['description'] ?? 'No description available';
                            $words = explode(' ', $description);
                            $chunks = array_chunk($words, 100);
                        @endphp

                        <div class="row">
                            @foreach($chunks as $chunk)
                                <div class="col-sm-4">
                                    <p class="font-roboto">{{ implode(' ', $chunk) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($paginatedProperties))
                    <div class="agent-property">
                        <div class="property-2 row column-sm zoom-gallery property-label property-grid">
                            @foreach($paginatedProperties as $property)
                                <div class="col-md-6 wow fadeInUp">
                                    <div class="property-box">
                                        <div class="property-image">
                                            <div class="property-slider">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset($property['image_1'] ?? '/default.jpg') }}" class="bg-img" alt="">
                                                </a>
                                            </div>
                                            <div class="labels-left">
                                                <div>
                                                    <span class="label label-shadow">{{ $property['property_type'] ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="seen-data">
                                                <i data-feather="camera"></i>
                                                <span>8</span>
                                            </div>
                                            <div class="overlay-property-box">
                                                <form method="POST" action="{{ route('favorite.toggle') }}">
                                                    @csrf
                                                    <input type="hidden" name="property_id" value="{{ $property['_id'] }}">
                                                    <button type="submit" class="effect-round">
                                                        <i data-feather="bookmark"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="property-details">
                                            <span class="font-roboto">{{ $property['city'] ?? 'Untitled Property' }}</span>
                                            <a href="{{ url('track-click/' . $property['_id']) }}">
                                                <h3>{{ $property['property_title'] ?? 'Untitled Property' }}</h3>
                                            </a>
                                            <h6>{{ number_format($property['price'], 2) }}PKR</h6>
                                            <p class="font-roboto">
                                                {{ \Illuminate\Support\Str::limit($property['description'] ?? 'No description available.', 100, '...') }}
                                            </p>
                                            <ul>
                                                <li><img src="{{ asset('assets/images/svg/icon/double-bed.svg') }}" class="img-fluid" alt="">Bed : {{ $property['beds'] }}</li>
                                                <li><img src="{{ asset('assets/images/svg/icon/bathroom.svg') }}" class="img-fluid" alt="">Baths : {{ $property['baths'] }}</li>
                                                <li><img src="{{ asset('assets/images/svg/icon/square-ruler-tool.svg') }}" class="img-fluid ruler-tool" alt="">marla : {{ $property['area'] }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @php
                            $totalPages = $paginatedProperties->lastPage();
                            $currentPage = $paginatedProperties->currentPage();
                        @endphp

                        @if ($totalPages > 1)
                            <nav class="theme-pagination">
                                <ul class="pagination">
                                    @for ($i = 1; $i <= $totalPages; $i++)
                                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                            <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                </ul>
                            </nav>
                        @endif
                    </div>
                @endif

            </div>

            <div class="col-xl-3 col-lg-4">
                <div class="left-sidebar single-sidebar sticky-cls">
                    <div class="filter-cards">
                        <div class="advance-card">
                            <h6>Info</h6>
                            <div class="category-property">
                                <p class="font-roboto">Welcome to this agent page. If you need any other info, contact the agent using the provided contacts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- agent profile section end -->

    
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

    <!-- range slider js -->
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../assets/js/range-slider.js"></script>

    <!-- slick js -->
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/slick-animation.min.js"></script>
    <script src="../assets/js/custom-slick.js"></script>

    <!--grid js -->
    <script src="../assets/js/grid-list.js"></script>

    <!-- Template js-->
    <script src="../assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="../assets/js/customizer.js"></script>

    <!-- Color-picker js-->
    <script src="../assets/js/color/single-property.js"></script>

</body>

</html>