



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







// when a picture is selected, submit will be clicked! problem now is the cashe wont refresh
if (profileUpload) {
    profileUpload.addEventListener('change', () => { submit_new_pro_pic.click(); })
}


// when click on profile picture

// imgProf.addEventListener('click', () => {
//     console.log('clicked')
//     profileUploadLabel.click();

// })

// also when you click the camera
if (cameraProf) {
    cameraProf.addEventListener('click', () => {
        console.log('clicked')
        profileUploadLabel.click();

    })
}

////////////////////////////////////////////////////////////////////////////////////////////////////////









/////////////////////////Edit Biography /////////////////////////////////////////////

const editBioBtn = document.querySelector('.editBioBtn');
const exitEditBioIcon = document.querySelector('.editBiographyContain ion-icon');
const editBiographyContain = document.querySelector('.editBiographyContain');
const editBiographyTextarea = document.querySelector('.editBiographyContain textarea');

if (editBioBtn) {
    // was getting error in GET
    editBioBtn.addEventListener('click', () => { editBiographyContain.style.display = 'inline-block'; editBiographyTextarea.focus() })
};

if (exitEditBioIcon) {
    // was getting error in GET
    exitEditBioIcon.addEventListener('click', () => { editBiographyContain.style.display = 'none'; })
}
////////////////////////////////////////////////////////////////////////////////////////////////////






//////////////Comments//////////////////////////////////////////////////////////////////////////

let editBtnForComment = document.querySelectorAll('.editBtnForComment');
let editCommentForm = document.querySelectorAll('.editCommentForm');

for (let i = 0; i < editBtnForComment.length; i++) {
    editBtnForComment[i].addEventListener('click', () => {
        console.log('clicked');
        editCommentForm[i].classList.toggle('editCommentFormActive');


    })

}





let comment = document.querySelectorAll('.comment');
let comments = document.querySelectorAll('.comments');


for (let i = 0; i < comment.length; i++) {

    comment[i].addEventListener('click', () => { comments[i].classList.toggle('commentsActive'); });


}

// Leave A comment 
const commentHeading = document.querySelectorAll('.commentHeading');
const leaveCommentForm = document.querySelectorAll('.leaveCommentForm');


for (let i = 0; i < commentHeading.length; i++) {
    commentHeading[i].addEventListener('click', () => { leaveCommentForm[i].classList.toggle('leaveCommentFormActive') });
}




///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





/////////////Register Form Validations  and Login  ------------------------------------------------------------------
//Register
let formSignup = document.getElementById('form-Signup');
let username = document.getElementById('username');
let email = document.getElementById('email');
let pwd = document.getElementById('pwd');
let pwdRepeat = document.getElementById('pwdRepeat');
let errorLanding = document.getElementById('errorLanding');

if (formSignup) {
    formSignup.addEventListener('submit', (e) => {

        if (username.value == '' || email.value == '' || pwd.value == '' || pwdRepeat.value == '') {
            e.preventDefault();
            errorLanding.innerHTML = 'Please fill fields not marked \"Optional\"';
        }

    })
}



// Login ----

let formLogin = document.getElementById('form-login');
let unameEmail = document.getElementById('unameEmail');
//let pwd = document.getElementById('pwd');
if (formLogin) {
    formLogin.addEventListener('submit', (e) => {
        if (unameEmail.value == '' || pwd.value == '') {
            e.preventDefault();
            errorLanding.innerHTML = 'Please fill in fields';
        }


    })
}







//----------------------------------------------------------------------------------------------------------







