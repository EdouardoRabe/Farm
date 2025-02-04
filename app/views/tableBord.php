<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Ferme</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Dashboard Ferme</h1>

        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form id="dateForm" method="POST" class="flex gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium mb-1">Date de fin</label>
                    <input type="date" name="dateFin" class="border rounded p-2" required>
                </div>
                <button type="button" id="submitBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Calculer
                </button>
            </form>
        </div>

        <div id="resultat" class="grid grid-cols-3 gap-6 mb-6 hidden">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-lg mb-2">Animaux</h3>
                <p class="text-3xl font-bold" id="stockAnimaux">0</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-lg mb-2">Nourriture</h3>
                <p class="text-3xl font-bold"><span id="stockNourriture">0</span> kg</p>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-lg mb-2">Capitaux</h3>
                <p class="text-3xl font-bold"><span id="capitaux">0</span> €</p>
            </div>

        </div>
        <table id="tableListAnimaux" class="w-full border-collapse border border-gray-300 mt-4 hidden">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">ID</th>
                    <th class="border border-gray-300 p-2">Type</th>
                    <th class="border border-gray-300 p-2">Poids</th>
                    <th class="border border-gray-300 p-2">Date d'achat</th>
                    <th class="border border-gray-300 p-2">Date de mort</th>
                    <th class="border border-gray-300 p-2">Image</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div id="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded hidden"></div>
    </div>

    <script>
        $('#submitBtn').click(function() {
            var dateFin = $('input[name="dateFin"]').val();
          

            if (!dateFin) {
                $('#error').text('La date de fin est requise').removeClass('hidden');
                return;
            }

            $.ajax({
                url: 'CalcultableauBord',
                method: 'POST',
                data: {
                    dateFin: dateFin
                },
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        $('#error').text(data.error).removeClass('hidden');
                    } else {
                        $('#resultat').removeClass('hidden');
                        $('#stockAnimaux').text(data.stock_animaux || 0);
                        $('#stockNourriture').text(data.stock_nourriture || 0);
                        $('#capitaux').text(data.capitaux || 0);
                       
                        var tableBody = $('#tableListAnimaux tbody');
                        tableBody.empty();
                        console.log(data.listanimaux);
                        if ( data.listanimaux) {  
                                  
                            data.listanimaux.forEach(function(animal) {
                                var row = `<tr>
                <td class="border border-gray-300 p-2">${animal.id_animal}</td>
                <td class="border border-gray-300 p-2">${animal.id_typeAnimal}</td>
                 <td class="border border-gray-300 p-2">${animal.poids}</td>
                <td class="border border-gray-300 p-2">${animal.date_achat || 'Non défini'}</td>
                <td class="border border-gray-300 p-2">${animal.date_mort || 'Non defini'}</td>
                 <td class="border border-gray-300 p-2"><img src="assets/img/${animal.image}" alt="img" style='width:100px; height:50px; text-align:center;'></td>
            </tr>`;
                                tableBody.append(row);
                            });
                            $('#tableListAnimaux').removeClass('hidden');
                        } else {
                            $('#tableListAnimaux').addClass('hidden');
                        }
                        
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log de l'erreur côté client
                    $('#error').text('Erreur de connexion').removeClass('hidden');
                }
            });
        });
    </script>
</body>

</html>