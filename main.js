let editAbsoluteDiv = document.querySelectorAll('.editAbsoluteDiv');
let editBtn = document.querySelectorAll('.editBtn');
let ionIcon = document.querySelectorAll('.formToEdit ion-icon');



/*had to make sure editAbsoluteDiv with form is inside the if logged in... 
or else the [i] count will be off and the third button will line up with the 
third post instead... But also it has to be editBtn.length in the for loop 
or else the count will be  off as well */


for (let i = 0; i < editBtn.length; i++) {
    editBtn[i].addEventListener('click', () => {
        editAbsoluteDiv[i].style.display = 'flex';



        ionIcon[i].addEventListener('click', () => {
            editAbsoluteDiv[i].style.display = 'none';



        })

    })

}




/// for profile image


let profileUploadLabel = document.getElementById('profileUploadLabel');
let submit_new_pro_pic = document.getElementById('submit_new_pro_pic');




profileUploadLabel.addEventListener('click', () => {

    if (submit_new_pro_pic.style.display == 'block') {
        submit_new_pro_pic.style.display = 'none';

    } else {
        submit_new_pro_pic.style.display = 'block';
    }
})


















