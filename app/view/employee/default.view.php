<style>
    * {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 1rem;
    line-height: 1.2;
}

.wrapper .flash{
    width: 600px;
    margin: 0 auto;
    margin-top: 20px;
}

.wrapper .flash p.message {
    margin: 10px 0 20px 0;
    padding: 5px;
    text-align: center;
    width: 400px;
    background-color: #53AF50;
    color: white;
    font-size: .8em;
    font-family: 'Arial'
}

.wrapper .flash p.error{
    color:red;
}

.wrapper .employees {
    width: 700px;
    margin:0 auto;
    margin-top: 20px;
}
.wrapper .employees table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 100px;
}

.wrapper .employees table th {
    text-align: left;
    padding: 5px;
    border-right: 2px solid #e4e4e4e4;
    border-bottom: 2px solid #e4e4e4e4;
    font: bold 1em Arial Helvetica sans-serif;
    color: #666
}

.wrapper .employees table thead th:last-of-type {
    border-right: none;
}

.wrapper .employees tbody td {
    text-align: left;
    padding: 5px 0;
    border-bottom: 1px solid #e4e4e4e4;
    font: 0.9em Arial Helvetica sans-serif;
    color: #666;
}

.wrapper .employees tbody tr:nth-child(2n) td {
    background-color: #f1f1f1;
}

</style>

    <div class="wrapper">
    <div class="flash">

    <a href="/employee/add">Add New Employee</a>

    <?php if (isset($_SESSION['message'])) { ?>
            <p class="message <?php echo ((isset($_SESSION['error'])) ? 'error' : ''); ?>">
                <?php echo  $_SESSION['message'];
                unset($_SESSION['error']);
                unset($_SESSION['message']); ?></p> <?php } ?>
    </div>

    
<div class="employees">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Addres</th>
                        <th>Salary</th>
                        <th>Tax (%)</th>
                        <th>Controller</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($employee !== false) {
                        foreach ($employee as $employees) {
                    ?>
                            <tr>
                                <td><?= $employees->name; ?></td>
                                <td><?= $employees->age; ?></td>
                                <td><?= $employees->address; ?></td>
                                <td><?= $employees->salary; ?>$</td>
                                <td><?= $employees->tax; ?></td>
                                <td><a href="/employee/edit/<?= $employees->id ?>">Edit</a>
                                    <a href="/employee/delete/<?= $employees->id ?>" onclick="if(!confirm('Do tou want ot Delete this Employee?')) return false;">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <td colspan="5">Sorry the data empty</td>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>