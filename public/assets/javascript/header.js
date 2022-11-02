const link = document.getElementById('link')
const burger = document.getElementById('burger')
const ul = document.querySelector('ul')

link.addEventListener('click', function (event) {
    event.preventDefault()
    burger.classList.toggle('open')
    ul.classList.toggle('open')
})