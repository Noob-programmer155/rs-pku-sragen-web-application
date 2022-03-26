async function getData(id) {
  try {
    const res = await fetch(`${window.location.origin}/blog/comments/${id}`);
    return res.json();
  } catch (e) {
    alert(e.message);
    return null;
  }
}

async function commentFunc(id,message,csrfToken) {
  let data = {};
  if(id !== null){
    data['id'] = id;
  }
  data['message'] = message;
  try {
    const res = await fetch(`${window.location.origin}/blog/comments/post`,{
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN':csrfToken,
      },
      body: JSON.stringify(data)
    });
    if(res){
      res.json().then(a => console.log(a));
    }
  } catch (e) {
    alert(e.message);
  }
}

const element1 = (data, isChild) => (
  `<li ${(isChild)? 'class=\'children\'':''}>
      <div class='comment-img'>
          <img src="/images/${data.image}" alt="${data.username}" />
      </div>
      <div class="comment-desc">
          <div class="desc-top">
              ${(isChild)? `<p>reply to <span>${data.replays}</span></p>`:''}
              <h6>${data.username}</h6>
              <span class="date">${data.dates_upload}</span>
              <a onclick='replyFunc(${data.id})' class="reply-link"><i
                      class="lni lni-reply"></i>Reply</a>
          </div>
          <p>
              ${data.description}
          </p>
      </div>
  </li>`
);
