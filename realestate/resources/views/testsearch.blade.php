
@include('header')
    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        <img src="../assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Search</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Listing</li>
                            <li class="breadcrumb-item active" aria-current="page">Search</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- property grid start -->
    <section class="property-section">
        <div class="container">
            <div class="row ratio_55">
                <div class="col-12 property-grid-3">


    <!-- Filter and Sorting Panel -->
    <div class="filter-panel tab-top-panel">
        <div class="top-panel">
            <ul class="grid-list-filter">
                <li>
                    <div class="filter-bottom-title">
                        <h6 class="mb-0 font-roboto">Advance search 
                            <i data-feather="align-center" class="float-end ms-2"></i>
                        </h6>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <span class="dropdown-toggle font-rubik" data-bs-toggle="dropdown">
                            <span>
                                @if(request('sort') == 'newest') Sort by Newest
                                @elseif(request('sort') == 'oldest') Sort by Oldest
                                @elseif(request('sort') == 'cheapest') Sort by price (Low to high)
                                @elseif(request('sort') == 'expensive') Sort by price (High to low)
                                @else Sort by Default
                                @endif
                            </span>
                            <i class="fas fa-angle-down ms-lg-3 ms-2"></i>
                        </span>
                        <div class="dropdown-menu text-start">
                            <a class="dropdown-item" href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'newest'])) }}">Sort by Newest</a>
                            <a class="dropdown-item" href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'oldest'])) }}">Sort by Oldest</a>
                            <a class="dropdown-item" href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'cheapest'])) }}">Sort by price (Low to high)</a>
                            <a class="dropdown-item" href="?{{ http_build_query(array_merge(request()->all(), ['sort' => 'expensive'])) }}">Sort by price (High to low)</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="left-sidebar filter-bottom-content">
        <h6 class="d-lg-none d-block text-end">
            <a href="javascript:void(0)" class="close-filter-bottom">Close filter</a>
        </h6>
        <form method="GET">
            <input type="hidden" name="city" value="{{ request('city') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="type" value="{{ request('type') }}">
            <input type="hidden" name="sort" value="{{ request('sort') }}">

            <div class="row">
                <div class="col-lg-4">
                    <label for="max-rooms" class="font-rubik">Max Rooms</label>
                    <input type="number" id="max-rooms" name="max_rooms" class="form-control" min="1" max="6" value="{{ request('max_rooms') }}" placeholder="Max Rooms">
                </div>
                <div class="col-lg-4">
                    <label for="bed" class="font-rubik">Bed</label>
                    <input type="number" id="bed" name="beds" class="form-control" min="1" max="4" value="{{ request('beds') }}" placeholder="Bed">
                </div>
                <div class="col-lg-4">
                    <label for="bath" class="font-rubik">Bath</label>
                    <input type="number" id="bath" name="baths" class="form-control" min="1" max="4" value="{{ request('baths') }}" placeholder="Bath">
                </div>
                <div class="col-lg-6">
                    <label for="min-price" class="font-rubik">Min Price</label>
                    <input type="number" id="min-price" name="min_price" class="form-control" min="0" value="{{ request('min_price') }}" placeholder="Min Price">
                </div>
                <div class="col-lg-6">
                    <label for="max-price" class="font-rubik">Max Price</label>
                    <input type="number" id="max-price" name="max_price" class="form-control" min="0" value="{{ request('max_price') }}" placeholder="Max Price">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="mt-3 btn btn-gradient color-2 btn-pill">Search Property</button>
                </div>
            </div>
        </form>
    </div>


    @php
        // Apply filtering before sorting
        $filteredResults = array_filter($results, function ($p) {
            return
                (!request('beds') || strtolower($p['beds']) == strtolower(request('beds'))) &&
                (!request('baths') || strtolower($p['baths']) == strtolower(request('baths'))) &&
                (!request('max_rooms') || strtolower($p['max_rooms']) == strtolower(request('max_rooms'))) &&
                (!request('min_price') || $p['price'] >= request('min_price')) &&
                (!request('max_price') || $p['price'] <= request('max_price'));
        });

        // Apply sorting
        if (request('sort')) {
            usort($filteredResults, function ($a, $b) {
                if (request('sort') == 'newest') {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                } elseif (request('sort') == 'oldest') {
                    return strtotime($a['created_at']) - strtotime($b['created_at']);
                } elseif (request('sort') == 'cheapest') {
                    return $a['price'] - $b['price'];
                } elseif (request('sort') == 'expensive') {
                    return $b['price'] - $a['price'];
                }
                return 0;
            });
        }

        // Pagination logic
        $totalResults = count($filteredResults);
        $perPage = 9;
        $currentPage = request('page', 1);
        $totalPages = ceil($totalResults / $perPage);
        $offset = ($currentPage - 1) * $perPage;

        // Get the paginated results
        $paginatedResults = array_slice($filteredResults, $offset, $perPage);
    @endphp

    <div class="container">
        @if(session('message'))
            <div id="wishlist-message" class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="property-2 column-sm zoom-gallery property-label property-grid row grid">
        @if (empty($filteredResults) || count($filteredResults) == 0)
            <div class="col-12 text-center">
                <h3>No property found</h3>
            </div>
        @else
            @foreach ($filteredResults as $property)
                <div class="col-xl-4 col-md-6 {{ $property['type'] ?? 'N/A' }} grid-item wow fadeInUp" data-class="{{ $property['type'] ?? 'N/A' }}">
                    <div class="property-box">
                        <div class="property-image">
                            <img src="{{ asset($property['image_1']) }}" class="bg-img" alt="Property Image">
                            <div class="labels-left">
                                <div>
                                    <span class="label label-shadow">{{ $property['type'] ?? 'N/A' }}</span>
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
    <a href="{{ url('track-click/' . $property['_id']) }}">
        <h3>{{ $property['property_title'] ?? 'Untitled Property' }}</h3>
    </a>
    <h6>{{ number_format($property['price'] ?? 0, 2) }}PKR</h6>
    <p class="font-roboto">
        {{ \Illuminate\Support\Str::limit($property['description'] ?? 'No description available.', 100, '...') }}
    </p>
    <ul>
        <li>
            <img src="../assets/images/svg/icon/double-bed.svg" class="img-fluid" alt="">
            Bed: {{ $property['beds'] ?? 0 }}
        </li>
        <li>
            <img src="../assets/images/svg/icon/bathroom.svg" class="img-fluid" alt="">
            Baths: {{ $property['baths'] ?? 0 }}
        </li>
        <li>
            <img src="../assets/images/svg/icon/square-ruler-tool.svg" class="img-fluid ruler-tool" alt="">
            Sq Ft: {{ $property['area'] ?? 0 }}
        </li>
    </ul>


    <div class="property-btn d-flex flex-wrap align-items-center gap-2 mt-2">

        <a href="mailto:{{ $property['email'] }}"
           class="btn btn-outline-success square-btn d-flex align-items-center justify-content-center">
            <i class="fas fa-envelope me-1"></i> 
        </a>

        <a href="https://wa.me/{{ str_replace(['+', '-'], '', $property['whatsapp_number']) }}" 
           class="btn btn-outline-success square-btn d-flex align-items-center justify-content-center" 
           target="_blank">
            <i class="fab fa-whatsapp me-1"></i> WhatsApp
        </a>

        <a href="tel:{{ str_replace(['+', ' '], '', $property['mobile_number']) }}" 
           class="btn btn-outline-success square-btn d-flex align-items-center justify-content-center">
            <i class="fas fa-phone-alt me-1"></i> Call
        </a>
    </div>
