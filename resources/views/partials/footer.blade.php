<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Alamat</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $profile->address }}</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>Phone: (0293) 365211, Fax: (0293) 365210</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>aimpusat88@gmail.com</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@aim.nag.co.id</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>isuzu@aim.nag.co.id</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>isuzu@aim.nag.co.id</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href=""><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Jam Buka</h4>
                <h6 class="text-light">Senin - Jumat:</h6>
                <p class="mb-4">08.00 - 16.30</p>
                <h6 class="text-light">Sabtu:</h6>
                <p class="mb-0">08.00 - 12.00</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Brosur</h4>
                <p class="mb-2">
                    <i class="fa fa-folder-open me-3">
                    </i><a class="text-decoration-none text-white" href="">Unduh Brosur Brand Isuzu</a>
                </p>
                <p class="mb-2">
                    <i class="fa fa-folder-open me-3">
                    </i><a class="text-decoration-none text-white" href="">Unduh Brosur Brand Daihatsu</a>
                </p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">Tentang Armada</h4>
                <p>{{ $profile->short_description }}</p>
                <a href="" class="btn btn-primary py-3 px-5 mt-3">Read More<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    Copyright &copy; 2024, All Right Reserved. <br>
                    Made with <span class="text-primary">&#10084;</span> by Armada Mobil
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
