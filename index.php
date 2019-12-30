

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <title>Noticias</title>
</head>


<h4 class="mt-5">Listado de Posts</h4>

<button type="button" class="btn btn-info mt-2 mb-2" id="descarga">descargar PDF</button>

<table class="table table-striped table-bordered " id="noticias">
    <thead>
    <tr>
        <th scope="col">Seleccionar</th>
        <th scope="col">Fecha de Creacion</th>
        <th scope="col">Titulo</th>
        <th scope="col">Cuerpo</th>
    </tr>
    </thead>


    <!--    var_dump($notis);-->

    <tbody>
<!--    --><?php
//    while ($notis = mysqli_fetch_assoc($consulta)) { ?>
<!--    <tr>-->
<!---->
<!--        <td></td>-->
<!--        <td>--><?//= $notis['fecha_creacion'] ?><!--</td>-->
<!--        <td>--><?//= $notis['titulo'] ?><!--</td>-->
<!--        <td>--><?//= $notis['cuerpo'] ?><!--</td>-->
<!--    </tr>-->
<!--    </tbody>-->
<!--    --><?php //} ?>

</table>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script>

    $(document).ready(function () {

        $('#noticias').DataTable({
            processing: true,
            serverSide: true,
            order: [1, 'ASC'],
            ajax: 'listar_noticias_query.php',


            columns: [
                {
                    data: 'id', name: 'id',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html(
                            `<div class="form-check">
                                    <input type="checkbox" value="${oData.id}">
                              </div>`
                        );
                    }
                },
                {data: 'fecha_creacion', name: 'fecha_creacion'},
                {data: 'titulo', name: 'titulo'},
                {data: 'cuerpo', name: 'cuerpo'}
            ]
        });

        $('#descarga').click(function () {

            //alert('hola');
            let seleccionados= [];
            $('#noticias').find('[type=checkbox]').each(function (index, check) {
                let seleccionado = $(check).is(':checked');
                if (seleccionado){
                    seleccionados.push($(check).val())
                }
            });
            window.open(`listar_noticias_pdf.php?seleccionados=${seleccionados}`);


        })



    })

</script>
