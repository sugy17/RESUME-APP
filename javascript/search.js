var limit = 10,
page = 0;

function nextpage() {
page += 1;
if (page > 0) {
    document.getElementById("pagination_top_<").style.display = "";
    document.getElementById("pagination_bottom_<").style.display = "";
}
document.getElementById("pagination_top_<").style.display = "";
document.getElementById("pagination_bottom_<").style.display = "";
fillTable();
}

function previouspage() {
page -= 1;
if (page <= 0) {
    document.getElementById("pagination_top_<").style.display = "none";
    document.getElementById("pagination_bottom_<").style.display = "none";
    page = 0;
}
document.getElementById("pagination_top_>").style.display = "";
document.getElementById("pagination_bottom_>").style.display = "";
fillTable();
}

var ui_map = {
'post_id': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="title">Select Post</label>  ' +
    '   	<select class="browser-default" name="post_id" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'department': '   <div class="col l7 m7 s12">  ' +
    '<!--First List items-->  ' +    
    '<label for="title">Select Department</label>  ' +
    '<select name="department" class="browser-default"> ' +
    '<option value="" value>--choose--</option>' +
    '<option value="ISE">ISE</option>' +
    '<option value="CSE">CSE</option>' +
    '<option value="Civil">Civil</option>' +
    '<option value="ME">ME</option>' +
    '<option value="EEE">EEE</option>' +
    '<option value="Architecture">Architecture</option>' +
    '<option value="MCA">MCA</option>' +
'</select>' +
'   </div>  ',
'branch_ug': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="title">Select UG Branch</label>  ' +
    '   	<select class="browser-default" name="branch_ug" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'degree_ug': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="degree_ug">Select UG Degree</label>  ' +
    '   	<select class="browser-default" name="degree_ug" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'degree_pg': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="degree_pg">Select PG Degree</label>  ' +
    '   	<select class="browser-default" name="degree_pg" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'areaofspecialization': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="areaofspecialization">Select phd specialization</label>  ' +
    '   	<select class="browser-default" name="areaofspecialization" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'status': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="status">Select Phd Status</label>  ' +
    '   	<select class="browser-default" name="status" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   		<option value="0">pursing</option>  ' +
    '   		<option value="1">completed</option>  ' +
    '   		<option value="2">others</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'university_ug': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="university_ug">Select UG University</label>  ' +
    '   	<select class="browser-default" name="university_ug" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'university_pg': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="university_pg">Select PG university</label>  ' +
    '   	<select class="browser-default" name="university_pg" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
'university_phd': '   <div class="col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<label for="university_phd">Select Phd university</label>  ' +
    '   	<select class="browser-default" name="university_phd" >  ' +
    '   		<option value="--choose--">--choose--</option>  ' +
    '   	</select>  ' +
    '   </div>  ',
// 'time_frame':'   <div class="col l7 m7 s12">  '  + 
// '   	<!--First List items-->  '  + 
// '   	<label for="time_frame">Select Time frame</label>  '  + 
// '   	<select class="browser-default" name="time_frame">  '  + 
// '   		<option value="1 MONTH">past 1 month</option>  '  + 
// '   		<option value="6 MONTH">past 6 months</option>  '  + 
// '   		<option value="1 WEEK">past 1 week</option>  '  + 
// '   		<option value="1 DAY">past 1 day</option>  '  + 
// '   	</select>  '  + 
// '   </div>  ',
'marks_ug': '   <div class="input-field col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<input class="validate" name="marks_ug" id="marks_ug_opt" type="text">  ' +
    '   	<label for="marks_ug_opt">UG marks above(%)</label>  ' +
    '   </div>  ',
'marks_pg': '   <div class="input-field col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<input class="validate" name="marks_pg" id="marks_pg_opt" type="text">  ' +
    '   	<label for="marks_pg_opt">PG marks above(%)</label>  ' +
    '     ' +
    '   </div>  ',
'marks_12': '   <div class="input-field col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<input class="validate" name="marks_12" id="marks_12_opt" type="text">  ' +
    '   	<label for="marks_12_opt">12th Marks above(%)</label>  ' +
    '   </div>  ',
'total_exp_years': '   <div class="input-field col l7 m7 s12">  ' +
    '   	<!--First List items-->  ' +
    '   	<input class="validate" name="total_exp_years" id="total_exp_years_opt" type="text">  ' +
    '   	<label for="total_exp_years_opt">experience (years)</label>  ' +
    '  </div>  '
// 'seen':'<div class="col l7 m7 s12">  '  + 
// '   	<!--First List items-->  '  + 
// '   	<label for="title">Seen/unseen</label>  '  + 
// '   	<select class="browser-default" name="seen" >  '  + 
// '   		<option value="--choose--">--choose--</option>  '  + 
// '   		<option value="0">unseen(new)</option>  '  + 
// '   		<option value="1">seen(old)</option>  '  + 
// '   	</select>  '  + 
// '   </div>  ',
}
var ui_operator = '<div class="col l2 m2 s12">  ' +
'   	<!--First List items-->  ' +
'   	<label >Logical operator</label>  ' +
'   	<select class="browser-default" name="operator" >  ' +
'   		<option value="AND">AND</option>  ' +
'   		<option value="OR">OR</option>  ' +
'   	</select>  ' +
'   </div>  ';

