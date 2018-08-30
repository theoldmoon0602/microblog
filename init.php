<?php

require_once './utils.php';


unlink('database.db');
system('sqlite3 database.db < schema.sql');
system('chmod 0777 database.db');

register_user('admin', 'OCamlab{Blind_XXX_Injection}');
