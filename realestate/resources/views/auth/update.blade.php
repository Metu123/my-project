
@include('header')
@include('partials.verify-email')
<style>
        .searchable-dropdown {
            position: relative;
            width: 100%;
        }
        .searchable-dropdown input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .dropdown-options {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            width: 100%;
            z-index: 1000;
        }
        .option {
            padding: 8px;
            cursor: pointer;
        }
        .option:hover {
            background: #f0f0f0;
        }
    </style>
    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        <img src="/assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Dashboard</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Create property</li>
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
        <div class="create-tab" id="create-property">
            <div class="property-wizard common-card">
                <div class="common-header">
                </div>
                <div class="create-property-form">
                    <div class="form-inputs">

<div class="container">

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display Error Messages -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

 
<div class="container">
    <h2>Update Property</h2>
    <form class="row gx-2 gx-sm-3" method="POST" action="{{ route('property.update', $property['_id']) }}" enctype="multipart/form-data">
        @csrf

        <!-- Hidden fields -->
        <input type="hidden" name="created_by" value="{{ session('user') }}">

        <div class="form-group col-sm-4">
            <label>Property Title</label>
            <input type="text" name="property_title" class="form-control" value="{{ $property['property_title'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="{{ $property['status'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ $property['type'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Max Rooms</label>
            <input type="number" name="max_rooms" class="form-control" value="{{ $property['max_rooms'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Beds</label>
            <input type="number" name="beds" class="form-control" value="{{ $property['beds'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Baths</label>
            <input type="number" name="baths" class="form-control" value="{{ $property['baths'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Area (Marla)</label>
            <input type="number" name="area" class="form-control" value="{{ $property['area'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Price (PKR)</label>
            <input type="number" name="price" class="form-control" value="{{ $property['price'] }}" required>
        </div>

        <div class="form-group col-sm-12">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $property['description'] }}</textarea>
        </div>

        <div class="form-group col-sm-4">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="{{ $property['city'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ $property['location'] }}" required>
        </div>

        <div class="form-group col-sm-4">
            <label>Landmark</label>
            <input type="text" name="landmark" class="form-control" value="{{ $property['landmark'] }}">
        </div>

        <div class="form-group col-sm-12">
            <label>Video (YouTube)</label>
            <input type="text" name="video_link" class="form-control" value="{{ $property['video_link'] }}">
        </div>

        @for ($i = 1; $i <= 8; $i++)
        <div class="form-group col-sm-6">
            <label>Upload Image {{ $i }}</label>
            <input type="file" name="image_{{ $i }}" class="form-control custom-file-input" accept="image/*">
            @if(isset($property["image_$i"]))
                <img src="{{ asset($property["image_$i"]) }}" alt="Property Image" width="100">
            @endif
        </div>
        @endfor

        <div class="form-inputs">
        <h6>Contact Information</h6>
        <div class="row gx-3">
            <div class="form-group col-sm-4">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $property['email'] }}" required>
            </div>
            <div class="form-group col-sm-4">
                <label>Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control" value="{{ $property['mobile_number'] }}" required>
            </div>
            <div class="form-group col-sm-4">
                <label>WhatsApp Number</label>
                <input type="text" name="whatsapp_number" class="form-control" value="{{ $property['whatsapp_number'] }}" required>
            </div>
        </div>
    </div>

        <div class="text-end">
            <button type="submit" class="btn btn-gradient color-2 btn-pill">Update Property</button>
        </div>
    </form>
</div>



<!-- JavaScript for YouTube Link Validation -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".youtube-input").addEventListener("input", function() {
            const pattern = /^(https?:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)/;
            this.setCustomValidity(pattern.test(this.value) || this.value === "" ? "" : "Please enter a valid YouTube URL");
        });
    });

</script>


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
    <!-- latest jquery-->
    <script>
        function setupSearchableDropdown(inputId, hiddenId, optionsId, optionsList) {
            const input = document.getElementById(inputId);
            const hiddenInput = document.getElementById(hiddenId);
            const optionsDiv = document.getElementById(optionsId);

            function showOptions(query) {
                optionsDiv.innerHTML = "";
                const filteredOptions = query
                    ? optionsList.filter(option => option.toLowerCase().includes(query.toLowerCase()))
                    : optionsList;

                if (filteredOptions.length === 0) {
                    optionsDiv.style.display = "none";
                    return;
                }

                filteredOptions.forEach(option => {
                    const div = document.createElement("div");
                    div.textContent = option;
                    div.classList.add("option");
                    div.addEventListener("click", function() {
                        input.value = option;
                        hiddenInput.value = option;
                        optionsDiv.style.display = "none";
                    });
                    optionsDiv.appendChild(div);
                });

                optionsDiv.style.display = "block";
            }

            input.addEventListener("input", function() {
                showOptions(this.value);
            });

            input.addEventListener("focus", function() {
                showOptions("");
            });

            document.addEventListener("click", function(event) {
                if (!input.contains(event.target) && !optionsDiv.contains(event.target)) {
                    optionsDiv.style.display = "none";
                }
            });
        }

        setupSearchableDropdown("statusInput", "statusHidden", "statusOptions", ["Sale", "Rent"]);
        setupSearchableDropdown("typeInput", "typeHidden", "typeOptions", ["Home", "Plot", "Commercial"]);
        setupSearchableDropdown("cityInput", "cityHidden", "cityOptions", [
            "Karachi", "Lahore", "Islamabad", "Rawalpindi", "Multan",
            "Faisalabad", "Peshawar", "Quetta", "Sialkot", "Gujranwala",
            "Hyderabad", "Bahawalpur", "Sargodha", "Sukkur", "Larkana"
        ]);
    </script>

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

    <!-- Dropzone js -->
    <script src="../assets/js/dropzone/dropzone.js"></script>
    <script src="../assets/js/dropzone/dropzone-script.js"></script>

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