var ui_option = '<div class="col l3 m3 s12">  ' +
'   	<!--First List items-->  ' +
'   	<label >select search field</label>  ' +
'   	<select class="browser-default" name="option" onchange=\'mapInput(this);\'>  ' +
'   		<option value="post_id">post</option>  ' +
'           <option value="department">department</option>' +
'   		<option value="branch_ug">ug branch</option>  ' +
'   		<option value="post_select">Post</option>  ' +
'   		<option value="degree_ug"> UG Degree</option>  ' +
'   		<option value="degree_pg">PG Degree</option>  ' +
'   		<option value="areaofspecialization"> phd specialization</option>  ' +
'   		<option value="status">uPhd Status</option>  ' +
'   		<option value="university_ug">UG University</option>  ' +
'   		<option value="university_pg">PG university</option>  ' +
'   		<option value="university_phd">Phd university</option>  ' +
'   		<option value="marks_ug">UG marks above(%)</option>  ' +
'   		<option value="marks_pg">PG marks above(%)</option>  ' +
'   		<option value="marks_12">12th Marks above(%)</option>  ' +
'   		<option value="total_exp_years">experience (years)</option>  ' +
'   	</select>  ' +
'   </div>  ';

// const replace_nth = function(s, f, r, n) {
// 	// From the given string s, replace f with r of nth occurrence
// 	return s.replace(RegExp("^(?:.*?" + f + "){" + n + "}"), x => x.replace(RegExp(f + "$"), r));
// };
var row_ctr = 0;

function addRow(key) {
//alert(ui_map[key]);
//opt = replace_nth(ui_option, 'value="'+key+'"', 'value="'+key+'"', row_ctr + 1);
if (row_ctr + 1 == Object.keys(ui_map).length)
    document.getElementById('row-container').innerHTML += '<div class="row" id="' + row_ctr + '">' + ui_option.replace('value="' + key + '"', 'value="' + key + '" selected') + ui_map[key] + '</div>';
else
    document.getElementById('row-container').innerHTML += '<div class="row" id="' + row_ctr + '">' + ui_option.replace('value="' + key + '"', 'value="' + key + '" selected') + ui_map[key] + ui_operator + '</div>';
row_ctr += 1;
}

function mapInput(row_opt) {
var key = row_opt.options[row_opt.selectedIndex].value;
//console.log(parseInt(row_opt.parentNode.parentNode.id) + 1);
if (parseInt(row_opt.parentNode.parentNode.id) + 1 == Object.keys(ui_map).length)
    row_opt.parentNode.parentNode.innerHTML = ui_option.replace('value="' + key + '"', 'value="' + key + '" selected') + ui_map[key] + '</div>';
else
    row_opt.parentNode.parentNode.innerHTML = ui_option.replace('value="' + key + '"', 'value="' + key + '" selected') + ui_map[key] + ui_operator + '</div>';
}

