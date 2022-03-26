async function getData(startDate,endDate,mount,nameSuggest) {
  try {
    let response = null
    if(nameSuggest){
      response = await fetch(`${window.location.origin}/search/item?s=${nameSuggest}`);
    }else{
      response = await fetch(`${window.location.origin}/blog/item/${startDate}/${endDate}?mount=${mount}`);
    }
    if (response) {
      return response.json();
    }
  } catch (e) {
    alert(e.message);
  }
}

function getSuggest(name,timeout) {
  return new Promise((resolve,reject) => {
    clearTimeout(timeout);
    timeout = setTimeout(async function () {
      try {
        const res = await fetch(`${window.location.origin}/sugestion/search?q=${name}`);
        if(res){
          resolve(res.json());
        }else{
          resolve([""]);
        }
      } catch (e) {
        reject(e);
      }
    }, 500);
  });
}

function setSuggestField(elem) {
  document.getElementById('search-field-blog').value = elem.getAttribute('data-item');
  let suggestionContainer = document.getElementById('search-item-container-blog');
  suggestionContainer.className = suggestionContainer.className.replace(' active','');
}

const end = "</div></div></div></div></div>";
const tags = (data) => {
  return `<span>#${data}</span>`
};
const elemHTML = (data) => {
  return `<div class='single-news'><div class='row'>
  <div class='col-lg-5 col-md-5 col-12 pr-0'><div class='image'>
  <a href='/blog/${data.title}?idbl=${data.id}'><img src='/images/blog/${data.image}'
  alt='${data.title}'></a></div></div><div class='col-lg-7 col-md-7 col-12  pl-0'>
  <div class='content'><h2 class='title'><a href='/blog/${data.title}?idbl=${data.id}'>
  ${data.title}</a></h2>${data.description}<ul class='meta-info'><li>
  <a href='/doctor/${data.doc_username}?iddoc=${data.doc_id}'>
  <img src='/images/doctors/${data.doc_image}' alt='#'>${data.doc_username}</a></li>
  <li><span>${data.date}</span></li><li><i class='lni lni-eye'></i><span> ${data.views}</span></li>
</ul><div class='tags-blog'>`
};

function search(mainContainer,mount) {
  let timeout = null;
  let container = document.getElementById('form-search-blog');
  let search = document.getElementById('search-field-blog');
  let suggestionContainer = document.getElementById('search-item-container-blog');
  let btnSearch = document.getElementById('btn-search-blog');
  const root = document.getElementById('blog-grid-page-container');
  suggestionContainer.addEventListener('click',(e) => {
    e.preventDefault();
  });
  suggestionContainer.addEventListener('mousedown',(e) => {
    e.preventDefault();
  });
  search.addEventListener('focus',(e) => {
    container.style.borderColor = '#33ccff';
    container.style.borderRadius = '1.7rem 1.7rem 0 0';
    // suggestionContainer.style.top = `${container.getBoundingClientRect().bottom}px`;
    // suggestionContainer.style.left = `${container.getBoundingClientRect().left}px`;
    suggestionContainer.style.width = `${container.getBoundingClientRect().width}px`;
    suggestionContainer.className += ' active'
  });
  search.addEventListener('blur',(e) => {
    container.style.borderColor = '#b3b3b3';
    container.style.borderRadius = '1.7rem';
    suggestionContainer.className = suggestionContainer.className.replace(' active','');
    suggestionContainer.children[0].innerHTML = '';
  });
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  search.addEventListener('keyup', async (e) => {
    e.preventDefault();
    if(e.key === 'Enter'){
      getData(null,null,null,search.value).then((data) => {
        if(data.length > 0){
          let i = 0;
          let element = "";
          for(item of data){
            if(i >= mount-1){
              last_date = item.date;
            }else if (i <= 0) {
              first_date = item.date;
            }
            item['date'] = new Date(item.date).toLocaleDateString("ID",options);
            element += elemHTML(item);
            for(var tag of item.tags){
              element += tags(tag.name);
            }
            element+=end;
            i++;
          }
          mainContainer.innerHTML = element;
        }else{
          mainContainer.innerHTML = '<span>data tidak ditemukan</span>';
        }
        root.style.display = 'none';
      });
    }
    if(search.value === ""){
      root.style.display = 'flex';
      getData(0,0,mount,null).then((data) => {
        let i = 0;
        let element = "";
        for(item of data){
          if(i >= mount-1){
            last_date = item.date;
          }else if (i <= 0) {
            first_date = item.date;
          }
          item['date'] = new Date(item.date).toLocaleDateString("ID",options);
          element += elemHTML(item);
          for(var tag of item.tags){
            element += tags(tag.name);
          }
          element+=end;
          i++;
        }
        mainContainer.innerHTML = element;
      });
    }else{
      try {
        let data = await getSuggest(search.value,timeout);
        let elem = '';
        if(data !== ""){
          data.forEach((item, i) => {
            elem += `<a onclick="setSuggestField(this)" data-item="${item.title}">${item.title}</a>`;
          });
          suggestionContainer.children[0].innerHTML = elem;
        }else{
          suggestionContainer.children[0].innerHTML = '<span>data tidak ditemukan</span>';
        }
      } catch (e) {
        alert(e.message);
      }
    }
  });
  btnSearch.addEventListener('click',() => {
    getData(null,null,null,search.value).then((data) => {
      if(data.length > 0){
        let i = 0;
        let element = "";
        for(item of data){
          if(i >= mount-1){
            last_date = item.date;
          }else if (i <= 0) {
            first_date = item.date;
          }
          item['date'] = new Date(item.date).toLocaleDateString("ID",options);
          element += elemHTML(item);
          for(var tag of item.tags){
            element += tags(tag.name);
          }
          element+=end;
          i++;
        }
        mainContainer.innerHTML = element;
      }else{
        mainContainer.innerHTML = '<span>data tidak ditemukan</span>';
      }
      root.style.display = 'none';
    });
  });
}

