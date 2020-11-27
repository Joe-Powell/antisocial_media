<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/871b467013.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

<style>
    * {
        font-family: sans-serif; padding:0px; margin:0px; box-sizing: border-box;
     }


    div h3 {
        display: none; position: absolute; top:0; z-index:3; background:blue; opacity:0.9; height: 100vh; width:100vw; text-align:center;
        padding-top:100px;
    }

    h3 ion-icon {
        font-size:45px;
    }

</style>

</head>
<body>
    


<div>
<h2>hello1</h2>
<h3><form> <input type='text' value='name'><input type='submit' value='the submit'> <ion-icon name='close-outline'></ion-icon></h3>
</div>
<div>
<h2>hello2</h2>
<h3><form> <input type='text' value='name'><input type='submit' value='the submit'> <ion-icon name='close-outline'></ion-icon></h3>
</div>
<div>
<h2>hello3</h2>
<h3><form> <input type='text' value='name'><input type='submit' value='the submit'> <ion-icon name='close-outline'></ion-icon></h3>
</div>
<div>
<h2>hello4</h2>
<h3><form> <input type='text' value='name'><input type='submit' value='the submit'> <ion-icon name='close-outline'></ion-icon></h3>
</div>
<div>
<h2>hello5</h2>
<h3><form> <input type='text' value='name'><input type='submit' value='the submit'> <ion-icon name='close-outline'></ion-icon></h3>
</div>




    <script>

    const h2 = document.querySelectorAll('div h2');
    const h3 = document.querySelectorAll('div h3');
    const xicon = document.querySelectorAll('h3 ion-icon');



    for(let i=0; i < h2.length; i++) {

    h2[i].addEventListener('click', () => {h3[i].style.display='block'})
        xicon[i].addEventListener('click', () => {h3[i].style.display='none'})

    }




</script>





















</body>
</html>