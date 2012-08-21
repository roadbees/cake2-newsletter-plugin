<?php

Router::connect('/manager/newsletter', array('controller' => 'newsletters', 'action' => 'dashboard','manager' => true, 'plugin' => 'newsletter'));

//Subscribe and Unsubcribe routes

Router::connect('/newsletter/subscribe', array('controller' => 'subscribers', 'action' => 'subscribe','manager' => false, 'plugin' => 'newsletter'));
Router::connect('/newsletter/unsubscribe', array('controller' => 'subscribers', 'action' => 'unsubscribe','manager' => false, 'plugin' => 'newsletter'));
