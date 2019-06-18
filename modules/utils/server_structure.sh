#!/bin/bash

function create_server_structure()
{
    server_dir="../server/application/modules"
    server_folders_module=(models views controllers)

    for item in ${server_folders_module[*]}
    do
        mkdir -p $server_dir/$modulo/$item;
    done
}
