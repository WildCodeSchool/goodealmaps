let link = document.getElementById('link')
let burger = document.getElementById('burger')
let ul = document.querySelector('ul')

link.addEventListener('click', function (event) {
    event.preventDefault()
    burger.classList.toggle('open')
    ul.classList.toggle('open')
})