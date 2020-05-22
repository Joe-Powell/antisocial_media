let editAbsoluteDiv = document.querySelectorAll('.editAbsoluteDiv');
let editBtn = document.querySelectorAll('.editBtn');
let ionIcon = document.querySelectorAll('.formToEdit ion-icon');





for (let i = 0; i < editBtn.length; i++) {
    
    editBtn[i].addEventListener('click', () => {
        editAbsoluteDiv[i].style.display = 'flex';



        ionIcon[i].addEventListener('click', () => {
            editAbsoluteDiv[i].style.display = 'none';



        })

    })

}
