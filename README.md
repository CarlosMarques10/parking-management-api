API DE GERENCIAMENTO DE ESTACIONAMENTO

#Tecnologias utilizadas
-XAMPP
-Composer
-Insomnia
-PostgreSQL

*OBS: rodar o comando "composer install"

#Endpoints

- Adicionar uma categoria
http://localhost/parking-management/src/router?acao=insertCategory
Enviar um json. Exemplo:
{
    "name": "Carro",
    "rate": 4.00
}

- Listar todas as categorias
http://localhost/parking-management/src/router?acao=findAllCategory

-  Adicionar um veiculo
http://localhost/parking-management/src/router?acao=insertVehicle
Enviar um json. Exemplo:
{
    "idVehicleCategory": 1,
    "plate": "PPP9999"
}

- Adicionar uma entrada
http://localhost/parking-management/src/router?acao=insertVehicleEntry
Enviar um json. Exemplo:
{
    "date_entry": "30-03-2024 14:00",
    "id_vehicle": 1
}

- Adicionar uma saida
http://localhost/parking-management/src/router?acao=insertVehicleExit
Enviar um json. Exemplo:
{
    "date_exit": "30-03-2024 17:00",
    "id_vehicle": 1
}

- Listar veiculos com suas entradas, saidas, tempo de permanencia e taxa total 
http://localhost/parking-management/src/router?acao=findAllVehicles
