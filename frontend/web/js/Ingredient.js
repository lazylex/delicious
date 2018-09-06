function addIngredient(id, name, nice_name, color, unit) {
    document.getElementById(name).style.display = 'none';
    document.getElementById("added_ing_div").style.visibility = 'visible';
    document.getElementById("ing_but_div").className="col-lg-4";
    var tr = document.createElement("tr");
    var count_td = document.createElement("td");
    var count = document.createElement("input");
    var unit = document.createElement("td");
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
    del.className="btn";
    del.onclick=function () {
        document.getElementById("ing_row_"+id).remove();
        document.getElementById("ing_but_"+id).style.display = 'inline';
        if(document.getElementById('added_ing').childElementCount==0)
        {
            document.getElementById("added_ing_div").style.visibility = 'hidden';
            document.getElementById("ing_but_div").className="col-lg-12";
        }
    }
    count.style.width="100%";
    count.name = 'ingredient[' + id + ']';
    count.value = '1';
    count.style.textAlign='center';
    count_td.style.width="60px";
    unit.style.width="160px";
    td_id.innerText = id;
    td_nice_name.innerText = nice_name;
    td_del.appendChild(del);
    tr.id="ing_row_"+id;
    tr.style.background=color;
    count_td.appendChild(count);
    tr.appendChild(td_nice_name);
    tr.appendChild(count_td);
    tr.appendChild(unit);

    tr.appendChild(td_del);
    //tr.appendChild(hidden);

    //document.getElementById('added_ing').className = "table table-bordered";
    document.getElementById('added_ing').appendChild(tr);
}