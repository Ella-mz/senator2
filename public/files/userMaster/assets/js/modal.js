let modalItems = document.querySelectorAll('.modal-tabs li a');
modalItems.forEach((item) => {
    item.addEventListener('click', function (e) {
        e.preventDefault();


        document.querySelector('.modal-tabs li a.selected').classList.remove('selected');
        this.classList.add('selected');

        let dataBox = this.getAttribute('data-bs-content')

        document.querySelector('.modal-tab-content div.selected').classList.remove('selected')
        document.querySelector(`.modal-tab-content div[data-bs-content="${dataBox}"]`).classList.add('selected')
    })
})