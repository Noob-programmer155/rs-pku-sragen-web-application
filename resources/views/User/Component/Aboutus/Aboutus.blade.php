@include("User.Component.Utils.header")

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">About Us</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="about-us section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="content-left wow fadeInLeft" data-wow-delay=".3s">
                  <img src="/images/about/{{$aboutUs[1][0] -> media}}" alt="{{$aboutUs[1][0] -> name}}">
                  <a href="/images/video/{{$aboutUs[1][1] -> media}}" class="glightbox1"><div class="video"><i class="lni lni-play"></i></div></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="content-right wow fadeInRight" data-wow-delay=".5s">
                    @foreach($aboutUs[0] as $ab => $about)
                      <span class="sub-heading">About</span>
                      <h2>{{$about -> title}}</h2>
                      {!! $about -> description !!}
                      <!-- view raw description  -->
                      <!-- {{$about['description']}} -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="our-achievement section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".2s" data-count-delay=".2s">
                    <i class="lni lni-apartment"></i>
                    <h3><div id="secondo1-about" class="countup" cup-end="{{$achivement['total_rooms']}}">{{$achivement['total_rooms']}}</div></h3>
                    <p>Hospital Rooms</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".4s" data-count-delay='.4s'>
                    <i class="lni lni-sthethoscope"></i>
                    <h3><span id="secondo2-about" class="countup" cup-end="{{$achivement['doc_count']}}">{{$achivement['doc_count']}}</span></h3>
                    <p>Specialist Doctors</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".6s" data-count-delay='.6s'>
                    <i class="lni lni-emoji-smile"></i>
                    <h3><span id="secondo3-about" class="countup" cup-end="{{$achivement['patient_count']}}">{{$achivement['patient_count']}}</span></h3>
                    <p>Happy Patients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".8s" data-count-delay='.8s'>
                    <i class="lni lni-certificate"></i>
                    <h3><span id="secondo4-about" class="countup" cup-end="{{$achivement['year_exp']}}">{{$achivement['year_exp']}}</span></h3>
                    <p>Years of Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="doctors section">
    <div class="container">
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
            @foreach($our_doctors as $doctor)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-doctor wow fadeInUp" data-wow-delay=".2s">
                        <div class="image">
                            <img src="/images/doctors/{{$doctor[0] -> image}}" alt="#">
                            <ul class="social">
                                @foreach($doctor[1] as $social)
                                    <li><a href="{{$social -> link}}"><i class="lni lni-{{$social -> social}}"></i></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="content">
                            <h5>{{$doctor[0] -> profession}}</h5>
                            <h3><a href="/dokter/{{$doctor[0] -> username}}?iddoc={{$doctor[0] -> id}}">{{$doctor[0] -> username}}</a></h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <a href="/dokter-kami"> >>> View More</a>
        </div>
    </div>
</section>

<section class="testimonials section">
    <div class="container" style="max-width:95vw">
        <div class="row">
            <div class="col-12">
                <div class="section-title align-center gray-bg">
                    <h3>testimonials</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">What People Say</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row testimonial-slider">
            @foreach($testimony as $response_Patient)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="single-testimonial">
                        <div class="text">
                            <div class="quote-icon">
                                <i class="lni lni-quotation"></i>
                            </div>

                            <p>{{$response_Patient -> description}}</p>
                        </div>
                        <div class="author">
                            <img src="/images/testimonial/{{$response_Patient -> image}}" alt="{{$response_Patient -> name}}">
                            <h4 class="name">
                                {{$response_Patient -> name}}
                                <span class="deg">{{$response_Patient -> patient_type}}</span>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="client-logo-section">
    <div class="container">
        <div class="client-logo-wrapper">
            <div class="
          client-logo-carousel
          d-flex
          align-items-center
          justify-content-between">
                <div class="client-logo">
                    <img src="/images/clients/client-logo-1.png" alt="#" />
                </div>
                <div class="client-logo">
                    <img src="/images/clients/client-logo-2.png" alt="#" />
                </div>
                <div class="client-logo">
                    <img src="/images/clients/client-logo-3.png" alt="#" />
                </div>
                <div class="client-logo">
                    <img src="/images/clients/client-logo-4.png" alt="#" />
                </div>
                <div class="client-logo">
                    <img src="/images/clients/client-logo-2.png" alt="#" />
                </div>
                <div class="client-logo">
                    <img src="/images/clients/client-logo-3.png" alt="#" />
                </div>
                <div class="client-logo">
                    <img src="/images/clients/client-logo-4.png" alt="#" />
                </div>
            </div>
        </div>
    </div>
</div>

@include("User.Component.Utils.footerHome")
<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<!--Tiny js -->
<script src="{{asset('js/tiny-slider.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<!-- Count js -->
<script src="{{asset('js/count-up.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<!-- Aboutus js -->
<script src="{{asset('js/aboutus.js')}}"></script>
<script type="text/javascript">
    //========= testimonial
    tns({
        container: '.testimonial-slider',
        items: 3,
        slideBy: 'page',
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 0,
        nav: true,
        controls: false,
        controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1170: {
                items: 3,
            }
        }
    });
    //====== Clients Logo Slider
    tns({
        container: ".client-logo-carousel",
        slideBy: "page",
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 15,
        nav: false,
        controls: false,
        responsive: {
            0: {
                items: 1,
            },
            540: {
                items: 3,
            },
            768: {
                items: 4,
            },
            992: {
                items: 4,
            },
            1170: {
                items: 6,
            },
        },
    });
    document.addEventListener('DOMContentLoaded',function (event) {
      GLightbox({
        selector: '.glightbox1',
        plyr: {
          css: 'https://cdn.plyr.io/3.5.6/plyr.css', // Default not required to include
          js: 'https://cdn.plyr.io/3.5.6/plyr.js', // Default not required to include
          config: {
            ratio: '16:9', // or '4:3'
            muted: false,
            hideControls: true,
            youtube: {
              noCookie: true,
              rel: 0,
              showinfo: 0,
              iv_load_policy: 3
            },
            vimeo: {
              byline: false,
              portrait: false,
              title: false,
              speed: true,
              transparent: false
            }
          }
        }
      });
    });
</script>

@include('User.Component.Utils.footer')
