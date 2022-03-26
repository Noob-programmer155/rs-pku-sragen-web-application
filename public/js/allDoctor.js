(function() {
  let filterButtons=document.querySelectorAll('.doctor-btn');imagesLoaded('#doctor-section-container',function () {var iso = new Isotope('.grid-doc',{itemSelector: '.grid-item-doc',layoutMode: 'fitRows',percentPosition: true,masonry:{columnWidth:'.grid-item-doc'}});
  filterButtons.forEach(e=>e.addEventListener('click',()=>{let filterValue=event.target.getAttribute('data-filter');iso.arrange({filter:filterValue});}));for(var i=0;i<filterButtons.length;i++){filterButtons[i].onclick=function(){var el=filterButtons[0];while(el){if(el.tagName==="BUTTON"){el.classList.remove("active");}
  el=el.nextSibling;}this.classList.add("active");};};});
})();
