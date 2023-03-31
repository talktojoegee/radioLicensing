<!-- Start Footer -->
<footer class="section-padding bg-custom-white footer-style-1 bg-light-blue">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="footer-box mb-md-40">
                    <div class="logo">
                        <a href="#">
                            <img src="{{'/storage/'.$account->logo ?? 'https://via.placeholder.com/152x42' }}" class="img-fluid image-fit" alt="{{$account->organization_name ?? '' }}">
                        </a>
                    </div>
                    <p class="text-custom-black no-margin">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-info mb-md-40">
                    <h5 class="text-custom-black fw-600">Working Time</h5>
                    <p class="no-margin text-custom-black fs-14">
                        Mon - Wed: <span class="text-custom-black fw-600">9:00 AM - 7:00 PM</span><br>
                        Thursday: <span class="text-custom-black fw-600">9:00 AM - 6:30 PM</span><br>
                        Friday: <span class="text-custom-black fw-600">9:00 AM - 6:00 PM</span><br>
                        Sat - Sun: <span class="text-custom-black fw-600">Closed</span>
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-info mb-sm-40">
                    <h5 class="text-custom-black fw-600">Emergency Cases</h5>
                    <h4 class="text-light-blue fw-600">1-800-123-4567</h4>
                    <p class="no-margin text-custom-black fs-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    </p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="footer-info">
                    <h5 class="text-custom-black fw-600">Our Location</h5>
                    <p class="text-custom-black fs-14">9000 Regency Parkway,<br>Suite 400 Cary</p>
                    <p class="no-margin text-custom-black fs-14">
                        Email: <a href="#" class="text-custom-black fw-600">info@domain.com</a><br>
                        Phone: <a href="#" class="text-custom-black fw-600">+(347) 123 456 7890</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
<!-- Start Copyright -->
<div class="copyright-style-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <p class="text-custom-black">
                    © {{date('Y')}} <a href="http://slidesigma.com/" class="fw-600" target="_blank">{{env('APP_NAME')}}</a> All Rights Reserved
                </p>
            </div>
            <div class="col-md-6">
                <div class="social-media mb-xl-20">
                    <ul class="custom">
                        <li><a href="#" class="text-light-grey fs-14"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="text-light-grey fs-14"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="text-light-grey fs-14"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#" class="text-light-grey fs-14"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Copyright -->
<!-- back to top -->
<div id="back-top" class="back-top">
    <a href="#top"><i class="flaticon-up-arrow"></i></a>
</div>
