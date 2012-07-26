<?php

Router::connect('/manager/newsletter', array('controller' => 'newsletters', 'action' => 'dashboard','manager' => true, 'plugin' => 'newsletter'));