function fillSearchOptions(key) {
xhttp_ctr += 1;
display_loading();
var xhttp;
selects = document.getElementsByName(key);
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        xhttp_ctr -= 1;
        display_loading();
        var data = JSON.parse(this.responseText);
        var i;
        if (key == 'post_id'){
            for (i = 0; i < data.length; i++)
                if(data[i][key]!='')
                    ui_map[key] = ui_map[key].replace('</option>     \t</select>', '</option><option value="' + data[i][key] + '">' + data[i]['post_select'] + '</option>     \t</select>');}
        else
            for (i = 0; i < data.length; i++)
                if(data[i][key]!='')
                    ui_map[key] = ui_map[key].replace('</option>     \t</select>', '</option><option value="' + data[i][key] + '">' + data[i][key] + '</option>     \t</select>');
        addRow(key);
    }
};

if (key == 'department'){
    //ui_map[key] = ui_map[key].replace('</option>     \t</select>', '</option><option value="' + data[i][key] + '">' + data[i][key] + '</option>     \t</select>');
    addRow(key);
    xhttp_ctr -= 1;
    display_loading();
    return;
}
else if (key == 'post_id')
    xhttp.open("GET", "api/get-data.php?query=select * from posts", true);
else
    xhttp.open("GET", "api/get-options.php?" + key + "=all", true);
xhttp.send();
}

window.onload = function() {
for (var key in ui_map)
    if (key.includes('marks') || key.includes('exp') || key == 'status')
        addRow(key)
    else
        fillSearchOptions(key);
fillTable();
////console.log(document.getElementById(row_ctr).firstChild.lastChild);
}


