@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Contact Us</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section id="contact-us" class="contact-us section">
    <div class="container">
        <div class="contact-head wow fadeInUp" data-wow-delay=".4s">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3>Contact</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">We’re connected all time to help our patients
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="single-head">
                        <h2 class="main-title">Contact Information</h2>
                        <div class="single-info">
                            <h3>Medical Address</h3>
                            <div class="info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <ul>
                                <li>{{$global[2] -> description}}</li>
                            </ul>
                        </div>
                        <div class="single-info">
                            <h3>Opening hours</h3>
                            <div class="info-icon">
                                <i class="lni lni-timer"></i>
                            </div>
                            <ul>
                                @foreach($time_works as $time)
                                  @php
                                    $times = explode(',',$time -> description);
                                    $time -> day = $times[0];
                                    $time -> time = $times[1];
                                  @endphp
                                    <li>{{$time -> day}} <span>|</span> {{$time -> time}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="single-info">
                            <h3>Email Support & Telp</h3>
                            <div class="info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <ul>
                                <li><a href="mailto:{{$global[0] -> description}}">{{$global[0] -> description}}</a></li>
                                <li><span>Or</span></li>
                                <li><a href="tel:{{$global[1] -> description}}">{{$global[1] -> description}}</a></li>
                            </ul>
                        </div>
                        <div class="single-info contact-social">
                            <h3>Social contact</h3>
                            <div class="info-icon">
                                <i class="lni lni-mobile"></i>
                            </div>
                            <ul>
                                @foreach($social_global as $social)
                                  <li><a href="{{$social -> description}}"><i class="lni lni-{{$social -> name}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('User.Component.Utils.footerHome')

<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>

@include('User.Component.Utils.footer')
