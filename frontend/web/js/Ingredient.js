function addIngredient(id,name){
    document.getElementById(name).style.display='none';
    document.getElementById('ing_post').value+=' '+id;
}