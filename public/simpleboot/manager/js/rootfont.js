//根据屏幕大小改变根元素字体大小
// (function(doc, win) {
//     var docEl = doc.documentElement,
//         resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
//         recalc = function() {
//             var clientWidth = docEl.clientWidth;
//             if (!clientWidth) return;
//             if (clientWidth >= 750) {
//                 docEl.style.fontSize = '100px';
//             } else {
//                 docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
//             }
//         };
//
//     if (!doc.addEventListener) return;
//     win.addEventListener(resizeEvt, recalc, false);
//     doc.addEventListener('DOMContentLoaded', recalc, false);
// })(document, window);
// document.getElementsByTagName('html')[0].style.fontSize = window.innerWidth / 7.5 + 'px';
var deviceWidth = document.documentElement.clientWidth;if(deviceWidth > 750)
    deviceWidth = 750;document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';