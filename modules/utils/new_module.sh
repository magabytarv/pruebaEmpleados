#!/bin/bash

source server_structure.sh
source api_server.sh
source controller_server.sh
source model_server.sh
source view_server.sh

source client_structure.sh
source module_client.sh
source model_client.sh
source controller_client.sh
source view_client.sh

echo -e '\E[37;44m'"\033[1mIngrese nombre del modulo\033[0m"
read modulo

create_server_structure
create_api_server
create_controller_server
create_model_server
create_view_server

create_client_structure
create_module_client
create_model_client
create_controller_client
create_view_client

echo -e '\E[37;44m'"\033[1mSu modulo esta creado visite la url http://dirworkspace/mipac/modulos/server/$modulo\033[0m"
