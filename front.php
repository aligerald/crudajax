<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/css/all.min.css" rel="stylesheet">
    <link href="./src/bootstrap.min.css" rel="stylesheet">
    <script src="./src/bootstrap.bundle.min.js"></script>
    <script src="./src/jquery.min.js"></script>
    <script src="./src/jquery.validate.js"></script>
    <title>FRONT</title>
</head>

<style>
    input {
        outline: none;
    }

    label.error {
        color: darkred;
    }

    input.error {
        border: 1px solid darkred;
    }
</style>

<body>
    <div class="container">
        <h1>Personas</h1>
        <div class="container mt-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#forModal"><i class="fa-solid fa-plus"></i></button>
            <div class="modal fade" id="forModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar Persona</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="insertar.php" id="formajax" method="POST">
                                <label for="nameper">Nombre</label>
                                <input id="nameper" name="nameper" class="m-2" /><br>
                                <label for="lastnameper">Apellido</label>
                                <input id="lastnameper" name="lastnameper" class="m-2" /><br>
                                <label for="datebirthper">Fecha de Nacimiento</label>
                                <input type="date" id="datebirthper" name="datebirthper" class="m-2" /><br>
                                <label for="addressper">Dirección</label>
                                <input id="addressper" name="addressper" class="m-2" /><br>
                                <label for="phoneper">Teléfono</label>
                                <input id="phoneper" name="phoneper" class="m-2" /><br>
                                <label for="emailper">Correo Electrónico</label>
                                <input id="emailper" name="emailper" class="m-2" /><br>
                                <button type="submit" id="insert_confirmm" class="btn btn-primary">Confirmar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="insert_cancell" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button name="insertperson" id="insertperson" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Agregar"><i class="fa-solid fa-plus"></i></button>
        <table id="tableajax" class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th colspan="2" style="text-align:center;">Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>

</html>

