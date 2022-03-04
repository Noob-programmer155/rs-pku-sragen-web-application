(function() {
  let filterButtons=document.querySelectorAll('.portfolio-btn');imagesLoaded('#portfolio-section-container',function () {var iso = new Isotope('.grid-proj',{itemSelector: '.grid-item-proj',masonry:{columnWidth:'.grid-item-proj'}});
  filterButtons.forEach(e=>e.addEventListener('click',()=>{let filterValue=event.target.getAttribute('data-filter');iso.arrange({filter:filterValue});}));for(var i=0;i<filterButtons.length;i++){filterButtons[i].onclick=function(){var el=filterButtons[0];while(el){if(el.tagName==="BUTTON"){el.classList.remove("active");}
  el=el.nextSibling;}this.classList.add("active");};};});
})();
