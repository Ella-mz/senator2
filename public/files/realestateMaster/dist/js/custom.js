let body = document.querySelector('body');
console.log(body)
let userProfile= document.querySelector('.user-panel .image img')
console.log(userProfile)
if(document.querySelector('body').classList.contains("sidebar-collapse")){
    console.log('userProfile')
    userProfile.classList.add('.hidden')
}else{
    userProfile.classList.remove('hidden')
}