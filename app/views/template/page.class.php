<?php
    require_once('./app/helpers/component.class.php');
    class Page extends Component{
        public static function templateHeader($title)
        {
            $path = PATH;
            print("
            <!DOCTYPE html>
            <html lang='en'>
                <head>
                    <meta charset='utf-8' />
                    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no' />
                    <meta name='description' content='' />
                    <meta name='author' content='' />
                    <title>$title</title>
                    <link rel='stylesheet' href='$path/app/views/assets/css/style.css'>
                    <!-- Favicon-->
                    <link rel='icon' type='image/x-icon' href='$path/app/views/assets/img/favicon.ico' />
                    <!-- Bootstrap icons-->
                    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css'>
                    <!-- Core theme CSS (includes Bootstrap)-->
                    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
                    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css'>
                    <!--SweetAlert -->
                    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
                </head>
                <body class='d-flex flex-column hv-100'>
                    <header>
            ");
            Page::templateNavbar();
            print("
                    </header>
                    <main class='flex-shrink-0'>
                        <h1 class='text-center my-3'>$title</h1>
                        <div class='container'>
            ");
            
        }

        public static function templateFooter()
        {
            $path = PATH;
            print("
                        </div>
                    </main>
                    <!-- Footer-->
                    <footer class='footer mt-auto py-3 bg-dark'>
                        <div class='container'>
                            <p class='m-0 text-center text-white'>Copyright &copy; Xavier Canjura and Salvador Gonzalez 2022</p>
                        </div>
                    </footer>
                    <!-- Bootstrap core JS-->
                    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'></script>
                    <!-- Core theme JS-->
                    <script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
                    <script src='http://localhost/desafio2/app/views/assets/js/jquery.dataTables.min.js'></script>
                    <script src='https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js'></script>
                    <script src='$path/app/views/assets/js/app.js'></script>
                    <script>
                        $(document).ready(function() {
                            $('#dataTable').DataTable({
                                language: {
                                    'info': 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                                    'emptyTable': 'No se encontraron datos',
                                    'zeroRecords': 'No se encontraron datos en la busqueda',
                                    'lengthMenu': 'Mostrar _MENU_ registros',
                                    'search': 'Buscar',
                                    'paginate': {
                                        'next': 'sig.',
                                        'previous': 'prev.' 
                                    }
                                },
                                'lengthMenu': [[5, 10, 20, 25, -1], [5, 10, 20, 25, 'Todos']]

                            });
                        } );
                    </script>
                </body>
            </html>
            ");
        }

        public static function templateNavbar()
        {
            if(preg_match("/^public/", $_GET['url']))
            {
                Page::templateNavbarPublic();
                Page::templateSlider();
            }
            else
            {
                if(isset($_SESSION['auth']))
                {
                    if( $_SESSION['auth']['id_tipo_usuario'] != 3)
                    {
                        Page::templateNavbarDash();
                    }
                    else
                    {
                        Page::templateNavbarPublic();
                    }
                }
                else
                {
                    Page::templateNavbarPublic();
                }
            }
        }

        public static function templateNavbarPublic()
        {
            $path = PATH;
            print("
            <!-- Navigation-->
            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container px-4 px-lg-5'>
                    <a class='navbar-brand' href='#!'>TextilExport</a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
                    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                        <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>
                            <li class='nav-item'><a class='nav-link active' aria-current='page' href='$path/public/'>Home</a></li>
                        </ul>
            ");
            if(isset($_SESSION['auth']))
            {
                print("
                    <ul class='navbar-nav'>
                            <li class='nav-item'>
                                <a class='nav-link' href='$path/public/cart/' aria-current='page role='button'>
                                    Carrito <pan id='countCart'></span>
                                </a>
                            </li>
                        </ul>
                        <ul class='navbar-nav'>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    ".$_SESSION['auth']['usuario']."
                                </a>
                                <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                    <li><a class='dropdown-item' href='#'>Action</a></li>
                                    <li><a class='dropdown-item' href='#'>Another action</a></li>
                                    <li><hr class='dropdown-divider'></li>
                                    <li><a class='dropdown-item' href='$path/auth/logout/'>Cerrar sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                ");
            }
            else
            {
                print("
                    <ul class='navbar-nav'>
                        <li class='nav-item'><a class='nav-link active' aria-current='page' href='$path/auth/login'>Iniciar sesion</a></li>
                    </ul>
                ");
            }
                        
            print("
                    </div>
                </div>
            </nav>
            ");
        }

        public static function templateNavbarDash()
        {
            $path = PATH;
            print("
            <!-- Navigation-->
            <nav class='navbar navbar-expand-lg navbar-light bg-light '>
                <div class='container px-4 px-lg-5'>
                    <a class='navbar-brand' href='#!'>TextilExport</a>
                    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
                    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                        <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'> 
            ");
                    print("<li class='nav-item'><a class='nav-link active' aria-current='page' href='$path/producto/'>Productos</a></li>");
            if($_SESSION['auth']['id_tipo_usuario'] == 1)
            {
                        print("
                            <li class='nav-item'><a class='nav-link' aria-current='page' href='$path/usuario/'>Usuarios</a></li>
                            <li class='nav-item'><a class='nav-link' aria-current='page' href='$path/cliente/'>Clientes</a></li>
                            <li class='nav-item'><a class='nav-link' aria-current='page' href='$path/categoria/'>Categorias</a></li>
                        ");
            }
                     print("<li class='nav-item'><a class='nav-link' aria-current='page' href='$path/venta/'>Ventas</a></li>");
            print("
                        </ul>
                        <ul class='navbar-nav'>
                            <li class='nav-item dropdown'>
                                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    ".$_SESSION['auth']['usuario']."
                                </a>
                                <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                    <li><a class='dropdown-item' href='#'>Action</a></li>
                                    <li><a class='dropdown-item' href='#'>Another action</a></li>
                                    <li><hr class='dropdown-divider'></li>
                                    <li><a class='dropdown-item' href='$path/auth/logout/'>Cerrar sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            ");
        }

        public static function templateNavbarLogin()
        {
            print("
            <!-- Navigation-->
            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
                <div class='container d-flex justify-content-center'>
                    <h3 class='text-center'>TextilExport</h3>
                </div>
            </nav>
            ");
        }

        public static function templateSlider()
        {
            print("
                <div class='slider'>
                    <div class='text-center text-white'>
                        <h1 class='display-4 fw-bolder'>Textil Export</h1>
                        <p class='lead fw-normal text-white-80 mb-0'>Empresa 100% salvadoreña y número 1 en ventas</p>
                    </div>
                </div>
            ");
        }
    }
?>