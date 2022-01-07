console.log('hello from phypopus');

function togglePopup(){
    document.querySelector('.popupphy').classList.add("active");
  document.querySelector('.bttns').classList.add('bttnac');
    

}
function closePopup(){
    document.querySelector('.popupphy').classList.remove("active");
    document.querySelector('.bttns').classList.remove('bttnac');
    
}