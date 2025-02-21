<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- DATATABLES -->
    <link rel="stylesheet" href="../assets/css/datatable.min.css">
    <!-- JQUERY -->
    <title>Videogames</title>
</head>
<body>
    <main>
        <h1>Videogames</h1>
        <table id="videogameTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Tittle</th>
                    <th>Developer</th>
                    <th>Publisher</th>
                    <th>Release Date</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Difficulty</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>hola</td>
                    <td>hola</td>
                    <td>hola</td>
                    <td>hola</td>
                    <td>hola</td>
                    <td>hola</td>
                    <td>hola</td>
                </tr>
            </tbody>
        </table>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#videogameTable').DataTable();
        });
    </script>
</body>
</html>