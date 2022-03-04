document.addEventListener('DOMContentLoaded',function (event) {
  const prev = document.getElementById('previous-btn-page-service');
  const next = document.getElementById('next-btn-page-service');
  const item = document.querySelectorAll('.item-data');
  let count_Item = item.length - 1;
  var c = 0;
  var st = []
  var btn = item[0];
  for(var data of item){
    st.push(document.getElementById(data.getAttribute('aria-controls')));
    data.addEventListener('click',function (event) {
      if(btn !== null)
        btn.className = 'page-link item-data';
      btn = this;
      c = btn.getAttribute('data-index');
      btn.className = 'page-link item-data active';

      for(var el of st){
        if(el.id === this.getAttribute('aria-controls')){
          el.className = el.className.replace(' hidden','');
        }else{
          el.className = 'row pl-4 pr-4 justify-content-center hidden';
        }
      }
    })
  }
  prev.addEventListener('click',function (event) {
    if(c-1 >= 0){
      item[c].className = 'page-link item-data';
      item[--c].click();
    }
  });
  next.addEventListener('click',function (event) {
    if(c+1 <= count_Item){
      item[c].className = 'page-link item-data';
      item[++c].click();
    }
  });
});
