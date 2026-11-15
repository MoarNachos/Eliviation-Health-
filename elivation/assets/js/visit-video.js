(function(){
 'use strict';
 document.querySelectorAll('[data-visit-film]').forEach(function(figure){
  var video=figure.querySelector('video'),button=figure.querySelector('button'),status=figure.querySelector('[data-video-status]');
  var mobile=window.matchMedia('(max-width:767px)'),desktop=video.poster;
  function poster(){video.poster=mobile.matches?video.dataset.mobilePoster:desktop;}
  poster(); if(mobile.addEventListener)mobile.addEventListener('change',poster);
  video.muted=true;video.controls=false;button.hidden=false;
  button.addEventListener('click',function(){
   status.textContent='';video.muted=false;video.controls=true;
   if(video.ended)video.currentTime=0;
   var result=video.play();
   if(result && result.catch)result.catch(function(){button.hidden=false;video.controls=true;status.textContent='Playback could not start. Try the video controls.';});
  });
  video.addEventListener('playing',function(){button.hidden=true;});
  video.addEventListener('pause',function(){button.hidden=false;});
  video.addEventListener('ended',function(){button.hidden=false;button.setAttribute('aria-label','Replay home-visit video with sound');});
  video.addEventListener('error',function(){video.controls=true;status.textContent='The video could not load. Please try again later.';});
  // No autoplay or automatic resume, including when reduced motion is requested.
  if('IntersectionObserver' in window){new IntersectionObserver(function(entries){entries.forEach(function(entry){if(!entry.isIntersecting&&!video.paused)video.pause();});},{threshold:0}).observe(video);}
  document.addEventListener('visibilitychange',function(){if(document.hidden&&!video.paused)video.pause();});
 });
}());
