<?php
session_start();

require_once 'class/Auth.php';
require_once 'class/Database.php';

if(!Auth::isLoggin()){
    header('location: index.php');
}

$db=new Database();
$conn=$db->getConnection();

$auth=new Auth($conn);
$getuserdata=$auth->getuserdata();


$username=$_SESSION['user']['name'];
$id=$_SESSION['user']['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>

 <div id="form" style="display:none">
    <form method="post" id="updateForm">
        <?php foreach($getuserdata as $upuser): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($upuser->id) ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($upuser->name) ?>">
        <?php endforeach; ?>
        <button type="button" id="update">Update</button>
        <button type="button" id="back">Back</button>
    </form>
</div>

    <div id="userdata">
        <a href="request_handle.php?id=<?=$id ?>">Logout</a>
        <a href="javascript:void();" id="edit"> Edit</a>



        <h1>Welcome
            <?= $username?>
        </h1>
        <table>
            <th>id</th>
            <th>name</th>

            <tbody>
                <?php foreach($getuserdata as $users):?>
                <tr>
                    <td>
                        <?= $users->id ?>
                    </td>
                    <td>
                        <?= $users->name?>
                    </td>

                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    </div>
    </div>

    <script>
        const edit = document.getElementById('edit');
        const userdata = document.getElementById('userdata');
        const update = document.getElementById('update');
        const back = document.getElementById('back');
        const form = document.getElementById('form');
        edit.addEventListener('click', function () {
            userdata.style.display = "none";
            form.style.display = "block";

        });
        back.addEventListener('click', function () {
            userdata.style.display = "block";
            form.style.display = "none";

        });

     update.addEventListener('click', async function () {
    const formdata = document.getElementById('updateForm');
    const formData = new FormData(formdata);

    // Create an empty object to hold form data
    const formObject = {};

    // Loop through all form fields and add them to the object
    formData.forEach((value, key) => {
        formObject[key] = value;
    });

    try {
        const response = await fetch('request_handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',  // Indicate that we're sending JSON
            },
            body: JSON.stringify(formObject),  // Convert the form data object to JSON
        });

        const result = await response.json(); // Assuming the response is in JSON format
        console.log(result); // Log or handle the response
    } catch (error) {
        console.error('Request failed', error);
    }
});



    </script>
</body>

</html>