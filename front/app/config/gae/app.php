<?php
// gae
return array(
	'debug' => true,
    'providers' => append_config(array(
        'Mer\ServiceProvider\GAEViewServiceProvider',
    ))
);
