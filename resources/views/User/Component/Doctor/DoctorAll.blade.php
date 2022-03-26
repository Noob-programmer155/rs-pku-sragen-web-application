@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Doctors</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Our Doctor</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="doctor-section section">
    <div id='doctor-section-container' class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Doctors</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Our Outstanding Team Is Active To Help You!</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id='doctor-btn-wrapper' class="doctor-btn-wrapper wow fadeInUp" data-wow-delay=".4s">
                    <h4>Pilih Department</h4>
                    <button class="doctor-btn active" data-filter="*">Show All Doctor</button>
                    @foreach($doctors['department'] as $dept)
                      <button class="doctor-btn" data-filter=".{{$dept->name}}">{{$dept->name}}<i class="lni {{$dept->icon}}"></i></button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row grid-doc" style="margin-top:80px;">
            @foreach($doctors['doctor'] as $doc)
                <div class="col-lg-3 col-md-6 col-12 grid-item-doc {{$doc -> department}}">
                    <a href="/doctor/{{$doc -> username}}?iddoc={{$doc -> id}}">
                        <div class="single-doctor wow fadeInUp" data-wow-delay=".2s">
                            <div class="image">
                                <img src="/images/doctors/{{$doc -> image}}" alt="{{$doc -> username}}">
                            </div>
                            <div class="content">
                                <h5>{{$doc -> profession}}</h5>
                                <h3>{{$doc -> username}}</h3>
                            </div>
                        </div>
                    </a>
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
<!-- Imagesloaded js -->
<script src="{{asset('js/imagesloaded.min.js')}}"></script>
<!-- Isotope js -->
<script src="{{asset('js/isotope.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/allDoctor.js')}}"></script>

@include('User.Component.Utils.footer')
