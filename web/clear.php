<?php
//var_dump(exec("php ../app/console assets:install"));
var_dump(exec("php ../app/console assets:install --symlink"));
var_dump(exec("php ../app/console cache:clear --env=prod"));