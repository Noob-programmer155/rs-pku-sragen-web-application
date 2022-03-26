@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Department</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/projects">Projects</a></li>
                    <li>{{$projects[0]['data'] -> title}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-details">
    <div class="container">
        <div class="content">
            <div class="row">
                <article class="col-lg-8 col-md-12 col-12">
                    <section class="details-content">
                        <div class="thumb">
                            <img src="/images/project/{{$projects[0]['images'][0] -> media}}" alt="$projects[0]['data'] -> title">
                        </div>
                        <h3 class="title">About this Project</h3>
                        <span>Title Project <h5>{{$projects[0]['data'] -> title}}</h5></span>
                        {!! $projects[0]['data'] -> description !!}
                    </section>
                </article>
                <aside class="col-lg-4 col-md-12 col-12">
                    <div class="portfolio-sidebar">
                        <section class="single-widget researcher-details">
                            <h3>About Researcher</h3>
                            <div class="author-box">
                                <div class="container-img">
                                  <a href="/doctor/{{$projects[0]['data'] -> researcher -> username}}?iddoc={{$projects[0]['data'] -> researcher -> id}}"><img src="/images/doctors/{{$projects[0]['data'] -> researcher -> image}}"
                                    alt="{{$projects[0]['data'] -> researcher -> username}}"></a>
                                </div>
                                <h6><a href="/doctor/{{$projects[0]['data'] -> researcher -> username}}?iddoc={{$projects[0]['data'] -> researcher -> id}}">{{$projects[0]['data'] -> researcher -> username}}</a></h6>
                                <p class="fw-500">{{$projects[0]['data'] -> researcher -> wise_words}}</p>
                                <ul class="social">
                                  @foreach($projects[0]['socials'] as $socials)
                                    <li><a href="{{$socials -> link}}"><i class="lni lni-{{$socials -> social}}"></i></a></li>
                                  @endforeach
                                </ul>
                            </div>
                        </section>
                        <section class="single-widget">
                            <h3>Research Details</h3>
                            <table class="list-info">
                              <tbody>
                                <tr>
                                  <td><i class="lni lni-files"></i></td>
                                  <td><span>Research Title :</span> {{$projects[0]['data'] -> researcher -> resTitle}}</td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-user"></i></td>
                                  <td><span>Researcher Name :</span> {{$projects[0]['data'] -> researcher -> username}}</td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-users"></i><td>
                                  <td><span>Client :</span> {{$projects[0]['data'] -> researcher -> resClient}}</td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-pencil-alt"></i></td>
                                  <td><span>Category : </span> {{$projects[0]['data'] -> researcher -> resCategory}}</td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-calendar"></i></td>
                                  <td><span>Research Year :</span> {{$projects[0]['data'] -> researcher -> resDate}}</td>
                                </tr>
                                <tr>
                                  <td><i class="lni lni-map-marker"></i></td>
                                  <td><span>Location : </span> {{$projects[0]['data'] -> researcher -> resLocation}}</td>
                                </tr>
                              </tbody>
                            </table>
                        </section>
                    </div>
                </aside>
                <section class="container image pt-1">
                  <div class="row">
                    <h4>Gallery</h4>
                    <div class="container-image">
                      <button id="department-detail-images-prev-btn">
                        <svg
                        class="reverse"
                        xmlns="http://www.w3.org/2000/svg"
                        height="4rem"
                        viewBox="0 50 400 250"
                        width="4rem"
                        style="--rotate:-90deg"><path d="M 50 300 L 350 300 Q 400 300 400 250 L 200 50 L 0 250 Q 0 300 50 300 L 350 300 "/></svg>
                      </button>
                      <div class="item-image-container-root">
                        <div id="item-image-department-detail-container" class="item-image-container">
                          @for($i=0;$i < count($projects[0]['images']);$i++)
                            <div class="item-image">
                              <a href="/images/project/{{$projects[0]['images'][$i] -> media}}" class="glightbox3">
                                <img src="/images/project/{{$projects[0]['images'][$i] -> media}}" alt="{{$projects[0]['data'] -> title}}">
                              </a>
                            </div>
                          @endfor
                        </div>
                      </div>
                      <button id="department-detail-images-next-btn"><svg
                        class="reverse"
                        xmlns="http://www.w3.org/2000/svg"
                        height="4rem"
                        viewBox="0 50 400 250"
                        width="4rem"
                        style="--rotate:90deg"><path d="M 50 300 L 350 300 Q 400 300 400 250 L 200 50 L 0 250 Q 0 300 50 300 L 350 300 "/></svg>
                      </button>
                    </div>
                  </div>
                </section>
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
<script src="{{asset('js/glightbox.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<!-- Home js -->
<script src="{{asset('js/project.js')}}"></script>

@include('User.Component.Utils.footer')
