<?php

use RickAndMorty\Controllers\Controller;

return [
    ['GET', '/', [Controller::class, 'characters']],
    ['GET', '/locations', [Controller::class, 'locations']],
    ['GET', '/episodes', [Controller::class, 'episodes']],
];
