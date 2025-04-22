@include('header')

    <!-- breadcrumb start -->
    <section class="breadcrumb-section p-0">
        <img src="../assets/images/inner-background.jpg" class="bg-img img-fluid" alt="">
        <div class="container">
            <div class="breadcrumb-content">
                <div>
                    <h2>Faq</h2>
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Faq</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb end -->

    <!-- section start -->
    <section class="faq-section log-in">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-lg-1">
                <div class="faq-image text-center">
                    <h3>Have Any Questions?</h3>
                    <p class="font-roboto">You can ask anything you want to know in our contact</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="faq-questions">
                    <div class="title-3 text-start">
                        <h2>Frequently Asked Questions (FAQs)</h2>
                    </div>
                    <div id="accordion" class="accordion">

                        <!-- FAQ 1 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-bs-toggle="collapse" href="#collapse1" aria-expanded="true">
                                    1. What is Pakearth?
                                </a>
                            </div>
                            <div id="collapse1" class="collapse show" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Pakearth is an online platform that allows users to post and browse real estate ads, helping buyers, sellers, and renters connect efficiently.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse2">
                                    2. How do I post an ad on Pakearth?
                                </a>
                            </div>
                            <div id="collapse2" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    To post an ad, register on our website, navigate to the "Post Ad" section, fill in the property details, upload images, and submit your listing for approval.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse3">
                                    3. Is posting an ad free?
                                </a>
                            </div>
                            <div id="collapse3" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    We offer both free and premium ad posting options. Premium listings get more visibility and additional features.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse4">
                                    4. How can I contact a property owner?
                                </a>
                            </div>
                            <div id="collapse4" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Each listing has a contact section where you can find the owner’s details or send an inquiry directly through the website.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse5">
                                    5. How do I edit or delete my ad?
                                </a>
                            </div>
                            <div id="collapse5" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Log in to your account, go to "My Listings," select the ad you want to edit or delete, and follow the on-screen instructions.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 6 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse6">
                                    6. How long will my ad be live?
                                </a>
                            </div>
                            <div id="collapse6" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Ads typically remain live for a set duration, which depends on the package you choose. You can renew or upgrade your listing if needed.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 7 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse7">
                                    7. How can I improve my ad’s visibility?
                                </a>
                            </div>
                            <div id="collapse7" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    For better visibility, use high-quality images, detailed descriptions, and consider upgrading to a premium listing.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 8 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse8">
                                    8. What should I do if I encounter fraudulent listings?
                                </a>
                            </div>
                            <div id="collapse8" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    If you come across a suspicious or fraudulent listing, report it using the "Report Ad" feature or contact our support team.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 9 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse9">
                                    9. Does Pakearth verify property listings?
                                </a>
                            </div>
                            <div id="collapse9" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    While we strive to maintain quality, we encourage users to independently verify property details before making any transactions.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 10 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse10">
                                    10. How do I contact Pakearth support?
                                </a>
                            </div>
                            <div id="collapse10" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    You can reach our support team via the "Contact Us" page, email, or phone for any queries or assistance.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 11 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse11">
                                    11. How can I reset my password?
                                </a>
                            </div>
                            <div id="collapse11" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Click on "Forgot Password" on the login page and follow the instructions to reset your password.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 12 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse12">
                                    12. Can I feature my ad at the top of search results?
                                </a>
                            </div>
                            <div id="collapse12" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Yes, we offer premium listing options to boost your ad’s visibility.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 13 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse13">
                                    13. Are there any restrictions on the type of ads I can post?
                                </a>
                            </div>
                            <div id="collapse13" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Yes, ads must comply with our terms of service and local property laws.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 14 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse14">
                                    14. How do I report a problem with my listing?
                                </a>
                            </div>
                            <div id="collapse14" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Go to "My Listings," find the ad, and select "Report a Problem" or contact our support team.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 15 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse15">
                                    15. Can I post ads for commercial properties?
                                </a>
                            </div>
                            <div id="collapse15" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Yes, we allow ads for residential, commercial, and rental properties.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 16 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse16">
                                    16. How do I update my contact information?
                                </a>
                            </div>
                            <div id="collapse16" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Log in to your account and navigate to "Profile Settings" to update your details.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 17 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse17">
                                    17. Do you offer any promotional deals for frequent advertisers?
                                </a>
                            </div>
                            <div id="collapse17" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Yes, we have special packages for bulk advertisers and real estate agencies.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 18 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse18">
                                    18. Can I post an ad on behalf of someone else?
                                </a>
                            </div>
                            <div id="collapse18" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    Yes, but ensure you have their consent and provide accurate details.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 19 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse19">
                                    19. How do I know if my ad has been approved?
                                </a>
                            </div>
                            <div id="collapse19" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    You will receive a confirmation email once your ad is approved and live.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 20 -->
                        <div class="card">
                            <div class="card-header">
                                <a class="collapsed card-link" data-bs-toggle="collapse" href="#collapse20">
                                    20. What payment methods do you accept for premium listings?
                                </a>
                            </div>
                            <div id="collapse20" class="collapse" data-bs-parent="#accordion">
                                <div class="card-body">
                                    We accept various payment methods, including credit/debit cards, bank transfers, and online payment gateways.
                                </div>
                            </div>
                        </div>

                    </div> <!-- End Accordion -->
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- section end -->

    
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

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- wow js-->
    <script src="../assets/js/wow.min.js"></script>

    <!-- feather icon js-->
    <script src="../assets/js/feather-icon/feather.min.js"></script>
    <script src="../assets/js/feather-icon/feather-icon.js"></script>

    <!-- slick js -->
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/slick-animation.min.js"></script>
    <script src="../assets/js/custom-slick.js"></script>

    <!-- Template js-->
    <script src="../assets/js/script.js"></script>

    <!-- Customizer js-->
    <script src="../assets/js/customizer.js"></script>

    <!-- Color-picker js-->
    <script src="../assets/js/color/template-color.js"></script>

</body>

</html>