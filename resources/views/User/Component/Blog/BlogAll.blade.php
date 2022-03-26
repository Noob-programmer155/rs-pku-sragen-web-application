@include('User.Component.Utils.header')
<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Blogs</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="section latest-news-area blog-list">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-12">

                <div class="search-container-blog">
                    <div id="form-search-blog">
                        <input id='search-field-blog' type="text" placeholder="Search blog...">
                        <button id='btn-search-blog' type="button"><i class="lni lni-search"></i></button>
                    </div>
                </div>

                <div id="search-item-container-blog" class="search-item-container">
                    <div class="search-item-subcontainer">
                    </div>
                </div>

                <div id="container-blog-all-item" class="container-blog-items"></div>

                <div id='blog-grid-page-container' class="pagination left blog-grid-page">
                    <ul class="pagination-list">
                      <li><a id='item-pagination-list-prev'>Prev</a></li>
                      @for($i=0;$i < $count_page;$i++)
                        <li class="item-pagination" style="width:0px;"></li>
                      @endfor
                      <li><a id='item-pagination-list-next'>Next</a></li>
                    </ul>
                    <span id="page-identity"></span>
                </div>
            </div>
            <aside class="col-lg-4 col-md-12 col-12">
                <div class="sidebar blog-grid-page">

                    <div class="widget search-widget">
                        <h5 class="widget-title">Search This Site</h5>
                        <form action="https://www.google.com/search" method="get" target="_blank">
                            <input type="text" name="q" placeholder="Search Here...">
                            <button type="submit"><i class="lni lni-search-alt"></i></button>
                        </form>
                    </div>

                    <div class="widget popular-feeds">
                        <h5 class="widget-title">Popular Feeds</h5>
                        <div class="popular-feed-loop">
                            @foreach($popular_blogs as $blog)
                                <div class="single-popular-feed">
                                    <div class="feed-desc">
                                        <a class="feed-img" href="/blog/{{$blog -> title}}?idbl={{$blog -> id}}">
                                            <img src="/images/blog/{{$blog -> image_home}}" alt="{{$blog -> title}}">
                                        </a>
                                        <div>
                                            <h6 class="post-title"><a href="/blog/{{$blog -> title}}?idbl={{$blog -> id}}">
                                              {{$blog -> title}}</a></h6>
                                            <span class="time"><i class="lni lni-calendar"></i> {{$blog -> dates_upload}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="widget popular-tag-widget">
                        <h5 class="widget-title">Popular Tags</h5>
                        <div class="tags">
                            @foreach($popular_tags as $tag)
                                <a class="popular-tag-item" data-name="{{$tag -> name}}">{{$tag -> name}}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="widget help-call">
                        <h5 class="widget-title">Need Help?</h5>
                        <div class="inner">
                            <h3>
                                Online Help!
                                <a href="tel:{{$global[1] -> description}}">{{$global[1] -> description}}</a>
                            </h3>
                        </div>
                    </div>

                </div>
            </aside>
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
<!-- BlogAll js -->
<script src="{{asset('js/blogAll.js')}}"></script>

@include('User.Component.Utils.footer')
