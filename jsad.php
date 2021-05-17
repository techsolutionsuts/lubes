<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <script src="js/jquery-1.11.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link href="js/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript">
        $(document).ready(function () {
            var dialogDiv = $('#dialog');

            dialogDiv.dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    'Create': CreateEmployee,
                    'Cancel': function () {
                        dialogDiv.dialog('close');
                        clearInputFields();
                    }
                }
            });

            function CreateEmployee() {
                var emp = {};
                emp.FirstName = $('#txtFirstName').val();
                emp.LastName = $('#txtLastName').val();
                emp.Email = $('#txtEmail').val();

                $.ajax({
                    url: 'EmployeeService.asmx/SaveEmployee',
                    method: 'post',
                    data: '{ employee:' + JSON.stringify(emp) + '}',
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    success: function () {
                        loadEmployees();
                        dialogDiv.dialog('close');
                        clearInputFields();
                    }
                });
            }

            function loadEmployees() {
                var tboby = $('#employees tbody');
                tboby.empty();

                $.ajax({
                    url: 'EmployeeService.asmx/GetEmployees',
                    method: 'post',
                    dataType: 'json',
                    success: function (data) {
                        $(data).each(function () {
                            var tr = $('<tr></tr>')
                            tr.append('<td>' + this.FirstName + '</td>')
                            tr.append('<td>' + this.LastName + '</td>')
                            tr.append('<td>' + this.Email + '</td>')
                            tboby.append(tr);
                        })
                    }
                });
            }

            function clearInputFields() {
                $('#dialog input[type="text"]').val('');
            }

            $('#btnAddEmployee').click(function () {
                dialogDiv.dialog("open");
            });

            loadEmployees();
        });
    </script>
</head>
<body style="font-family: Arial">
<form action="savesales.php" id="form1" method="post">
     <div id="dialog">
            <table>
            <tr><td>
<center><h4><i class="icon icon-money icon-large"></i> Cash</h4></center><hr></td></tr>
  <tr><td><input type="hidde" id="txtFirstName" name="date" value="<?php echo date("m/d/y"); ?>" /></td></tr>
<tr><td><input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" /></td></tr>
<tr><td><input type="hidden" name="amount" value="<?php echo $_GET['total']; ?>" /></td></tr>
<tr><td><input type="hidden" name="ptype" value="<?php echo $_GET['pt']; ?>" /></td></tr>
<tr><td><input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" /></td></tr>
<tr><td><input type="hidden" name="profit" value="<?php echo $_GET['totalprof']; ?>" /></td></tr>
<center>
<tr><td><input type="text" size="25" value="" name="cname" id="txtLastName" onkeyup="suggest(this.value);" onblur="fill();" class="" autocomplete="off" placeholder="Enter Customer Name" style="width: 268px; height:30px;" /></td></tr>
     
            </table>
        </div>
        <table id="employees" style="border-collapse: collapse" border="1">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <br />
        <input type="button" id="btnAddEmployee" value="Add New Employee" />
    </form>
</body>
</html>
