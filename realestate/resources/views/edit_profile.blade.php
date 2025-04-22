@include('header')

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
                            <li class="breadcrumb-item active" aria-current="page">My profile</li>
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
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ url('/property/create') }}">create property</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="{{ url('/profile') }}">My profile</a>
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
        <div class="my-profile" id="profile">
            <div class="profile-info">
                <div class="common-card">
                    <div class="user-name media">
                        <div class="media-body">
                            <h5>{{ session('user') }} </h5>
                            
                        </div>

                        @if($profile)
                            <span data-bs-toggle="modal" data-bs-target="#edit-profile" class="label label-light label-flat color-4">Edit</span>
                        @else
                            <span data-bs-toggle="modal" data-bs-target="#edit-profile" class="label label-light label-flat color-4">Add</span>
                        @endif
                    </div>

                    <ul class="user-detail">
                        <li>
                            <i data-feather="map-pin"></i>
                            <span>{{ $profile->address ?? 'Not available' }}</span>
                        </li>
                        <li>
                            <i data-feather="mail"></i>
                            <span>{{ session('user_email') }}</span>
                        </li>
                    </ul>
                    <p class="font-roboto">
                        {{ $profile->description ?? 'No description available. Click "Add" to update your profile.' }}
                    </p>
                </div>

                <div class="common-card">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-7">
                            <div class="information-detail">
                                <div class="common-header">
                                    <h5>About</h5>
                                </div>
                                <div class="information">
                                    <ul>
                                        <li>
                                            <span>Gender :</span>
                                            <p>{{ $profile->gender ?? 'Not available' }}</p>
                                        </li>
                                        <li>
                                            <span>Birthday :</span>
                                            <p>{{ $profile->birthday ?? 'Not available' }}</p>
                                        </li>
                                        <li>
                                            <span>Phone number :</span>
                                            <p>{{ $profile->phone_number ?? 'Not available' }}</p>
                                        </li>
                                        <li>
                                            <span>Address :</span>
                                            <p>{{ $profile->address ?? 'Not available' }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End of common-card -->
            </div>
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

    <!-- edit profile modal start -->

<div class="modal fade edit-profile-modal" id="edit-profile">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-3">
                        <div class="form-group col-md-6">
                            <label for="first">First Name</label>
                            <input type="text" class="form-control" id="first" name="first_name" value="{{ $profile->first_name ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last">Last Name</label>
                            <input type="text" class="form-control" id="last" name="last_name" value="{{ $profile->last_name ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="">Choose...</option>
                                <option value="female" {{ isset($profile->gender) && $profile->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="male" {{ isset($profile->gender) && $profile->gender == 'male' ? 'selected' : '' }}>Male</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="birthday">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $profile->birthday ?? '' }}">
                        </div>
                        <div class="form-group col-12">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $profile->address ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ $profile->city ?? '' }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone_number" value="{{ $profile->phone_number ?? '' }}">
                        </div>
                        
                        <!-- Profile Image -->
                        <div class="form-group col-md-6">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                            @if(isset($profile->profile_image))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Image" class="img-thumbnail" width="100">
                                </div>
                            @else
                                <p>No profile image uploaded.</p>
                            @endif
                        </div>

                        <!-- Cover Image -->
                        <div class="form-group col-md-6">
                            <label for="cover_image">Cover Image</label>
                            <input type="file" class="form-control" id="cover_image" name="cover_image">
                            @if(isset($profile->cover_image))
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $profile->cover_image) }}" alt="Cover Image" class="img-thumbnail" width="100">
                                </div>
                            @else
                                <p>No cover image uploaded.</p>
                            @endif
                        </div>

                        <div class="form-group col-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $profile->description ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dashed color-2 btn-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-gradient color-2 btn-pill">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- edit profile modal start -->

    
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

    <!-- datepicker js-->
    <script src="../assets/js/date-picker.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Template js-->
    <script src="../assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="../assets/js/customizer.js"></script>

    <script>

        (function($) {
            "use strict";
            // colorpicker js
            var color_picker3 = document.getElementById("ColorPicker3").value;
            document.getElementById("ColorPicker3").onchange = function() {
                color_picker3 = this.value;
                document.documentElement.style.setProperty('--theme-default3', color_picker3);
            };

            var color_picker4 = document.getElementById("ColorPicker4").value;
            document.getElementById("ColorPicker4").onchange = function() {
                color_picker4 = this.value;
                document.documentElement.style.setProperty('--theme-default4', color_picker4);
            };
            
        })(jQuery);

       $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'dd mmmm yy'
        });

    </script>

</body>

</html>