const filterTag = null;
(function () {
  let elem = document.getElementById('container-blog-all-item');
  let mount = 7;
  search(elem,mount);
  let nextAnchor = document.getElementById('item-pagination-list-next');
  let prevAnchor = document.getElementById('item-pagination-list-prev');
  let containersAnchor = document.getElementsByClassName('item-pagination');
  let lengthContainerAnchors = containersAnchor.length;
  let label = document.getElementById('page-identity');
  let last_date = new Date();
  let first_date = new Date();
  let c = 1;
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  getData(0,0,mount,null).then((data) => {
    let i = 0;
    let element = "";
    for(item of data){
      if(i >= mount-1){
        last_date = item.date;
      }else if (i <= 0) {
        first_date = item.date;
      }
      item['date'] = new Date(item.date).toLocaleDateString("ID",options);
      element += elemHTML(item);
      for(var tag of item.tags){
        element += tags(tag.name);
      }
      element+=end;
      i++;
    }
    elem.innerHTML = element;
  });
  label.innerText = 'page '+c+' of '+lengthContainerAnchors;
  nextAnchor.addEventListener('click',() => {
    if (c < lengthContainerAnchors) {
      getData(0,last_date,mount,null).then((data) => {
        let i = 0;
        let element = "";
        for(item of data){
          if(i >= mount-1){
            last_date = item.date;
          }else if (i <= 0) {
            first_date = item.date;
          }
          item['date'] = new Date(item.date).toLocaleDateString("ID",options);
          element += elemHTML(item);
          for(var tag of item.tags){
            element += tags(tag.name);
          }
          element+=end;
          i++;
        }
        elem.innerHTML = element;
      });
      ++c;
      label.innerText = 'page '+c+' of '+lengthContainerAnchors;
    }
  });
  prevAnchor.addEventListener('click',() => {
    if (c > 1) {
      getData(first_date,0,mount,null).then((data) => {
        let i = 0;
        let element = "";
        for(item of data){
          if(i >= mount-1){
            last_date = item.date;
          }else if (i <= 0) {
            first_date = item.date;
          }
          item['date'] = new Date(item.date).toLocaleDateString("ID",options);
          element += elemHTML(item);
          for(var tag of item.tags){
            element += tags(tag.name);
          }
          element+=end;
          i++;
        }
        elem.innerHTML = element;
      });
      --c;
      label.innerText = 'page '+c+' of '+lengthContainerAnchors;
    }
  });
})()
