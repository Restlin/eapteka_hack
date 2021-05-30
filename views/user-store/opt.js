let select = document.getElementById('userstore-item_id');
let label = document.getElementById('label-js');
let myDR = document.querySelector('.myDropDown').querySelector('.form-group');




const init = function () {
    if (!select) return;
    select.querySelector('option').onclick = function (event) {
        label.innerText = '👍🏻 Оптимальная цена'
        label.classList.add('myLabelLove');

        if(myDR.querySelector('.help-block').innerHTML === '') return;
            myDR.querySelector('.help-block').classList.add('myBad')
    }
    select.querySelectorAll('option').forEach((item, i) => {
        if (i !== 0) {
            item.onclick = function (event) {
                label.innerText = ''
                label.classList.remove('myLabelLove')
                if(!myDR.querySelector('.help-block')) return;
                myDR.querySelector('.help-block').classList.remove('myBad')
            }
        }
    })
    select.querySelector('option').click()
}

init();