function fillTable() {
xhttp_ctr += 1;
display_loading();
document.getElementById("pagination_top_>").style.display = "";
document.getElementById("pagination_bottom_>").style.display = "";
rows = document.getElementById('row-container');
query = 'select * from applicant natural join application natural join posts ';
f = document.getElementById('from').value;
t = document.getElementById('to').value;
if (f && t)
    query += " where application_date between '" + f + "' and '" + t + "' and ";
else if (f)
    query += " where application_date between '" + f + "' and curdate() and "
else
    query += " where application_date BETWEEN (CURRENT_DATE() - INTERVAL 1000 MONTH) AND CURRENT_DATE() and";
tick_old = document.getElementById('old-tick');
tick_new = document.getElementById('new-tick');
if (tick_new.checked ^ tick_old.checked)
    if (tick_new.checked)
        query += " seen=" + tick_new.value + " and ";
    else
        query += " seen=" + tick_old.value + " and ";
else
    query += " seen in (0,1) " + " and ";
for (var key in ui_map) {
    for (var ele in document.getElementsByName(key)) {
        ele = document.getElementsByName(key)[ele];
        try {
            operator = ele.parentElement.nextElementSibling.lastElementChild.selectedOptions[0].value;
        } catch (err) {
            operator = '     ';
        }
        try {
            if (key.includes('marks') || key.includes('exp')) {
                if (ele.value != "" && ele.value != null)
                    query += key + '>' + ele.value + " " + operator + " ";
            } else if (ele.selectedIndex != 0 && key == 'status')
                query += key + "=" + ele.options[ele.selectedIndex].value + " " + operator + " ";
            else if (ele.selectedIndex != 0)
                query += " " + key + "='" + ele.options[ele.selectedIndex].value + "' " + operator + " ";
        } catch (err) {}
    }
}
query = query.slice(0, -4);
query += " order by application_date desc,application_time desc ";
query = query.replace("where  or", "where ");
query = query.replace("where  and", "where ");
query += " limit " + limit + " offset " + limit * page;
//console.log(query);
var old_tbody = document.getElementsByTagName('tbody')[0];
document.getElementById('page_no_top').innerHTML = "page: " + (page + 1);
document.getElementById('page_no_bottom').innerHTML = "page: " + (page + 1);
var xhttp;
document.getElementById('result_table').style.display = "";
document.getElementById("pagination_top").style.display = "";
document.getElementById("pagination_bottom").style.display = "";
xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var new_tbody = document.createElement('tbody');
        try {
            var data = JSON.parse(this.responseText);
            for (i = 0; i < limit; i++) {
                var tr = document.createElement('tr');
                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                var td4 = document.createElement('td');
                var td5 = document.createElement('td');
                var td6 = document.createElement('td');
                var td7 = document.createElement('td');
                var td = document.createElement('td');
                var td_img = document.createElement('td');
                td_img.setAttribute("class", "outside");
                td.setAttribute("class", "outside");
                try {
                    td1.appendChild(document.createTextNode(data[i]['application_id']));
                    //td1.innerHTML="<iframe src='http://docs.google.com/viewer?url=http://sugyan.skyline.cloudns.cl:5000/abc/"+data[i]['file_path']+"&embedded=true' width='100' height='100' style='border: none;'></iframe>";
                    td2.appendChild(document.createTextNode(data[i]['name']));
                    td3.appendChild(document.createTextNode(data[i]['post_select']));
                    td4.appendChild(document.createTextNode(data[i]['marks_ug']));
                    td5.appendChild(document.createTextNode(data[i]['marks_pg']));
                    td6.appendChild(document.createTextNode(data[i]['total_exp_years'] + " years"));
                    a = document.createElement('a');
                    a.href = 'api/'+data[i]['resume'];/*'http://africau.edu/images/default/sample.pdf'; *///
                    //a.target = "_blank";
                    a.download = data[i]['application_id'];
                    a.setAttribute("class", "waves-effect waves-light btn blue");
                    a.innerHTML += 'Download<i class="material-icons right">file_download</i>';
                    td7.appendChild(a);
                    if (data[i]["seen"] == 0) {
                        td.innerHTML = '<span class="new badge"></span>';
                        tr.style.fontWeight = "bold";
                    } else
                        td.innerHTML = "<pre>       </pre>";
                    tr.setAttribute("onclick", "get_info(" + data[i]['application_id'] + ",this);mark_seen(this);");
                    tr.style.cursor = "pointer";
                    td_img.innerHTML = '<div class="portrait"><img id="blah" src="api/'+data[i]['photo']/*'https://miro.medium.com/max/2048/0*0fClPmIScV5pTLoE.jpg'*/+'" alt="not uploaded" class="circle responsive-img" /></div>';
                    tr.appendChild(td);
                    tr.appendChild(td_img);
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(td3);
                    tr.appendChild(td4);
                    tr.appendChild(td5);
                    tr.appendChild(td6);
                    tr.appendChild(td7);
                    new_tbody.appendChild(tr);
                } catch (err) {
                    document.getElementById("pagination_top_>").style.display = "none";
                    document.getElementById("pagination_bottom_>").style.display = "none";
                    break;
                }
                //tr.setAttribute("onclick","window.location='view-application.php?application_id="+data[i]['application_id']+"';");
                //tr.setAttribute("onclick","window.location='http://docs.google.com/viewer?url=http://sugyan.skyline.cloudns.cl:5000/abc/"+data[i]['file_path']+"&embedded=true';");

            }
        } catch (err) {
            document.getElementById("pagination_top_>").style.display = "none";
            document.getElementById("pagination_bottom_>").style.display = "none";
            tr = document.createElement('tr');
            var td = document.createElement('td');
            td.setAttribute('colspan', "9");
            if (page == 0)
                td.appendChild(document.createTextNode("No resumes matching specifed criteria"));
            else
                td.appendChild(document.createTextNode("Reached end of results"));
            tr.appendChild(td);
            td.setAttribute('style', 'text-align: center;');;
            new_tbody.appendChild(tr);
        }
        try {
            old_tbody.parentNode.replaceChild(new_tbody, old_tbody)
        } catch (err) {}
        document.getElementById('pagination_top').scrollIntoView();
        xhttp_ctr -= 1;
        display_loading();
    }
};
// var query = "";
// var elements = document.getElementsByTagName("select");
// for (var i = 0; i < elements.length; i++) {
// 	//alert(elements[i].selectedIndex);
// 	if (elements[i].selectedIndex != 0)
// 		query += elements[i].name + "=" + elements[i].options[elements[i].selectedIndex].value + "&";
// }
// elements = document.getElementsByTagName("input");
// for (var i = 0; i < elements.length; i++) {
// 	//alert(elements[i].selectedIndex);
// 	if (elements[i].value != "")
// 		query += elements[i].name + "=" + elements[i].value + "&";
// }
// query = query.slice(0, -1);
xhttp.open("GET", "api/get-data.php?query=" + query, true);
xhttp.send();
}


