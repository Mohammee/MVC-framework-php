
<style>
* {
    margin: 0;
    padding: 0;
    border: 0;
    outline: 0;
    font-size: 1rem;
    line-height: 1.2;
}

.wrapper {
    overflow: hidden;
}

.wrapper .appform {
   width: 400px;
   margin:0 auto;
}

.field {
    width: 400px;
    margin: 20px 0;
    padding: 10px;
    border: 1px solid #e4e4e4e4;
    background-color: #f1f1f1f1;
}

.field legend {
    background-color: #66666666;
    padding: 5px;
    font: 1em 'Arial ,sans-serif';
}

.wrapper .appform .field p.message {
    padding: 5px;
    text-align: center;
    width: 80%;
    margin: auto;
    background-color: #53AF50;
    color: white;
    font-size: .8em;
    font-family: 'Arial'
}

.wrapper .appform .field p.error {
    color: red;
}

.field table {
    width: 100%;
}

.field table tr td {
    padding: 1px;
}

.field table label {
    color: #555555;
    font-size: .9em;
    font-family: 'Arial'
}

.field table input[type='text'] {
    width: 98%;
    padding: 2%;
    margin: 3px 0 8px 0;
    font-family: 'Arial'
}

.field table input[type='number'] {
    width: 98%;
    padding: 2%;
    margin: 3px 0 8px 0;
    font-family: 'Arial'
}

.field table input[type='submit'] {
    padding: 5px 20px;
    background-color: #53AF50;
    border-radius: 2px;
    color: white;
    font-family: 'Arial'
}
</style>


 <div class="wrapper">

<form method="POST" class="appform" enctype="application/x-www-form-urlencoded" autocomplete="off">
    <fieldset class="field">
        <legend>Employees Information</legend>
        <table>
            <tr>
                <td><label for="name">Employee Name:</label></td>
            </tr>

            <tr>
                <td><input type="text" name='name' id="name" placeholder="Enter Employeee Name" value="<?= (isset($user))?$user->name:''; ?>" required></td>
            </tr>


            <tr>
                <td><label for="age">Employee Age:</label></td>
            </tr>

            <tr>
                <td><input type="number" name='age' id="age" min='21' max='66' required  value="<?= (isset($user))?$user->age:''; ?>"></td>
            </tr>


            <tr>
                <td><label for="address">Employee Address:</label></td>
            </tr>

            <tr>
                <td><input type="text" name='address' id="address" placeholder="Enter Employee Adrress" maxlength="50" required  value="<?= (isset($user))?$user->address:''; ?>"></td>
            </tr>

            <tr>
                <td><label for="salary">Employee Salary:</label></td>
            </tr>

            <tr>
                <td><input type="number" id="salary" name='salary' step="0.01" min='1500' max='9000' required  value="<?= (isset($user))?$user->salary:''; ?>"></td>
            </tr>


            <tr>
                <td><label for="tax">Employee Tax (%):</label></td>
            </tr>

            <tr>
                <td><input type="number" name='tax' id="tax" step="0.01" min='1' max='5' required  value="<?= (isset($user))?$user->tax:''; ?>"></td>
            </tr>


            <tr>
                <td><input type="submit" name='submit' value="Save" required></td>
            </tr>

        </table>
    </fieldset>
</form>
 </div>