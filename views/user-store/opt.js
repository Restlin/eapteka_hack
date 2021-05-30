let select = document.getElementById('userstore-item_id');
let label = document.getElementById('label-js');


const init = function () {
    if (!select) return;
    select.querySelector('option').onclick = function (event) {
        label.innerText = '👍🏻 Оптимальная цена'
        label.classList.add('myLabelLove');
    }
    select.querySelectorAll('option').forEach((item, i) => {
        if (i !== 0) {
            item.onclick = function (event) {
                label.innerText = ''
            }
        }
    })
    select.querySelector('option').click()
}

init();