<script type="application/javascript">
    function addRow(row) {
        let tableajaxbody = $('#tableajax>tbody');
        let newRow = '<tr data-id_per="' + row.id_per + '">' +
            '<td>' + row.name_per + '</td>' +
            '<td>' + row.lastname_per + '</td>' +
            '<td>' + row.datebirth_per + '</td>' +
            '<td>' + row.address_per + '</td>' +
            '<td>' + row.phone_per + '</td>' +
            '<td>' + row.email_per + '</td>' +
            '<td><button class="btn btn-primary data-toggle="tooltip" data-placement="bottom" title="Editar"edit" onclick="editRow($(this).closest(\'tr\'));"><i class="fa-solid fa-square-pen"></i></button></td>' +
            '<td><button class="btn btn-danger data-toggle="tooltip" data-placement="bottom" title="Eliminar" delete" onclick="deleteRow($(this).closest(\'tr\'));"><i class="fa-regular fa-trash-can"></i></button></td>' +
            '</tr>';
        tableajaxbody.append(newRow);
    }

    function getEditRow(row) {
        console.log(row);
        return '<tr data-id_per="' + row.attr('data-id_per') + '">' +
            '<td><input id="name_per" name="name_per" value="' + row.children()[0].textContent + '"/></td>' +
            '<td><input id="lastname_per" name="lastname_per" value="' + row.children()[1].textContent + '"/></td>' +
            '<td><input id="datebirth_per" name="datebirth_per" value="' + row.children()[2].textContent + '"/></td>' +
            '<td><input id="address_per" name="address_per" value="' + row.children()[3].textContent + '"/></td>' +
            '<td><input id="phone_per" name="phone_per" value="' + row.children()[4].textContent + '"/></td>' +
            '<td><input id="email_per" name="email_per" value="' + row.children()[5].textContent + '"/></td>' +
            '<td><button id="edit_confirm" class="btn btn-success">Confirm</button></td>' +
            '<td><button id="edit_cancel" class="btn btn-secondary">Cancel</td>' +
            '</tr>';
    }

    function editRow(row) {
        let oldRow = row.clone();
        let editRow = getEditRow(row);
        let nextRow = row.next();
        let tableajaxbody = $('#tableajax>tbody');
        row.remove();
        if (nextRow.children().lenght) {
            $(editRow).insertBefore(nextRow);
        } else {
            tableajaxbody.append(editRow);
        }
        $('#edit_confirm').click(function() {
            let row = $(this).closest('tr');
            let id_per = row.attr('data-id_per');
            let data = {
                name_per: row.find('input[name="name_per"]').val(),
                lastname_per: row.find('input[name="lastname_per"]').val(),
                datebirth_per: row.find('input[name="datebirth_per"]').val(),
                address_per: row.find('input[name="address_per"]').val(),
                phone_per: row.find('input[name="phone_per"]').val(),
                email_per: row.find('input[name="email_per"]').val(),
            }
            $.ajax('back.php?id_per=' + id_per, {
                method: 'PUT',
                data: data,
                success: function() {
                    row.remove();
                    oldRow.children()[0].textContent = data.name_per;
                    oldRow.children()[1].textContent = data.lastname_per;
                    oldRow.children()[2].textContent = data.datebirth_per;
                    oldRow.children()[3].textContent = data.address_per;
                    oldRow.children()[4].textContent = data.phone_per;
                    oldRow.children()[5].textContent = data.email_per;

                    if (nextRow.children().lenght) {
                        $(oldRow).insertBefore(nextRow);
                    } else {
                        tableajaxbody.append(oldRow);
                    }
                },
                error: function(jqXHR, textStatus, errorThrwn) {
                    alert(errorThrwn);
                }
            });
        });
        $('#edit_cancel').click(function() {
            $(this).closest('tr').remove();

            if (nextRow.children().lenght) {
                oldRow.insertBefore(nextRow);
            } else {
                tableajaxbody.append(oldRow);
            }
        });
    };

    function deleteRow(row) {
        let id_per = row.attr('data-id_per');
        let email_per = row.children()[5].textContent;
        if (confirm("Confirmas que quieres eiminar " + email_per)) {
            $.ajax({
                url: 'back.php?id_per=' + id_per,
                type: 'DELETE',
                success: function(result) {
                    row.remove();
                },
                error: function() {
                    alert('Fallo el servidor');
                }
            });
        }
    }

    $(document).ready(function() {
        $.get('back.php', function(resp) {
            let results = JSON.parse(resp);
            $.each(results, function(i, row) {
                addRow(row);
            });
        });
        $("#formajax").validate({
            rules: {
                nameper: {
                    required: true,
                    isLetters: true,
                    minlength: 3,
                    maxlength: 30
                },
                lastnameper: {
                    required: true,
                    isLetters: true,
                    minlength: 3,
                    maxlength: 30
                },
                datebirthper: {
                    required: true,
                    date: true
                },
                addressper: {
                    required: true
                },
                phoneper: {
                    required: true,
                    number: true
                },
                emailper: {
                    required: true,
                    email: true
                },
            },
            messages: {
                nameper: {
                    required: "Por favor ingrese su nombre",
                    isLetters: "Por favor ingrese un nombre correcto",
                    minlength: "Ingrese un nombre valido",
                    maxlength: "Ingrese un nombre valido"
                },
                lastnameper: {
                    required: "Por favor ingrese su apellido",
                    isLetters: "Por favor ingrese un apellido correcto",
                    minlength: "Ingrese un apellido valido",
                    maxlength: "Ingrese un apellido valido"
                },
                datebirthper: {
                    required: "Por favor ingrese su fecha de nacimeinto",
                    date: "Ingrese una fecha valida"
                },
                addressper: {
                    required: "Por favor ingrese su dirección"
                },
                phoneper: {
                    required: "Por favor ingrese su teléfono",
                    email: "Ingrese un teléfono valido"
                },
                emailper: {
                    required: "Por favor ingrese su correo electrónico",
                    email: "Ingrese un email valido"
                },
            },
        });
    });

    $('#insertperson').click(function() {
        $('#insertperson').prop('disabled', true);
        $('#tableajax>tbody').append(
            '<tr>' +
            '<td><input id="name_per" name="name_per"/></td>' +
            '<td><input id="lastname_per" name="lastname_per"/></td>' +
            '<td><input  type="date" id="datebirth_per" name="datebirth_per"/></td>' +
            '<td><input id="address_per" name="address_per"/></td>' +
            '<td><input id="phone_per" name="phone_per"/></td>' +
            '<td><input id="email_per" name="email_per"/></td>' +
            '<td><button id="insert_confirm" class="btn btn-primary">Confirmar</button></td>' +
            '<td><button id="insert_cancel" class="btn btn-secondary">Cancelar</td>' +
            '</tr>'
        );
        let newRow = $('#tableajax>tbody').children().last();
        $('#insert_confirm').click(function() {
            let data = {
                name_per: $('#name_per').val(),
                lastname_per: $('#lastname_per').val(),
                datebirth_per: $('#datebirth_per').val(),
                address_per: $('#address_per').val(),
                phone_per: $('#phone_per').val(),
                email_per: $('#email_per').val()
            };
            $.post('back.php', data, function(resp) {
                newRow.remove();
                data.id_per = resp;
                addRow(data);
            });
            $('#insertperson').prop('disabled', false);
        });
        $('#insert_cancel').click(function() {
            newRow.remove();
            $('#insertperson').prop('disabled', false);
        });
    });
</script>