</div>


                    </div>
                </div>
            @endforeach
        @endif
    </div>

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
            </div>
        </div>
    </section>
    <!-- property grid end -->

    
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
    <span class="createdAt" id="createdAt_{{ $property['_id'] }}">{{ $property['created_at'] ?? '00000000000000' }}</span>

<script>
    function timeAgo(inputTime) {
        if (!/^\d{14}$/.test(inputTime)) return "Invalid format!";

        // Parse as UTC
        const year = parseInt(inputTime.slice(0, 4));
        const month = parseInt(inputTime.slice(4, 6)) - 1;
        const day = parseInt(inputTime.slice(6, 8));
        const hour = parseInt(inputTime.slice(8, 10));
        const minute = parseInt(inputTime.slice(10, 12));
        const second = parseInt(inputTime.slice(12, 14));

        const inputDateUTC = new Date(Date.UTC(year, month, day, hour, minute, second));
        const nowUTC = new Date();

        // Convert now to UTC
        const nowUTCSeconds = Math.floor(nowUTC.getTime() / 1000);
        const inputUTCSeconds = Math.floor(inputDateUTC.getTime() / 1000);

        const diff = nowUTCSeconds - inputUTCSeconds;

        if (diff < 0) return "In the future";
        if (diff < 5) return "Just now";
        if (diff < 60) return `${diff} second${diff === 1 ? '' : 's'} ago`;

        const minutes = Math.floor(diff / 60);
        if (minutes < 60) return `${minutes} minute${minutes === 1 ? '' : 's'} ago`;

        const hours = Math.floor(diff / 3600);
        if (hours < 24) return `${hours} hour${hours === 1 ? '' : 's'} ago`;

        const days = Math.floor(diff / 86400);
        if (days < 30) return `${days} day${days === 1 ? '' : 's'} ago`;

        const months = Math.floor(days / 30);
        if (months < 12) return `${months} month${months === 1 ? '' : 's'} ago`;

        const years = Math.floor(months / 12);
        return `${years} year${years === 1 ? '' : 's'} ago`;
    }

    function updateTimes() {
        document.querySelectorAll(".createdAt").forEach(span => {
            const rawTime = span.innerText.trim();
            span.innerText = timeAgo(rawTime);
        });
    }

    window.onload = updateTimes;
</script>

<script>
        // Wait for the page to fully load
        document.addEventListener("DOMContentLoaded", function () {
            let messageDiv = document.getElementById("wishlist-message");
            if (messageDiv) {
                setTimeout(() => {
                    messageDiv.style.transition = "opacity 0.5s";
                    messageDiv.style.opacity = "0";
                    setTimeout(() => messageDiv.remove(), 1000);
                }, 5000);
            }
        });
    </script>
     
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

    <!-- filter js -->
    <script src="../assets/js/filter.js"></script>
    <script src="../assets/js/isotope.min.js"></script>

    <!-- wow js-->
    <script src="../assets/js/wow.min.js"></script>

    <!-- range slider js -->
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="../assets/js/range-slider.js"></script>

    <!-- slick js -->
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/slick-animation.min.js"></script>
    <script src="../assets/js/custom-slick.js"></script>

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
