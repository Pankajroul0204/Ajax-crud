<h1>Ajax crud</h1>
<hr>
<script src="jquery.min.js"></script>
<h2 id="heading">Insert Data</h2>
<hr>
<!-- <form id="form" method="POST"> -->
    <label>Name:</label><input type="text" name="emp_name" id="name"><br>
    <label>Age:</label><input type="text" name="emp_age" id="age"><br>
    <label>Gender:</label><input type="text" name="emp_gender" id="gender"><br>
    <label>Designation:</label><input type="text" name="emp_desig" id="desig"><br>
    <label>Email:</label><input type="text" name="emp_email" id="email"><br>
    <label>Password:</label><input type="text" name="emp_pswd" id="pswd"><br>
    <button onclick="insert()" id="btn">Submit</button>
    <!-- </form> -->
    <hr>
<h2>Fetch data</h2>
<hr>

<table border=1>
    <tr>
        <th>Sl.no</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Designation</th>
        <th>Email</th>
        <th>Password</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <tbody id="data">    </tbody>
</table>
<hr>
<h2>Update Data </h2>
<hr>
    <input type="hidden" name="uemp_name" id="uemp_id"><br>
    <label>Name:</label><input type="text" name="uemp_name" id="uemp_name"><br>
    <label>Age:</label><input type="text" name="uemp_age" id="uemp_age"><br>
    <label>Gender:</label><input type="text" name="uemp_gender" id="uemp_gender"><br>
    <label>Designation:</label><input type="text" name="uemp_desig" id="uemp_desig"><br>
    <label>Email:</label><input type="text" name="uemp_email" id="uemp_email"><br>
    <label>Password:</label><input type="text" name="uemp_pswd" id="uemp_pswd"><br>
    <button onclick="update( )" id="btn">Update</button>
    <script>

    $(document).ready(function(){
    $('#heading').html('Insert data')
    fetch()
    }
    )

function insert(){
    $.ajax({
        type:'POST',
        url:'db.php',
        data:{
            insert:'Insert',
            emp_name:$('#name').val(),
            emp_age:$('#age').val(),
            emp_gender:$('#gender').val(),
            emp_desig:$('#desig').val(),
            emp_email:$('#email').val(),
            emp_pswd:$('#pswd').val(),
        },success:function(data){
            alert('Inserted')
            fetch()
        }
    })
}

function fetch(){
           $.ajax({
            type:'GET',
            url:'db.php',
            data:{
                fetch:'fetch'
            },success:function(data){
                json_data=JSON.parse(data)
                html=""
                for(let i=0;i<json_data.length;i++){
                   html+= `<tr>
                   <td>`+(i+1)+`</td>
                   <td>`+json_data[i]['emp_name']+`</td>
                   <td>`+json_data[i]['emp_age']+`</td>
                   <td>`+json_data[i]['emp_gender']+`</td>
                   <td>`+json_data[i]['emp_desig']+`</td>
                   <td>`+json_data[i]['emp_email']+`</td>
                   <td>`+json_data[i]['emp_pswd']+`</td>
                   <td><button style="background-color:blue;color:white" onclick="edit(`+json_data[i]['emp_id']+`)">Edit</button></td>
                   <td><button style="background-color:red;color:white" onclick="del(`+json_data[i]['emp_id']+`)">Delete</button></td>
                   </tr>`
                }
                $('#data').html(html)

            }
           })
}



function edit(id){
    $.ajax({
        type:'POST',
        url:'db.php',
        data:{
            edit:'edit',
            id:id
        },success:function(data){
          d=JSON.parse(data)
          res=d[0]
          $('#uemp_id').val(res.emp_id)
          $('#uemp_name').val(res.emp_name)
          $('#uemp_age').val(res.emp_age)
          $('#uemp_gender').val(res.emp_gender)
          $('#uemp_desig').val(res.emp_desig)
          $('#uemp_email').val(res.emp_email)
          $('#uemp_pswd').val(res.emp_pswd)
          console.log(res)
        }
    })
}

function update(){
    $.ajax({
        type:'POST',
        url:'db.php',
        data:{
            update:'update',
            emp_id:$('#uemp_id').val(),
            emp_name:$('#uemp_name').val(),
            emp_age:$('#uemp_age').val(),
            emp_gender:$('#uemp_gender').val(),
            emp_desig:$('#uemp_desig').val(),
            emp_email:$('#uemp_email').val(),
            emp_pswd:$('#uemp_pswd').val(),
        },success:function(data){
           console.log(data);
           fetch()
        }

    })
}


function del(id){
    $.ajax({
        type:'POST',
        url:'db.php',
        data:{
            delete:'delete',
             id:id
            },success:function(data){
            console.log(data)
            fetch()
        }
    })
}

    </script>
