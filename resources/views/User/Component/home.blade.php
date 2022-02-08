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
                        <a href="/images/video/{{$mediaItem -> media}}" class="glightbox video"><i class="lni lni-play"></i></a>
                      @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">

                <div class="content-right wow fadeInRight" data-wow-delay=".5s">
                    @foreach($aboutUs[0] as $ab => $about)
                      <span class="sub-heading">About</span>
                      <h2>{{$about['title']}}</h2>
                      {!! $about['description'] !!}
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
                              aria-selected="true"><i class="lni {{$department[$i]['icon']}}"></i> {{$department[$i][0] -> name}}</button>
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
                                            {!! $department[$i]['description'] !!}
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
                    <div class="row">
                        @foreach($service as $serv)
                          <div class="col-lg-4 col-md-6 col-12 p-0">
                              <div class="single-list custom-border-right custom-border-bottom wow fadeInUp"
                                  data-wow-delay=".2s">
                                  <img class="shape1" src="/images/service/shape1.svg" alt="#">
                                  <img class="shape2" src="/images/service/shape2.svg" alt="#">
                                  <i class="lni {{$serv['icon']}}"></i>
                                  <h4><a href="/service/{{$serv[0] -> id}}">{{$serv[0] -> name}}</a></h4>
                                  <p>{{$serv[0] -> description_title}}</p>
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
                <div class="single-achievement wow fadeInUp" data-wow-delay=".2s">
                    <i class="lni lni-apartment"></i>
                    <h3 class="counter"><span id="secondo1" class="countup" cup-end="1357">1357</span></h3>
                    <p>Hospital Rooms</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".4s">
                    <i class="lni lni-sthethoscope"></i>
                    <h3 class="counter"><span id="secondo2" class="countup" cup-end="357">357</span></h3>
                    <p>Specialist Doctors</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".6s">
                    <i class="lni lni-emoji-smile"></i>
                    <h3 class="counter"><span id="secondo3" class="countup" cup-end="2100">2100</span></h3>
                    <p>Happy Patients</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-12">
                <div class="single-achievement wow fadeInUp" data-wow-delay=".6s">
                    <i class="lni lni-certificate"></i>
                    <h3 class="counter"><span id="secondo4" class="countup" cup-end="45">45</span></h3>
                    <p>Years of Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--bootstrap js-->
<script src="/js/bootstrap.min.js"></script>
<!--Wow js -->
<script src="/js/wow.min.js"></script>
<!--Tiny js -->
<script src="/js/tiny-slider.js"></script>
<!-- Glightbox js -->
<script src="/js/glightbox.min.js"></script>
<!-- Count js -->
<script src="/js/count-up.min.js"></script>
<!-- Imagesloaded js -->
<script src="/js/imagesloaded.min.js"></script>
<!-- Isotope js -->
<script src="/js/isotope.min.js"></script>
<!-- Main js -->
<script src="/js/main.js"></script>
<script type="text/javascript">
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
        autoplay: false,
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

    //====== counter up
    var cup = new counterUp({
        start: 0,
        duration: 2000,
        intvalues: true,
        interval: 100,
        append: " ",
    });
    cup.start();

    @foreach($aboutUs[1] as $mediaItem)
      @if($mediaItem -> name === 'about_media')
        @if($mediaItem -> media !== null)
          //========= glightbox
          GLightbox({
            'href': '/images/video/{{$mediaItem -> media}}',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
          });
        @endif
      @endif
    @endforeach

    @if($achivement )
      cup.update();
    @endif
    
    //============== isotope masonry js with imagesloaded
    imagesLoaded('#container', function () {
        var elem = document.querySelector('.grid');
        var iso = new Isotope(elem, {
            // options
            itemSelector: '.grid-item',
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.grid-item'
            }
        });

        let filterButtons = document.querySelectorAll('.portfolio-btn-wrapper button');
        filterButtons.forEach(e =>
            e.addEventListener('click', () => {

                let filterValue = event.target.getAttribute('data-filter');
                iso.arrange({
                    filter: filterValue
                });
            })
        );
    });
</script>
@include('User.Component.Utils.footer')
