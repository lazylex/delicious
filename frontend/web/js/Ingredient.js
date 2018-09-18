function addIngredient(id, name, nice_name, color, unit_name, calories) {

    document.getElementById(name).style.display = 'none';
    //document.getElementById(name).style.visibility='hidden';
    //document.getElementById(name).style.opacity=0;
    document.getElementById(name).className = '';//хз почему, но если не сбросить класс, то элемент списка не исчезнет
    document.getElementById("added_ing_div").style.display = 'inline-table';
    document.getElementById("added_ing_div").style.height = 'auto';
    document.getElementById("added_ing_div").style.marginTop = '20px';
    document.getElementById("added_ing_div").style.marginBottom = '20px';
    //document.getElementById("ing_but_div").className="col-lg-6";
    var tr = document.createElement("tr");
    var count_td = document.createElement("td");
    var count = document.createElement("input");
    var unit = document.createElement("td");
    //var td_id = document.createElement("td");
    var td_cal = document.createElement("td");
    var td_nice_name = document.createElement("td");
    var td_del = document.createElement("td");
    //tr.className = "table table-bordered";
    /*var hidden = document.createElement("input");
     hidden.type = 'hidden';
     hidden.name = 'ingredient[]';
     hidden.value = id;*/

    var del = document.createElement("button");
    del.type = 'button';
    del.name = 'del_but_' + id;
    del.innerText = 'Удалить';
    del.className = "btn btn-outline-danger";
    del.onclick = function () {
        sum = parseInt(sum - document.getElementById("cal_" + id).innerText, 10);

        document.getElementById("ing_row_" + id).remove();
        document.getElementById("ing_but_" + id).style.display = 'inline';
        document.getElementById(name).className = 'list-group-item d-flex justify-content-between align-items-center list-group-item-can-change-back';
        if (document.getElementById('added_ing').childElementCount == 0) {
            sum = 0;

            document.getElementById("added_ing_div").style.display = 'none';

            //document.getElementById("ing_but_div").className="col-lg-12";
        }
        document.getElementById("recipe-calories").value = sum;
    }
    count.style.width = "100%";
    count.name = 'ingredient[' + id + ']';
    count.value = '1';
    count.style.textAlign = 'center';
    count_td.style.width = "60px";
    count.type = "number";
    count.min='1';
    count.max='5000';
    count.onchange = function () {
        document.getElementById("cal_" + id).innerText = (calories * count.value).toFixed(2);
        var cc = document.getElementsByClassName("calories_td");
        sum = 0;
        for (var i = 0; i < cc.length; i++) {
            sum = (parseFloat(sum) + parseFloat(cc[i].innerText)).toFixed(2);
        }
        //alert(sum);
        document.getElementById("recipe-calories").value = parseInt(sum, 10);
    }
    unit.style.width = "160px";
    unit.innerText = unit_name;
    //td_id.innerText = id;
    td_nice_name.innerText = nice_name;
    td_del.appendChild(del);
    tr.id = "ing_row_" + id;
    //tr.style.background = color;
    count_td.appendChild(count);
    td_cal.innerText = calories;
    //td_cal.style.color=color;
    td_cal.style.fontWeight='bold';
    td_cal.className = 'calories_td';
    td_cal.id = 'cal_' + id;

    tr.appendChild(td_nice_name);
    tr.appendChild(count_td);
    tr.appendChild(unit);
    tr.appendChild(td_cal);
    tr.appendChild(td_del);
    //tr.appendChild(hidden);

    //document.getElementById('added_ing').className = "table table-bordered";
    document.getElementById('added_ing').appendChild(tr);
    count.dispatchEvent(new Event('change'));
}