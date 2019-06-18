#!/bin/bash

function create_client_structure()
{
    client_dir="../client/src/app"
    client_folders_module=(views controllers)

    for item in ${client_folders_module[*]}
    do
        mkdir -p $client_dir/$modulo/$item;
    done
}
