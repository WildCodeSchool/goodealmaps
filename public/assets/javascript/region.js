document.querySelector("select.region").addEventListener('change', function (e) {
    opt = e.target.options;
    let index = e.target.selectedIndex;
    window.location = opt[index].getAttribute('link');
})