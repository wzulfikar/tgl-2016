<!DOCTYPE html>
<html lang="en">

<head>
@include('layout.head')
@stack('head')
</head>

<body id="page-top" class="index">

    @include('layout.nav')

    {{-- 
    <!-- Header -->
    <header>
      @include('layout.banner')
    </header>
    --}}
    
    @section('content')
    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Portfolio</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cabin.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/cake.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/circus.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/game.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/safe.png" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <i class="fa fa-search-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="img/portfolio/submarine.png" class="img-responsive" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    @show

    {{-- @include('layout.footer') --}}

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    
    <script src="{{ bower() }}/underscore/underscore-min.js"></script>
    <script src="{{ bower() }}/PACE/pace.min.js"></script>
    
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyBYUTX2BMi7YeXkQj2PbEl_V2ORd-iNhu8"></script>
    <script src="{{ bower() }}/gmaps/gmaps.min.js"></script>
    <script src="{{ bower() }}/jquery/dist/jquery.min.js"></script>
    <script src="{{ bower() }}/growl/javascripts/jquery.growl.js"></script>

    <script src="{{ bower() }}/growl/javascripts/jquery.growl.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ bower() }}/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="{{ bower() }}/easing/easing-min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ urlS() }}/js/jqBootstrapValidation.js"></script>
    <script src="{{ urlS() }}/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="{{ urlS() }}/js/freelancer.min.js"></script>
    
    @stack('script')

</body>

</html>
