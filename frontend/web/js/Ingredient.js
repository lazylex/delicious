function addIngredient(id, name, nice_name) {
    document.getElementById(name).style.display = 'none';

    var tr = document.createElement("tr");
    var count = document.createElement("input");
    var td_id = document.createElement("td");
    var td_nice_name = document.createElement("td");
    var td_del = document.createElement("td");
    //tr.className = "table table-bordered";
    /*var hidden = document.createElement("input");
    hidden.type = 'hidden';
    hidden.name = 'ingredient[]';
    hidden.value = id;*/

    var del = document.createElement("button");
    del.type = 'button';
    del.name = 'del_but_'+id;
    del.innerText = 'Удалить';
    del.onclick=function () { document.getElementById("ing_row_"+id).remove(); }

    count.name = 'ingredient[' + id + ']';
    td_id.innerText = id;
    td_nice_name.innerText = nice_name;
    td_del.appendChild(del);
    tr.id="ing_row_"+id;
    tr.appendChild(count);
    tr.appendChild(td_nice_name);
    tr.appendChild(td_del);
    //tr.appendChild(hidden);

    //document.getElementById('added_ing').className = "table table-bordered";
    document.getElementById('added_ing').appendChild(tr);
}