function hide_back() {
document.getElementById("pagination_top_<").style.display = "none";
document.getElementById("pagination_bottom_<").style.display = "none";
}

function fillData(app_id) {
xhttp_ctr += 1;
display_loading();
var xhttp;
var status = {
    0: 'pursing',
    1: 'complelted',
    2: 'others',
    7: ''
};
var part_fulltime = {
    0: 'part-time',
    1: 'fulltime',
    7: ''
};
var teaching = {
    1: 'teaching',
    0: 'non-teaching'
};
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        xhttp_ctr -= 1;
        display_loading();
        var data = JSON.parse(this.responseText)[0];
        for (var i in data) {
            try {
                var opt = document.getElementById(i);
                if (i == 'status')
                    opt.innerHTML = status[data[i]];
                else if (i == 'part_fulltime')
                    opt.innerHTML = part_fulltime[data[i]];
                else if (i == 'teaching')
                    opt.innerHTML = teaching[data[i]];
                else if (data[i] != '' && data[i] != 0)
                    opt.innerHTML = data[i];
                //else opt.innerHTML='--nil--';
            } catch (err) {
                var x = 0;
            }
        }
        if (data['status_others'] != "")
            document.getElementById('status').innerHTML = data['status_others'];
        //document.getElementById('resume_file').innerHTML="<iframe src='http://docs.google.com/viewer?url=http://48019832af19.ngrok.io/abc/"+data['file_path']+"&embedded=true' width='500' height='800' style='border: none;'></iframe>";
    }
};
xhttp.open("GET", "api/get-data.php?query=select * from applicant a,application b, posts p where a.uid=b.uid and p.post_id=b.post_id and application_id=" + app_id, true);
xhttp.send();
}

function get_info(app_id, tr) {
var table = document.getElementById("result_table");
var row;
try {
    row = document.getElementById('expanded_row');
    if (row.rowIndex == tr.rowIndex + 1) {
        row.parentNode.removeChild(row);
        return;
    }
    row.parentNode.removeChild(row);
} catch (err) {}
xhttp_ctr += 1;
display_loading();
var xhttp;
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        xhttp_ctr -= 1;
        display_loading();
        td = document.createElement("td");
        td.style.pointerEvents = "none";
        td.setAttribute('colspan', "9");
        td.innerHTML = xhttp.responseText;
        row = table.insertRow(tr.rowIndex + 1);
        row.appendChild(td);
        //row.setAttribute('bgcolor','yellow');
        row.id = 'expanded_row';
        fillData(app_id);
    }
};
xhttp.open("GET", "html/template.html", true);
xhttp.send();
}


function mark_seen(tr) {
var xhttp;
if (tr.cells[0].innerHTML != '<span class="new badge"></span>')
    return;
tr.style.fontWeight = "normal";
xhttp = new XMLHttpRequest();
tr.cells[0].innerHTML = "<pre>   </pre>";
xhttp.open("GET", "api/set-seen.php?seen=1&application_id=" + tr.cells[2].innerHTML, true);
xhttp.send();
}

function mark_unseen(tr) {
var xhttp;
tr.style.fontWeight = "bold";
xhttp = new XMLHttpRequest();
xhttp.open("GET", "api/set-seen.php?seen=0&application_id=" + tr.cells[2].innerHTML, true);
xhttp.send();
}

var xhttp_ctr = 0;

async function display_loading() {
if (xhttp_ctr == 0) {
    await new Promise(r => setTimeout(r, 250));
    document.getElementById('loading').style.display = "none";
    //console.log("stop loading");
} else {
    document.getElementById('loading').style.display = "";
    //console.log("start loading");
}
}