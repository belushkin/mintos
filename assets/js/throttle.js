export default function throttle (callback, limit) {
    var wait = false;
    return function () {
        if (!wait) {
            wait = true;
            setTimeout(function () {
                wait = false;
                callback.call();
            }, limit);
        }
    }
}