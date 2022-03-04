@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Projects</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Projects</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="portfolio-section section">
    <div id='portfolio-section-container' class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Projects</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Here is Some of our <br>Latest Cases</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id='portfolio-btn-wrapper' class="portfolio-btn-wrapper wow fadeInUp" data-wow-delay=".4s">
                    <button class="portfolio-btn active" data-filter="*">Show All</button>
                    @foreach($projects[0] as $proj)
                      <button class="portfolio-btn" data-filter=".{{$proj->name}}">{{$proj->name}}</button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row grid-proj" style="margin-top:80px;">
            @foreach($projects[1] as $proj)
                <div class="col-lg-4 col-md-6 grid-item-proj {{$proj -> name}}">
                    <div class="portfolio-item-wrapper">
                        <div class="portfolio-img">
                            <img src="/images/portfolio/{{$proj -> image_init}}" alt="{{$proj -> title}}">
                        </div>
                        <div class="portfolio-overlay">
                            <div class="pf-content">
                                <a href="/proyek/{{$proj -> title}}?idproj={{$proj -> id}}" class="detail-btn"><i class="lni lni-link"></i></a>
                                <span class="category">{{$proj -> name}}</span>
                                <h4><a href="/proyek/{{$proj -> title}}?idproj={{$proj -> id}}">{{$proj -> title}}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('User.Component.Utils.footerHome')

<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<script src="{{asset('js/glightbox.js')}}"></script>
<!-- Imagesloaded js -->
<script src="{{asset('js/imagesloaded.min.js')}}"></script>
<!-- Isotope js -->
<script src="{{asset('js/isotope.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<!-- Project js -->
<script src="{{asset('js/projectAll.js')}}"></script>

@include('User.Component.Utils.footer')
