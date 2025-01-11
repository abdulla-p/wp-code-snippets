document.addEventListener('DOMContentLoaded', () => {
    const lazyVideos = document.querySelectorAll('.lazy-load-video');

    if (lazyVideos.length > 0) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const videoContainer = entry.target;
                    const videoSrc = videoContainer.getAttribute('data-src');
                    
                    const video = document.createElement('video');
                    video.autoplay = true;
                    video.loop = true;
                    video.muted = true;
                    video.playsInline = true;
                    video.style.width = '100%';
                    video.style.height = 'auto';
                    video.style.objectFit = 'cover';
    
                    const source = document.createElement('source');
                    source.src = videoSrc;
                    source.type = 'video/mp4';
    
                    video.appendChild(source);
                    videoContainer.appendChild(video);
                    
                    observer.unobserve(videoContainer);  // Stop observing.
                }
            });
        });
        
        lazyVideos.forEach(video => observer.observe(video)); // Observe each element.
    }
});  