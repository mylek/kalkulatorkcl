<?php
exec("php ../app/console assets:install");
exec("php ../app/console cache:clear --env=prod");