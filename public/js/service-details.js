 $(window).on('load', function() {
  const gligh = GLightbox({
    selector: '.glightbox3',
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
  const btnPrev =  document.getElementById("service-detail-images-prev-btn");
  const btnNext =  document.getElementById("service-detail-images-next-btn");
  const elem = $(".item-image-container-root");
  const subEl = document.getElementById("item-image-service-detail-container");
  const subEl2 = $("#item-image-service-detail-container");
  let childrens = null;
  let initItemSize = 0;
  let initCountChild = 0;
  let size = null;
  let pre = null;
  let c = 0;
  btnPrev.addEventListener('click', function () {
    if(!size && !pre && !childrens){
      childrens = subEl2[0].children;
      initItemSize = childrens[0].offsetWidth;
      size = parseInt(elem.css('max-width').match(/[0-9]+/));
      initCountChild = size/initItemSize;
      pre = elem.css('max-width').match(/[a-z]+/)[0];
    }
    if(c+initCountChild <= 0){
      subEl.style.left = `${((c+initCountChild)*initItemSize)}${pre}`;
      c+=initCountChild;
    }
  });
  btnNext.addEventListener('click', function () {
    if(!size && !pre && !childrens){
      childrens = subEl2[0].children;
      initItemSize = childrens[0].offsetWidth;
      size = parseInt(elem.css('max-width').match(/[0-9]+/));
      initCountChild = size/initItemSize;
      pre = elem.css('max-width').match(/[a-z]+/)[0];
    }
    if(c-initCountChild > -1*childrens.length){
      subEl.style.left = `${((c-initCountChild)*initItemSize)}${pre}`;
      c-=initCountChild;
    }
  });
});
