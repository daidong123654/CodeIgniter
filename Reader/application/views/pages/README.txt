this is a test phpprogramme if you want to run it please make changes as follows:
application/config/routes.php :
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';

then goto :

http://localhost/Library/CodeIgniter_2.1.2/index.php/home/
or http://localhost/Library/CodeIgniter_2.1.2/index.php/about/
