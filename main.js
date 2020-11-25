



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

        const editTextarea = document.querySelector('.editAbsoluteDiv textarea');
        editTextarea.focus();



        ionIcon[i].addEventListener('click', () => {
            editAbsoluteDiv[i].style.display = 'none';



        })

    })

}




////////////////////////////////////////////Profil picture changing/////////////////////////////////


let profileUploadLabel = document.getElementById('profileUploadLabel');
let submit_new_pro_pic = document.getElementById('submit_new_pro_pic');
let profileUpload = document.getElementById('profileUpload');
let cameraProf = document.querySelector('.forRelative ion-icon');
let profileUploadForm = document.querySelector('.profileUploadForm');




console.log('main.js connected......');
console.log(imgProf);






// when a picture is selected, submit will be clicked! problem now is the cashe wont refresh
profileUpload.addEventListener('change', () => { submit_new_pro_pic.click(); })



// when click on profile picture
imgProf.addEventListener('click', () => {
    console.log('clicked')
    profileUploadLabel.click();

})

// also when you click the camera
cameraProf.addEventListener('click', () => {
    console.log('clicked')
    profileUploadLabel.click();

})

////////////////////////////////////////////////////////////////////////////////////////////////////////









/////////////////////////Edit Biography /////////////////////////////////////////////

const editBioBtn = document.querySelector('.editBioBtn');
const exitEditBioIcon = document.querySelector('.editBiographyContain ion-icon');
const editBiographyContain = document.querySelector('.editBiographyContain');

editBioBtn.addEventListener('click', () => { editBiographyContain.style.display = 'flex' })
exitEditBioIcon.addEventListener('click', () => { editBiographyContain.style.display = 'none' })














