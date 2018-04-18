<?php
    $list_column = \DB::getSchemaBuilder()->getColumnListing($table);

	switch ($current_menu_item) {
        case 'categories':
            $title = 'Category';
            $list_action = ['create', 'edit', 'delete'];
            break;
        
        case 'questions': 
            $title = 'Question';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'roles':
            $title = 'Role';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'permissions':
            $title = 'Permission';
            $list_action = ['create', 'edit', 'delete'];
            break;

        case 'users':
            $list_action = ['edit'];
            $title = 'User';
        default:
            # code...
            $title = '';
            break;
    }
?>