document.addEventListener('DOMContentLoaded', function() {
    
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    function checkNewstickerVisibility() {
        const tickers = document.querySelectorAll('.newsticker');
        
        tickers.forEach(function(ticker) {
            const groups = ticker.querySelectorAll('.newsticker__group');
            
            if (isInViewport(ticker)) {
                groups.forEach(function(group) {
                    if (!group.classList.contains('animate')) {
                        group.classList.add('animate');
                    }
                });
            }
        });
    }
    
    checkNewstickerVisibility();
    
    window.addEventListener('scroll', function() {
        checkNewstickerVisibility();
    });
    
    window.addEventListener('resize', function() {
        checkNewstickerVisibility();
    });
    
});