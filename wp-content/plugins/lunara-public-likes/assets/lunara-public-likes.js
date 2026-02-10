(function(){
  function formatCount(n){
    try{ return new Intl.NumberFormat().format(n); }catch(e){ return String(n); }
  }

  function onClick(e){
    var btn = e.target.closest('.lunara-like-button');
    if (!btn || btn.classList.contains('is-liked') || btn.dataset.loading) return;

    e.preventDefault();
    var postId = parseInt(btn.dataset.postId, 10);
    if (!postId) return;

    btn.dataset.loading = '1';

    var fd = new FormData();
    fd.append('action', 'lunara_public_like');
    fd.append('nonce', LunaraPublicLikes.nonce);
    fd.append('post_id', postId);

    fetch(LunaraPublicLikes.ajaxUrl, {method:'POST', credentials:'same-origin', body:fd})
      .then(function(r){ return r.json(); })
      .then(function(resp){
        if (resp && resp.success && resp.data){
          btn.classList.add('is-liked');
          var label = btn.querySelector('.lunara-like-label');
          var count = btn.querySelector('.lunara-like-count');
          if (label) label.textContent = 'Liked';
          if (count) count.textContent = formatCount(resp.data.count || 0);
        }
      })
      .finally(function(){ delete btn.dataset.loading; });
  }

  document.addEventListener('click', function(e){
    if (e.target.closest('.lunara-like-button')) onClick(e);
  });
})();
