<?php 
echo '
    <div class="user-dashboard-nav-bg">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <symbol id="chrome-tab-geometry-left" viewBox="0 0 214 36">
                    <path d="M17 0h197v36H0v-2c4.5 0 9-3.5 9-8V8c0-4.5 3.5-8 8-8z"></path>
                </symbol>
                <symbol id="chrome-tab-geometry-right" viewBox="0 0 214 36">
                    <use xlink:href="#chrome-tab-geometry-left"></use>
                </symbol>
                <clipPath id="crop">
                    <rect class="mask" width="100%" height="100%" x="0"></rect>
                </clipPath>
            </defs><svg width="52%" height="100%">
                <use xlink:href="#chrome-tab-geometry-left" width="214" height="36"
                    class="chrome-tab-geometry"></use>
            </svg>
            <g transform="scale(-1, 1)"><svg width="52%" height="100%" x="-100%" y="0">
                    <use xlink:href="#chrome-tab-geometry-right" width="214" height="36"
                        class="chrome-tab-geometry"></use>
                </svg></g>
        </svg>
    </div>
';
?>