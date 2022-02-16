@include('User.Component.Utils.header')

<section class="hero-area style2">
    <div class="hero-slider">
        @foreach($carousel_main as $carousel)
            <div class="single-slider">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="hero-text wow fadeInLeft" data-wow-delay=".3s">
                                <div class="section-heading">
                                    <h2 class="wow fadeInLeft" data-wow-delay=".3s">{{$carousel -> title}}</h2>
                                    <p class="wow fadeInLeft" data-wow-delay=".5s">{{$carousel -> description}}</p>
                                    <div class="button wow fadeInLeft" data-wow-delay=".7s">
                                        <a href="/make-appointment" class="btn">Book Appointment</a>
                                        <a href="/about-us" class="btn alt">About Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="hero-image wow fadeInRight" data-wow-delay=".5s">
                                <!-- masih kosong -->
                                <!-- <img src="url/{{$carousel -> image}}" alt="{{$carousel -> title}}"> -->
                                <img src="/images/hero/{{$carousel -> image}}" alt="{{$carousel -> image}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="appointment">
    <div class="container">

        <div class="appointment-form">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="appointment-title">
                        <span>Appointment</span>
                        <h2>Book An Appointment</h2>
                        <p>Please feel welcome to contact our friendly reception staff with any general or medical
                            enquiry. Our doctors will receive or return any urgent calls.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 custom-padding">
                    <div class="appointment-btn button">
                        <a class="btn" href="/make-appointment">Get Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-us section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="content-left wow fadeInLeft" data-wow-delay=".3s">
                    @foreach($aboutUs[1] as $mediaItem)
                      @if($mediaItem -> name === 'about_img')
                        <img src="/images/about/{{$mediaItem -> media}}" alt="{{$mediaItem -> name}}">
                      @else
                        <a id='vid_about_us_home' href="/images/video/{{$mediaItem -> media}}" class="glightbox video"><i class="lni lni-play"></i></a>
                      @endif
                    @endforeach
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
                      <div class="button">
                          <a href="/about-us" class="btn">More About Us</a>
                      </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="departments section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Departments</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Specialities available at Medicapps</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @for ($i = 0; $i < count($department); $i++)
                      <li class="nav-item" role="presentation">
                          <button class="nav-link @if($i<=0){{'active'}}@endif" id="main-{{$department[$i][0] -> name}}-tab" data-bs-toggle="tab"
                              data-bs-target="#panel-main-{{$department[$i][0] -> name}}" type="button" role="tab" aria-controls="panel-main-{{$department[$i][0] -> name}}"
                              aria-selected="true"><i class="lni {{$department[$i][0] -> icon}}"></i> {{$department[$i][0] -> name}}</button>
                      </li>
                    @endfor
                </ul>
                <div class="tab-content" id="myTabContent">
                    @for ($i = 0; $i < count($department); $i++)
                        <div class="tab-pane fade @if($i<=0){{'show active'}}@endif" id="panel-main-{{$department[$i][0] -> name}}" role="tabpanel"
                            aria-labelledby="main-{{$department[$i][0] -> name}}-tab">
                            <div class="department-content">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="image w-100">
                                            <img src="/images/departments/{{$department[$i][0] -> image}}" alt="{{$department[$i][0] -> name}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="text">
                                            <h3>{{$department[$i][0] -> name}}</h3>
                                            {!! $department[$i][0] -> description !!}
                                            <div class="d-md-flex d-lg-flex d-block align-items-center mt-15">
                                                <div class="rating">
                                                    <h4>Department Rating</h4>
                                                    <div class="container mt-15 mb-0 p-0">
                                                        {{$department[$i]['rating']['rating']}}/
                                                        <div class="star">
                                                            <div>
                                                                &nbsp;
                                                                @for($r=1;$r<=4;$r++)
                                                                  @if($r <= $department[$i]['rating']['rating'])
                                                                    <i class="lni lni-star-filled full"></i>
                                                                  @elseif($r > $department[$i]['rating']['rating']+1)
                                                                    <i class="lni lni-star part"></i>
                                                                  @else
                                                                  <i class="lni lni-star full"></i>
                                                                  <i class="lni lni-star-filled part full"
                                                                    style="--range:@php echo substr($department[$i]['rating']['rating'],2) . '0%;' @endphp"></i>
                                                                  @endif
                                                                @endfor
                                                            </div>
                                                            &nbsp;4.0<span>&nbsp;&nbsp;<i class="lni lni-user"></i>
                                                            {{$department[$i]['rating']['total']}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="flex-grow:1;"></div>
                                                <div class="button">
                                                    <a href="/department/{{$department[$i][0] -> id}}" class="btn">View Speciality</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Service</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">Pelayanan Kami</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="services-content">
                    <div class="row pl-4 pr-4 justify-content-center">
                        @foreach($service as $serv)
                          <div class="col-lg-4 col-md-6 col-12 p-0">
                              <div class="single-list custom-border-right wow fadeInUp m-0"
                                  data-wow-delay=".2s">
                                  <img class="shape1" src="/images/service/shape1.svg" alt="#">
                                  <img class="shape2" src="/images/service/shape2.svg" alt="#">
                                  <i class="lni {{$serv -> icon}}"></i>
                                  <h4><a href="/service/{{$serv -> id}}">{{$serv -> name}}</a></h4>
                                  <p>{{$serv -> description_title}}</p>
                              </div>
                          </div>
                        @endforeach
                    </div>
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
                    <h3><div id="secondo1" class="countup" cup-end="{{$achivement['total_rooms']}}">{{$achivement['total_rooms']}}</div></h3>
                    <p>Hospital Rooms</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".4s" data-count-delay='.4s'>
                    <i class="lni lni-sthethoscope"></i>
                    <h3><span id="secondo2" class="countup" cup-end="{{$achivement['doc_count']}}">{{$achivement['doc_count']}}</span></h3>
                    <p>Specialist Doctors</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".6s" data-count-delay='.6s'>
                    <i class="lni lni-emoji-smile"></i>
                    <h3><span id="secondo3" class="countup" cup-end="{{$achivement['patient_count']}}">{{$achivement['patient_count']}}</span></h3>
                    <p>Happy Patients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".8s" data-count-delay='.8s'>
                    <i class="lni lni-certificate"></i>
                    <h3><span id="secondo4" class="countup" cup-end="{{$achivement['year_exp']}}">{{$achivement['year_exp']}}</span></h3>
                    <p>Years of Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

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
                                <a href="/projects/{}" class="detail-btn"><i class="lni lni-link"></i></a>
                                <span class="category">{{$proj -> name}}</span>
                                <h4><a href="/projects/{}">{{$proj -> title}}</a></h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="testimonials style2 section">
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
                            <h3><a href="/doctors/{}">{{$doctor[0] -> username}}</a></h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="how-works">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12 p-0">

                <div class="single-work first">
                    <div class="main-icon">
                        <i class="lni lni-agenda"></i>
                    </div>
                    <h3>Best Monitoring System</h3>
                    <p>Despite advances in technology and understanding of biological systems, drug discovery is
                        still a lengthy, expensive.</p>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-12 p-0">

                <div class="single-work middle">
                    <div class="main-icon">
                        <i class="lni lni-hospital"></i>
                    </div>
                    <h3>Advanced Operating Room</h3>
                    <p>Despite advances in technology and understanding of biological systems, drug discovery is
                        still a lengthy, expensive.</p>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-12 p-0">

                <div class="single-work last">
                    <div class="main-icon">
                        <i class="lni lni-sthethoscope"></i>
                    </div>
                    <h3>Only Best Doctors</h3>
                    <p>Despite advances in technology and understanding of biological systems, drug discovery is
                        still a lengthy, expensive.</p>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="latest-news-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h3>Blogs</h3>
                    <h2 class="wow fadeInUp" data-wow-delay=".4s">latest news</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                @foreach($blogs[0] as $blog)
                    <div class="single-news style2 wow fadeInUp" data-wow-delay=".4s">
                        <div class="row">
                            <div class="col-12">
                                <div class="image">
                                    <a href="/blog/{}"><img src="/images/blog/{{$blog[1][0] -> media}}"
                                            alt="{{$blog[0] -> title}}"></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="content">
                                    <h2 class="title"><a href="/blog/{}">{{$blog[0] -> title}}</a></h2>
                                    <div class="description">{!! $blog[0] -> description !!}</div>
                                    <ul class="meta-info">
                                        <li>
                                            <a href="/doctors/{}">
                                              <img src="/images/doctors/{{$blog[0] -> doc_image}}" alt="#">
                                              {{$blog[0] -> doc_username}}</a>
                                        </li>
                                        <li>
                                            <span style="color:#fff">{{$blog[0] -> date}}</span>
                                        </li>
                                        <li>
                                            <i class="lni lni-eye" style="color:#fff"></i>
                                            <span style="color:#fff">{{$blog[0] -> views}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                @foreach($blogs[1] as $blog)
                    @if($blog !== null)
                        <div class="single-news wow fadeInUp" data-wow-delay=".2s">
                          <div class="row">
                              <div class="col-lg-5 col-md-5 col-12 pr-0">
                                  <div class="image">
                                      <a href="/blog/{}"><img src="/images/blog/{{$blog[1][0] -> media}}"
                                              alt="{{$blog[0] -> title}}"></a>
                                  </div>
                              </div>
                              <div class="col-lg-7 col-md-7 col-12 pl-0">
                                  <div class="content">
                                      <h2 class="title"><a href="/blog/{}">{{$blog[0] -> title}}</a></h2>
                                      <div class="description">{!! $blog[0] -> description !!}</div>
                                      <ul class="meta-info">
                                          <li>
                                              <a href="/doctors/{}">
                                                <img src="/images/doctors/{{$blog[0] -> doc_image}}" alt="#">
                                                {{$blog[0] -> doc_username}}</a>
                                          </li>
                                          <li>
                                              <span>{{$blog[0] -> date}}</span>
                                          </li>
                                          <li>
                                              <i class="lni lni-eye"></i>
                                              <span>{{$blog[0] -> views}}</span>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('User.Component.Utils.footerHome')

<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<!--Tiny js -->
<script src="{{asset('js/tiny-slider.js')}}"></script>
<!-- Glightbox js -->
<script src="{{asset('js/glightbox.min.js')}}"></script>
<!-- Count js -->
<script src="{{asset('js/count-up.min.js')}}"></script>
<!-- Imagesloaded js -->
<script src="{{asset('js/imagesloaded.min.js')}}"></script>
<!-- Isotope js -->
<script src="{{asset('js/isotope.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>

<script>
    //======== Hero Slider
    var slider = new tns({
        container: '.hero-slider',
        slideBy: 'page',
        autoplay: true,
        autoplayButtonOutput: false,
        mouseDrag: true,
        gutter: 0,
        items: 1,
        nav: false,
        controls: true,
        controlsText: [
            '<i class="lni lni-chevron-left"></i>',
            '<i class="lni lni-chevron-right"></i>'
        ],
        responsive: {
            1200: {
                items: 1,
            },
            992: {
                items: 1,
            },
            0: {
                items: 1,
            }

        }
    });
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
    //========= glightbox
    @foreach($aboutUs[1] as $mediaItem)
      @if($mediaItem -> name === 'about_media')
        GLightbox({
            'href': '/images/video/{{$mediaItem -> media}}',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });
      @endif
    @endforeach
</script>

@include('User.Component.Utils.footer')
